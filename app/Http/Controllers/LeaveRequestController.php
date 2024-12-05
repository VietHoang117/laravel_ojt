<?php

namespace App\Http\Controllers;

use App\Models\ProposalType;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use App\Enums\LeaveStatusEnum;
use Illuminate\Support\Facades\Validator;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $data = Proposal::query()
            ->with('user', 'type', 'attachments')
            ->OwnedByUserGroup()
            ->paginate(10);
        $dexuats = ProposalType::all();
        $nguoiquanlys = User::all();

        $status = LeaveStatusEnum::getValues();

        return view('admin.leave.index', [
            'data' => $data,
            'dexuats' => $dexuats,
            'nguoiquanlys' => $nguoiquanlys,
            'status' => $status,
            'leaveStatusEnum' => LeaveStatusEnum::class,
        ]);

    }


    public function save(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'proposal_type_id' => 'required',
            'proposal_name' => 'required',
            'content' => 'required|string',
            'user_manager_id' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $data = $request->only([
            'proposal_type_id',
            'proposal_name',
            'content',
            'user_manager_id',
            'day_off',
            'from_date',
            'to_date'
        ]);

        $data['user_id'] = Auth::id();
        $proposal = Proposal::create($data);

        // Xử lý file đính kèm nếu có

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if ($file) { // Kiểm tra file có tồn tại
                    $filePath = $file->store('attachments'); // Lưu file vào thư mục 'attachments'

                    // Lưu thông tin file vào bảng attachments
                    Attachment::create([
                        'proposal_id' => $proposal->id,
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $filePath,
                    ]);
                }
            }
        }

        return back()->with('success', 'Đã tạo đề xuất thành công');

    }

    public function approval(Request $request, $id)
    {
        //validate
        $data = Proposal::findOrFail($id);
        if ($data) {
            $data->update(['user_reviewer_id' => $request->input('approver'), 'status' => LeaveStatusEnum::SEND]);
        }
        return back()->with('success', 'Gửi duyệt thành công');
    }

    public function browse(Request $request, $id)
    {
        //validate
        $data = Proposal::findOrFail($id);

        // Kiểm tra quyền trực tiếp
        if ($data->user_reviewer_id !== Auth::id()) {
            return back()->with('error', 'Bạn không có quyền duyệt');
        }

        // Cập nhật trạng thái
        $data->update(['status' => $request->input('browse')]);

        return back()->with('success', 'Đã gửi thành công');

    }

}

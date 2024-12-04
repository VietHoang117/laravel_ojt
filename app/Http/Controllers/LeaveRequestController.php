<?php

namespace App\Http\Controllers;

use App\Models\ProposalType;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Enums\LeaveStatusEnum;

class LeaveRequestController extends Controller
{
    public function index()
    {

        $data = Proposal::with('user')->paginate(10);
        $dexuats = ProposalType::all(); // with('user)
        $nguoiquanlys = User::all();

        $status = LeaveStatusEnum::getValues();
        return view('admin.leave.index', ['data' => $data, 'dexuats' => $dexuats, 'nguoiquanlys' => $nguoiquanlys]);
    }


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proposal_name' => 'required',
            'content' => 'required|string',
            'user_manager_id' => 'required|exists:user_id',
            'user_reviewer_id' => 'nullable|exists:user_manager_id',
        ]);
    
        // Nếu dữ liệu không hợp lệ, trả về kèm thông báo lỗi
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'proposal_type_id',
            'proposal_name',
            'content',
            'user_manager_id'
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


        return redirect()->route('leaves.index')->with('success', 'Đã tạo đề xuất thành công');

    }

}
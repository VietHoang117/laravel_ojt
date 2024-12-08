<?php

namespace App\Http\Controllers;

use App\Models\ProposalType;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use App\Enums\LeaveStatusEnum;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ApprovalMail;
use Illuminate\Support\Facades\DB;

class LeaveRequestController extends Controller
{
    public function index(Request $request)
    {
        // Lấy giá trị từ input 'search'
        $search = $request->input('search');

        // Xây dựng query tìm kiếm
        $data = Proposal::query()
            ->with(['user', 'type', 'attachments', 'reviewer'])
            ->OwnedByUserGroup();

        if (!empty($search)) {
            $data->where(function ($query) use ($search) {
                $query->where('proposal_name', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $data = $data->paginate(7);

        // Các dữ liệu khác
        $dexuats = ProposalType::all();
        $nguoiquanlys = User::all();
        $status = LeaveStatusEnum::getValues();
        $type_of_vacations = [
            (object) [
                'name' => 'Sáng'
            ],
            (object) [
                'name' => 'Chiều'
            ]
        ];

        $rest_types = [
            (object) [
                'name' => 'Nghỉ phép'
            ],
            (object) [
                'name' => 'Nghỉ không phép'
            ]
        ];


        return view('admin.leave.index', [
            'data' => $data,
            'dexuats' => $dexuats,
            'nguoiquanlys' => $nguoiquanlys,
            'status' => $status,
            'leaveStatusEnum' => LeaveStatusEnum::class,
            'search' => $search,
            'type_of_vacations' => $type_of_vacations,
            'rest_types' => $rest_types
        ]);
    }



    public function save(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'proposal_type_id' => 'required',
            'proposal_name' => 'required',
            'content' => 'required|string',
            'from_date' => 'required',
            'to_date' => 'required'
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $data = $request->only([
            'proposal_type_id',
            'proposal_name',
            'content',
            'type_of_vacation',
            'rest_type',
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
        try {
            DB::beginTransaction();

            $data = Proposal::findOrFail($id);
            if ($data) {
                // Cập nhật thông tin người duyệt nhưng chưa commit
                $data->update(['user_reviewer_id' => $request->input('approver'), 'status' => LeaveStatusEnum::SEND]);

                $approver = User::where('id', $request->input('approver'))->first();

                // Kiểm tra nếu người duyệt tồn tại và có email
                if ($approver && $approver->email) {
                    Mail::to($approver->email)->send(new ApprovalMail([
                        'name' => 'Xin chào ' . $approver->name,
                        'content' => 'Mày hãy vào duyệt đề xuất xin nghỉ này: ' . $data->proposal_name,
                        'link' => env('APP_URL') . 'admin/leaves'
                    ]));
                } else {
                    throw new \Exception('Người duyệt không hợp lệ hoặc không có email.');
                }
            }
            DB::commit(); // Commit nếu mọi thứ thành công
            return back()->with('success', 'Đã cập nhật và gửi email thành công.');
        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', 'Không thể gửi email hoặc cập nhật: ' . $e->getMessage());
        }

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

    public function delete($id)
    {
        $data = Proposal::query()->findOrFail($id);
        $data->delete();
        return back()->with('success', 'Xóa thành công!');
    }
}

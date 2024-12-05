@extends('layouts.main')
@section('title', 'Đề xuất nghỉ phép')

@section('content')
    <h1>Đề xuất</h1>

    <div class="card-body">
        <form action="{{ route('leaves.save') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Modal -->
            <div class="modal fade" id="exampleModalLeaves" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Đề Xuất</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="type" class="form-label">Loại đề xuất</label>
                                        <select class="form-select" id="type" name="proposal_type_id"
                                            onchange="toggleDateFields()">
                                            <option value="">Chọn loại đề xuất</option>
                                            @foreach ($dexuats as $item)
                                                <option value="{{ $item->id }}">{{ $item->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="proposal_name" class="col-form-label">Tên Đề Xuất:</label>
                                <input type="text" class="form-control" id="proposal_name" name="proposal_name">
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-form-label">Nội Dung:</label>
                                <textarea class="form-control" id="content" name="content"></textarea>
                            </div>
                            <div class="form-group" id="day_off_none">
                                <label for="day_off" class="col-form-label">Ngày nghỉ:</label>
                                <input type="date" class="form-control" id="day_off" name="day_off">
                            </div>

                            <div id="date-fields" style="display: none;">
                                <div class="form-group">
                                    <label for="from_date" class="col-form-label">Từ ngày:</label>
                                    <input type="date" class="form-control" id="from_date" name="from_date">
                                </div>

                                <div class="form-group">
                                    <label for="to_date" class="col-form-label">Đến ngày:</label>
                                    <input type="date" class="form-control" id="to_date" name="to_date">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Người Quản Lí</label>
                                <select class="form-select" name="user_manager_id">
                                    <option value="">Chọn Quản Lí</option>
                                    @foreach ($nguoiquanlys as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="attachments" class="form-label">Tệp đính kèm</label>
                                <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                                <small class="form-text text-muted">Kéo thả tệp đính kèm vào đây.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Table -->

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="get" action="{{ route('leaves.index') }}">
                    <div class="input-group">
                        <input class="form-control" name="search" value="{{ request('search') }}"
                            placeholder="Tìm Kiếm...">
                        <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                    </div>
                </form>
            </div>



            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLeaves">
                    Làm Đơn
                </button>
            </div>
        </div>

        <table id="payrollTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Mã số</th>
                    <th>Tên đề xuất</th>
                    <th>Ngày tạo</th>
                    <th>Người tạo</th>
                    <th>Người duyệt</th>
                    <th>Trạng Thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->proposal_name }}</td>
                        <td>{{ $value->created_at->format('d-m-Y') }}</td>
                        <td>{{ $value->user->name ?? 'N/A' }}</td>
                        <td>{{ $value->reviewer->name ?? 'Chưa chỉ định' }}</td>
                        <td>{{ $value->status }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#showFormModal-{{ $value->id }}" title="Hiển thị thông tin chi tiết">
                                Hiển Thị
                            </button>

                            <!-- Gửi người duyệt -->
                            @if ($value->status === $leaveStatusEnum::DRAFT)
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#approvalFormModal-{{ $value->id }}"
                                    title="Chỉ đích danh người duyệt">
                                    Người duyệt
                                </button>

                                <a href="{{ route('leaves.delete', $value->id) }}" class="btn btn-danger"
                                    onclick="return confirmDelete()">
                                    Xóa
                                </a>
                            @endif

                            @if ($value->status === $leaveStatusEnum::SEND && Auth::id() === $value->user_reviewer_id)
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#approvalFormModalUser-{{ $value->id }}">
                                    Duyệt
                                </button>
                            @endif

                            <!-- Hiển Thị -->
                            <div class="modal fade" id="showFormModal-{{ $value->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="showFormModalLabel-{{ $value->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="showFormModalLabel-{{ $value->id }}">
                                                Thông tin chi tiết - {{ $value->proposal_name }}
                                            </h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body bg-light">
                                            <!-- Hiển thị thông tin chi tiết -->
                                            <div class="row mb-3">
                                                <div class="col-sm-4 text-end fw-bold">Mã số:</div>
                                                <div class="col-sm-8 text-dark">{{ $value->id }}</div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-4 text-end fw-bold">Loại đề xuất:</div>
                                                <div class="col-sm-8 text-dark">{{ $value->type->type_name ?? 'Chưa có' }}
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-4 text-end fw-bold">Tên đề xuất:</div>
                                                <div class="col-sm-8 text-dark">{{ $value->proposal_name }}</div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-4 text-end fw-bold">Ngày tạo:</div>
                                                <div class="col-sm-8 text-dark">
                                                    {{ $value->created_at->format('d-m-Y') }}
                                                </div>
                                            </div>
                                            @if ($value->day_off)
                                                <div class="row mb-3">
                                                    <div class="col-sm-4 text-end fw-bold">Ngày Nghỉ:</div>
                                                    <div class="col-sm-8 text-dark">
                                                        {{ $value->day_off ? $value->day_off : '' }}
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($value->from_date)
                                                <div class="row mb-3">
                                                    <div class="col-sm-4 text-end fw-bold">Từ Ngày:</div>
                                                    <div class="col-sm-8 text-dark">
                                                        {{ $value->from_date ? $value->from_date : '' }}
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($value->to_date)
                                                <div class="row mb-3">
                                                    <div class="col-sm-4 text-end fw-bold">Đến Ngày:</div>
                                                    <div class="col-sm-8 text-dark">
                                                        {{ $value->to_date ? $value->to_date : '' }}
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row mb-3">
                                                <div class="col-sm-4 text-end fw-bold">Nội dung:</div>
                                                <div class="col-sm-8 text-dark">{{ $value->content }}</div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-4 text-end fw-bold">Người tạo:</div>
                                                <div class="col-sm-8 text-dark">{{ $value->user->name ?? 'N/A' }}</div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-4 text-end fw-bold">Người Quản Lý:</div>
                                                <div class="col-sm-8 text-dark">
                                                    {{ $value->manager->name ?? '' }}</div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-4 text-end fw-bold">Người duyệt:</div>
                                                <div class="col-sm-8 text-dark">
                                                    {{ $value->reviewer->name ?? 'Chưa chỉ định' }}</div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-sm-4 text-end fw-bold">Trạng thái:</div>
                                                <div class="col-sm-8">
                                                    <span
                                                        class="badge 
                                                        @if ($value->status === 'Gửi') bg-warning 
                                                        @elseif($value->status === 'Chấp Nhận') bg-success 
                                                        @elseif($value->status === 'Từ chối') bg-danger 
                                                        @else bg-secondary @endif">
                                                        {{ $value->status }}
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Hiển thị tệp đính kèm nếu có -->
                                            @if (!empty($value->attachments))
                                                <div class="row mb-3">
                                                    <div class="col-sm-4 text-end fw-bold">Tệp đính kèm:</div>
                                                    <div class="col-sm-8">
                                                        @foreach ($value->attachments as $attachment)
                                                            <p>{{ $attachment->file_name }}</p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- Form ẩn -->
                            <div class="modal fade" id="approvalFormModal-{{ $value->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="approvalFormModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="approvalFormModalLabel">Chỉ chỉ đích danh người
                                                duyệt</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('leaves.approval', ['id' => $value->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="approver">Người duyệt:</label>
                                                    <select class="form-control" id="approver" name="approver">
                                                        <option value="">Chọn người duyệt</option>
                                                        <!-- Thêm các option trong backend -->
                                                        @foreach ($nguoiquanlys as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-success">Xác nhận</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Hủy</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form duyệt -->
                            <div class="modal fade" id="approvalFormModalUser-{{ $value->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="approvalFormModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="approvalFormModalLabel">Duyệt</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('leaves.browse', ['id' => $value->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="approver">Chọn trạng thái:</label>
                                                    <select class="form-control" id="approver" name="browse">
                                                        <option value="">Chọn trạng thái</option>
                                                        <option value="{{ $leaveStatusEnum::ACCEPT }}">
                                                            {{ $leaveStatusEnum::ACCEPT }}</option>
                                                        <option value="{{ $leaveStatusEnum::REFUSE }}">
                                                            {{ $leaveStatusEnum::REFUSE }}</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-success">Xác nhận</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Hủy</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function toggleDateFields() {
            const select = document.getElementById('type');
            const dateFields = document.getElementById('date-fields');
            const dateFieldsNone = document.getElementById('day_off_none');

            // Hiển thị các trường nếu giá trị là "2"
            if (select.value === "2") {
                dateFields.style.display = 'block';
                dateFieldsNone.style.display = 'none';
            } else {
                dateFields.style.display = 'none';
                dateFieldsNone.style.display = 'block';
            }
        }

        function toggleApprovalForm() {
            const form = document.getElementById('approvalForm');

            // Hiện hoặc ẩn form với hiệu ứng mượt
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
@endsection

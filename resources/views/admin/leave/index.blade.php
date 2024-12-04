@extends('layouts.main')
@section('title', 'Đề xuất nghỉ phép')

@section('content')
<h1>Đề xuất</h1>

<div class="card-body">
    <form action="{{ route('leaves.save') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLeaves" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <select class="form-select" id="type" name="proposal_type_id">
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
    <div class="row mb-3">
        <div class="col-md-6">
            <form method="GET" action="{{ route('leaves.index') }}">
                <div class="input-group">
                    <input class="form-control" name="search" placeholder="Tìm Kiếm...">
                    <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLeaves">
                Phản Hồi
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
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->proposal_name }}</td>
            <td>{{ $value->created_at->format('d-m-Y') }}</td>
            <td>{{ $value->user->name ?? 'N/A' }}</td>
            <td>{{ $value->manager->name ?? 'Chưa chỉ định' }}</td>
            <td>{{ $value->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

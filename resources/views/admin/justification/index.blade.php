@extends('layouts.main')
@section('title')
Duyệt Giải Trình
@stop
@section('content')

<h1>Duyệt Ngày Công</h1>

<form method="GET" action="{{ route('justifications.index') }}">
    <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">
    <button type="submit">Tìm kiếm</button>
</form>



<div class="card-body">
    <table id="payrollTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Nhân Viên</th>
                <th>Ngày Chấm Công</th>
                <th>Lý do </th>
                <th>Phản hồi của admin</th>
                <th>Trạng Thái </th>
                <th>Hành Động</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->user->name }}</td>
                <td>{{ $value->attendance->created_at }}</td>
                <td>{{ $value->reason }}</td>
                <td>{{ $value->response }}</td>
                <td>{{ $value->status }}</td>
                <td>
                    <form action="{{ route('justifications.submit', ['id' => $value->id]) }}" method="POST">
                        @csrf
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Giải Trình</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- <form> -->

                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Phản Hồi:</label>
                                            <textarea class="form-control" id="message-text" name="response"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Phòng ban</label>
                                            <select class="form-select" name="status">
                                                <option value="">--- Chọn Trạng Thái ---</option>
                                                @foreach ($status as $item)
                                                <option value="{{ $item }}">
                                                    {{ $item }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary">Gửi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                        data-id="{{ $value->id }}">Phản Hồi</button>


                    <a href="{{ route('justifications.delete', $value->id) }}" class="btn btn-danger"
                        onclick="return confirmDelete()">
                        Xóa
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
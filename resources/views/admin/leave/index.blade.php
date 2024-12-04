@extends('layouts.main')
@section('title')
    Đề xuất nghỉ phép
@stop
@section('content')

    <h1>Đề xuất</h1>
    <div class="card-body">
        <table id="payrollTable" class="table table-bordered table-hover">
        <div class="col-md-6">
                    <div class="form-group">
                        <form method="get" action="{{ route('search') }}">
                            <div class="input-group">
                                <input class="form-control" name="search" placeholder="Tìm Kiếm...">
                                <button type="submit" class="btn btn-primary">Tìm Kiếm </button>
                            </div>
                        </form>
                    </div>
                </div>
            <thead>
                <tr>
                    <th>Mã số</th>
                    <th>Tên đề xuất</th>
                    <th>Ngày tạo</th>
                    <th>Người tạo</th>
                    <th>Người duyệt</th>
                    <th>Trạng Thái </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <p class="text-red">
                                {{ $value->loai_de_xuat }}

                            </p>
                            <p>
                                {{ $value->ten_de_xuat }}
                            </p>
                        </td>
                        <td>{{ $value->ngay_lap }}</td>
                        <td>{{ $value->user }}</td>
                        <td>{{ $value->user_reviewer }}</td>
                        <td>{{ $value->status }}</td>
                        <td>
                            <form action="{{ route('leaves.save', ['id' => $value->id]) }}" method="POST">
                                @csrf
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal-{{ $value->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel-{{ $value->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel-{{ $value->id }}">Trả Lời
                                                    Giải Trình</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Phản Hồi:</label>
                                                    <textarea class="form-control" id="message-text-{{ $value->id }}" name="response"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Trạng Thái</label>
                                                    <select class="form-select" name="status">
                                                        <option value="">--- Chọn Trạng Thái ---</option>
                                                        @foreach ($status as $item)
                                                            <option value="{{ $item }}">{{ $item }}
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

                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal-{{ $value->id }}">
                                Phản Hồi
                            </button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection

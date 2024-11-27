@extends('layouts.main')
@section('title')
Danh sách mail
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 text-left">
            <h4>Danh sách cấu hình email</h4>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('configurations.store') }}" class="col-md-2 btn btn-primary float-right">Thêm Mới</a>
        </div>
        <div class="card-body">
            <table id="payrollTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên nhân viên</th>
                        <th>Email</th>
                        <th>Thời gian gửi mail</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)

                        <tr>
                            <td>{{$value->id}}</td>
                            <td>
                                {{ $value->user->name }}
                            </td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->reminder_time }}</td>
                            <td>
                                <a href="{{ route('configurations.edit', $value->id) }}" class="btn btn-success">Sửa</a>
                                <a href="{{ route('configurations.delete', $value->id) }}" class="btn btn-danger"
                                    onclick="return confirmDelete()">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $data->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
@extends('layouts.main')
@section('title')
Danh sách mail
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 text-left">
            <h1 style="font-size: 30px; font-weight: bold;">Danh sách cấu hình email</h1>
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
@extends('layouts.main')
@section('title')
Bậc Lương
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 text-left">
            <h4>Quản Lý Bảng Lương</h4>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('salarylevels.store') }}" class="col-md-2 btn btn-primary float-right">Thêm Mới</a>
        </div>
        <div class="card-body">
            <table id="payrollTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Bậc Lương</th>
                        <th>Lương Ngày</th>
                        <th>Lương Tháng</th>
                        <th>Hành Động</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$value)
                    
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{ $value->level_name }}</td>
                        <td>{{ $value->daily_rate }}</td>
                        <td>{{ $value->monthly_rate }}</td>
                        <td>
                            <a href="{{ route('salarylevels.edit', $value->id) }}" class="btn btn-success">Sửa</a>
                            <a href="{{ route('salarylevels.delete', $value->id) }}" class="btn btn-danger" onclick="return confirmDelete()">
                                Xóa
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>
@endsection
@extends('layouts.main')
@section('title')
Bảng Lương
@stop
@section('content')
<div class="container-fluid">

    
    

    <div class="row">
        <div class="col-md-6 text-left">
            <h4>Quản Lý Bảng Lương Theo Tháng</h4>
            <a href="{{ route('export.payrolls') }}" class="btn btn-primary">Export Users</a>

        </div>
        
        <div class="col-md-6 text-right">
            @if(App\Helpers\PermissionHelper::can('update_payroll'))
                <a href="{{ route('payrolls.update-wage') }}" class="col-md-3 btn btn-primary float-right">Cập nhật lương
                    tháng này</a>
            @endif
        </div>
        <div class="card-body">
            <table id="payrollTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Nhân Viên</th>
                        <th>Bậc Lương</th>
                        <th>Phòng Ban</th>
                        <th>Tháng</th>
                        <th>Số Ngày Công Hợp Lệ</th>
                        <th>Số Ngày Công Không Hợp Lệ</th>
                        <th>Lương Nhận Được</th>
                        <th>Hành Động</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)

                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{ $value->user->name }}</td>
                            <td>{{ $value->salarylevel->level_name }}</td>
                            <td>{{ $value->user->department ? $value->user->department->room_name : '' }}</td>
                            <td>{{ $value->month }}</td>
                            <td>{{ $value->valid_workdays }}</td>
                            <td>{{ $value->invalid_workdays }}</td>
                            <td>{{ number_format($value->salary_received, 0) }} VND</td>
                            <td>
                                <a href="{{ route('payrolls.edit', $value->id) }}" class="btn btn-success">Sửa</a>
                                <a href="{{ route('payrolls.delete', $value->id) }}" class="btn btn-danger"
                                    onclick="return confirmDelete()">
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
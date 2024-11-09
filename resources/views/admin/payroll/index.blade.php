@extends('layouts.main')
@section('title')
Bảng Lương
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 text-left">
            <h4>Quản Lý Bảng Lương</h4>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('payrolls.store') }}" class="col-md-2 btn btn-primary float-right">Thêm Mới</a>
        </div>
        <div class="card-body">
            <table id="payrollTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Nhân Viên</th>
                        <th>Email</th>
                        <th>Phòng Ban</th>
                        <th>Tháng</th>
                        <th>Số Ngày Công Hợp Lệ</th>
                        <th>Số Ngày Công Không Hợp Lệ</th>
                        <th>Lương Nhận Được</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$value)
                    
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ $value->user->name }}</td>
                        <td>{{ $value->user->email }}</td>
                        <td>{{ $value->user->department ? $value->user->department->room_name : '' }}</td>
                        <td>{{ $value->month }}</td>
                        <td>{{ $value->valid_workdays }}</td>
                        <td>{{ $value->invalid_workdays }}</td>
                        <td>{{ number_format($value->salary_received, 2) }} VND</td>
                        <td>
                            <a href="{{ route('payrolls.edit', $value->id) }}" class="btn btn-success">Sửa</a>
                            <a href="{{ route('payrolls.delete', $value->id) }}" class="btn btn-danger" onclick="return confirmDelete()">
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

<script>
function confirmDelete() {
    return confirm("Bạn có chắc chắn muốn xóa bản ghi này?");
}
</script>

@extends('layouts.main')
@section('title')
    Phòng ban
@stop
@section('content')

    <style>
        td.details-control {
            cursor: pointer;
            text-align: center;
            color: #007bff;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-left">
                <h4>Phòng Ban</h4>
            </div>
            <div class="col-md-6 text-right">

                <a href="{{route('departments.store')}}" class="col-md-2 btn btn-block btn-primary float-right">Thêm
                    mới</a>

            </div>
            <div class="card-body">

                <table id="example123" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Tên</th>
                        <th>Chức vụ</th>
                        <th>Phòng ban</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr data-child="Số điện thoại: 0123456789<br>Email: nguyenA@example.com">
                        <td class="details-control">+</td>
                        <td>Nguyễn Văn A</td>
                        <td>Nhân viên</td>
                        <td>Phòng Kinh Doanh</td>
                    </tr>
                    <tr data-child="Số điện thoại: 0987654321<br>Email: tranB@example.com">
                        <td class="details-control">+</td>
                        <td>Trần Văn B</td>
                        <td>Quản lý</td>
                        <td>Phòng Tài Chính</td>
                    </tr>
                    </tbody>
                </table>

                <table id="example" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Phòng Ban</th>
                        <th>Trạng Thái</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $r)
                        <tr>
                            <td>
                                {{ $r->name }}
                            </td>
                            <td>{{ $r->name }}</td>
                            <td>
                                {{ $r-> status  }}
                            </td>
                            <td>
                                <a href="{{ route('departments.edit', ['id' => $r->id])}}"
                                   class="btn btn-success">Sửa</a>
                                <a href="{{ route('departments.delete', ['id' => $r->id])}}"
                                   class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var table = $('#example123').DataTable({
                "paging": false
            });

            // Thêm sự kiện click để mở rộng hàng cha con
            $('#example tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // Nếu hàng con đang hiển thị, ẩn nó
                    row.child.hide();
                    tr.find('td.details-control').text('+');
                } else {
                    // Nếu hàng con đang ẩn, hiển thị nó
                    row.child(tr.data('child')).show();
                    tr.find('td.details-control').text('-');
                }
            });
        });
    </script>
@endsection

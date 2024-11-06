@extends('layouts.main')
@section('title')
    Sắp diễn ra
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-left">
                 <h4>Sắp diễn ra</h4>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{route('upcoming.store')}}" class="col-md-2 btn btn-block btn-primary float-right">Thêm mới</a>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Tiêu đề chính</th>
                        <th>Mô tả</th>
                        <th>Ảnh</th>
                        <th>Vị trí tổ chức</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $r)
                        <tr>
                            <td>{{ $r->title  }}</td>
                            <td>{{ $r->big_title  }}</td>
                            <td>{{ $r->great_description  }}</td>
                            <td>
                                <img src="{{url('/')}}/storage/{{ $r->image}}" width="100px" alt="">
                            </td>
                            <td>{{ $r->location  }}</td>
                            <td>{{ $r->time  }}</td>
                            <td>
                                <a href="{{ route('upcoming.edit', ['id' => $r->id])}}" class="btn btn-success">Sửa</a>
                                <a href="{{ route('upcoming.delete', ['id' => $r->id])}}" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

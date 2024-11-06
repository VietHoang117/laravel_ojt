@extends('layouts.main')
@section('title')
    baclv
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-left">
                 <h4>Tiện ích</h4>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{route('utiliti.store')}}" class="col-md-2 btn btn-block btn-primary float-right">Thêm mới</a>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Tên</th>
                        <th>Ảnh</th>
                        <th>Mô tả</th>
                        <th>Link</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $r)
                        <tr>
                            <td>{{ $r->id  }}</td>
                            <td>{{ $r->title  }}</td>
                            <td>
                                <img src="{{url('/')}}/storage/{{ $r->image}}" width="100px" alt="">
                            </td>
                            <td>{{ $r->description  }}</td>
                            <td>{{ $r->link  }}</td>
                            <td>
                                <a href="{{ route('utiliti.edit', ['id' => $r->id])}}" class="btn btn-success">Sửa</a>
                                <a href="{{ route('utiliti.delete', ['id' => $r->id])}}" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

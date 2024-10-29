@extends('layouts.main')
@section('title')
    baclv
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-left">
                 <h4>Mô tả</h4>
            </div>
            <div class="col-md-6 text-right">
                @if(count($data) === 0)
                <a href="{{route('general.store')}}" class="col-md-2 btn btn-block btn-primary float-right">Thêm mới</a>
                @endif
            </div>
            <div class="card-body">
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $r)
                        <tr>
                            <td>{{ $r->title  }}</td>
                            <td>{{ $r->description  }}</td>
                            <td>
                                <a href="{{ route('general.edit', ['id' => $r->id])}}" class="btn btn-success">Sửa</a>
                                <!-- <a href="{{ route('general.delete', ['id' => $r->id])}}" class="btn btn-danger">Xóa</a> -->
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

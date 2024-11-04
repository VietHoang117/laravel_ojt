@extends('layouts.main')
@section('title')
Tài Khoản
@stop
@section('content')
<div class="container-fluid">

    <form action="{{ route('import.users') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit" class="btn-dark">Import Users</button>
    </form>
    <a href="{{ route('export.users') }}" class="btn btn-primary">Export Users</a>

    <div class="row">
        <div class="col-md-6 text-left">
            <h4>Danh Sách Tài Khoản</h4>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('users.store')}}" class="col-md-2 btn btn-block btn-primary float-right">Thêm mới</a>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tên </th>
                        <th>Email</th>
                        <th>Phòng Ban</th>
                        <th>Thời gian chấm công </th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $r)
                    <tr>
                        <!-- <td>
                                <img src="{{url('/')}}/storage/{{ $r->image}}" width="100px">
                            </td> -->
                        <td>
                            {{ $r->name }}
                        </td>
                        <td>
                            {{ $r->email }}
                        </td>
                        <td>
                            {{$r->department ? $r->department->room_name:''}}
                        </td>
                        <td>
                            {{$r->time}}
                        </td>
                        <td>
                            <a href="{{ route('users.edit', ['id' => $r->id])}}" class="btn btn-success">Sửa</a>
                            <a href="{{ route('users.delete', ['id' => $r->id]) }}" class="btn btn-danger"
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

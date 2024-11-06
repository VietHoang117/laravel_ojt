@extends('layouts.main')
@section('title')
    Thực đơn
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-left">
                 <h4>Thực đơn</h4>
            </div>
            <div class="col-md-6 text-right">
                @if(count($data) < 4) 
                 <a href="{{route('menu.store')}}" class="col-md-2 btn btn-block btn-primary float-right">Thêm mới</a>
                @endif
            </div>
            <div class="card-body">
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Ảnh</th>
                        <th>Mô tả</th>
                        <th>Link</th>
                        <th>Vị trí ảnh</th>
                        <th>Ảnh chính</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $r)
                        <tr>
                            <td>{{ $r->title  }}</td>
                            <td>
                                <img src="{{url('/')}}/storage/{{ $r->image}}" width="100px" alt="">
                            </td>
                            <td>{{ $r->description  }}</td>
                            <td>{{ $r->link  }}</td>
                            <td>
                                {{ $r->numerical_order  }}
                            </td>
                            <td>
                                <div class="custom-control custom-switch">
                                    @if($r->turn_off)

                                    <i class="fa fa-solid fa-check" style="color:#007bff"></i>

                                    @endif
                                    <!-- <input type="checkbox" name="turn_off" {{ $r->turn_off ? 'checked' : '' }}> -->
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('menu.edit', ['id' => $r->id])}}" class="btn btn-success">Sửa</a>
                                <a href="{{ route('menu.delete', ['id' => $r->id])}}" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

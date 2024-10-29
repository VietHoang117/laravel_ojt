@extends('layouts.main')
@section('title')
   Thông tin chung
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-left">
                 <h4>Thông tin chung</h4>
            </div>
            <div class="col-md-6 text-right">
                @if(count($data) === 0) 
                <a href="{{route('synthetics.store')}}" class="col-md-2 btn btn-block btn-primary float-right">Thêm
                    mới</a>
                @endif    
            </div>
            <div class="card-body">
                <table id="example3" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Hottline</th>
                        <th>Tổng đài</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Link Face</th>
                        <th>Link Youtobe</th>
                        <th>Link Tiktok</th>
                        <th>Link đặt chỗ</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $r)
                        <tr>
                            <td>
                                <img src="{{url('/')}}/storage/{{ $r->logo}}" width="100px" alt="">
                            </td>
                            <td>{{ $r->hottline  }}</td>

                            <td>{{ $r->switchboard  }}</td>
                            <td>
                                {{ $r->email  }}
                            </td>
                            <td>
                                {{ $r->address  }}
                            </td>
                            <td>
                                {{ $r->link_face  }}
                            </td>
                            <td>
                                {{ $r->link_youtobe  }}
                            </td>
                            <td>
                                {{ $r->link_tiktok  }}
                            </td>
                            <td>
                                {{ $r->link_reservations  }}
                            </td>
                            <td>
                                {{ $r->operating_time  }}
                            </td>
                            <td>
                                <a href="{{ route('synthetics.edit', ['id' => $r->id])}}"
                                   class="btn btn-success">Sửa</a>
                                <!-- <a href="{{ route('synthetics.delete', ['id' => $r->id])}}"
                                   class="btn btn-danger">Xóa</a> -->
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

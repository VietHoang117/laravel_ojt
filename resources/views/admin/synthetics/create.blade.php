@extends('layouts.main')
@section('title')
    Tạo mới
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary margin-auto">
                    <div class="card-header">
                        <h3 class="card-title">Thêm mới</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <span class="text-red ml-5">{{ $error }}</span>
                        @endforeach
                    @endif
                    
                    <form action="{{ route('synthetics.save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputFile">Logo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="logo" value="{{old('logo')}}" class="form-control" id="product_image">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hottline</label>
                                <input type="text" class="form-control" name="hottline" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tổng đài</label>
                                <input type="text" class="form-control" name="switchboard" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link Facebook</label>
                                <input type="text" class="form-control" name="link_face" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link Youtobe</label>
                                <input type="text" class="form-control" name="link_youtobe" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link Tiktok</label>
                                <input type="text" class="form-control" name="link_tiktok" value="{{old('link_tiktok')}}" placeholder="Enter Link">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link Đặt chỗ</label>
                                <input type="text" class="form-control" name="link_reservations" value="{{old('link_reservations')}}" placeholder="Enter Link">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thời gian hoạt động</label>
                                <input type="text" class="form-control" name="operating_time" value="{{old('operating_time')}}" placeholder="Enter Link">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                        <h3 class="card-title">Chỉnh sửa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <span class="text-red ml-5">{{ $error }}</span>
                        @endforeach
                    @endif

                    <form action="{{ route('menu.edit', ['id' => $data->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tiêu đề</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter title" value="{{old('title', $data->title)}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" value="{{old('image', $data->image)}}" class="form-control" id="product_image">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả</label>
                                <textarea type="text" class="form-control" value="{{old('description', $data->description)}}" name="description">{{ old('description', $data->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link</label>
                                <input type="text" class="form-control" name="link" value="{{old('link', $data->link)}}" placeholder="Enter Link">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số thứ tự</label>
                                <input type="number" class="form-control" name="numerical_order" value="{{old('numerical_order', $data->numerical_order)}}">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="turn_off" class="custom-control-input" id="customSwitch1" {{ $data->turn_off ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customSwitch1">Ảnh chính</label>
                                </div>
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

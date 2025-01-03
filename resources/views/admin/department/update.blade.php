@extends('layouts.main')
@section('title')
    Chỉnh Sửa
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

                    <form action="{{ route('departments.edit', ['id' => $data->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('room_name', $data->room_name) }}" name="room_name"
                                        placeholder="Enter ">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Chọn người được xử
                                            lí</label>
                                    </div>
                                    <select class="custom-select" name="parent_id" id="inputGroupSelect01">
                                        <option selected>Chọn phòng ban...</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ old('parent_id', $department->parent_id) == $department->id ? 'selected' : '' }}>
                                                {{ $department->room_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="status"
                                        value="{{ old('status', $data->status) }}"
                                        {{ old('status', $data->status ?? false) == \App\Enums\DepartmentStatusEnum::ACTIVATED ? 'checked' : '' }} />
                                    <label class="form-check-label" for="exampleCheck1">Kích Hoạt</label>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" onclick="window.history.back()">Quay
                                    Lại</button>

                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

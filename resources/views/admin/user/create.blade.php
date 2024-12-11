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

                    <form action="{{ route('users.save') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mật Khẩu</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone_number" placeholder="Enter ">
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Ngày Sinh</label>
                                <input type="date" class="form-control" name="date_of_birth"
                                    value="{{ old('date_of_birth') }}">
                            </div>
                            <div class="form-group">
                                <label for="gender">Giới Tính</label>
                                <select class="form-select" name="gender">
                                    <option value="">--- Chọn Giới Tính ---</option>
                                    <option value="nam" {{ old('gender') == 'nam' ? 'selected' : '' }}>Nam</option>
                                    <option value="nữ" {{ old('gender') == 'nữ' ? 'selected' : '' }}>Nữ</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Phòng ban</label>
                                <select class="form-select" name="department_id">
                                    <option value="">--- Chọn phòng ban ---</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">
                                            {{ $department->room_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Vai trò</label>
                                <select class="form-select" name="role_id">
                                    <option value="">--- Chọn vai trò ---</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
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

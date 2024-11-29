@extends('layouts.main')
@section('title')
    Tạo Mới Bậc Lương
@stop
@section('content')
    <div class="container">
        <h2>Thêm Bậc Lương Mới</h2>

        <!-- Hiển thị lỗi nếu có -->
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form tạo mới -->
        <form action="{{ route('payrolls.save') }}" method="POST">
            @csrf
            <!-- Dropdown chọn người dùng -->
            <div class="form-group">
                <label for="user_id">Chọn người dùng:</label>
                <select class="form-control" name="user_id" id="user_id" required>
                    <option value="" disabled selected>--- Chọn người dùng ---</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Input tên bậc lương -->
            <div class="form-group">
                <label for="level_name">Tên Bậc Lương:</label>
                <input type="text" name="level_name" id="level_name" class="form-control" value="{{ old('level_name') }}" required>
            </div>
            
            <!-- Nút hành động -->
            <div class="form-group mt-3">
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Quay Lại</button>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
@endsection

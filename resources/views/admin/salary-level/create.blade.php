@extends('layouts.main')
@section('title')
    Tạo mới
@stop
@section('content')
    <div class="container">
        <h2>Thêm Bậc Lương Mới</h2>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <span class="text-red ml-5">{{ $error }}</span>
            @endforeach
        @endif

        <form action="{{ route('salarylevels.save') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Chọn người được xử lí</label>
                </div>
                <select class="custom-select" name="user_id" id="inputGroupSelect01">
                    <option selected>Choose...</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="level_name">Tên Bậc Lương:</label>
                <input type="text" name="level_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="daily_rate">Lương Ngày:</label>
                <input type="number" name="daily_rate" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="monthly_rate">Lương Tháng:</label>
                <input type="number" name="monthly_rate" class="form-control" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="window.history.back()">Quay Lại</button>

            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
@endsection

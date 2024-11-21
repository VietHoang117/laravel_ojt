@extends('layouts.main')
@section('title')
    Sửa
@stop
@section('content')
    <div class="container">
        <h2>Chỉnh Sửa Bậc Lương</h2>

        <form action="{{ route('salarylevels.save.edit', $data->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="level_name">Tên Bậc Lương:</label>
                <input type="text" name="level_name" value="{{ $data->level_name }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="daily_rate">Lương Ngày:</label>
                <input type="number" name="daily_rate" value="{{ $data->daily_rate }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="monthly_rate">Lương Tháng:</label>
                <input type="number" name="monthly_rate" value="{{ $data->monthly_rate }}" class="form-control" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="window.history.back()">Quay Lại</button>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
@endsection

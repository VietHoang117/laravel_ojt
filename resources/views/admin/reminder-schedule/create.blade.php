@extends('layouts.main')
@section('title')
Tạo mới
@stop
@section('content')
<div class="container">
    <h2>Cấu hình chung</h2>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <span class="text-red ml-5">{{ $error }}</span>
        @endforeach
    @endif

    <form action="{{ route('configurations.save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="level_name">Email:</label>
                    <input type="text" name="email" class="form-control" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="daily_rate">Thời gian:</label>
                    <input type="time" name="reminder_time" class="form-control" required>
                </div>
            </div>

        </div>
        <button type="button" class="btn btn-primary" onclick="window.history.back()">Quay Lại</button>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection
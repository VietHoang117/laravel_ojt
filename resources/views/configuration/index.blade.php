@extends('layouts.main')
@section('title')
    Cài đặt giờ
@stop
@section('content')
    <div class="container">
        <h2>Cài đặt giờ nhắc nhở</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('configurations.save') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="check_in">Giờ nhắc nhở Check-In</label>
                <input type="time" class="form-control" name="check_in"
                       value="{{ $attendances->check_in ?? '08:00' }}">
            </div>
            <div class="form-group">
                <label for="check_out">Giờ nhắc nhở Check-Out</label>
                <input type="time" class="form-control" name="check_out"
                       value="{{ $attendances->check_out ?? '17:00' }}">
            </div>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </form>
    </div>
@endsection

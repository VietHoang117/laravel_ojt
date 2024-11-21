@extends('layouts.main')
@section('title')
Giải Trình
@stop
@section('content')

<form action="{{ route('attendance.justify', $attendance->id) }}" method="POST">
    @csrf
    <textarea name="reason" required></textarea>
    <button type="submit">Gửi giải trình</button>
</form>

@endsection
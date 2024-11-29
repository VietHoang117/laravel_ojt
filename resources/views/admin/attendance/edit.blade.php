@extends('layouts.main')
@section('title')
    Sửa Thông Tin Chấm Công
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary margin-auto">
                    <div class="card-header">
                        <h3 class="card-title">Sửa Thông Tin Chấm Công</h3>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <!-- Tên nhân viên -->
                            <div class="form-group">
                                <label for="name">Tên nhân viên</label>
                                <input type="text" class="form-control" id="name" value="{{ $attendance->user->name }}" disabled>
                            </div>

                            <!-- Ngày -->
                            <div class="form-group">
                                <label for="date">Ngày</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ $attendance->date }}" required>
                            </div>

                            <!-- Giờ vào -->
                            <div class="form-group">
                                <label for="check_in">Giờ vào</label>
                                <input type="time" class="form-control" id="check_in" name="check_in" 
                                    value="{{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : '' }}">
                            </div>

                            <!-- Giờ ra -->
                            <div class="form-group">
                                <label for="check_out">Giờ ra</label>
                                <input type="time" class="form-control" id="check_out" name="check_out" 
                                    value="{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : '' }}">
                            </div>

                            <!-- Trạng thái -->
                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="present" {{ $attendance->status === 'present' ? 'selected' : '' }}>Hợp lệ</option>
                                    <option value="absent" {{ $attendance->status === 'absent' ? 'selected' : '' }}>Không hợp lệ</option>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Quay Lại</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main')
@section('title')
    Sửa Thông Tin Chấm Công
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary margin-auto">
                    <div class="card-header">
                        <h3 class="card-title">Sửa Thông Tin Chấm Công</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <span class="text-red ml-5">{{ $error }}</span>
                        @endforeach
                    @endif

                    <form action="{{ route('edit', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên nhân viên</label>
                                <input type="text" class="form-control" id="name" value="{{ $data->user->name }}"
                                    disabled>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Phòng ban</label>
                                <select class="form-select" name="department_id">
                                    <option value="">--- Chọn phòng ban ---</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('department_id', $data->department_id) == $department->id ? 'selected' : '' }}>
                                            {{ $department->room_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="date">Ngày</label>
                                <input type="date" class="form-control" id="date" name="date"
                                    value="{{ $attendance->date }}" required>
                            </div>

                            <div class="form-group">
                                <label for="check_in">Giờ vào</label>
                                <input type="time" class="form-control" id="check_in" name="check_in"
                                    value="{{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : '' }}">
                            </div>

                            <div class="form-group">
                                <label for="check_out">Giờ ra</label>
                                <input type="time" class="form-control" id="check_out" name="check_out"
                                    value="{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : '' }}">
                            </div>

                            <div class="form-group">
                                <label for="late">Muộn giờ</label>
                                <input type="text" class="form-control" id="late" name="late"
                                    value="{{ $attendance->late }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="present" {{ $attendance->status === 'present' ? 'selected' : '' }}>Hợp
                                        lệ
                                    </option>
                                    <option value="absent" {{ $attendance->status === 'absent' ? 'selected' : '' }}>Không
                                        hợp lệ
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" onclick="window.history.back()">Quay Lại</button>

                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

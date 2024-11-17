@extends('layouts.main')
@section('title')
Sửa Lương
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

                <form action="{{ route('payrolls.edit', ['id' => $data->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="valid_workdays">Ngày làm việc hợp lệ</label>
                            <input type="number" class="form-control" name="valid_workdays"
                                placeholder="Nhập Ngày làm việc hợp lệ"
                                value="{{ old('valid_workdays', $data->valid_workdays) }}">
                        </div>

                        <div class="form-group">
                            <label for="invalid_workdays">Ngày làm việc không hợp lệ</label>
                            <input type="number" class="form-control" name="invalid_workdays"
                                placeholder="Nhập Ngày làm việc không hợp lệ"
                                value="{{ old('invalid_workdays', $data->invalid_workdays) }}">
                        </div>

                        <div class="form-group">
                            <label for="month">Tháng</label>
                            <input type="text" class="form-control" name="month"
                                placeholder="Nhập Tháng (e.g., 2024-11)" value="{{ old('month', $data->month) }}">
                        </div>

                        <div class="form-group">
                            <label for="salary_received">Lương Nhận Được</label>
                            <input type="number" class="form-control" name="salary_received" placeholder="Nhập Lương"
                                step="0.01" value="{{ old('salary_received', $data->salary_received) }}">
                        </div>                      

                        <div class="form-group">
                            <label class="form-label">Người Cập Nhật</label>
                            <select class="form-select" name="updated_by">
                                <option value="">--- Chọn người xử lí ---</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="status" value="1"
                                {{ old('status', $data->status) == \App\Enums\DepartmentStatusEnum::ACTIVATED ? 'checked' : '' }} />
                            <label class="form-check-label" for="exampleCheck1">Kích Hoạt</label>
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
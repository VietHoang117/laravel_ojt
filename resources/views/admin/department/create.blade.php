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

                <form action="{{ route('departments.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="room_name" placeholder="Enter ">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phòng ban</label>
                            <select class="form-select" name="parent_id">
                                <option value="">--- Chọn phòng ban ---</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('parent_xid', $data->parent_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->room_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="status"
                                value="{{ \App\Enums\DepartmentStatusEnum::ACTIVATED }}"
                                {{ old('status', $department->status ?? false) == \App\Enums\DepartmentStatusEnum::ACTIVATED ? 'checked' : '' }} />
                            <label class="form-check-label" for="exampleCheck1">Kích Hoạt</label>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
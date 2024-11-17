@extends('layouts.main')
@section('title')
    Tạo mới Payroll
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary margin-auto">
                    <div class="card-header">
                        <h3 class="card-title">Thêm mới Payroll</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <span class="text-red ml-5">{{ $error }}</span>
                        @endforeach
                    @endif

                    <form action="{{ route('payrolls.save') }}" method="post">
                        @csrf
                        <div class="card-body">

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
                                <label for="valid_workdays">Số Ngày Công Hợp Lệ</label>
                                <input type="number" id="valid_workdays" class="form-control" name="valid_workdays"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="invalid_workdays">Số Ngày Công không hợp lệ</label>
                                <input type="number" id="invalid_workdays" class="form-control" name="invalid_workdays"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="month">Tháng</label>
                                <input type="text" class="form-control" name="month" placeholder="Nhập Tháng"
                                    value="{{ old('month') }}">
                            </div>

                            <div class="form-group">
                                <label for="salary_received">Lương Nhận Được</label>
                                <input type="text" id="salary_received" class="form-control" name="salary_received"
                                    readonly>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Chọn người xử lí</label>
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



                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="status"
                                    value="1" {{ old('status') ? 'checked' : '' }} />
                                <label class="form-check-label" for="exampleCheck1">Kích Hoạt</label>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" onclick="window.history.back()">Quay Lại</button>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

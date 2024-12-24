@extends('layouts.main')
@section('title')
Tạo mới
@stop
@section('content')
<style>
    .select2-results__option {
        color: black !important;
        /* Màu chữ trong danh sách gợi ý */
    }

    .select2-selection__rendered {
        color: black !important;
        /* Màu chữ của các giá trị đã chọn */
    }

    .text-black {
        color: black !important; /* Đặt màu chữ là đen */
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black !important; /* Màu chữ trong các tag đã chọn */
    }
</style>
<div class="container">
    <h2>Thêm Bậc Lương Mới</h2>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <span class="text-red ml-5">{{ $error }}</span>
        @endforeach
    @endif

    <form action="{{ route('salarylevels.save') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="inputGroupSelect01">Chọn nhân viên</label>
            <select class="custom-select select2 text-black" name="user_id[]" id="inputGroupSelect01" multiple>
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
        <button type="button" class="btn btn-primary" onclick="window.history.back()">Quay Lại</button>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection
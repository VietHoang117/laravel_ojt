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
        color: black !important;
        /* Đặt màu chữ là đen */
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black !important;
        /* Màu chữ trong các tag đã chọn */
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
            <div class="d-flex">
                <!-- Input text -->
                <input type="text" name="level_name" id="level_name" class="form-control mr-2"
                    placeholder="Nhập tên bậc lương" required  onchange="changeDisabled()">

                <!-- Dropdown select -->
                <select name="level_name" id="level_name_select" class="form-control" onchange="toggleInput(this)"
                    aria-label="Chọn bậc lương">
                    <option value="" selected>Chọn bậc lương</option>

                    @foreach ($salaryLevels as $salaryLevel)
                        <option value="{{ $salaryLevel->level_name }}" data-daily-rate="{{ $salaryLevel->daily_rate }}">
                            {{  $salaryLevel->level_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="daily_rate">Lương Ngày:</label>
            <input type="number" name="daily_rate" id="daily_rate" class="form-control" required>
        </div>
        <button type="button" class="btn btn-primary" onclick="window.history.back()">Quay Lại</button>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
<script>
    // Hiển thị input nếu người dùng chọn "Khác"
    function toggleInput(selectElement) {
        var inputField = document.getElementById('level_name');
        var selectField = document.getElementById('level_name_select');
        if (selectField.value !== "") {
            inputField.disabled = true;
        } else {
            inputField.disabled = false;
        }

        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var dailyRate = selectedOption.getAttribute('data-daily-rate');

        var dailyRateField = document.getElementById('daily_rate');

        if (dailyRate !== null && dailyRate !== "") {
            dailyRateField.value = dailyRate;

        } else {
            dailyRateField.value = "";
        }
    }
    function changeDisabled() {
        var inputField = document.getElementById('level_name');
        var selectField = document.getElementById('level_name_select');
        if (inputField.value !== "") {
            selectField.disabled = true;
        } else {
            selectField.disabled = false;
        }

    }
</script>
@endsection
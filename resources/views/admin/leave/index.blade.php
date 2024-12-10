@extends('layouts.main')
@section('title', 'Đề xuất nghỉ phép')

@section('content')
    <h1 style="font-size: 30px; font-weight: bold;">Đơn Phép</h1>


<div class="card-body">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <span class="text-red ml-5">{{ $error }}</span>
        @endforeach
    @endif
    <!-- Table -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <x-leave-modal :id="'exampleModalLeaves'" :dexuats="$dexuats" :restTypes="$restTypes" :typeOfVacations="$typeOfVacations" :ngayPheps="$ngayPheps"></x-leave-modal>
    <!-- Table -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form method="get" action="{{ route('leaves.index') }}">
                <div class="input-group">
                    <input class="form-control" name="search" value="{{ request('search') }}" placeholder="Tìm Kiếm...">
                    <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                </div>
            </form>
        </div>

        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLeaves">
                Làm Đơn
            </button>

        </div>
    </div>

    <table id="payrollTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Mã số</th>
                <th>Tên đề xuất</th>
                <th>Ngày tạo</th>
                <th>Người tạo</th>
                <th>Người duyệt</th>
                <th>Trạng Thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->proposal_name }}</td>
                    <td>{{ $value->created_at->format('d-m-Y') }}</td>
                    <td>{{ $value->user->name ?? 'N/A' }}</td>
                    <td>{{ $value->reviewer->name ?? 'Chưa chỉ định' }}</td>
                    <td>{{ $value->status }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#showFormModal-{{ $value->id }}" title="Hiển thị thông tin chi tiết">
                            Hiển Thị
                        </button>

                        <!-- Gửi người duyệt -->
                        @if ($value->status === $leaveStatusEnum::DRAFT)
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#approvalFormModal-{{ $value->id }}" title="Chỉ đích danh người duyệt">
                                Người duyệt
                            </button>
                        @endif

                        @if ($value->status === $leaveStatusEnum::SEND && Auth::id() === $value->user_reviewer_id)
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#approvalFormModalUser-{{ $value->id }}">
                                Duyệt
                            </button>
                        @endif

                        <!-- Hiển Thị -->
                        <x-leave-show-modal :data="$value"></x-leave-show-modal>

                        <!-- Form ẩn -->
                        <x-leave-designate-reviewer-modal :value="$value"
                            :nguoiquanlys="$nguoiquanlys"></x-leave-designate-reviewer-modal>

                        <!-- Form duyệt -->
                        <x-leave-apprroval-modal :value="$value" :leaveStatusEnum="$leaveStatusEnum"
                            :dexuats="$dexuats"></x-leave-apprroval-modal>


                        <a href="{{ route('leaves.delete', $value->id) }}" class="btn btn-danger"
                            onclick="return confirmDelete()">
                            Xóa
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mt-4">
    {{ $data->links('pagination::bootstrap-4') }}
</div>

<script>
    function toggleDateFields() {
        const select = document.getElementById('type');
        const dateFields = document.getElementById('date-fields');
        const dateFieldsNone = document.getElementById('day_off_none');

        // Hiển thị các trường nếu giá trị là "2"
        if (select.value === "Nghỉ nửa ca") {
            dateFields.style.display = 'block';
            dateFieldsNone.style.display = 'none';
        } else {
            dateFields.style.display = 'none';
            dateFieldsNone.style.display = 'block';
        }
    }

    function toggleApprovalForm() {
        const form = document.getElementById('approvalForm');

        // Hiện hoặc ẩn form với hiệu ứng mượt
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>

<script>
    document.getElementById('to_date').addEventListener('change', function () {
        const fromDate = new Date(document.getElementById('from_date').value);
        const toDate = new Date(this.value);

        if (toDate < fromDate) {
            alert('Đến ngày phải lớn hơn hoặc bằng Từ ngày');
            this.value = '';
        }
    });
</script>
@endsection

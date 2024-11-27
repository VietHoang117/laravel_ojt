@extends('layouts.main')
@section('title')
    Trang chủ
@stop
@section('content')
    <div class="container-fluid">
        <div class="container mx-auto p-4 bg-white shadow-md mt-10">
            @if (auth()->user()->roles->first()->is_system_role != true)
                <h1 class="text-2xl font-bold text-center text-gray-800">Bảng chấm công hàng tháng</h1>


                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="overflow-x-auto mt-6">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                {{ session(key: 'check') }}
                                <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-center">Tên
                                </th>
                                <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-center">Ngày
                                </th>
                                <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-center">Thứ
                                </th>
                                <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-center">Giờ
                                    Vào
                                </th>
                                <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-center">Giờ
                                    ra
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b text-center">{{ $time['name'] }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $time['date'] }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $time['day'] }}</td>
                                <td class="py-2 px-4 border-b text-center text-blue-500 cursor-pointer">
                                    @if ($checkIn)
                                        <a href="{{ route('check-in') }}" class="btn-success">Check In</a>
                                    @else
                                        <span class="text-success">
                                            Đã check in
                                        </span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b text-center text-blue-500 cursor-pointer">
                                    @if ($checkOut)
                                        <a href="{{ route('check-out') }}" class="btn-danger">Check Out</a>
                                    @else
                                        <span class="text-success">
                                            Đã check out
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>

                    </table>
                    <div class="mt-4">
                        {{ $data->links() }}
                    </div>
                </div>

                <!-- Thêm khoảng cách giữa hai bảng -->
                <div class="my-8"></div>

                <div class="col-md-12 text-left">
                    <h1>Danh sách chấm công</h1>


                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Phòng ban</th>
                                <th>Ngày</th>
                                <th>Giờ vào</th>
                                <th>Giờ ra</th>
                                <th>Giờ đã làm</th>
                                <th>Muộn Giờ</th>
                                <th>Trạng Thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $r)
                                <tr>
                                    <td>{{ $r['name'] }}</td>
                                    <td>{{ $r['room_name'] }}</td>
                                    <td>{{ $r['date'] }}</td>
                                    <td>
                                        {{ $r['check_in'] }}
                                    </td>
                                    <td>{{ $r['check_out'] }}</td>
                                    <td>{{ $r['total_time'] }}</td>
                                    <td>{{ $r['late'] }}</td>
                                    <td><span class="{{ $r['status'] === 'Hợp lệ' ? 'text-success' : 'text-danger' }}">
                                            {{ $r['status'] }}
                                        </span></td>
                                    <td>

                                        <form action="{{ route('justifications.report', ['id' => $r['id']]) }}"
                                            method="POST">
                                            @csrf
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal-{{ $r['id'] }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel-{{ $r['id'] }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Giải Trình</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- <form> -->

                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Lý Do Giải
                                                                    Trình:</label>
                                                                <textarea class="form-control" id="message-text" name="reason"></textarea>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Hủy</button>
                                                            <button type="submit" class="btn btn-primary">Gửi</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal-{{ $r['id'] }}">
                                            Gửi Giải Trình
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            @endif

            <div class="my-8"></div>

            @if (App\Helpers\PermissionHelper::can('is-system-admin'))
                <div class="col-md-6">
                    <div class="form-group">
                        <form method="get" action="{{ route('search') }}">
                            <div class="input-group">
                                <input class="form-control" name="search" placeholder="Tìm Kiếm...">
                                <button type="submit" class="btn btn-primary">Tìm Kiếm </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 text-left">
                    <h1>Danh sách chấm công tất cả nhân viên</h1>
                </div>
                <div class="card-body">
                    <table id="example3" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Phòng ban</th>
                                <th>Ngày</th>
                                <th>Giờ vào</th>
                                <th>Giờ ra</th>
                                <th>Giờ đã làm</th>
                                <th>Muộn Giờ</th>
                                <th>Trạng Thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataTotals as $r)
                                <tr>
                                    <td>{{ $r['name'] }}</td>
                                    <td>{{ $r['room_name'] }}</td>
                                    <td>{{ $r['date'] }}</td>
                                    <td>
                                        {{ $r['check_in'] }}
                                    </td>
                                    <td>{{ $r['check_out'] }}</td>
                                    <td>{{ $r['total_time'] }}</td>
                                    <td>{{ $r['late'] }}</td>
                                    <td><span class="{{ $r['status'] === 'Hợp lệ' ? 'text-success' : 'text-danger' }}">
                                            {{ $r['status'] }}
                                        </span></td>
                                    <td>
                                        <a href="{{ route('edit', $r['id']) }}" class="btn btn-success">Sửa</a>
                                        <a class="btn btn-danger" onclick="return confirmDelete()">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $dataTotals->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

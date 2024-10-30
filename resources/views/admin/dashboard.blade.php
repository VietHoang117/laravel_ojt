@extends('layouts.main')
@section('title')
baclv
@stop
@section('content')
<div class="container-fluid">
    <div class="container mx-auto p-4 bg-white shadow-md mt-10">
        <h1 class="text-2xl font-bold text-center text-gray-800">Bảng chấm công hàng tháng</h1>
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        {{ session(key: 'check') }}
                        <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-center">Tên</th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-center">Ngày
                        </th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-center">Thứ</th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-center">Giờ Vào
                        </th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-center">Giờ ra
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
        </div>
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
                    @foreach($data as $r)
                    <tr>
                        <td>{{ $r['name']  }}</td>
                        <td>{{ $r['room_name']  }}</td>
                        <td>{{ $r['date']  }}</td>
                        <td>
                            {{  $r['check_in'] }}
                        </td>
                        <td>{{ $r['check_out'] }}</td>
                        <td>{{ $r['total_time']  }}</td>
                        <td>{{ $r['late']  }}</td>
                        <td>{{ $r['status'] === 'present' ? 'Có mặt' : 'Vắng mặt' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.main')
@section('title')
Duyệt Giải Trình
@stop
@section('content')

<h1>Duyệt Ngày Công</h1>

    <form method="GET" action="{{ route('admin.attendance.index') }}">
        <input type="text" name="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">
        <button type="submit">Tìm kiếm</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Tên nhân viên</th>
                <th>Phòng ban</th>
                <th>Ngày</th>
                <th>Lý do giải trình</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ $attendance->user->department->room_name ?? 'N/A' }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->justification_reason }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.attendance.confirm', $attendance->id) }}">
                            @csrf
                            <button type="submit" name="approve" value="true">Duyệt</button>
                            <button type="submit" name="approve" value="false">Không duyệt</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $attendances->links() }}


@endsection
@extends('layouts.main')
@section('title')
Bậc Lương
@stop
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 text-left">
            <h1 style="font-size: 30px; font-weight: bold;">Quản Lý Bậc Lương</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('salarylevels.store') }}" class="col-md-2 btn btn-primary float-right">Thêm Mới</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Bậc lương</th>
                        <th>Lương Ngày</th>
                        <th>Tổng người dùng</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salaryLevels as $salaryLevel)
                        <tr>
                            <td>{{ $salaryLevel->level_name }}</td>
                            <td>{{ $salaryLevel->daily_rate }}</td>
                            <td>
                                {{ count($salaryLevel->users) }}
                            </td>
                            <td>
                                <button class="btn btn-info" onclick="toggleUsers({{ $salaryLevel->level_name }})">Xem người
                                    dùng</button>
                                <div id="users-{{ $salaryLevel->level_name }}" style="display: none; margin-top: 10px;">
                                    @if ($salaryLevel->users->isNotEmpty())
                                        <ul class="list-group">
                                            @foreach ($salaryLevel->users as $user)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>{{ $user->name }}</span>
                                                    <a href="{{ route('salarylevels.delete', $user->id) }}"
                                                        class="btn btn-danger btn-sm" onclick="return confirmDelete()">
                                                        <i class="fas fa-trash-alt"></i> Xóa
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>Không có người dùng</p>
                                    @endif
                                </div>

                                <script>
                                    function confirmDelete() {
                                        return confirm("Bạn có chắc chắn muốn xóa người dùng này?");
                                    }
                                </script>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <script>
                function toggleUsers(levelName) {
                    var userDiv = document.getElementById('users-' + levelName);
                    if (userDiv.style.display === 'none') {
                        userDiv.style.display = 'block';
                    } else {
                        userDiv.style.display = 'none';
                    }
                }
            </script>
        </div>
    </div>
</div>
@endsection
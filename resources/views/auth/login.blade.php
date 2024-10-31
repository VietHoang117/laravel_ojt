<!doctype html>
<html lang="en">

<head>
    <title>Đăng Nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset ('client/login/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/login/css/bootstrap.min.css') }}">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">

                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        <div class="img" style="background-image: url(client/login/images/bg-1.jpg);"></div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Đăng Nhập</h3>
                                </div>

                            </div>
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                @if($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                                @endif
                                <div class="input-group mb-3">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                        placeholder="Email">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password">

                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Ghi Nhớ
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#">Quên Mật Khẩu</a>
                                    </div>
                                </div>
                                <div class="row">

                                    <!-- /.col -->
                                    <div class="col-5">
                                        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                                    </div>
                                    <!-- /.col -->
                                </div>

                            </form>
                            <p class="text-center">Bạn không phải thành viên? <a data-toggle="tab" href="#signup">Đăng Kí</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset ('client/login/js/jquery.min.js')}}"></script>
    <script src="{{ asset ('client/login/js/popper.js')}}"></script>
    <script src="{{ asset ('client/login/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset ('client/login/js/main.js')}}"></script>

</body>

</html>
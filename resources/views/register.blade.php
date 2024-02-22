@extends("layouts.auth")
@section('content')
<form action="{{url('/register')}}" method="post">
    @csrf
    <div class="d-flex flex-column justify-content-center align-items-center bg-mb" style="height: 100vh">
        @error('username')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="w-100 mb-2 text-center">
            <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-MB-Bank-MBB.png" class="" style="width: 80px">
        </div>
        <div class="text-center text-uppercase fw-bolder h4 text-white">Đăng ký</div>
        <div class="w-100 p-3">
            <input type="text" name="username" class="form-control w-100 mb-3 p-2" placeholder="Số điện thoại">
            <input type="password" name="password" class="form-control p-2 mb-3" placeholder="Mật khẩu">
            <input type="password" name="password_confirmation" class="form-control p-2" placeholder="Nhập lại mật khẩu">
            <button type="submit" class="btn btn-primary w-100 mt-3">Đăng ký</button>
        </div>
        <div class="text-white">Đã có tài khoản ?   <span class="font-semi-bold">
            <a href="{{url('login')}}">Đăng nhập ngay</a>
        </span></div>
    </div>
</form>
@endsection

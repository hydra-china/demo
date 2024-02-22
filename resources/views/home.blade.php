@extends("layouts.app")
@section("content")
    <div class="bg-mb text-white fw-bolder p-1">
        <div class="row align-items-baseline m-0">
            <div class="col-6">
                <div>
                    Xin chào,
                </div>
                <div>
                    0904 800 240
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end align-items-center">
                    <div>
                        <div>Hotline:</div>
                        <div>{{ $hotline ?? '0000 00 00 00' }}</div>
                    </div>
                    <div class="ps-2">
                        <i class="bi bi-bell-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("components.reward")
    @include('components.slide')
    <div class="my-3 text-center">
        <a href="{{url('/vay')}}" class="bg-mb text-white btn p-3"><h3 class="m-0">Đăng ký khoản vay</h3></a>
    </div>
    @include("components.list")
    @include("components.news")
    @include("components.copyright")
@endsection

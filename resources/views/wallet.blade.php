@php use App\Models\Wallet; @endphp
@php
    /**
     * @var Wallet $wallet
     */
@endphp
@extends('layouts.app')
@section('content')
    <div class="bg-mb text-white fw-bolder p-1">
        <h3 class="my-2 text-center text-uppercase">Ví tiền</h3>
    </div>
    <div class="my-2">
        @include('components.credit-card',['wallet' => $wallet])
    </div>
    <div class="my-1 px-3 p-2 ">
        <div class="d-flex justify-content-between bg-light p-2 rounded">
            <span class="text-uppercase font-semi-bold">Số dư ví:</span>
            <span style="cursor: pointer" id="show-withdraw-amount" class="font-semi-bold text-danger">{{number_format($wallet['amount'])}} VND</span>

            <button href="#" id="show-withdraw-amount-btn" class="d-none" type="button" data-bs-toggle="modal"
                    data-bs-target="#withdraw-amount">
                aa
            </button>

        </div>
        <div class="mt-1 small px-2">
            <a href="{{url('/history')}}">Biến động số dư</a>
        </div>
    </div>
    <div class="p-2 px-3">
        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#withdraw"
           class="d-block btn bg-mb text-white p-3 font-semi-bold">
            <div class="d-flex justify-content-between">
                <span class="text-uppercase"> Rút tiền về tài khoản liên kết</span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                         class="bi bi-database-fill-down" viewBox="0 0 16 16">
                    <path
                        d="M12.5 9a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7m.354 5.854 1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V10.5a.5.5 0 0 0-1 0v2.793l-.646-.647a.5.5 0 0 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0M8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1"/>
                    <path
                        d="M2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-4.815 1.843A12 12 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777C2.875 8.755 2 8.007 2 7m6.257 3.998L8 11c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13h.027a4.55 4.55 0 0 1 .23-2.002m-.002 3L8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-1.3-1.905"/>
                </svg>
                </span>
            </div>
        </a>
    </div>
    <div class="p-2">
        <img alt="" class="w-100" src="{{asset("/img/wallet.911a2f9edd9a6151a551.jpg")}}">
    </div>

    <div class="modal fade" id="withdraw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 {{$bg}}" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="my-2 p-2 text-center">
                        <img src="{{$iconSrc}}" style="max-width: 3rem">
                    </div>
                    <div class="{{$bg}} text-center">{{$wallet['reason']}}</div>
                </div>
                @if(! $action)
                    <div class="modal-footer">
                        <a href="{{url('contact')}}" type="button" class="btn bg-mb text-white d-block w-100">Liên hệ
                            CSKH</a>
                    </div>
                @else
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary d-block w-100" data-bs-dismiss="modal"
                                aria-label="Close">Đóng
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <button id="withdraw-2-btn" href="#" type="button" data-bs-toggle="modal" data-bs-target="#withdraw-2"
            class="d-none">
        <div class="d-flex justify-content-between">
            <span class="text-uppercase"> Rút tiền về tài khoản liên kết</span>
            <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                         class="bi bi-database-fill-down" viewBox="0 0 16 16">
                    <path
                        d="M12.5 9a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7m.354 5.854 1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V10.5a.5.5 0 0 0-1 0v2.793l-.646-.647a.5.5 0 0 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0M8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1"/>
                    <path
                        d="M2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-4.815 1.843A12 12 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777C2.875 8.755 2 8.007 2 7m6.257 3.998L8 11c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13h.027a4.55 4.55 0 0 1 .23-2.002m-.002 3L8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-1.3-1.905"/>
                </svg>
                </span>
        </div>
    </button>
    <div class="modal fade" id="withdraw-2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="my-2 p-2 text-center">
                        <img src="{{asset('img/wrong.png')}}" style="max-width: 3rem">
                    </div>
                    <div class="text-danger text-center">Điểm tín dụng không đủ</div>
                </div>
                <div class="modal-footer">
                    <a href="{{url('contact')}}" type="button" class="btn bg-mb text-white w-100">Liên hệ CSKH</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="withdraw-amount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Rút tiền</h1>
                    <button id="close-withdraw-amount" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="my-form" action="{{url('wallet/withdraw')}}" method="POST">
                        <div>
                            @csrf
                            <input class="form-control" placeholder="Nhập số tiền rút" name="amount" type="number"
                                   max="{{$wallet['amount']}}"
                                   required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="my-2 btn btn-success px-5">
                                Tiếp tục
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("after_scripts")
    <script>
        $(document).ready(function () {
            $("#my-form").submit(function (e) {
                e.preventDefault()

                @if($wallet['amount'] == 0)
                    alert('Số dư không khả dụng')
                    return;
                @endif

                $("#close-withdraw-amount").click()
                const formData = new FormData(this)
                $.ajax({
                    type: "POST",
                    url: "{{ url('wallet/withdraw')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $("#withdraw-2-btn").click()
                    },
                    error: function (error) {
                        $("#withdraw-2-btn").click()
                    }
                });
            })
        })
    </script>
    <script>
        $(document).ready(function () {
            $("#show-withdraw-amount").click(function (e) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('wallet/check')}}",
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $("#show-withdraw-amount-btn").click()
                    },
                    error: function (error) {
                        $("#withdraw-2-btn").click()
                    }
                });
            })
        })
    </script>
@endpush

@php use App\Models\Config; @endphp
@php
    /**
     * @var Config $contract
     */
@endphp
@extends('layouts.app')

@section('content')
    <div class="fixed-top bg-mb text-white fw-bolder p-1">
        <h3 class="my-2 text-center text-uppercase">Hoàn tất khoản vay</h3>
    </div>

    <div class="p-3 mt-5">
        {!! $contract['value'] !!}
    </div>

    <div class="px-3">
        <div>Ký xác nhận</div>
    </div>
    <div class="text-center my-2">
        <canvas id="signatureCanvas" class="shadow rounded border" width="400" height="200"></canvas>

    </div>
    <div class="text-center">
        <a class="btn btn-danger" id="clear-canvas">Reset chữ ký</a>
        <button class="btn btn-success" id="submit-canvas">Xác nhận khoản vay</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        window.onload = function () {
            const canvas = document.querySelector("canvas");

            const signaturePad = new SignaturePad(canvas);

            signaturePad.toDataURL(); // save image as PNG
            signaturePad.toDataURL("image/jpeg"); // save image as JPEG
            signaturePad.toDataURL("image/jpeg", 0.5); // save image as JPEG with 0.5 image quality
            signaturePad.toDataURL("image/svg+xml"); // save image as SVG data url

            signaturePad.toSVG();
            signaturePad.toSVG({includeBackgroundColor: true}); // add background color to svg output

            const clearBtn = document.querySelector("#clear-canvas");

            clearBtn.addEventListener('click', function () {
                signaturePad.clear();
            })

            const submitBtn = document.querySelector('#submit-canvas');

            submitBtn.addEventListener('click', function () {
                const data = signaturePad.toDataURL()

                axios.post('{{ url('confirm_signature') }}', {
                    'signature': data,
                    '_token' : '{{csrf_token()}}'
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(function (response) {
                        Swal.fire({
                            title: "Thành công",
                            text: "Đã nộp hồ sơ, chờ xác nhận. Liên hệ CSKH để được duyệt nhanh chóng",
                            icon: "success",
                            button:function () {

                            }
                        }).then((result)=>{
                            window.location.href = '{{url('/')}}'
                        });
                    })
                    .catch(function (error) {
                        Swal.fire({
                            title: "Không thành công",
                            text: "Có lỗi xảy ra",
                            icon: "error"
                        });
                    });
            })

        }
    </script>
@endsection

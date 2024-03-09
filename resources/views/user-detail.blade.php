@php use App\Models\Profile;use Illuminate\Support\Carbon; @endphp
@extends("layouts.app")
@section('content')
    <style>
        .avatar {
            width: 6rem;
        }
    </style>
    <div class="bg-mb text-white fw-bolder p-1 d-flex justify-content-between align-items-center ">
        <div class="p-1">
            <a href="{{url('profile')}}">
                <img style="width: 0.8rem" src="{{asset('img/back.png')}}">
            </a>
        </div>
        <h3 class="my-2 text-center text-uppercase">Thông tin cá nhân</h3>
        <div></div>
    </div>

    <div class="p-2 pt-3">
        <div class="d-flex w-100 align-items-center">
            <div class="avatar col-2">
                <img class="w-100 rounded"
                     src="{{$profile->getSelfieImageUrl()}}"
                     style="aspect-ratio: 1">
            </div>
            <div class="text-mb h2 font-weight-bold">
                <div style="margin-left: 1.5rem">
                    {{ $profile->name }}
                </div>
            </div>
        </div>
    </div>

    <div class="p-2">
        <div class="d-flex align-items-center">
            <img style="width: 1.2rem"
                 src="https://icones.pro/wp-content/uploads/2022/07/icones-d-administration-bleu.png">
            <span class="text-mb fw-bold ms-1 text-uppercase">Thông tin cá nhân</span>
        </div>
        <div class="mt-2">
            <div class="border-top p-1">
                <div class="row">
                    <div class="col-6">Họ tên</div>
                    <div class="col-6">{{$profile->name}}</div>
                </div>
            </div>
            <div class="border-top p-1">
                <div class="row">
                    <div class="col-6">Địa chỉ</div>
                    <div class="col-6">{{$profile->address}}</div>
                </div>
            </div>
            <div class="border-top p-1">
                <div class="row">
                    <div class="col-6">Số CMT / CCCD</div>
                    <div class="col-6">{{$profile->uuid}}</div>
                </div>
            </div>
            <div class="border-top p-1">
                <div class="row">
                    <div class="col-6">Ngày tháng năm sinh</div>
                    <div class="col-6">{{$profile->birthday}}</div>
                </div>
            </div>
            <div class="border-top p-1">
                <div class="row">
                    <div class="col-6">Nghề nghiệp</div>
                    <div class="col-6">{{$profile->job}}</div>
                </div>
            </div>
            <div class="border-top p-1">
                <div class="row">
                    <div class="col-6">Thu nhập hàng tháng</div>
                    <div class="col-6">{{Profile::salaryOptions()[$profile->salary]}}</div>
                </div>
            </div>
            <div class="border-top p-1">
                <div class="row">
                    <div class="col-6">Mục đích vay</div>
                    <div class="col-6">{{$profile->in_order_to}}</div>
                </div>
            </div>
            <div class="border-top p-1">
                <div class="row">
                    <div class="col-6">SĐT Người thân</div>
                    <div class="col-6">{{$profile->alt_phone}}</div>
                </div>
            </div>
            <div class="border-top p-1">
                <div class="row">
                    <div class="col-6">Mối quan hệ</div>
                    <div class="col-6">{{$profile->alt_relation}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-2 mt-3">
        <div class="d-flex align-items-center">
            <img style="width: 1.2rem"
                 src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxBhnHwmxdUANCWl-f4MSuJQ9vKkw_S97mCV_Bs1DhoEOwbnEuG3MBLFm7v7XgZcV82d4&usqp=CAU">
            <span class="text-mb fw-bold ms-1 text-uppercase">Tài khoản ngân hàng</span>
        </div>
        <div class="mt-2">
            <div class="border-top p-1">
                <div class="row">
                    <div class="col-6">Tên ngân hàng</div>
                    <div class="col-6">{{bank_info($profile->bank_name)['label']}}</div>
                </div>
            </div>
            <div class="border-top p-1">
                <div class="row">
                    <div class="col-6">STK Ngân hàng</div>
                    <div class="col-6 d-flex align-items-center">
                        <span id="bank_account" class="me-2">**********</span>
                        <img id="show_bank_account" style="width: 1rem; cursor: pointer"
                             src="https://cdn.pixabay.com/photo/2016/12/18/11/04/eye-1915454_1280.png" alt="">

                    </div>
                </div>
            </div>
            <div class="border-top p-1">
                <div class="row">
                    <div class="col-6">Tên người thụ hưởng</div>
                    <div class="col-6">{{$profile->account_name}}</div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('after_scripts')
    <script>

        $(document).ready(
            function () {
                let showBank = false

                $("#show_bank_account").click(function () {
                    if (!showBank) {
                        $("#bank_account").text("{{$profile->bank_account}}")
                        showBank = true
                        $("#show_bank_account").attr('src', 'https://cdn-icons-png.freepik.com/512/3507/3507619.png')
                    } else {
                        $("#bank_account").text("**********")
                        showBank = false
                        $("#show_bank_account").attr('src', 'https://cdn.pixabay.com/photo/2016/12/18/11/04/eye-1915454_1280.png')
                    }
                });
            }
        )
    </script>
@endpush


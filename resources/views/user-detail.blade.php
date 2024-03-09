@php use App\Models\Profile;use Illuminate\Support\Carbon; @endphp
@extends("layouts.app")
@section('content')
    <div class="bg-mb text-white fw-bolder p-1">
        <h3 class="my-2 text-center text-uppercase">Thông tin cá nhân</h3>
    </div>
    {{--    <div class="">--}}

    {{--        <div class="text-primary pb-3">Mục đích vay: </div><div>{{ $profile->in_order_to }}</div>--}}
    {{--        <div class="text-primary pb-3">Địa chỉ: </div><div>{{ $profile->address }}</div>--}}
    {{--        <div class="text-primary pb-3">Số tài khoản: </div><div>{{ $profile->bank_account }}</div>--}}
    {{--        <div class="text-primary pb-3">Chủ tài khoản: </div><div>{{ $profile->account_name }}</div>--}}
    {{--        <div class="text-primary pb-3">Ngân hàng: </div><div>{{ $profile->bank_name }}</div>--}}
    {{--    </div>--}}
    <div class="p-2 m-2 border shadow rounded">
        <div class="d-flex justify-content-between mb-1">
            <b>Họ và tên</b>
            <div>{{ $profile->name }}</div>
        </div>
        <div class="d-flex justify-content-between mb-1">
            <b>Số CMT/CCCD</b>
            <div>{{ hide_numbers($profile->uuid) }}</div>
        </div>
        <div class="d-flex justify-content-between mb-1">
            <b>Nghề nghiệp</b>
            <div>{{ $profile->job }}</div>
        </div>
        <div class="d-flex justify-content-between mb-1">
            <b>Ngày tháng năm sinh</b>
            <div>{{ $profile->birthday }}</div>
        </div>
        <div class="d-flex justify-content-between mb-1">
            <b>Địa chỉ</b>
            <div>{{ $profile->address }}</div>
        </div>

        <div class="d-flex justify-content-between mb-1">
            <b>Thu nhập hàng tháng</b>
            <div>{{ Profile::salaryOptions()[$profile->salary] }}</div>
        </div>

        <div class="d-flex justify-content-between mb-1">
            <b>Mục đích vay</b>
            <div>{{$profile->in_order_to }}</div>
        </div>

        <div class="d-flex justify-content-between mb-1">
            <b>SĐT Người thân</b>
            <div>{{$profile->alt_phone }}</div>
        </div>

        <div class="d-flex justify-content-between mb-1">
            <b>Mối quan hệ</b>
            <div>{{$profile->alt_relation }}</div>
        </div>


        <div class="d-flex justify-content-between mb-1">
            <b>Số tài khoản</b>
            <div>{{ hide_numbers($profile->bank_account) }}</div>
        </div>
        <div class="d-flex justify-content-between mb-1">
            <b>Chủ tài khoản</b>
            <div>{{ $profile->account_name }}</div>
        </div>
        <div class="d-flex justify-content-between mb-1">
            <b>Ngân hàng</b>
            <div>{{ bank_info($profile->bank_name)['name'] }}</div>
        </div>
    </div>
@endsection

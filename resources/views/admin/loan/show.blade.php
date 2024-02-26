@php
    /**
     * @var \App\Models\Loan $loan
 * @var \App\Models\Profile $profile
     */
@endphp

<div class="row">
    <div class="col-md-6">
        <div><span class="text-primary pb-3">Họ và tên: </span><span>{{ $profile->name }}</span></div>
        <div><span class="text-primary pb-3">Số CMT/CCCD: </span><span>{{ $profile->uuid }}</span></div>
        <div><span class="text-primary pb-3">Ngày tháng năm sinh: </span><span>{{ $profile->birthday }}</span></div>
        <div><span class="text-primary pb-3">Nghệ nghiệp: </span><span>{{ $profile->job }}</span></div>
        <div><span class="text-primary pb-3">Thu nhập một tháng: </span><span>{{ $profile->salary }}</span></div>
        <div><span class="text-primary pb-3">Mục đích vay: </span><span>{{ $profile->in_order_to }}</span></div>
        <div><span class="text-primary pb-3">Địa chỉ: </span><span>{{ $profile->address }}</span></div>
        <div><span class="text-primary pb-3">SĐT người thân: </span><span>{{ $profile->alt_phone }}</span></div>
        <div><span class="text-primary pb-3">Mối quan hệ với chủ khoản vay: </span><span>{{ $profile->alt_relation }}</span></div>
        <div><span class="text-primary pb-3">Số tài khoản: </span><span>{{ $profile->bank_account }}</span></div>
        <div><span class="text-primary pb-3">Chủ tài khoản: </span><span>{{ $profile->account_name }}</span></div>
        <div><span class="text-primary pb-3">Ngân hàng: </span><span>{{ $profile->bank_name }}</span></div>
        <div><span class="text-primary">Số tiền vay: </span><span>{{ number_format($loan->amount) }}</span> đ</div>
        <div><span class="text-primary">Thời gian vay: </span><span>{{ $loan->months }}</span> tháng</div>
    </div>
    <div class="col-md-6">

        <div class="my-1 row">
            <div class="col-6 mb-3">
                <div class="mb-1">CCCD Mặt trước</div>
                <a href="{{$profile->getFrontCardImageUrl()}}" target="_blank">
                    <img style="width: 150px" class="mb-1" src="{{ $profile->getFrontCardImageUrl() }}" alt="">
                </a>
            </div>
            <div class="col-6 mb-3">
                <div class="mb-1">CCCD Mặt sau</div>
                <a href="{{$profile->getBackCardImageUrl()}}" target="_blank">
                    <img style="width: 150px" class="mb-1" src="{{ $profile->getBackCardImageUrl() }}" alt="">
                </a>
            </div>
            <div class="col-6 mb-3">
                <div class="mb-1">Ảnh chân dung</div>
                <a href="{{$profile->getSelfieImageUrl()}}" target="_blank">
                    <img style="width: 150px" class="mb-1" src="{{ $profile->getSelfieImageUrl() }}" alt="">
                </a>
            </div>
            <div class="col-6 mb-3">
                <div class="mb-1">Chữ ký</div>
                <a href="{{$profile->getSelfieImageUrl()}}" target="_blank">
                    <img style="width: 150px" class="mb-1" src="{{ $loan->getSignature() }}" alt="">
                </a>
            </div>
        </div>

        @if($loan['status']==0)
            <a href="{{ url('admin/profile/' . $profile->id . '/edit') }}" class="btn btn-primary">Sửa hồ sơ</a>
            <a href="{{ url('admin/loan/' . $loan->id . '/approve') }}" class="btn btn-primary">Duyệt khoản vay</a>
        @endif
    </div>
</div>

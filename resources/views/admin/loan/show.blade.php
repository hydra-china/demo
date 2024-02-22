@php
    /**
     * @var \App\Models\Loan $loan
 * @var \App\Models\Profile $profile
     */
@endphp

<div class="row">
    <div class="col-md-6">
        <div><span class="text-primary">Họ và tên: </span><span>{{ $profile->name }}</span></div>
        <div><span class="text-primary">Số CMT/CCCD: </span><span>{{ $profile->uuid }}</span></div>
        <div><span class="text-primary">Ngày tháng năm sinh: </span><span>{{ $profile->birthday }}</span></div>
        <div><span class="text-primary">Nghệ nghiệp: </span><span>{{ $profile->job }}</span></div>
        <div><span class="text-primary">Thu nhập một tháng: </span><span>{{ $profile->salary }}</span></div>
        <div><span class="text-primary">Mục đích vay: </span><span>{{ $profile->in_order_to }}</span></div>
        <div><span class="text-primary">Địa chỉ: </span><span>{{ $profile->address }}</span></div>
        <div><span class="text-primary">SĐT người thân: </span><span>{{ $profile->alt_phone }}</span></div>
        <div><span class="text-primary">Mối quan hệ với chủ khoản vay: </span><span>{{ $profile->alt_relation }}</span>
        </div>
        <div><span class="text-primary">Số tài khoản: </span><span>{{ $profile->bank_account }}</span></div>
        <div><span class="text-primary">Chủ tài khoản: </span><span>{{ $profile->account_name }}</span></div>
        <div><span class="text-primary">Ngân hàng: </span><span>{{ $profile->bank_name }}</span></div>
    </div>
    <div class="col-md-6">
        <div><span class="text-primary">Số tiền vay: </span><span>{{ number_format($loan->amount) }}</span> đ</div>
        <div><span class="text-primary">Thời gian vay: </span><span>{{ $loan->months }}</span> tháng</div>
        <div class="d-flex my-1">
            <a href="{{$profile->getFrontCardImageUrl()}}" target="_blank">
                <img style="width: 100px" class="me-1" src="{{ $profile->getFrontCardImageUrl() }}" alt="">
            </a>
            <a href="{{$profile->getBackCardImageUrl()}}" target="_blank">
                <img style="width: 100px" class="me-1" src="{{ $profile->getBackCardImageUrl() }}" alt="">
            </a>
            <a href="{{$profile->getSelfieImageUrl()}}" target="_blank">
                <img style="width: 100px" class="me-1" src="{{ $profile->getSelfieImageUrl() }}" alt="">
            </a>
        </div>

        <a href="{{ url('admin/profile/' . $profile->id . '/edit') }}" class="btn btn-primary">Sửa hồ sơ</a>
        <a href="{{ url('admin/loan/' . $loan->id . '/approve') }}" class="btn btn-primary">Duyệt khoản vay</a>
    </div>
</div>

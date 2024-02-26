{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

{{--<li class="nav-item"><a class="nav-link" href="{{ backpack_url('profile') }}"><i class="nav-icon la la-question"></i> Hồ sơ </a></li>--}}





<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-list"></i> Thống kê</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('loan') }}"><i class="nav-icon la la-money-bill"></i> Khoản vay </a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('wallet') }}"><i class="nav-icon la la-wallet"></i> Ví</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('notification') }}"><i class="nav-icon la la-bell"></i> Thông báo nạp tiền</a></li>
    </ul>
</li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('staff') }}"><i class="nav-icon la la-user"></i> Danh sách CSKH</a></li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-list"></i> Cấu hình</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('config') }}"><i class="nav-icon la la-cogs"></i> Cài đặt</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('notification') }}"><i class="nav-icon la la-bell"></i> Thông báo</a></li>
    </ul>
</li>

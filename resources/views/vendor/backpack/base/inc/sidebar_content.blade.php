{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('loan') }}"><i class="nav-icon la la-question"></i> Khoản vay </a></li>
{{--<li class="nav-item"><a class="nav-link" href="{{ backpack_url('profile') }}"><i class="nav-icon la la-question"></i> Hồ sơ </a></li>--}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('staff') }}"><i class="nav-icon la la-question"></i> Danh sách NV</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('notification') }}"><i class="nav-icon la la-question"></i> Notifications</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('wallet') }}"><i class="nav-icon la la-question"></i> Wallets</a></li>
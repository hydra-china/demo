{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Khoản vay" icon="la la-question" :link="backpack_url('loan')" />
<x-backpack::menu-item title="Hồ sơ" icon="la la-question" :link="backpack_url('profile')" />
<x-backpack::menu-item title="CSKH" icon="la la-question" :link="backpack_url('staff')" />

@php
    /**
     * @var $widget
     */
    $tab = $widget['tab'];
//    dd($tab);
@endphp
<ul class="nav">
    <li class="nav-item">
        <a class="nav-link @if($tab=='loan') @else text-dark @endif" href="{{url('admin/loan')}}">Thông tin khoản
            vay</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab=='notification') @else text-dark @endif" href="{{url('admin/notification')}}">Nạp tiền</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab=='wallet') @else text-dark @endif" href="{{url('admin/wallet')}}">Quản lý tài
            khoản</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab=='recharge') @else text-dark @endif" href="{{url('admin/recharge')}}">Thông báo nạp tiền</a>
    </li>
</ul>

@php
    /**
* @var $widget
 */
    $data = $widget['data'];
@endphp
<div class="mt-4">
    <div class="d-flex w-75">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$data['total']}}</h5>
                    <p class="card-text">Tổng số khoản vay</p>
                    <a href="{{url('admin/loan')}}" class="card-link">Xem</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$data['waiting']}}</h5>
                    <p class="card-text">Khoản vay chờ duyệt</p>
                    <a href="{{url('admin/loan?status=0')}}" class="card-link">Xem</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$data['accept']}}</h5>
                    <p class="card-text">Khoản vay đã được duyệt</p>
                    <a href="{{url('admin/loan?status=1')}}" class="card-link">Xem</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$data['deny']}}</h5>
                    <p class="card-text">Khoản vay bị từ chối</p>
                    <a href="{{url('admin/loan?status=2')}}" class="card-link">Xem</a>
                </div>
            </div>
        </div>
    </div>
</div>

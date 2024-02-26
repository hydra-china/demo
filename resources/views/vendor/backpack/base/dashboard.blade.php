@php use App\Models\Loan; @endphp
@extends(backpack_view('blank'))

@php
    $totalLoan = Loan::query()->count();
    $waitingLoan = Loan::query()->where('status', 0)->count();
    $acceptLoan = Loan::query()->where('status', 1)->count();
    $denyLoan = Loan::query()->where('status', 2)->count();
@endphp

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$totalLoan}}</h5>
                        <p class="card-text">Tổng số khoản vay</p>
                        <a href="{{url('admin/loan')}}" class="card-link">Xem</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$waitingLoan}}</h5>
                        <p class="card-text">Khoản vay chờ duyệt</p>
                        <a href="{{url('admin/loan?status=0')}}" class="card-link">Xem</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$acceptLoan}}</h5>
                        <p class="card-text">Khoản vay đã được duyệt</p>
                        <a href="{{url('admin/loan?status=1')}}" class="card-link">Xem</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$denyLoan}}</h5>
                        <p class="card-text">Khoản vay bị từ chối</p>
                        <a href="{{url('admin/loan?status=1')}}" class="card-link">Xem</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

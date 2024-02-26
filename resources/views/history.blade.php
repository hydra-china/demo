@php use App\Models\Notification; @endphp
@php
    /**
     * @var Notification[] $notifications
     */
@endphp
@extends('layouts.app')
@section('content')
    <div class="fixed-top bg-mb text-white fw-bolder p-1">
        <h3 class="my-2 text-center text-uppercase">Lịch sử giao dịch</h3>
    </div>
    <div class="my-5 p-2">
        <div class="p-1"></div>
        @foreach($notifications as $notification)
            <div class="p-1 rounded bg-light border mb-2">
                <div class="{{$notification['type']==1?'text-success':'text-danger'}} h4 fw-bolder my-1">
                    {{$notification['type']==1?'+':'-'}}{{number_format($notification['amount'])}}
                    VND
                </div>
                <div class="text-mb">{{$notification['title']}}</div>
                <div class="small">{{$notification['created_at']}}</div>
            </div>
        @endforeach

    </div>
@endsection

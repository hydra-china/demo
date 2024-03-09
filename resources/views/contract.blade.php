@php
    /**
     * @var $contract
 * @var $signature
     */
@endphp
@extends('layouts.app')
@section('content')
    <style>
    </style>
    <div
            class="fixed-top bg-mb text-white fw-bolder p-1 @if($back)d-flex justify-content-between align-items-center @else text-center @endif">
        @if($back)
            <div class="p-1">
                <a href="{{url($back)}}">
                    <img style="width: 0.8rem" src="{{asset('img/back.png')}}">
                </a>
            </div>
        @endif
        <h3 class="my-2 text-center text-uppercase">Hợp đồng vay</h3>
        @if($back)
            <div class="p-1">
                <a href="{{$back}}">
                    <img style="width: 0rem" src="{{asset('img/back.png')}}">
                </a>
            </div>
        @endif
    </div>
    <div class="p-3 mt-5 bg-mb-img" style="position: relative">
        <img style="position: absolute;z-index: -1;top:5%" src="{{asset('img/bg-mb.jpg')}}" class="w-100">
        {!! $contract['value'] !!}
        <div class="d-flex justify-content-between">

            <div>
                <div class="text-center font-weight-bold mb-2">Bên vay</div>
                <img style="opacity: 0.7" src="{{url('uploads/'.$signature)}}" width="150px"> <h5
                    id="contractAppendName"></h5></div>

            <div>
                <div class="text-center font-weight-bold mb-2">Bên cho vay</div>
                <img style="opacity: 0.7" src="{{asset('img/sign-mb.jpg')}}" width="150px"> <h5
                    id="contractAppendName"></h5></div>
        </div>
    </div>
@endsection

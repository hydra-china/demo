@php
    /**
     * @var $contract
     */
@endphp
@extends('layouts.app')
@section('content')
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
    <div class="p-3 mt-5">
        {!! $contract['value'] !!}
        <div class="d-flex justify-content-between">
            <div><p>Bên vay</p> <img src="https://i.imgur.com/oCCFhps.png" width="150px"> <h5
                    id="contractAppendName"></h5></div>
            <div><p>Bên cho vay</p> <img src="https://i.imgur.com/oCCFhps.png" width="150px"> <h5
                    id="contractAppendName"></h5></div>
        </div>
    </div>
@endsection

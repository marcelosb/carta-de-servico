@extends('web.layouts.master')

@section('content')
    <section class="header--faq">
        <h1>{{ $faq->title }}</h1>
        <div class="line"></div>
    </section>

    <section class="wrapper">
        <div class="content--faq">
            {!! $faq->content !!}
        </div>
    </section>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/web/faq.css') }}">
@endsection

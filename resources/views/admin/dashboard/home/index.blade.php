@extends('admin.dashboard.layouts.master')

@section('content')
    <section class="container--home--cards">
        
        {{-- TOTAL DE SECRETARIAS REGISTRADAS --}}
        <div class="card--item">
            <div class="column--text">
                <span>{{ $secretariesTotal }}</span>
                <span>Secretarias</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -3 24 24" fill="white" width="65px" height="65px">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8.17 5.7L1 10.48V21h5v-8h4v8h5V10.25z"/>
                    <path d="M17 7h2v2h-2z" fill="none"/>
                    <path d="M10 3v1.51l2 1.33L13.73 7H15v.85l2 1.34V11h2v2h-2v2h2v2h-2v4h6V3H10zm9 6h-2V7h2v2z"/>
                </svg>
            </div>
        </div>

        {{-- TOTAL DE SERVIÇOS REGISTRADOS --}}
        <div class="card--item">
            <div class="column--text">
                <span>{{ $servicesTotal }}</span>
                <span>Serviços</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -3 24 24" fill="white" width="65px" height="65px">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                </svg>
            </div>
        </div>
    </section>

@endsection

@section('styles')
    <style>
        .container--home--cards {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 35px;
        }
        .container--home--cards > .card--item {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            width: 45%;
            padding: 20px;
        }

        .card--item > .column--text {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        .card--item > .column--text > span:first-child {
            font-size: 40px;
            font-weight: 600;
            color: #FFFFFF;
        }
        .card--item > .column--text > span:last-child {
            color: #FFFFFF;
            margin-top: -15px;
            font-size: 25px;
        }

        .container--home--cards > .card--item:first-child {
            background-color: #00C0EF;
        }
        .container--home--cards > .card--item:last-child {
            background-color: #003B6B;
        }

        @media screen and (min-width:0px) and (max-width: 999px) {
            .container--home--cards > .card--item {
                width: 100%;
                height: 110px;
                padding: 15px;
                margin-top: 20px;
            }
        }
    </style>   
@endsection

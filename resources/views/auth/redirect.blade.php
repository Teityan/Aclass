@extends('layouts.common')

@section('style')
    <style>
        td{padding:1rem}
        @media screen and (max-width:600px){
            td{padding:.25rem}
        }
        tr:nth-of-type(n+5) td, h2{text-align:center}
        .g-recaptcha > div{margin:0 auto}
    </style>
@endsection

@section('content')
    <div class=card>
        <h2>アプリへリダイレクト中</h2>
        <div style="text-align: center;"/>
        <button type="button" onclick="login();">ログインを完了する</button>
    </div>
        <script>
            function login() {
                location.href = "intent://aclass/#Intent;scheme=aclass;package=com.teityan.aclasstest;S.token={{auth()->user()->api_token}};end;"
            }
        </script>
    </div>
@endsection

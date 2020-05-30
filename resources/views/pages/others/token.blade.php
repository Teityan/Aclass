@extends('layouts.common')

@section('style')
    <style>
        form div{display:inline-block;margin-top:.5rem;text-align:left}
        input{font-size:1rem}
    </style>
    <script>
        function toggle(button) {
            var password = document.getElementById("token");
            if (password.type == "password") {
                button.innerHTML = "Hide";
                password.type = "text";
            }
            else {
                button.innerHTML = "Show";
                password.type = "password";
            }
        }


    </script>
@endsection

@section('content')
    <div class=card>
        <h3>トークン変更</h3>
        <form action="" method="POST" style=text-align:center>
            @csrf
                <label id=nowPassword>現在のトークン</label><br />
                <input type=password id=token name=token value="{{$token}}" style="width: 80%;" readonly/>
                <button class="ui-component__password-field__show-hide" type="button" onclick="toggle(this);">Show</button>
            <br />
            <div>
                <input class="button first-button" type=submit value="変更" />
            </div>
        </form>
    </div>
@endsection

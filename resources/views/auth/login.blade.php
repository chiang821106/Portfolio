@extends('layouts.app')

@section('content')

    <style>
        /* 背景圖 */
        .img {
            background-image: url('img/index/d3.jpg');
            background-attachment: fixed;
            background-position: center 0px;
            background-repeat: no-repeat;
            background-size: cover;
            height: 750px;
            padding-top: 130px;
        }

        /* navbar底部陰影 */
        #navBar {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 10px -10px;
        }

        /* 登入框樣式 */
        .card {
            border: 0;
            box-shadow: rgba(0,0,0,.16) 0 2px 5px 0, rgba(0,0,0,.12) 0 2px 10px 0;

        }

        .card-header {
            color: #fff;
            background: #F2994A;
            background-image: linear-gradient(120deg, #fda085  0%, #f6d365 100%);
        }

        /* 按鈕樣式 */
        .btn:active {
            box-shadow: none;
        }

        .btnAgree {
            background-color: #f1b432;
            color: #fff;
            box-shadow: rgba(0,0,0,.16) 0 2px 5px 0, rgba(0,0,0,.12) 0 2px 10px 0;
        }

        .btnAgree:hover,
        .btnAgree:focus {
            color: #fff;
            background-color: #df9f17;
            box-shadow: none;
        }

        .btnAgree:active {
            background-color: #b8861c;
        }

        /* 表單樣式 */
        .form-control:focus {
            border-color: #f1b432;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
            background-color: #fafafa;
        }

    </style>
    <section class="img">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 onclick="login()">{{ __('會員登入') }}</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="u_account"
                                        class="col-md-4 col-form-label text-md-right">{{ __('帳號') }}</label>

                                    <div class="col-md-6">
                                        <input id="u_account" type="text"
                                            class="form-control @error('u_account') is-invalid @enderror" name="u_account"
                                            value="{{ old('u_account') }}" required autocomplete="u_account" autofocus>

                                        @error('u_account')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('密碼') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('記住我') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btnAgree">
                                            {{ __('登入') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="/password.request">
                                                {{ __('忘記密碼?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>

    function login(){
        document.getElementById('u_account').value="cw1519";
        document.getElementById('password').value="111111111";
    }

    </script>
@endsection

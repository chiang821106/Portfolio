@extends('layouts.app')

@section('content')
    <style>
        /* 背景圖 */
        .img {
            background-image: url('img/index/d2.jpg');
            background-attachment: fixed;
            background-position: center -70px;
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
            margin-bottom: 30px
        }

        .card-header {
            color: #fff;
            background: #F2994A;
            background-image: linear-gradient(120deg, #fda085  0%, #f6d365 100%);
        }

        @media(max-width: 770px) {

            .img {
                height: 1100px;
            }
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
                        <div class="card-header" onclick="register()">
                            <h3>{{ __('註冊帳號') }}</h3>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                {{-- 姓名 --}}
                                <div class="form-group row">
                                    <label for="u_name" class="col-md-4 col-form-label text-md-right">{{ __('姓名') }}</label>

                                    <div class="col-md-6">
                                        <input id="u_name" type="text"
                                            class="form-control @error('u_name') is-invalid @enderror" name="u_name"
                                            value="{{ old('u_name') }}" required autocomplete="name" autofocus>

                                        @error('u_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- 帳號 (登入用)--}}
                                <div class="form-group row">
                                    <label for="u_account"
                                        class="col-md-4 col-form-label text-md-right">{{ __('會員帳號') }}</label>

                                    <div class="col-md-6">
                                        <input id="u_account" type="text"
                                            class="form-control @error('u_account') is-invalid @enderror" name="u_account"
                                            value="{{ old('u_account') }}" required autocomplete="u_account">

                                        @error('u_account')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- 密碼 --}}
                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('會員密碼') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                {{-- 確認密碼 --}}
                                <div class="form-group row">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-right">{{ __('再次確認密碼') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password"
                                            class="form-control  @error('password-confirm') is-invalid @enderror"
                                            name="password_confirmation" required autocomplete="new-password">

                                        @error('password-confirm')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- 電子郵件 --}}
                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('電子信箱') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>



                                {{-- 地址 --}}
                                <div class="form-group row">
                                    <label for="u_address"
                                        class="col-md-4 col-form-label text-md-right">{{ __('聯絡地址') }}</label>

                                    <div class="col-md-6">
                                        <input id="u_address" type="text"
                                            class="form-control @error('u_address') is-invalid @enderror" name="u_address"
                                            value="{{ old('u_address') }}" required autocomplete="u_address" autofocus>

                                        @error('u_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- 電話 --}}
                                <div class="form-group row">
                                    <label for="u_phone"
                                        class="col-md-4 col-form-label text-md-right">{{ __('手機號碼') }}</label>

                                    <div class="col-md-6">
                                        <input id="u_phone" type="text"
                                            class="form-control @error('u_phone') is-invalid @enderror" name="u_phone"
                                            value="{{ old('u_phone') }}" required autocomplete="u_phone" autofocus>

                                        @error('u_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- 權限(預設0->會員) --}}
                                <div class="form-group row" style="visibility:hidden">
                                    <label for="u_right"
                                        class="col-md-4 col-form-label text-md-right">{{ __('權限') }}</label>

                                    <div class="col-md-6">
                                        <input id="u_right" type="text"
                                            class="form-control @error('u_right') is-invalid @enderror" name="u_right"
                                            value="0" required autocomplete="u_right" autofocus>

                                        @error('u_right')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btnAgree">
                                            {{ __('會員註冊') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- <div class="card">
                        <img src="img/bg-img/bg-2.jpg" height="425px;" alt="">
                    </div> --}}

                </div>



            </div>
        </div>
    </section>
@endsection

<script>
    function register() {
        document.getElementById('u_name').value = "江小興";
        document.getElementById('u_account').value = "kavin555";
        document.getElementById('password').value = "kavin555";
        document.getElementById('password-confirm').value = "kavin555";
        document.getElementById('email').value = "kavin@gmail.com";
        document.getElementById('u_address').value = "台中市烏日區華安路18巷";
        document.getElementById('u_phone').value = "09653348561";
    }

</script>

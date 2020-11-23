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
            background-color: #f1bf52;
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
                        <div class="card-header"onclick="email()">
                          <h3 >{{ __('重設密碼連結信') }}</h3>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
        
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
        
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('電子郵件') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0 justify-content-center">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn btnAgree">
                                            {{ __('送出') }}
                                        </button>
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
      function email(){
          document.getElementById('email').value="test20200821@gmail.com"
      }

    </script>
@endsection

@include('web.layouts.LogLayouts.header')
<style>
    @if(session('lang') == 'ar')
        .form-body{
        direction: rtl;
        }
    .form-content .page-links a:last-child {
        margin-right: 20px
    }
    .form-content .form-items {
        text-align: right;
    }
    .form-content input {
        text-align: right;
    }
    .form-content .form-button .ibtn {
        margin-left: 10px;
        margin-right: 0;
    }
    @endif
</style>
<div class="form-body">
    <div class="website-logo">
        <a href="index-2.html">
            <div class="logo">
                <img class="logo-size" src="images/logo-light.svg" alt="">
            </div>
        </a>
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <p>{{session_lang(setting()->description,setting()->description_ar)}}</p>
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <div class="page-links">
                        <a href="{{ route('login') }}" class="active">{{trans('auth.Login')}}</a><a href="{{ route('register') }}">{{trans('auth.Register')}}</a>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                            @csrf
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{trans('auth.Email_Address')}}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{trans('auth.Password')}}" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">{{trans('auth.Login')}}</button> <a href="{{url('password/reset')}}">{{trans('auth.Forget_password')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('web.layouts.LogLayouts.footer')

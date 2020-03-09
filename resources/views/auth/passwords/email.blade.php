@include('web.layouts.LogLayouts.header')
<style>
    @if(session('lang') == 'ar')
        .form-body{
        direction: rtl;
    }
    .form-content .form-items h3,
    .form-content .form-items p {
        text-align: right;
    }
    .form-content input {
        text-align: right;
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
                    <p>{{setting()->description}}</p>
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>{{trans('auth.Password_Reset')}}</h3>
                        <p>{{trans('auth.To_reset_your_password_enter_the_email_address_you_use_to_sign')}}</p>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('auth.E-Mail_Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" style="width:auto" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('auth.Send_Password_Reset_Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="form-sent">
                    <div class="tick-holder">
                        <div class="tick-icon"></div>
                    </div>
                    <h3>{{trans('auth.Password_link_sent')}}</h3>
                    <p>{{trans('auth.Please_check_your_inbox')}} <a href="http://brandio.io/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="046d6b627669446d6b62766970616974686570612a6d6b">[email&#160;protected]</a></p>
                    <div class="info-holder">
                        <span>{{trans('auth.Unsure_if_that_email_address_was_correct')}}</span> <a href="#">{{trans('auth.We_can_help')}}</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/jquery.min.js"></script>
@include('web.layouts.LogLayouts.footer')

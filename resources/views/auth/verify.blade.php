@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('auth.Verify_Your_Email_Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ trans('auth.A_fresh_verification_link_has_been_sent_to_your_email_address') }}
                        </div>
                    @endif

                    {{ trans('auth.Before_proceeding_please_check_your_email_for_a_verification_link') }}
                    {{ trans('auth.If_you_did_not_receive_the_email') }}, <a href="{{ route('verification.resend') }}">{{ trans('auth.click_here_to_request_another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

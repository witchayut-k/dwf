@extends('auth.layouts.app')

@section('content')

<div class="app-login-box login">
    <div class="app-login-box-user">
        <div>
            <img src="{{ asset('backend/img/logo-circle.png') }}" alt="logo" />
        </div>
        <div>
            <img src="{{ asset('backend/img/logo-text.png') }}" alt="logo text" class="logo-text" />
        </div>
    </div>

    <div class="app-login-box-container">
        {{ Form::open(['url'=>route('login'),'id'=>'form-login', 'redirect-url'=> \App\Helpers\URLHelper::adminLoggedInURL()]) }}
        <div class="form-group">
            <label class="control-label">Username</label>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="form-group mb-10">
            <label class="control-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <div class="d-flex justify-between">
                <div class="app-checkbox">
                    <label>
                        <input type="checkbox" name="rememberme" checked> Remember me
                    </label>
                </div>
                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div>

        <div class="form-group">
            {{-- {!! htmlFormSnippet() !!} --}}
            {!! htmlFormSnippet([
                "theme" => "light",
                "size" => "normal",
                "tabindex" => "3",
                "callback" => "callbackFunction",
                "expired-callback" => "expiredCallbackFunction",
                "error-callback" => "errorCallbackFunction",
            ]) !!}
        </div>

        <button type="submit" class="btn btn-primary btn-block" disabled>Login</button>

        {{ Form::close() }}
    </div>

    {{-- <div class="app-login-box-footer">
        &copy; Boooya 2017. All rights reserved.
    </div> --}}
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/login.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\Auth\LoginRequest', '#form-login') !!}
{{-- {!! JsValidator::formRequest('App\Http\Requests\Backend\Auth\ForgetPasswordRequest', '#form-forget-password') !!}
--}}
<script>
    function callbackFunction (res) {
        $('.btn-primary').prop('disabled', false);
    }
</script>
@endsection
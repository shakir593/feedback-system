<!-- meta tags and other links -->
@extends('auth.layouts.auth-master')
@section('title', 'Login')
@section('css')
<style>
    .auth-login-page {
        margin: 0;
        background: #fff;
    }

    .auth-login {
        min-height: 100vh;
        display: flex;
        background: #fff;
    }

    .auth-login__visual {
        position: relative;
        flex: 1 1 50%;
        min-height: 100vh;
        background: #0b4fc1;
        overflow: hidden;
    }

    .auth-login__visual img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: left center;
    }

    .auth-login__panel {
        flex: 1 1 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px 32px;
        background: #fff;
    }

    .auth-login__card {
        width: 100%;
        max-width: 420px;
    }

    .auth-login__logo {
        display: flex;
        justify-content: center;
        margin-bottom: 28px;
    }

    .auth-login__logo img {
        width: 210px;
        height: auto;
        display: block;
    }

    .auth-login__title {
        margin: 0 0 8px;
        color: #0b1b3a;
        font-size: 26px !important;
        font-weight: 700;
        line-height: 1.3;
        letter-spacing: -0.02em;
    }

    .auth-login__subtitle {
        margin: 0 0 28px;
        color: #8b95a7;
        font-size: 15px;
        line-height: 1.5;
    }

    .auth-login__field {
        margin-bottom: 16px;
    }

    .auth-login .form-control {
        height: 52px;
        border: 1px solid #e6ebf2;
        border-radius: 12px;
        background: #f7f9fc;
        color: #0b1b3a;
        font-size: 15px;
        box-shadow: none;
    }

    .auth-login .form-control::placeholder {
        color: #9aa3b2;
    }

    .auth-login .form-control:focus {
        border-color: #2f80ed;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(47, 128, 237, 0.12);
    }

    .auth-login .icon-field .icon {
        color: #9aa3b2;
        font-size: 18px;
    }

    .auth-login .toggle-password {
        position: absolute;
        top: 26px;
        right: 16px;
        transform: translateY(-50%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border: 0;
        background: transparent;
        color: #9aa3b2;
        font-size: 18px;
        line-height: 1;
        cursor: pointer;
    }

    .auth-login__remember {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 4px 0 0;
        min-height: 0;
        padding-left: 0;
    }

    .auth-login__remember .form-check-input {
        float: none;
        margin: 0;
        width: 16px;
        height: 16px;
        border-color: #d5dbe6;
        cursor: pointer;
    }

    .auth-login__remember .form-check-label {
        color: #6b7280;
        font-size: 14px;
        cursor: pointer;
    }

    .auth-login__submit {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 52px;
        margin-top: 24px;
        border: 0;
        border-radius: 12px;
        background: #2f80ed;
        color: #fff;
        font-size: 15px;
        font-weight: 600;
        line-height: 1;
        cursor: pointer;
    }

    .auth-login__submit:hover {
        background: #1f6fe0;
    }

    .auth-login__footer {
        margin: 28px 0 0;
        text-align: center;
        color: #8b95a7;
        font-size: 14px;
    }

    .auth-login__footer a {
        color: #2f80ed;
        font-weight: 600;
        text-decoration: none;
    }

    .auth-login__footer a:hover {
        text-decoration: underline;
    }

    .auth-login .invalid-feedback {
        display: block;
    }

    @media (max-width: 991px) {
        .auth-login {
            flex-direction: column;
        }

        .auth-login__visual {
            flex: none;
            width: 100%;
            min-height: 240px;
            height: 34vh;
        }

        .auth-login__panel {
            flex: none;
            width: 100%;
            padding: 32px 20px 48px;
        }
    }
</style>
@endsection
@section('content')
    <section class="auth-login">
        <div class="auth-login__visual" aria-hidden="true">
            <img src="{{ asset('backend/assets/images/auth/feedback-auth-image.png') }}" alt="">
        </div>

        <div class="auth-login__panel">
            <div class="auth-login__card">
                <a href="{{ url('/') }}" class="auth-login__logo">
                    <img src="{{ asset('backend/assets/images/auth/feedback-logo.png') }}" alt="Feedback System">
                </a>

                <h1 class="auth-login__title">Sign In to your Account</h1>
                <p class="auth-login__subtitle">Welcome back! please enter your detail</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="icon-field auth-login__field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="position-relative auth-login__field">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="your-password" placeholder="Password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="button" class="toggle-password" data-toggle="#your-password" aria-label="Show password">
                            <iconify-icon icon="lucide:eye"></iconify-icon>
                        </button>
                    </div>

                    <div class="form-check auth-login__remember">
                        <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember" @checked(old('remember'))>
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <button type="submit" class="auth-login__submit">Sign In</button>

                    <p class="auth-login__footer">
                        Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $(".toggle-password").on("click", function() {
            var iconElement = $(this).find("iconify-icon");
            var input = $($(this).attr("data-toggle"));

            if (input.attr("type") === "password") {
                input.attr("type", "text");
                iconElement.attr("icon", "lucide:eye-off");
                $(this).attr("aria-label", "Hide password");
            } else {
                input.attr("type", "password");
                iconElement.attr("icon", "lucide:eye");
                $(this).attr("aria-label", "Show password");
            }
        });
    });
</script>
@endsection
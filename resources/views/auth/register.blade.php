@extends('auth.layouts.auth-master')
@section('title', 'Register')
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
        position: sticky;
        top: 0;
        flex: 1 1 50%;
        height: 100vh;
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
        align-items: flex-start;
        justify-content: center;
        padding: 16px 32px 40px;
        background: #fff;
    }

    .auth-login__card {
        width: 100%;
        max-width: 420px;
    }

    .auth-login__logo {
        display: flex;
        justify-content: center;
        margin-bottom: 8px;
    }

    .auth-login__logo img {
        width: 220px;
        height: 108px;
        object-fit: cover;
        object-position: center 42%;
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

    .auth-login__hint {
        display: block;
        margin-top: 8px;
        color: #8b95a7;
        font-size: 13px;
    }

    .auth-login__terms {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        gap: 8px;
        margin: 4px 0 0;
        min-height: 0;
        padding-left: 0;
    }

    .auth-login__terms .form-check-input {
        float: none;
        margin: 3px 0 0;
        width: 16px;
        height: 16px;
        border-color: #d5dbe6;
        cursor: pointer;
    }

    .auth-login__terms .form-check-label {
        flex: 1;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.5;
        cursor: pointer;
    }

    .auth-login__terms .form-check-label a {
        color: #2f80ed;
        font-weight: 600;
        text-decoration: none;
    }

    .auth-login__terms .invalid-feedback {
        flex-basis: 100%;
        margin-left: 24px;
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
            position: relative;
            top: auto;
            flex: none;
            width: 100%;
            height: 34vh;
            min-height: 240px;
        }

        .auth-login__panel {
            flex: none;
            width: 100%;
            padding: 16px 20px 40px;
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

                <h1 class="auth-login__title">Sign Up to your Account</h1>
                <p class="auth-login__subtitle">Welcome back! please enter your detail</p>

                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="icon-field auth-login__field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="f7:person"></iconify-icon>
                        </span>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Username" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="icon-field auth-login__field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" required>
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
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="your-password" required placeholder="Password">
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

                    <div class="position-relative auth-login__field">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                            </span>
                            <input type="password" name="password_confirmation" class="form-control" id="password-confirm" required placeholder="Confirm Password">
                        </div>
                        <button type="button" class="toggle-password" data-toggle="#password-confirm" aria-label="Show password">
                            <iconify-icon icon="lucide:eye"></iconify-icon>
                        </button>
                        <span class="auth-login__hint">Your password must have at least 8 characters</span>
                    </div>

                    <div class="form-check auth-login__terms">
                        <input class="form-check-input @error('terms_and_conditions') is-invalid @enderror" type="checkbox" name="terms_and_conditions" value="1" id="condition" @checked(old('terms_and_conditions'))>
                        <label class="form-check-label" for="condition">
                            By creating an account means you agree to the
                            <a href="javascript:void(0)">Terms &amp; Conditions</a> and our
                            <a href="javascript:void(0)">Privacy Policy</a>
                        </label>
                        @error('terms_and_conditions')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="auth-login__submit">Sign Up</button>

                    <p class="auth-login__footer">
                        Already have an account? <a href="{{ route('login') }}">Sign In</a>
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

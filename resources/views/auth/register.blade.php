<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<x-head/>

<body>

    <section class="auth bg-base d-flex flex-wrap">
        <div class="auth-left d-lg-block d-none">
            <div class="d-flex align-items-center flex-column h-100 justify-content-center">
                <img src="{{ asset('backend/assets/images/auth/auth-img.png') }}" alt="">
            </div>
        </div>
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <a href="{{ url('/') }}" class="mb-40 max-w-290-px">
                        <img src="{{ asset('backend/assets/images/logo.png') }}" alt="">
                    </a>
                    <h4 class="mb-12">Sign Up to your Account</h4>
                    <p class="mb-32 text-secondary-light text-lg">Welcome back! please enter your detail</p>
                </div>
                <form action="{{ route('register') }}" method = "post">
                    @csrf
                    <div class="icon-field mb-16">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="f7:person"></iconify-icon>
                        </span>
                        <input type="text" name = "name"  class="form-control h-56-px bg-neutral-50 radius-12 @error('name') is-invalid @enderror" placeholder="Username" value="{{ old('name') }}" required>

                         @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                    <div class="icon-field mb-16">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" name = "email" class="form-control h-56-px bg-neutral-50 radius-12 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email" required>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                    <div class="mb-20">
                        <div class="position-relative ">
                            <div class="icon-field">
                                <span class="icon top-50 translate-middle-y">
                                    <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                </span>
                                <input type="password" name = "password" class="form-control h-56-px bg-neutral-50 radius-12 @error('password') is-invalid @enderror" id="your-password" required placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                        </div>
                    </div>
                    <div class="mb-20">
                        <div class="position-relative ">
                            <div class="icon-field">
                                <span class="icon top-50 translate-middle-y">
                                    <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                </span>
                                <input type="password" name = "password_confirmation" class="form-control h-56-px bg-neutral-50 radius-12 @error('password') is-invalid @enderror" id="password-confirm" required placeholder="Confirm Password">
                            </div>
                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#password-confirm"></span>
                        </div>
                        <span class="mt-12 text-sm text-secondary-light">Your password must have at least 8 characters</span>
                    </div>
                    <div class="">
                        <div class="d-flex justify-content-between gap-2">
                            <div class="form-check style-check d-flex align-items-start">
                                <input class="form-check-input border border-neutral-300 mt-4 @error('terms_and_conditions') is-invalid @enderror" type="checkbox" name = "terms_and_conditions" value="" id="condition">
                                <label class="form-check-label text-sm" for="condition">
                                    By creating an account means you agree to the
                                    <a  href="javascript:void(0)" class="text-primary-600 fw-semibold">Terms & Conditions</a> and our
                                    <a  href="javascript:void(0)" class="text-primary-600 fw-semibold">Privacy Policy</a>
                                </label>
                                @error('terms_and_conditions')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                          
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign Up</button>

                    <div class="mt-32 center-border-horizontal text-center">
                        <span class="bg-base z-1 px-4">Or sign up with</span>
                    </div>
                    <!-- <div class="mt-32 d-flex align-items-center gap-3">
                        <button type="button" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
                            <iconify-icon icon="ic:baseline-facebook" class="text-primary-600 text-xl line-height-1"></iconify-icon>
                            Google
                        </button>
                        <button type="button" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
                            <iconify-icon icon="logos:google-icon" class="text-primary-600 text-xl line-height-1"></iconify-icon>
                            Google
                        </button>
                    </div> -->
                    <div class="mt-32 text-center text-sm">
                        <p class="mb-0">Already have an account? <a  href="{{ route('login') }}" class="text-primary-600 fw-semibold">Sign In</a></p>
                    </div>

                </form>
            </div>
        </div>
    </section>

<x-script />

<script>
    $(document).ready(function() {
                $(".toggle-password").on("click", function() {
            console.log("Toggle password clicked");
            var iconElement = $(this).find("iconify-icon");
            var input = $($(this).attr("data-toggle"));
            
            console.log("Input type before:", input.attr("type"));
            console.log("Icon element found:", iconElement.length);
            
            if (input.attr("type") === "password") {
                input.attr("type", "text");
                iconElement.attr("icon", "lucide:eye-off");
                console.log("Password shown, icon changed to eye-off");
            } else {
                input.attr("type", "password");
                iconElement.attr("icon", "lucide:eye");
                console.log("Password hidden, icon changed to eye");
            }
        });
    });
</script>
</body>

</html>
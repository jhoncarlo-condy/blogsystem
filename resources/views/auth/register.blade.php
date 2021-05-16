@extends('login.login')
@push('css')
<style>
    label{
        color:white;
    }
</style>
@endpush
@section('content')
<div class="col-md-12 ml-8 mt-4" style="color:white;">
    <a href="{{ route('welcome') }}">
    <button type="button" class="btn btn-primary"><i class="fas fa-arrow-left    "></i>Back</button>
    </a>
</div>
<div class="container" style="margin-bottom: 200px;">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container px-0">
            <img style="height:50px;widht:50px;"src="https://www.pngkey.com/png/full/232-2326777_blogger-logo-icons-no-attribution-white-blog-icon.png" alt="">

            </div>
            <h2 style="color:white;">Register</h2>
    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Login') }}" id="login">
        @csrf

        <div class="container">
            <label for="">Firstname</label>
            <input type="text" name="firstname" placeholder="Firstname" required="required" />
            @if ($errors->has('lastname'))
            <span class="text-danger" role="alert">
              {{ $errors->first('lastname') }}
            </span>
            @endif
        </div>
        <div class="container">
        <label for="">Lastname</label>
        <input type="text" name="lastname" placeholder="Lastname" required="required" />
        @if ($errors->has('lastname'))
        <span class="text-danger" role="alert">
          {{ $errors->first('lastname') }}
        </span>
        @endif
        </div>
        <div class="container">
        <label for="">Email</label>
        <input type="email" name="email" placeholder="E-mail Address" required="required" />
        @if ($errors->has('email'))
        <span class="text-danger" role="alert">
          {{ $errors->first('email') }}
        </span>
        @endif
        </div>
        <div class="container">
        <label for="">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required="required" />
        @if ($errors->has('password'))
        <span class="text-danger" role="alert">
          {{ $errors->first('password') }}
        </span>
        @endif
        </div>
        <div class="container">
        <label for="">Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="Password" required="required" />
        </div>

        <div class="container">
        <button type="submit" class="btn btn-primary btn-block btn-large">Register</button>
        </div>
    </form>
        </div>
    </div>
</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
@push('scripts')
{{-- jquery validation --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function()
    {
        $("#login").validate(
            {
                rules:
                {
                    firstname: "required",
                    lastname: "required",
                    email: "required",
                    password:
                    {
                        required:true,
                        minlength:6,
                    },
                    password_confirmation:
                    {
                        equalTo:"#password",
                    },
                },
                messages:
                {
                    password:
                    {
                        required: "Password field is required",
                        minlength: "Password must be at least 6 characters",
                    },
                    password_confirmation:
                    {
                        equalTo: "Password and Confirm password must match",
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.container').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }


            });



    });
</script>
@endpush

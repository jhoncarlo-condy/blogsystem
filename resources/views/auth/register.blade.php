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

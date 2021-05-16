@extends('login.login')

@section('content')
<div class="col-md-12 ml-8 mt-4" style="color:white;">
    <a href="{{ route('welcome') }}">
    <button type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i>Back</button>
    </a>

   </div>
<div class="login">
    <div class="container col-md-8">
        <img style="height:50px;widht:50px;"src="https://www.pngkey.com/png/full/232-2326777_blogger-logo-icons-no-attribution-white-blog-icon.png" alt="">
    </div>
	<h1>Login</h1>
    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
        @method('POST')
        @csrf
    	<input type="text" name="email" placeholder="E-mail Address" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        @if ($errors->has('email'))
            <span class="text-danger" role="alert">
                {{ $errors->first('email') }}
            </span>
        @endif
        @if ($errors->has('password'))
            <span class="text-danger" role="alert">
                {{ $errors->first('password') }}
            </span>
        @endif
        <button type="submit" class="btn btn-primary btn-block btn-large">Log in</button>
    </form>
</div>

@endsection

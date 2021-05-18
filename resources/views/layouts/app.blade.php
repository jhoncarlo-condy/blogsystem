<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="https://www.pngkey.com/png/full/232-2326777_blogger-logo-icons-no-attribution-white-blog-icon.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">

    {{-- sweetalert --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" integrity="sha512-hwwdtOTYkQwW2sedIsbuP1h0mWeJe/hFOfsvNKpRB3CkRxq8EW7QMheec1Sgd8prYxGm1OM9OZcGW7/GUud5Fw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <link rel="stylesheet" href="{{ asset('css/style.default.css') }}" id="theme-stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    {{-- adminlte --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0-rc/css/adminlte.min.css" integrity="sha512-S1Y8PRHoSCFivYnyJYztqto78nz9RCO/cnKTLG3+68QtiX0ttkzF6TOeHHghQDoYxGy6sJx17+cocftgUxUh8A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- boostrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    {{-- ionicon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" integrity="sha512-JApjWRnfonFeGBY7t4yq8SWr1A6xVYEJgO/UMIYONxaR3C9GETKUg0LharbJncEzJF5Nmiv+Pr5QNulr81LjGQ==" crossorigin="anonymous" />
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

   {{-- summernote --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" integrity="sha512-pDpLmYKym2pnF0DNYDKxRnOk1wkM9fISpSOjt8kWFKQeDmBTjSnBZhTd41tXwh8+bRMoSaFsRnznZUiH9i3pxA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" integrity="sha512-wXEyXmtKft9mEiu8LTc3+3BQ95aYbvxgvzH4IzFHOwvGlA14B6zREXD4CRmUPx8r2Z1RVUOXS47bwjsotSlZkQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" integrity="sha512-KbfxGgOkkFXdpDCVkrlTYYNXbF2TwlCecJjq1gK5B+BYwVk7DGbpYi4d4+Vulz9h+1wgzJMWqnyHQ+RDAlp8Dw==" crossorigin="anonymous" />
    {{-- toast --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" />

    {{-- fancybox --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha512-j7/1CJweOskkQiS5RD9W8zhEG9D9vpgByNGxPIqkO5KrXrwyDAroM9aQ9w8J7oRqwxGyz429hPVk/zR6IOMtSA==" crossorigin="anonymous"></script>
    {{-- bootstrap select --}}
<style>
        label.error
        {
            color:red;
        }
        input.error
        {
            color:red;
        }
        /* .eye
        {
            position: absolute;
            padding-right: 100&;
            margin-left: 5px;
            height: 25px;
            display: flex;
            align-items: center;


        } */

    </style>
    @stack('css')
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
        <!-- Navbar -->

        @include('layouts.navbar')


        <!-- /.navbar -->
        @if (Auth::user())
        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')
        @endif
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->

          @yield('content-header')

          <!-- Main content -->
          @yield('content-wrapper')
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        @include('layouts.footer')

    </div>
    <script>
        function readURL(input) {
   if (input.files && input.files[0]) {

     var reader = new FileReader();

     reader.onload = function(e) {
       $('.image-upload-wrap').hide();

       $('.file-upload-image').attr('src', e.target.result);
       $('.file-upload-content').show();

       $('.image-title').html(input.files[0].name);
     };

     reader.readAsDataURL(input.files[0]);

   } else {
     removeUpload();
   }
 }

 function removeUpload() {
   $('.file-upload-input').replaceWith($('.file-upload-input').clone());
   $('.file-upload-content').hide();
   $('.image-upload-wrap').show();
 }
 $('.image-upload-wrap').bind('dragover', function () {
     $('.image-upload-wrap').addClass('image-dropping');
   });
   $('.image-upload-wrap').bind('dragleave', function () {
     $('.image-upload-wrap').removeClass('image-dropping');
 });
 </script>
 {{-- sweetalert --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- bootstrap script --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
{{-- boostrap select --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
{{-- jquery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous"></script>

{{-- jquery validation --}}
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
{{-- summernote script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js" integrity="sha512-kZv5Zq4Cj/9aTpjyYFrt7CmyTUlvBday8NGjD9MxJyOY/f2UfRYluKsFzek26XWQaiAp7SZ0ekE7ooL9IYMM2A==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js" integrity="sha512-+cXPhsJzyjNGFm5zE+KPEX4Vr/1AbqCUuzAS8Cy5AfLEWm9+UI9OySleqLiSQOQ5Oa2UrzaeAOijhvV/M4apyQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js" integrity="sha512-98e5nQTE7pmtZ3xoD5GCVKafmziXDT5WINC91MugFzF57zzBnmvGQl1N70cvdyBSWxjCOC55gq9Zn76MUgtEMQ==" crossorigin="anonymous"></script>
{{-- adminlte --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0-rc/js/adminlte.min.js" integrity="sha512-/jef8/XLtQr4dHl6m/uYPWSGXgUs3gTFszQrpd791b7zYMPB8PCLdXJlUVjikDjHddPugjG6iPwmn7MDGNPZ6w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0-rc/js/demo.min.js" integrity="sha512-3/HE6zD8Gcgn/U/CWUJ8DRWFJIo7J0y53TurBXwmuVNamtzh1p+2Pu60NlvXunrcsTc61RL9x3qxD40DIOLbsg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stack('scripts')
@stack('addpost')
@stack('category')
</body>
</html>

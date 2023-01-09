<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MyClothes</title>
 @include('layouts.fixed.head')

 <style>
  .CenterPage {
    width: auto;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%)}
  .txtstyle {
    font-size: 16px;  
    font-weight: 490; 
    text-align: center;
    color: grey}
  .screencenter{
    text-align: center}
  .imgrounded {
    border-radius: 20%}
  .btn-primary {
    background-color: #320662 !important;
    padding: 11px;
    width: 170px;
    border-radius: 13px;
  }

 </style>
</head>

<body>
<div class="hold-transition">   
  <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="{{asset('assets/img/MyClothes Logo.png')}}" alt="MyClothes Logo" height="100" width="100">
    </div>
      <div class="CenterPage">
        @if ($message = Session::get('success'))
          <div class="alert alert-info">
              {{ $message }}
          </div>
        @endif
      <div class="screencenter">
      <img src="{{asset('assets/img/logo.png')}}" class="imgrounded" alt="Logo" height="150" width="150"></p>
      </div>

      <div class="screencenter">
        <img src="{{asset('assets/img/name.png')}}" alt="name" height="80" width="240"></p>
      </div>

      <div class="txtstyle">
        <p> Our B2B technology platform enables apparel brands to match their customers with the best-fitting products. </p>
      </div>
      <br>
      <br>
      <br>
      <div class="screencenter">
        <a class="btn btn-primary" href="{{ route('signin') }}"> PROCEED</a>
      </div>
    </div>
</div>
  @include('layouts.fixed.footer-scripts')
</body>
</html>
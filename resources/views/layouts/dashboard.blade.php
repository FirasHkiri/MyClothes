@extends('layouts.fixed.master')


@section('title')
  MyClothes  
@endsection


@section('css')
<style>
  .CenterPage {
    width: auto;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%)}
  .txtstyle {
    font-size: 16px;
    font-family: 'georgia';
    font-weight: 510; 
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
@endsection


@section('scripts')

@endsection


@section('content')
      <div class="CenterPage">
        <div class="screencenter">
          <img src="{{asset('assets/img/logo.png')}}" class="imgrounded" alt="Logo" height="150" width="150"></p>
        </div>
        <div class="screencenter">
          <img src="{{asset('assets/img/name.png')}}" alt="name" height="80" width="240"></p>
        </div>
    </div>
@endsection


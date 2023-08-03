@extends('layouts.template')
@section('content')
<div class="col-8 col-lg-8">
<div class="row">

  <div class="col">
    <!-- Title and Top Buttons Start -->
    <div class="page-title-container">
      <div class="row">
        <!-- Title Start -->
        <div class="col">
          <h1 class="mb-0 pb-0 display-4" id="title">Settings</h1>
        </div>
      </div>
    </div>
    <!-- Title and Top Buttons End -->

    <!-- Public Info Start -->
    <h2 class="small-title">Setting</h2>
    <div class="card mb-5">
      @if (session('success'))
          <div class="alert alert-success">
              <p class="msg"> {{ session('success') }}</p>
          </div>
        @endif
      <div class="card-body">
        <form action="{{route('settings.edit')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">App Name</label>
            <div class="col-sm-8 col-md-9 col-lg-10">
              <input type="text" class="form-control" name="app_name" value="{{$setting->app_name}}" />
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">App Icon</label>     
            <div class="col-sm-8 col-md-9 col-lg-10">
              <input type="hidden" id="custId" name="app_icon_hidden" value="{{$setting->app_icon}}">
              <img src="{{ asset('img/favicon/') }}/{{$setting->app_icon}}" width="32" height="32"><input type="file" id="myFile" name="app_icon" style="float: right;">
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">App Logo</label>                
            <div class="col-sm-8 col-md-9 col-lg-10">
              <input type="hidden" id="custId" name="app_logo_hidden" value="{{$setting->app_logo}}">
              <img src="{{ asset('img/logo/') }}/{{$setting->app_logo}}" width="50" height="50"><input type="file" id="myFile" name="app_logo" style="float: right;">
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Opening Time</label>
 
            <div class="col-sm-8 col-md-9 col-lg-10">
              <input type="text" class="form-control" name="opening" value="{{$setting->opening}}"/>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Closing Time</label>
            <div class="col-sm-8 col-md-9 col-lg-10">
              <input type="text" class="form-control date-picker-close" name="closing" value="{{$setting->closing}}" />
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Tickets Starts From</label>
            <div class="col-sm-8 col-md-9 col-lg-10">
              <input type="text" class="form-control date-picker-close" name="ticket_starts" value="{{$setting->ticket_starts}}" />
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8 col-md-9 col-lg-10">
              <input type="email" class="form-control" name="email" value="{{$setting->email}}"  />
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Phone</label>
            <div class="col-sm-8 col-md-9 col-lg-10">
              <input type="text" class="form-control" name="contact" value="{{$setting->contact}}" />
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Ticket Message</label>
            <div class="col-sm-8 col-md-9 col-lg-10">
              <textarea class="form-control" name="message"  rows="3">{{$setting->message}}</textarea>

            </div>
          </div>
          
           <div class="mb-3 row">
            <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Promotional Message</label>
            <div class="col-sm-8 col-md-9 col-lg-10">
              <textarea class="form-control" name="user_message"  rows="3">{{$setting->user_message}}</textarea>

            </div>
          </div>
          <div class="mb-3 row mt-5">
            <div class="col-sm-8 col-md-9 col-lg-10 ms-auto">
              <button type="submit" class="btn btn-outline-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>


      </section>
    </div>



@endsection
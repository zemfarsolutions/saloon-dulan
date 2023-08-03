@extends('layouts.template')
@section('content')


    <div class="col-8 col-lg-8">
      <!-- Inventory Start -->
      <h2 class="small-title">Edit</h2>
      
   
      <!-- Today's Orders End -->
      <section class="scroll-section" id="basic">
        <!-- Basic Start -->
        <h2 class="small-title"> Hair Dresser</h2>
        <div class="card mb-5"> @if (session('success')) 
          <div class="alert alert-success">
              <p class="msg"> {{ session('success') }}</p>
          </div>
        @endif
          <div class="card-body">
            <form action="{{route('hairdresser.edit' , ['user' => $user->id])}}" method="POST">
              @csrf
              @method('put')
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{$user->name}}" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{$user->email}}" class="form-control" required />
              </div>
              
              <button type="submit" class="btn btn-primary">Save</button>&nbsp;&nbsp;&nbsp;<a href="{{ route('hairdresser') }}"><button type="button" class="btn btn-alternate">Cancel</button></a>
            </form>
          </div>
        </div>
      </section>
      <!-- Categories End -->
    </div>



@endsection
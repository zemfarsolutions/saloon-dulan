@extends('layouts.template')
@section('content')


    <div class="col-8 col-lg-8">
      <!-- Inventory Start -->
      <h2 class="small-title">Add</h2>
      
   
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
            <form action="{{route('hairdresser.add')}}" method="POST">
              @csrf
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" />
              </div>
              
              <div class="mb-3 w-100" data-select2-id="10">
                <label class="form-label">Section</label>
                <select  tabindex="-1" class="form-select" required name="section_id">
                  <option value="" selected>Select Section</option>
                  @foreach($section as $dt)
                  <option value="{{$dt->id}}" >{{$dt->name}}</option>
                  @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Save</button>&nbsp;&nbsp;&nbsp;<a href="{{ route('hairdresser') }}"><button type="button" class="btn btn-alternate">Cancel</button></a>
            </form>
          </div>
        </div>
      </section>
      <!-- Categories End -->
    </div>



@endsection
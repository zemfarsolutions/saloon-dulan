@extends('layouts.template')
@section('content')


    <div class="col-8 col-lg-8">
      <!-- Inventory Start -->
      <h2 class="small-title">Add</h2>
      
   
      <!-- Today's Orders End -->
      <section class="scroll-section" id="basic">
        <!-- Basic Start -->
        <h2 class="small-title"> Appointment</h2>
        <div class="card mb-5"> @if (session('success'))
          <div class="alert alert-success">
              <p class="msg"> {{ session('success') }}</p>
          </div>
        @endif
          <div class="card-body">
            <form action="{{route('appointments.add')}}" method="POST">
              @csrf
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" />
              </div>
              <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Hair Dresser</label>
                <select name = "hairdresser" class="form-control" >
                  <option value="">Select Hair Dresser</option>
                  @foreach($hairdresser as $hairdressers)
                  <option value="{{ $hairdressers->id }}">{{$hairdressers->name}}</option>
                  @endforeach
                </select>
              </div>
             
              <button type="submit" class="btn btn-primary">Save</button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-alternate">Cancel</button>
            </form>
          </div>
        </div>
      </section>
      <!-- Categories End -->
    </div>



@endsection
@extends('layouts.template')
@section('content')


    <div class="col-8 col-lg-8">
      <!-- Inventory Start -->
      <h2 class="small-title">Add Role</h2>
      
      <section class="scroll-section" id="basic">
        <!-- Basic Start -->
        <h2 class="small-title">Role</h2>
        <div class="card mb-5">
          @if (session('success'))
          <div class="alert alert-success">
              <p class="msg"> {{ session('success') }}</p>
          </div>
        @endif
          <div class="card-body">
            <form action="{{route('roles.add')}}" method="POST">
              @csrf
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" required />
              </div>
              
              <button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;&nbsp;<a href="{{ route('roles') }}"><button type="button" class="btn btn-alternate">Cancel</button></a>
            </form>
          </div>
        </div>
      </section>
    </div>



@endsection
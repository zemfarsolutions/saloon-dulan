@extends('layouts.template')
@section('content')


    <div class="col-8 col-lg-8">
      <h2 class="small-title">Edit</h2>
      <!-- Inventory Start -->
      <h2 class="small-title">Role</h2>
      
      <section class="scroll-section" id="basic">
        <!-- Basic Start -->
        <div class="card mb-5">
          @if (session('success'))
          <div class="alert alert-success">
              <p class="msg"> {{ session('success') }}</p>
          </div>
        @endif
          <div class="card-body">
            <form action="{{ route('roles.edit', ['userrole' => $userrole->id]) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" value="{{$userrole->name}}" name="name" required />
              </div>
              
              <button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;&nbsp;<a href="{{ route('roles') }}"><button type="button" class="btn btn-alternate">Cancel</button></a>
            </form>
          </div>
        </div>
      </section>
    </div>



@endsection
@extends('layouts.template')
@section('content')


    <div class="col-8 col-lg-8">
      <!-- Inventory Start -->
      <h2 class="small-title">Edit</h2>
      
      <section class="scroll-section" id="basic">
        <h2 class="small-title">User</h2>
        <div class="card mb-5">
          @if (session('success'))
          <div class="alert alert-success">
              <p class="msg"> {{ session('success') }}</p>
          </div>
        @endif
          <div class="card-body">
            <form action="{{ route('users.edit', ['user' => $user->id]) }}" method="POST">
              @csrf
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{$user->name}}" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{$user->email}}" class="form-control" required />
              </div>
              
              
              <div class="mb-3 w-100" data-select2-id="10">
                <label class="form-label">Role</label>
                <select  tabindex="-1" class="form-select" required name="role_id">
                  <option value="" selected>Select Role</option>
                  @foreach($role as $dt)
                  <option value="{{$dt->id}}" @if($dt->id == $user->role_id) selected @endif >{{$dt->name}}</option>
                  @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Save</button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-alternate">Cancel</button>
            </form>
          </div>
        </div>
      </section>
    </div>



@endsection
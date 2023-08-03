@extends('layouts.template')
@section('content')


    <div class="col-8 col-lg-8">
 <!-- Inventory Start -->
 <div class="page-title-container">
  <div class="row">
    <!-- Title Start -->
    <div class="col-12 col-md-7">
      <h1 class="mb-0 pb-0 display-4" id="title">Promotion List</h1>
     
    </div>
    <!-- Title End -->

    <!-- Top Buttons Start -->
    <div class="col-12 col-md-5 d-flex align-items-start justify-content-end">
      <!-- Add New Button Start -->
      <a href="{{ route('promotion.add')  }}" >
      <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto add-datatable">
        <i data-cs-icon="plus"></i>
        <span>Add New</span>
      </button> </a>
      <!-- Add New Button End -->

      <!-- Check Button Start -->
      <div class="btn-group ms-1 check-all-container">



      </div>
      <!-- Check Button End -->
    </div>
    <!-- Top Buttons End -->
  </div>
</div>
      <section class="scroll-section" id="stripedRows">
        <div class="card mb-5">
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" width="5%">#</th>
                  <th scope="col" width="20%">Name</th>
                  <th scope="col" width="30%">Image</th>
                  <th scope="col" width="30%">Actions</th>
                </tr>
              </thead>
              <tbody>

                 @foreach($data as $dt)
                <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <td>{{ $dt->name }}</td>
                  <td>{{ $dt->image }}</td>

                  <td>
                    
                   
                  <a href="{{route('promotion.delete', ['user'=>$dt->id])}}" class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="cs-icon cs-icon-bin"><path d="M4 5V14.5C4 15.9045 4 16.6067 4.33706 17.1111C4.48298 17.3295 4.67048 17.517 4.88886 17.6629C5.39331 18 6.09554 18 7.5 18H12.5C13.9045 18 14.6067 18 15.1111 17.6629C15.3295 17.517 15.517 17.3295 15.6629 17.1111C16 16.6067 16 15.9045 16 14.5V5"></path><path d="M14 5L13.9424 4.74074C13.6934 3.62043 13.569 3.06028 13.225 2.67266C13.0751 2.50368 12.8977 2.36133 12.7002 2.25164C12.2472 2 11.6734 2 10.5257 2L9.47427 2C8.32663 2 7.75281 2 7.29981 2.25164C7.10234 2.36133 6.92488 2.50368 6.77496 2.67266C6.43105 3.06028 6.30657 3.62044 6.05761 4.74074L6 5"></path><path d="M2 5H18M12 9V13M8 9V13"></path></svg>
                    <span class="d-none d-xxl-inline-block">Delete</span>
                  </a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>



@endsection
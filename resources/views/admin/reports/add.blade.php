@extends('layouts.template')
@section('content')


    <div class="col-8 col-lg-8">
      <!-- Inventory Start -->
      
   
      <section class="scroll-section" id="basic">
        <!-- Basic Start -->
        <h2 class="small-title">Report</h2>
        <div class="card mb-5">
          @if (session('success')) 
          <div class="alert alert-success">
              <p class="msg"> {{ session('success') }}</p>
          </div>
          @endif
          <div class="card-body">
            <form action="{{route('report.get')}}" method="POST">
              @csrf
              <div class="mb-2">
                <label class="form-label">Desk</label>
                 <select  tabindex="-1" class="form-select"  name="section_id">
                  <option value="" selected>Select Desk</option>
                  @foreach($sections as $dt)
                  <option value="{{$dt->id}}" >{{$dt->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label">Hair dresser</label>
                 <select  tabindex="-1" class="form-select"  name="user_id">
                  <option value="" selected>Select Hair Dresserxxx</option>
                  @foreach($hairdressers as $dt)
                  <option value="{{$dt->id}}" >{{$dt->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label">Ticket Status</label>
                 <select  tabindex="-1" class="form-select"  name="ticket_status">
                  <option value="" selected>Select Ticket Status</option>
                  <option value="0" >In Que</option>
                    <option value="1" >Serving</option>
                    <option value="2" >Served</option>
                    <option value="3" >Discarded</option>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label">Ticket Type</label>
                 <select  tabindex="-1" class="form-select"  name="ticket_type">
                  <option value="" selected>Select Ticket Type</option>
                  <option value="0" >General</option>
                    <option value="1" >Appointments</option>
                    <option value="2" >Special</option>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label">Start Date</label>
                <input type="text" id="fp-default" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly" name="start_date">
              </div>
              <div class="mb-2">
                <label class="form-label">End Date</label>
                <input type="text" id="fp-default" class="form-control flatpickr-basic flatpickr-input active" placeholder="YYYY-MM-DD" readonly="readonly" name="end_date">
              </div>
              <button type="submit" class="btn btn-primary">Search</button>
            </form>
          </div>
        </div>
      </section>
      @if(!empty($data))
       <section class="scroll-section" id="stripedRows">
        <div class="card mb-5">
          <div class="card-body">
           
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" width="5%">#</th>
                  <th scope="col" width="20%">Ticket No</th>
                  <th scope="col" width="20%">Ticket Type</th>
                  <th scope="col" width="30%">Desk</th>
                  <th scope="col" width="20%">Hair Dresser</th>
                  <th scope="col" width="20%">InQue Time</th>
                  <th scope="col" width="20%">Serving From</th>
                  <th scope="col" width="20%">Served Time</th>
                </tr>
              </thead>
              <tbody>

                 @foreach($data as $dt)
                <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  @if($dt->is_appoint == 1)
                  <td>{{ $dt->ticket_number }}A</td>
                  @elseif ($dt->is_appoint == 2)
                  <td>{{ $dt->ticket_number }}S</td>
                    @else
                  <td>{{ $dt->ticket_number }}G</td>
                  @endif
                  
                  @if($dt->is_appoint == 1)
                  <td>A</td>
                  @elseif ($dt->is_appoint == 2)
                  <td>S</td>
                  @else
                  <td>G</td>
                  @endif
                  <td>{{ $dt->section_name }}</td>
                  <td>{{ $dt->name }}</td>
                   <td>{{ $dt->enqueue_time }}</td>
                  <td>{{ $dt->serving_time }}</td>
                   <td>{{ $dt->served_time }}</td>
                 
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </section>
      @endif
    </div>



@endsection
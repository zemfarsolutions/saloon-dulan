@extends('layouts.template')
@section('content')


    <div class="col-8 col-lg-8">
      <div class="row">
      <h2 class="small-title">Today Summary</h2>
      <div class="mb-5">
        <div class="row g-2 card hover-scale-up cursor-pointer sh-15">
          <div class="col-12 col-sm-6 col-lg-3">

              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                <div>
                  <i data-cs-icon="radish" class="text-white"></i>
                </div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Served</div>
                <div class=""><h1>
                  
                  {{$data['served']}} </h1></div>
              </div>

          </div>
          <div class="col-12 col-sm-6 col-lg-3">
            
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                <div>
                  <i data-cs-icon="loaf" class="text-white"></i>
                </div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Serving</div>
                <div class=""><h1>
                  {{$data['serving']}}
                  </h1></div>
              </div>

          </div>
          <div class="col-12 col-sm-6 col-lg-3">
            
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                <div>
                  <i data-cs-icon="pepper" class="text-white"></i>
                </div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">InQue</div>
                <div class=""><h1>
                  {{$data['inque']}}
                  </h1></div>
              </div>

          </div>
          <div class="col-12 col-sm-6 col-lg-3">
            
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                <div>
                  <i data-cs-icon="pepper" class="text-white"></i>
                </div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Total</div>
                <div><h1>
                  {{$data['served']+$data['inque']+$data['serving']}}
                 
                  </h1></div>
              </div>

          </div>
        
        </div>
      </div>
    </div>
        
        <div class = "row">
                <div class="mb-5">
                <h2 class="small-title">Session Status</h2>
              <div class="col-12 col-sm-6 col-lg-3" >
           
            <div class="card hover-scale-up cursor-pointer" style = "background:green !important;">
              <form action="{{route('admin.session')}}" method="POST" id = "form-ap">
                <a href="javascript:{}" onclick="document.getElementById('form-ap').submit(); return false;">
                  @csrf
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
              
               <div style="color:white" class="heading text-center mb-0 d-flex align-items-center lh-1">@if(!is_null($sessionss)) @if($sessionss->session_status==0) Session Started At @endif @else Click to Start Session @endif</div>
                <div style="color:white" class="heading text-center mb-0 d-flex align-items-center lh-1">@if(!is_null($sessionss)) @if($sessionss->session_status==0) @php  $c_date = date('d-m-Y H:i:s', strtotime($sessionss->session_start_at)); echo $c_date; @endphp  @endif @endif</div>
              </div>
              </form>
                </div></a>
       
          </div>
          </div>
        </div>

     

    <div class="row">
      
      <div class="mb-5">
<h2 class="small-title">Serving</h2>
       
        <div class="row g-2">
        @foreach($ticketServing as $ticket)
           
                    
          <div class="col-12 col-sm-6 col-lg-1" style="width: 5.6%;">
           
            <div class="sw-6 sh-6 me-1 mb-1 d-inline-block bg-separator d-flex justify-content-center align-items-center rounded-md col-md-2" style="background-color:#d4d4d4; !important;">
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
               
                <h2 style="color:#000 !important;" class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}</h2>
<!--                 <div class="heading text-center mb-0 d-flex align-items-center lh-1">
                  @php
                  $section = DB::select("select name from sections where id = ?",[$ticket->section_id]);
                @endphp {{$section[0]->name}}</div> -->
<!--                 <div style="color:black" class="text-small ">Estimated Time: @php $date = strtotime($ticket->possible_serving); echo date('H:i:s A', $date); @endphp </div> -->
<!--                 <div style="color:black" class="text-small ">Service Start: @php  $date = $time = date('H:i:s A', strtotime($ticket->serving_time)); echo $date; @endphp </div> -->
              </div>
            </div>
          </div>
            @endforeach
        </div>
      </div>
    
      <div class="mb-5">
        <h2 class="small-title">Appointment</h2>
        <div class="row g-2">
            @foreach($special as $ticket)
           
          <div class="col-12 col-sm-6 col-lg-1"style="width: 5.6%;">
            <form action="{{route('ticket.discard', ['ticket' => $ticket->id])}}" method="POST" id = "form-ap-{{$ticket->id}}">
              @csrf
<!--               <a href="javascript:{}" onclick="document.getElementById('form-ap-{{$ticket->id}}').submit(); return false;"> -->
    
            <div class="sw-6 sh-6 me-1 mb-1 d-inline-block bg-separator d-flex justify-content-center align-items-center rounded-md col-md-2" style="background-color:#d4d4d4; !important;">
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">

            
                <h2 style="color:#000 !important;" class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}A</h2>
<!--                 <h3 style="color:#000 !important;" class="heading text-center mb-0 d-flex align-items-center lh-1">
                  @php
                  $section = DB::select("select name from sections where id = ?",[$ticket->section_id]);
                @endphp {{$section[0]->name}}</h3> -->
               
               
              </div>
            </div>
<!--               </a> -->
          </form>
          </div>
        @endforeach
        </div>
      </div>
    
      <div class="mb-5">
        <h2 class="small-title">In-Queue</h2>
     
        <div class="row g-2">
            @foreach($ticketQ as $ticket)
           
          <div class="col-12 col-sm-6 col-lg-1"style="width: 5.8%;" >
            <form action="{{route('ticket.discard', ['ticket' => $ticket->id])}}" method="POST" id="frm-q-{{$ticket->id}}" style="height:100%!important;width:100%!important">
              @csrf
             <div class="sw-6 sh-6 me-1 mb-1 d-inline-block bg-separator d-flex justify-content-center align-items-center rounded-md col-md-2" style="background-color:#d4d4d4; !important;">
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                @if ($ticket->is_appoint==1)
                <h2 class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}A</h2>
                @elseif($ticket->is_appoint==2)
                <h2 class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}S</h2>
               @else
              <h2 class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}</h2>
                 @endif
                
                
              </div><center></center> 
            </div>
          </form>
          </div>
        @endforeach
        </div>
      </div>
      <div class="mb-5">
        
        <h2 class="small-title">Served</h2>
        <div class="row g-2">
        
            @foreach($ticketServed as $ticket)
            
          
          <div class="col-12 col-sm-6 col-lg-2"style="width: 5.8%;">
             <div class="sw-6 sh-6 me-1 mb-1 d-inline-block bg-separator d-flex justify-content-center align-items-center rounded-md col-md-2" style="background-color:#d4d4d4; !important;">
            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
               @if ($ticket->is_appoint==1)
                <h2 class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}A</h2>
                @elseif($ticket->is_appoint==2)
                <h2 class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}S</h2>
               @else
              <h2 class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}</h2>
                 @endif
              </div>
              </div>
            </div>
                    @endforeach
          </div>

         
         
        </div>

      <div class="mb-5">
        <h2 class="small-title">Discarded</h2>
        <div class="row g-2">
         
            @foreach($ticketDicarded as $ticket)
          
          <div class="col-12 col-sm-6 col-lg-2"style="width: 5.6%;">
             <div class="sw-6 sh-6 me-1 mb-1 d-inline-block bg-separator d-flex justify-content-center align-items-center rounded-md col-md-2" style="background-color:#d4d4d4; !important;">
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
               
                @if ($ticket->is_appoint==1)
                <h2 class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}A</h2>
                @elseif($ticket->is_appoint==2)
                <h2 class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}S</h2>
               @else
              <h2 class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}</h2>
                 @endif
                
            </div>
          </div>

         
          
         
        </div>
                    @endforeach
      </div>
    </div>
            </div>
    </div>
    




@endsection
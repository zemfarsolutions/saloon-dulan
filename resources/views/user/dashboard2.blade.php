@extends('udashboard.template')
@section('content')


<div class="col-12" style="background-color:#293541!important">
  <!-- Inventory Start -->
  <h2 class="small-title">Tickets</h2>
  
  <div class="mb-5">
        <h1 style="color:white!important">Serving</h1>
       
        <div class="row g-2">
            @php 
            $tickets = DB::select('select * from tickets where serving_time is not null and served_time is null');
            @endphp
        @foreach($tickets as $ticket)
           
                    
          <div class="col-12 col-sm-6 col-lg-2" style="width:18%!importnat">
           
            <div class="card hover-scale-up cursor-pointer sh-19">
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                  <i data-cs-icon="radish" class="text-white"></i>
                </div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}</div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">@php
                  $section = DB::select("select u.name as username, s.name as section_name from users as u inner join sections as s on u.section_id = s.id where u.id = ?",[$ticket->user_id]);
                @endphp {{$section[0]->username}}/{{$section[0]->section_name}}</div>
<!--                 <div class="text-small text-primary">Estimated Time: @php $date = strtotime($ticket->possible_serving); echo date('H:i:s A', $date); @endphp </div> -->
                <div class="text-small text-primary">Service Start: @php  $date = $time = date('H:i:s A', strtotime($ticket->serving_time)); echo $date; @endphp </div>
              </div>
            </div>
          </div>
            @endforeach
        </div>
      </div>

<div class="mb-5">
        <h1 style="color:white!important">InQue</h1>
       
        <div class="row g-2">
            @php 
            $tickets = DB::select('select * from tickets where serving_time is null and served_time is null ');
            @endphp
        @foreach($tickets as $ticket)
           
                    
          <div class="col-12 col-sm-6 col-lg-2" style="width:18%!importnat">
           
            <div class="card hover-scale-up cursor-pointer sh-19">
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                  <i data-cs-icon="radish" class="text-white"></i>
                </div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}</div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">@php
                  $section = DB::select("select name from sections where id = ?",[$ticket->section_id]);
                @endphp {{$section[0]->name}}</div>
                <div class="text-small text-primary">Estimated Time: @php $date = strtotime($ticket->possible_serving); echo date('H:i:s A', $date); @endphp </div>
                <div class="text-small text-primary">Service Start: @php  $date = $time = date('H:i:s A', strtotime($ticket->serving_time)); echo $date; @endphp </div>
              </div>
            </div>
          </div>
            @endforeach
        </div>
      </div>

<div class="mb-5">
        <h1 style="color:white!important">Appointments</h1>
       
        <div class="row g-2">
       
        @foreach($special as $ticket)
           
                    
          <div class="col-12 col-sm-6 col-lg-2" style="width:18%!importnat">
           
            <div class="card hover-scale-up cursor-pointer sh-19">
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                  <i data-cs-icon="radish" class="text-white"></i>
                </div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">{{$ticket->ticket_number}}</div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">@php
                  $section = DB::select("select name from sections where id = ?",[$ticket->section_id]);
                @endphp {{$section[0]->name}}</div>
                <div class="text-small text-primary">Estimated Time: @php $date = strtotime($ticket->possible_serving); echo date('H:i:s A', $date); @endphp </div>
                <div class="text-small text-primary">Service Start: @php  $date = $time = date('H:i:s A', strtotime($ticket->serving_time)); echo $date; @endphp </div>
              </div>
            </div>
          </div>
            @endforeach
        </div>
      </div>
@endsection

@extends('rlayouts.template')
@section('content')
    <meta http-equiv="refresh" content="30" />
    <script type="text/javascript">
        let opt = {
            group: 'shared',
            animation: 150,
            /*onStart: (evt) => {console.log(evt.oldIndex)},*/
            onEnd: (evt) => {
                //console.log(evt.item.getAttribute('data-task-id'),  evt.to.id)
                var url = '{{ route('updatestation') }}';
                var status_id = evt.to.getAttribute('data-status-id');
                var task_id = evt.item.getAttribute('data-task-id');
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        ticket_id: task_id,
                        section_id: status_id,
                    },
                    success: function(response) {
                        //console.log(response);
                        location.reload();
                    }
                });
            }
        }
    </script>


    <div>
        <a style="float : right;  cursor: pointer; color: #1cc49d; background-color: #1b2f31; border-radius: 50px; display: flex; justify-content: center; align-items: center; height: 3em; width: 8em; font-size: large;
  font-weight: 600;"
            onClick="window.location.reload()">Refresh</a>
    </div>

    <!-- Inventory Start -->
    <h2 class="small-title">Tickets</h2>
    <h2 style="color:#000 !important; font-size:15px;" class="small-title">Select Hair Dresser</h2>
    <label class="mb-3 top-label w-100" id="artist" name="artist" data-select2-id="10">
        <select tabindex="-1" class="form-select" width="100%" style="height:50px;">
            <option value="0">All</option>
            @foreach ($users as $user)
                <option value="{{ $user->section_id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </label>

    <div class="row">




        <div class="col-md-2 col-sm-2 col-xs-2 " id="slash">
            @php
                $sections = DB::select('select s.id, s.name as section_name ,s.is_system from sections as s where s.is_system=0');
            @endphp
            @foreach ($sections as $section)
                @php
                    $username = '-';
                    if ($section->is_system == 0) {
                        $name = DB::select('select u.name from users as u where u.section_id=?', [$section->id]);
                        $username = $name[0]->name;
                    }
                    $tickets = DB::select('select tickets.id, tickets.session_id, tickets.ticket_number, tickets.user_id, tickets.section_id, tickets.enqueue_time, tickets.serving_time, tickets.served_time, tickets.is_discarded, tickets.possible_serving, tickets.is_appoint, tickets.que_in from tickets inner join session on session.id=tickets.session_id where session.session_status = 0 and que_in=0  and section_id = ?', [$section->id]);
                    
                @endphp
                <div class="status-card" style="width:300px;">
                    <div class="card-header">
                        <span class="card-header-text" style="padding:3%">
                            {{ $section->section_name }}/{{ $username }}
                        </span>
                    </div>
                    <div class="list" id="c_{{ $section->id }}" data-status-id="{{ $section->id }}">


                        <p style="background-color:white;color:white;font-size:1px;height:1px;">.</p>



                        <input type="hidden" class="form-control" id="sectionId" value="{{ $section->section_name }}"
                            placeholder="Enter Email" name="sectionId">
                        <script type="text/javascript">
                            new Sortable.create(document.getElementById("c_{{ $section->id }}"), opt);
                        </script>
                        @foreach ($tickets as $ticket)
                            @if ($ticket->is_appoint == 1)
                                <div class="text-row ui-sortable-handle"
                                    style="background:#FFC000!important; color:white!important; font-size:30px;"
                                    data-task-id="{{ $ticket->id }}">

                                    {{ $ticket->ticket_number }}A
                                    @if (is_null($ticket->serving_time))
                                        <form action="{{ route('ticket.discarded', ['ticket' => $ticket->id]) }}"
                                            method="POST" id="form-ap-discard-{{ $ticket->id }}">
                                            @csrf
                                            <a href="javascript:{}"
                                                onclick="document.getElementById('form-ap-discard-{{ $ticket->id }}').submit(); return false;"
                                                style="background:red; color:#fff;padding:5px; float: right; margin-top: -25px;font-size:12px;">
                                                Discard
                                            </a>
                                        </form>
                                        <form action="{{ route('ticket.serving', ['ticket' => $ticket->id]) }}"
                                            method="POST" id="form-ap-{{ $ticket->id }}"
                                            style="max-height: 10px!important;">
                                            @csrf

                                            <a href="javascript:{}"
                                                onclick="document.getElementById('form-ap-{{ $ticket->id }}').submit(); return false;"
                                                style="background:#6176CE; color:#fff;padding:5px; float: right; margin-top: -25px; font-size:12px;">
                                                Serve
                                            </a>
                                        </form>

                                        <input type="hidden" class="form-control" id="ticketId"
                                            value="{{ $ticket->ticket_number }}" placeholder="Enter Email" name="ticketId">
                                        <input type="hidden" name="_token" id="csrf-token"
                                            value="{{ Session::token() }}" />

                                        <a onclick="callFunction({{ $ticket->id }})" id="butsaves"
                                            style="background:green; color:#fff;padding:5px; float: right; margin-top: -25px; font-size:12px;">
                                            @csrf
                                            Call
                                        </a>
                                    @else
                                        <form action="{{ route('ticket.serveded', ['ticket' => $ticket->id]) }}"
                                            method="POST" id="form-ap_serve-{{ $ticket->id }}"
                                            style="max-height: 10px!important;">
                                            @csrf
                                            <a href="javascript:{}"
                                                onclick="document.getElementById('form-ap_serve-{{ $ticket->id }}').submit(); return false;"style="background:green; color:#ccc;padding:10px; float: right; margin-top: -25px;font-size:12px;">
                                                Served

                                            </a>
                                        </form>
                                    @endif
                                </div>
                            @else
                                <div class="text-row ui-sortable-handle"
                                    style="background:#FFC000!important; color:white!important; font-size:30px;"
                                    data-task-id="{{ $ticket->id }}">

                                    {{ $ticket->ticket_number }}@if ($ticket->is_appoint == 2)
                                        S
                                    @endif

                                    @if (is_null($ticket->serving_time))
                                        <form action="{{ route('ticket.discarded', ['ticket' => $ticket->id]) }}"
                                            method="POST" id="form-ap-discard-{{ $ticket->id }}"
                                            style="max-height: 10px!important;">
                                            @csrf
                                            <a href="javascript:{}"
                                                onclick="document.getElementById('form-ap-discard-{{ $ticket->id }}').submit(); return false;"
                                                style="background-color: #f44336; text-align: center; border-radius: 20px; color:#fff; padding: 10px 16px; float: right; margin-top: -30px; font-size:20px;">
                                                D
                                            </a>
                                        </form>

                                        <form action="{{ route('ticket.serving', ['ticket' => $ticket->id]) }}"
                                            method="POST" id="form-ap-{{ $ticket->id }}"
                                            style="max-height: 10px!important;">
                                            @csrf
                                            <a href="javascript:{}"
                                                onclick="document.getElementById('form-ap-{{ $ticket->id }}').submit(); return false;"
                                                style="background-color: #008CBA; text-align: center; border-radius: 20px; color:#fff; padding: 10px 16px; float: right; margin-top: -30px;font-size:20px;">

                                                S

                                            </a>
                                        </form>


                                        <input type="hidden" class="form-control" id="ticketId"
                                            value="{{ $ticket->ticket_number }}" placeholder="Enter Email" name="ticketId">
                                        <input type="hidden" name="_token" id="csrf-token"
                                            value="{{ Session::token() }}" />

                                        <a onclick="callFunction({{ $ticket->id }})" id="butsaves"
                                            style="background-color: #4CAF50; text-align: center; border-radius: 20px; color:#fff; padding: 10px 16px;  float: right; margin-top: -30px; font-size:20px;">
                                            @csrf
                                            C
                                        </a>
                                    @else
                                        <form action="{{ route('ticket.serveded', ['ticket' => $ticket->id]) }}"
                                            method="POST" id="form-ap_serve-{{ $ticket->id }}"
                                            style="max-height: 10px!important;">
                                            @csrf
                                            <a href="javascript:{}"
                                                onclick="document.getElementById('form-ap_serve-{{ $ticket->id }}').submit(); return false;"
                                                style="background-color: #008CBA; text-align: center; border-radius: 20px; color:#fff; padding: 10px 16px; float: right; margin-top: -30px;font-size:20px;">
                                                Served
                                            </a>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>


                </div>
            @endforeach

        </div>

        <!-- IN-QUEUE Tickets list Start -->
        <div class="col-md-2 col-sm-3 col-xs-3" style="margin-left:20%;">
            @php
                $sections = DB::select('select s.id, s.name as section_name ,s.is_system from sections as s where s.id=1');
            @endphp
            @foreach ($sections as $section)
                @php
                    $username = '-';
                    if ($section->is_system == 0) {
                        $name = DB::select('select u.name from users as u where u.section_id=?', [$section->id]);
                        $username = $name[0]->name;
                    }
                    $tickets = DB::select('select tickets.id, tickets.session_id, tickets.ticket_number, tickets.user_id, tickets.section_id, tickets.enqueue_time, tickets.serving_time, tickets.served_time, tickets.is_discarded, tickets.possible_serving, tickets.is_appoint, tickets.que_in from tickets inner join session on session.id=tickets.session_id where session.session_status = 0 and  serving_time is null and served_time is null and section_id = ?', [$section->id]);
                @endphp
                <div class="status-card" style="width:180px;">
                    <div class="card-header">
                        <span class="card-header-text">
                            {{ $section->section_name }}
                        </span>
                    </div>
                    <div class="list" id="c_{{ $section->id }}" data-status-id="{{ $section->id }}">
                        <script type="text/javascript">
                            new Sortable.create(document.getElementById("c_{{ $section->id }}"), opt);
                        </script>
                        @foreach ($tickets as $ticket)
                            @if ($ticket->is_appoint == 1)
                                <div class="text-row ui-sortable-handle"
                                    style="background:#FFC000!important; color:white !important; font-size:30px;"
                                    data-task-id="{{ $ticket->id }}">

                                    {{ $ticket->ticket_number }}A
                                </div>
                            @else
                                <div class="text-row ui-sortable-handle"
                                    style="background:#FFC000 !important; color:white !important; font-size:30px; width=150px;"
                                    data-task-id="{{ $ticket->id }}">

                                    {{ $ticket->ticket_number }}@if ($ticket->is_appoint == 2)
                                        S
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>


                </div>
            @endforeach
        </div>

        <!-- IN-QUEUE Tickets list End -->





        <!--
        <div class="col-md-2" style="margin-left:3%;" >
              @php
                  $sections = DB::select('select s.id, s.name as section_name ,s.is_system from sections as s where s.id=9');
              @endphp
            @foreach ($sections as $section)
    @php
        $username = '-';
        if ($section->is_system == 0) {
            $name = DB::select('select u.name from users as u where u.section_id=?', [$section->id]);
            $username = $name[0]->name;
        }
        $tickets = DB::select('select * from tickets inner join session on session.id=tickets.session_id where session.session_status = 0 and  serving_time is not null and served_time is null and section_id = ?', [$section->id]);
    @endphp
                                  <div class="status-card" >
                                    <div class="card-header">
                                        <span class="card-header-text">
                                            {{ $section->section_name }}/{{ $username }}
                                          </span>
                                    </div>
                                    <div class="list" id="c_{{ $section->id }}" data-status-id="{{ $section->id }}" >
                                      <script type="text/javascript">
                                          new Sortable.create(document.getElementById("c_{{ $section->id }}"), opt);
                                      </script>
                                  @foreach ($tickets as $ticket)
    @if ($ticket->is_appoint == 1)
    <div class="text-row ui-sortable-handle" style="background:green!important; color:white!important;"  data-task-id="{{ $ticket->id }}">

                              {{ $ticket->ticket_number }}-A
                            </div>
@else
    <div class="text-row ui-sortable-handle"  data-task-id="{{ $ticket->id }}">

                              {{ $ticket->ticket_number }}- -@if ($ticket->is_appoint == 2)
    S
    @endif
                            </div>
    @endif
    @endforeach
                      </div>


                    </div>
    @endforeach
            </div>

           -->

        <!-- Served Tickets list Start -->

        <div class="col-md-2 col-sm-3 col-xs-3" style="margin-left:2%;">

            @php
                $sections = DB::select('select s.id, s.name as section_name ,s.is_system from sections as s where s.id=2');
            @endphp
            @foreach ($sections as $section)
                @php
                    $username = '-';
                    if ($section->is_system == 0) {
                        $name = DB::select('select u.name from users as u where u.section_id=?', [$section->id]);
                        $username = $name[0]->name;
                    }
                    $tickets = DB::select('select tickets.id, tickets.session_id, tickets.ticket_number, tickets.user_id, tickets.section_id, tickets.enqueue_time, tickets.serving_time, tickets.served_time, tickets.is_discarded, tickets.possible_serving, tickets.is_appoint, tickets.que_in from tickets inner join session on session.id=tickets.session_id where session.session_status = 0 and  que_in=2 and que_in = ' . $section->id . ' order by tickets.id desc limit 10');
                @endphp
                <div class="status-card" style="width:180px;">
                    <div class="card-header">
                        <span class="card-header-text">
                            {{ $section->section_name }}
                        </span>
                    </div>
                    <div class="list" id="c_{{ $section->id }}" data-status-id="{{ $section->id }}">
                        <script type="text/javascript">
                            new Sortable.create(document.getElementById("c_{{ $section->id }}"), opt);
                        </script>
                        @foreach ($tickets as $ticket)
                            @if ($ticket->is_appoint == 1)
                                <div class="text-row ui-sortable-handle"
                                    style="background:Red!important; color:#fff; font-size:30px;"
                                    data-task-id="{{ $ticket->id }}">

                                    {{ $ticket->ticket_number }}A
                                </div>
                            @else
                                <div class="text-row ui-sortable-handle"
                                    style="background:#87CEFA!important; color:#fff; font-size:30px; width:150px"
                                    data-task-id="{{ $ticket->id }}">

                                    {{ $ticket->ticket_number }}@if ($ticket->is_appoint == 2)
                                        S
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>


                </div>
            @endforeach

        </div>
        <!-- Served Tickets list End -->

        <!-- Discarded Tickets list Start -->

        <div class="col-md-2 col-sm-3 col-xs-3" style="margin-left:2%;">
            @php
                $sections = DB::select('select s.id, s.name as section_name ,s.is_system from sections as s where s.id=3');
            @endphp
            @foreach ($sections as $section)
                @php
                    $username = '-';
                    if ($section->is_system == 0) {
                        $name = DB::select('select u.name from users as u where u.section_id=?', [$section->id]);
                        $username = $name[0]->name;
                    }
                    $tickets = DB::select('select tickets.id, tickets.session_id, tickets.ticket_number, tickets.user_id, tickets.section_id, tickets.enqueue_time, tickets.serving_time, tickets.served_time, tickets.is_discarded, tickets.possible_serving, tickets.is_appoint, tickets.que_in from tickets inner join session on session.id=tickets.session_id where session.session_status = 0 and  que_in=3 and que_in = ?', [$section->id]);
                @endphp
                <div class="status-card" style="width:180px;">
                    <div class="card-header">
                        <span class="card-header-text">
                            {{ $section->section_name }}
                        </span>
                    </div>
                    <div class="list" id="c_{{ $section->id }}" data-status-id="{{ $section->id }}">
                        <script type="text/javascript">
                            new Sortable.create(document.getElementById("c_{{ $section->id }}"), opt);
                        </script>
                        @foreach ($tickets as $ticket)
                            @if ($ticket->is_appoint == 1)
                                <div class="text-row ui-sortable-handle"
                                    style="background:#ABA1A5!important; color:white!important; font-size:30px;"
                                    data-task-id="{{ $ticket->id }}">

                                    {{ $ticket->ticket_number }}A
                                </div>
                            @else
                                <div class="text-row ui-sortable-handle"
                                    style="background:#ABA1A5!important; color:white!important; font-size:30px; width:150px;"
                                    data-task-id="{{ $ticket->id }}">

                                    {{ $ticket->ticket_number }}@if ($ticket->is_appoint == 2)
                                        S
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>


                </div>
            @endforeach

        </div>

    </div>

    <!-- Discarded Tickets list End -->

    </div>
    </div>

    <script>
        function callFunction(ticket) {
            console.log(ticket);
            var url = "{{ route('storeNotification') }}";
            {{-- var url = '{{route("storeNotification", "id"}}' --}}
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: {
                    token: ticket
                },
                success: function(data) {
                    console.log(data);
                }
            });
        }
    </script>
@endsection

@extends('layouts.template')
@section('content')
<script type="text/javascript">
  let	opt = {
    group: 'shared', 
    animation:150,
  /*onStart: (evt) => {console.log(evt.oldIndex)},*/
  onEnd: (evt) => {
    //console.log(evt.item.getAttribute('data-task-id'),  evt.to.id)
    var url = '{{route("updatestation")}}';
    var status_id = evt.to.getAttribute('data-status-id');
      var task_id = evt.item.getAttribute('data-task-id');
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      //console.log(status_id,  task_id)
    $.ajax({
                   url:  url,
                   type: 'POST',
                   data: {_token: CSRF_TOKEN,
                    ticket_id:task_id,
                    section_id:status_id,
                  },
                   success: function(response){
                       }
               });
    }
  }
  </script>

<div class="col-8 col-lg-8">
  <!-- Inventory Start -->
  <h2 class="small-title">Tickets</h2>
  
  <div class="mb-5">
    <h1>Serving</h1>
   
    <div class="row g-2">
      @php  
      $sections = DB::select('select s.id, s.name as section_name, u.name from sections as s inner join users as u on u.section_id = s.id');
      @endphp
    @foreach($sections as $section)
      @php  
      $tickets = DB::select('select * from tickets where serving_time is null and served_time is null and section_id = ?',[$section->id]);
      @endphp
      <div class="status-card" >
        <div class="card-header">
            <span class="card-header-text">
                {{ $section->section_name }}/{{$section->name}}
              </span>
        </div>
        <div class="list" id="c_{{$section->id}}" data-status-id="{{$section->id}}" >
          <script type="text/javascript">
            new Sortable.create(document.getElementById("c_{{$section->id}}"), opt);
          </script>
      @foreach($tickets as $ticket)

      <div class="text-row ui-sortable-handle"  data-task-id="{{$ticket->id}}">
							{{$ticket->ticket_number}}
			</div>
      @endforeach
    </div>

      
</div>


    @endforeach            
  </div>
 
</div>

</div>



@endsection
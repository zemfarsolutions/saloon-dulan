@extends('udashboard.template')
@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                    <img src="{{ asset('/img/') }}/logo/Logo.png" style="display:block;margin-left: auto;margin-right: auto;"
                        alt="alternate text" class="img-fluid rounded-md">
                    <div style="height:20%!important"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-12">
            <form action="{{ route('ticket.add') }}" method="post">
                @csrf
                <button type="submit" class="col-12 col-lg-12"
                    style="border-style: solid;
      border-width: 2px;
      border-color:#gray;background-color: transparent;
    ">
                    <!--       <div class="mb-5" style = "border-style: solid;
          border-width: 2px;
          border-color:#fff"> -->


                    <div class="row">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-3">

                            <h1 style=color:#fff;margin-top:22%;>
                                Get a Ticket
                            </h1>
                        </div>
                        <div class="col-md-3">
                            <img src="{{ asset('/img/') }}/logo/generate.png"
                                style="display:block;margin-left: auto;margin-right: auto;" alt="alternate text"
                                class="img-fluid rounded-md">
                        </div>
                        <div class="col-md-3">

                        </div>
                    </div>

                    <!--         </div> -->
                </button>
            </form>
        </div>



        <!-- Today's Orders End -->
        <div class="row" style="margin-bottom: 5%!important">

            <div class="col-12 col-lg-12">
                <div class="mb-5" style="border-style: solid;
      border-width: 2px;
      border-color:gray;">

                    <div class="row">

                        <div class="col-md-6" style="padding:5%;">
                            <h1 style="color:#fff;">Or Choose Your Favourite</h1>
                        </div>
                        <div class="col-md-6">
                            <h1
                                style="color:#fff;text-align:center;border-style: solid;
      border-width: 2px;
      border-color:gray;padding:2%;margin:10px;">
                                SELECT THE DESK NUMBER
                            </h1>
                            @php
                                $sections = DB::select('select s.id, s.name as section_name, u.name, u.id as userId from sections as s inner join users as u on u.section_id = s.id');
                            @endphp
                            <div class="row" id="additionalInfoWeek" style="padding:10px;">
                                @foreach ($sections as $section)
                                    <div class="sw-6 sh-6 me-1 mb-1 d-inline-block bg-separator d-flex justify-content-center align-items-center rounded-md col-md-2"
                                        style="margin:5px; background-color:#e28743 !important;">
                                        <form action="{{ route('ticket.add') }}" method="POST"
                                            id="form-ap-{{ $section->id }}">
                                            @csrf
                                            <input type="hidden" name="section_id" value="{{ $section->id }}">
                                            <input type="hidden" name="user_id" value="{{ $section->userId }}">
                                            <a href="javascript:{}"
                                                onclick="document.getElementById('form-ap-{{ $section->id }}').submit(); return false;"
                                                class="row g-0 sh-10">

                                                <div class="col">
                                                    <div
                                                        class="card-body d-flex flex-row pt-0 pb-0 h-100 align-items-center justify-content-between">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <div class="fw-bold text-alternate"
                                                                style="color:#fff !important;">{{ $section->section_name }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </a>
                                        </form>
                                    </div>
                                @endforeach

                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!--         hafix code -->
            <!--           <div class="col-12 col-lg-12">


                    @php
                        $sections = DB::select('select s.id, s.name as section_name, u.name from sections as s inner join users as u on u.section_id = s.id');
                    @endphp
                    <div class="tab-pane fade show active" id="additionalInfoWeek">
                      @foreach ($sections as $section)
    <div class="card mb-2">
                        <form action="{{ route('ticket.add') }}" method="POST" id = "form-ap-{{ $section->id }}">
                          @csrf
                          <input type="hidden"  name="section_id" value="{{ $section->id }}">
                          <a href="javascript:{}" onclick="document.getElementById('form-ap-{{ $section->id }}').submit(); return false;" class="row g-0 sh-10">
                          <div class="col-auto h-100" style="background:#20ADED!important">
                            <img src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-512.png" alt="alternate text" class="card-img card-img-horizontal sw-11">
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-row pt-0 pb-0 h-100 align-items-center justify-content-between">
                              <div class="d-flex flex-column justify-content-center">
                                <div class="mb-1">{{ $section->section_name }}/{{ $section->name }}</div>
                              </div>
                              @php
                                  $today = Carbon::today();
                                  $ticketcount = DB::select('select count(*) as t from tickets where serving_time is null and is_discarded =0 and created_at >=? and section_id = ?', [$today, $section->id]);
                              @endphp

                              <div class="d-flex flex-row ms-3">
                                <div class="d-flex flex-column align-items-center">
                                  <div class="text-muted text-small">Status</div>
                                  <div class="text-alternate">Serving</div>
                                </div>
                                <div class="d-flex flex-column align-items-center ms-3">
                                  <div class="text-muted text-small">InQue</div>

                                  <div class="text-alternate">{{ $ticketcount[0]->t }}</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a></form>
                      </div>
    @endforeach

                    </div>


                  </div> -->
            <!-- Categories End -->
        </div>
    </div>
@endsection

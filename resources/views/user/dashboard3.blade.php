@extends('udashboard.template')
@section('content')
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>

    <style>
        .heading {
            background-color: white;
            color: black;
            text-align: center;
            padding: 10px 0px 10px 0px;
            font-size: 20px;
            font-weight: bold;
        }

        .desk {
            background-color: blueviolet;
            color: white;
            text-align: center;
            padding: 10px 0px 10px 0px;
            font-size: 20px;
            border-width: 1px;
            border-style: solid;
            border-color: gray;
        }

        .ticket {
            background-color: rgba(255, 0, 0, 0.3);
            color: white;
            text-align: center;
            padding: 10px 0px 10px 0px;
            font-size: 20px;
            border-width: 1px;
            border-style: solid;
            border-color: gray;
            border-radius: 8px;

        }

        .ticketActive {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 0px 10px 0px;
            font-size: 20px;
            border-width: 1px;
            border-style: solid;
            border-color: gray;
            border-radius: 8px;
        }

        .myBorder {
            border-width: 1px;
            border-style: solid;
            border-color: gray;
            padding: 10px 10px 10px 10px;

        }
    </style>

    <div class="col-12">

        <audio id="myAudio">
            <source src="{{ asset('public/img/') }}/notification.mp3" type="audio/ogg">
            <source src="{{ asset('public/img/') }}/notification.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>



        <div class="row">
            <div class="col-md-5 row myBorder">
                <div class="col-md-3">
                    <h3 class="heading">Desk</h3>
                    <div id="divDeskData"></div>
                </div>
                <div class="col-md-9">
                    <h3 class="heading">Ticket Numbers</h3>
                    <div id="divTicketNumber" class="row ms-2"></div>
                </div>
            </div>
            <div class="col col-md-3 myBorder" style="margin-left: 20px">
                <h3 class="heading">In Queue</h3>
                <div id="divQueueData" class="row ms-2" style=""></div>
                <h3 class="heading">Appointments</h3>
                <div id="divAppointmentData" class="row ms-2" style=""></div>
            </div>

            <div class="col col-md-4 myBorder">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $slider = DB::select('select * from promotion');
                        @endphp
                        @foreach ($slider as $key => $slide)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="public/img/logo/{{ $slide->image }}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @php
                $message = DB::select('select user_message from settings');
            @endphp

            <h2 style="margin-top: 30px; color: white; text-align: center; marquee direction:right">
                >{{ $message[0]->user_message }}</h2>

            <!-- Modal -->
            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ticket Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h1 id="modalMessage"
                                style="background-color: #4CAF50; color: white; text-align: center;
            padding: 10px 0px 10px 0px;
            font-size: 20px;
            border-width: 1px;
            border-style: solid;
            border-color: gray;
            border-radius: 8px;">
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script>
            $(document).ready(function() {
                window.addEventListener('load', function() {
                    loadData();
                });

                function loadData() {
                    $.ajax({
                        type: "GET",
                        url: "getudashboard3",
                        dataType: "json",

                        success: function(response) {
                            console.log('showModel', response.showModel);
                            $('#divTicketNumber').html(response.ticketData);
                            $('#divDeskData').html(response.deskData);
                            $('#divQueueData').html(response.queueData);
                            $('#divAppointmentData').html(response.appointmentData);
                            if (response.showModel == true) {

                                playAudio();


                                $('#modalMessage').html(response.message);
                                $('#confirmationModal').modal('show');
                                setTimeout(function() {
                                    $('#confirmationModal').modal('hide');
                                }, 5000);
                            }
                        }
                    });
                }
                setInterval(loadData, 5000);
            })
        </script>
    @endsection

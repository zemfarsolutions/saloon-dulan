<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Ticket</title>
    <style>
        div.item {
            vertical-align: top;
            display: inline-block;
            margin-bottom: -10px;
            text-align: center;
            width: 200px;
        }

        img {
            width: 180px;

        }

        .caption {
            display: block;
            padding-top: -10px !important;
        }
    </style>
</head>

<body>

    <div id="ticket">
        <div style="text-align: center;">
            <img src="{{ asset('/public/img/logo/') }}/ticket_logo.png" style="width:400px;" alt="Logo">
        </div>
        <div style="text-align:center;">
            <?php
            $type = '';
            if ($data[0]->is_appoint == 2) {
                $type = 'S';
            } elseif ($data[0]->is_appoint == 1) {
                $type = 'A';
            }
            
            ?>
            <h1 style="font-size:60px;">{{ $data[0]->ticket_number }}{{ $type }}</h1>
        </div>


        <div style="text-align:center;">
            <h3 style="font-size:30px;margin-left: -25%;"id="pick_date">date</h3>
            <h3 style="font-size:30px;margin-top: -5%;margin-left: 25%;"id="pick_date_time"></h3>
        </div>

        <div style="text-align:center;background-color:#000;height: 2px;margin-left: 25%;margin-right: 25%;">

        </div>

        <div style="text-align:center;">
            <h1 style="font-size:40px;">Tel: 02085770900</h1>
        </div>
        <div style="text-align:center;">
            <h1 style="font-size:30px;">www.hairdesignsbyalex.co.uk</h1>
        </div>

        <!--           {{ $setting[0]->message }} -->

    </div>

    <script src="script.js"></script>

    <script>
        var dt = new Date();
        document.getElementById("pick_date").innerHTML = dt.toDateString();

        const formatAMPM = (date) => {
            let hours = date.getHours();
            let minutes = date.getMinutes();
            const ampm = hours >= 12 ? 'pm' : 'am';
            hours %= 12;
            hours = hours || 12;
            minutes = minutes < 10 ? `0${minutes}` : minutes;
            const strTime = `${hours}:${minutes} ${ampm}`;
            return strTime;
        };

        function refreshTime() {
            const currTime = formatAMPM(new Date());
            document.getElementById("pick_date_time").innerHTML = currTime;
        }
        setInterval(refreshTime, 1000);
        window.print();
        window.onafterprint = function(event) {
            window.location.href = '/'
        };
        // document.location.href = "/";
    </script>
</body>

</html>

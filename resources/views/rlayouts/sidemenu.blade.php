<?php $settings = \App\Http\Controllers\AdminHomeController::getSetting(); ?>
<div id="nav" class="">
    <div class="row justify-content-between p-2">
        <img src="public/img/logo/Logo.png" style="width: 250px;">
        <h3 style="color: white; text-align: right; margin-top: -35px" id="pick_date_time"></h3>
        <h3 style="color: white; text-align: right; margin-top: -35px; padding-right: 120px" id="pick_date">date</h3>
    </div>
    <div style="background-color: gray; height: 1px; width: 100%"></div>
</div>
<main style="padding-top:20px">
    <div class="container">
        <div class="row">
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
            </script>

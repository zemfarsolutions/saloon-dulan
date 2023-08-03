<!-- Layout Footer Start -->
<footer>
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <p class="mb-0 text-muted text-medium">Copyright © 2022-2023 hairdesignsbyalex.co.uk. All rights
                        reserved</p>
                </div>
                <div class="col-sm-6 d-none d-sm-block">

                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Layout Footer End -->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"
    integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Vendor Scripts Start -->
<script src="{{ asset('/js/') }}/vendor/jquery-3.5.1.min.js"></script>
<script src="{{ asset('/js/') }}/vendor/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/js/') }}/vendor/OverlayScrollbars.min.js"></script>
<script src="{{ asset('/js/') }}/vendor/autoComplete.min.js"></script>
<script src="{{ asset('/js/') }}/vendor/clamp.min.js"></script>
<script src="{{ asset('/js/') }}/vendor/bootstrap-submenu.js"></script>
<script src="{{ asset('/js/') }}/vendor/datatables.min.js"></script>
<script src="{{ asset('/js/') }}/vendor/mousetrap.min.js"></script>

<!-- Vendor Scripts End -->

<!-- Template Base Scripts Start -->
<script src="{{ asset('/font/') }}/CS-Line/csicons.min.js"></script>
<script src="{{ asset('/js/') }}/base/helpers.js"></script>
<script src="{{ asset('/js/') }}/base/globals.js"></script>
<script src="{{ asset('/js/') }}/base/nav.js"></script>
<script src="{{ asset('/js/') }}/base/search.js"></script>
<script src="{{ asset('/js/') }}/base/settings.js"></script>
<script src="{{ asset('/js/') }}/base/init.js"></script>
<script src="{{ asset('/js/') }}/vendor/select2.full.min.js"></script>
<!-- Template Base Scripts End -->
<!-- Page Specific Scripts Start -->
<script src="{{ asset('/js/') }}/cs/datatable.extend.js"></script>
<script src="{{ asset('/js/') }}/plugins/datatable.editablerows.js"></script>
<script src="{{ asset('/js/') }}/common.js"></script>
<script src="{{ asset('/js/') }}/scripts.js"></script>
<!-- Page Specific Scripts End -->
<!-- Sound script -->
<script>
    var x = document.getElementById("myAudio");

    function playAudio() {
        x.play();
    }

    function pauseAudio() {
        x.pause();
    }
</script>
<!-- Sound script End -->

<script>
    $(document).ready(function() {
        $('.alert-success').fadeIn().delay(3000).fadeOut();
    });

    $('#artist').change(function() {
        $id = $('#artist').find(":selected").val();
        if ($id == 0)
            location.reload();
        var url = '{{ route('getuserticket') }}';
        var status_id = $id;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: "POST",
            url: url,
            data: {
                _token: CSRF_TOKEN,
                id: $id
            },
            success: function(response) {
                //alert(response);
                $('#slash').empty();
                $('#slash').append(response);
            }
        });
    });
</script>

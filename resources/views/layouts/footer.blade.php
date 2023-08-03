<!-- Layout Footer Start -->
<footer>
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <p class="mb-0 text-muted text-medium" style="text-align: center";>Copyright © 2022-2023
                        hairdesignsbyalex.co.uk. All rights reserved</p>
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- Layout Footer End -->
</div>
<!-- Vendor Scripts Start -->

<script src="{{ asset('public/js/') }}/vendor/bootstrap.bundle.min.js"></script>
<script src="{{ asset('public/js/') }}/vendor/OverlayScrollbars.min.js"></script>
<script src="{{ asset('public/js/') }}/vendor/autoComplete.min.js"></script>
<script src="{{ asset('public/js/') }}/vendor/clamp.min.js"></script>
<script src="{{ asset('public/js/') }}/vendor/bootstrap-submenu.js"></script>
<script src="{{ asset('public/js/') }}/vendor/datatables.min.js"></script>
<script src="{{ asset('public/js/') }}/vendor/mousetrap.min.js"></script>

<!-- Vendor Scripts End -->
<script src="{{ asset('public/js/') }}/vendor/pickers/pickadate/picker.js"></script>
<script src="{{ asset('public/js/') }}/vendor/pickers/pickadate/picker.date.js"></script>
<script src="{{ asset('public/js/') }}/vendor/pickers/pickadate/picker.time.js"></script>
<script src="{{ asset('public/js/') }}/vendor/pickers/pickadate/legacy.js"></script>
<script src="{{ asset('public/js/') }}/vendor/pickers/flatpickr/flatpickr.min.js"></script>
<script src="{{ asset('public/js/') }}/scripts/forms/pickers/form-pickers.js"></script>
<!-- Template Base Scripts Start -->
<script src="{{ asset('public/font/') }}/CS-Line/csicons.min.js"></script>
<script src="{{ asset('public/js/') }}/base/helpers.js"></script>
<script src="{{ asset('public/js/') }}/base/globals.js"></script>
<script src="{{ asset('public/js/') }}/base/nav.js"></script>
<script src="{{ asset('public/js/') }}/base/search.js"></script>
<script src="{{ asset('public/js/') }}/base/settings.js"></script>
<script src="{{ asset('public/js/') }}/base/init.js"></script>
<script src="{{ asset('public/js/') }}/vendor/select2.full.min.js"></script>
<!-- Template Base Scripts End -->
<!-- Page Specific Scripts Start -->
<script src="{{ asset('public/js/') }}/cs/datatable.extend.js"></script>
<script src="{{ asset('public/js/') }}/plugins/datatable.editablerows.js"></script>
<script src="{{ asset('public/js/') }}/common.js"></script>
<script src="{{ asset('public/js/') }}/scripts.js"></script>
<!-- Page Specific Scripts End -->
<script>
    $(document).ready(function() {
        $('.alert-success').fadeIn().delay(3000).fadeOut();
    });
</script>
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
<script>
    $(document).ready(function() {
        setInterval(function() {
            $("#refresh").load(window.location.href + " refresh", function() {
                console.log("loaded")
            });
        }, 60000);
    });
</script>

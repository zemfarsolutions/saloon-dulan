<!-- Layout Footer Start -->
<footer>
    <div class="mw-100 footer-content">
        <div class="mw-100 container">
            <div class="mw-100 row">
                <div class="mw-100 col-12 col-sm-12">
                    <p style="background:red; color:#ccc;text-align: center; width:100%; height:50px;">Copyright ©
                        2022-2023 hairdesignsbyalex.co.uk. All rights reservedxxx</p>
                </div>
                <div class="col-sm-6 d-none d-sm-block">

                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Layout Footer End -->
</div>
<!-- Vendor Scripts Start -->
<script src="{{ asset('public/js/') }}/vendor/jquery-3.5.1.min.js"></script>
<script src="{{ asset('public/js/') }}/vendor/bootstrap.bundle.min.js"></script>
<script src="{{ asset('public/js/') }}/vendor/OverlayScrollbars.min.js"></script>
<script src="{{ asset('public/js/') }}/vendor/autoComplete.min.js"></script>
<script src="{{ asset('public/js/') }}/vendor/clamp.min.js"></script>
<script src="{{ asset('public/js/') }}/vendor/bootstrap-submenu.js"></script>
<script src="{{ asset('public/js/') }}/vendor/datatables.min.js"></script>
<script src="{{ asset('public/js/') }}/vendor/mousetrap.min.js"></script>

<!-- Vendor Scripts End -->

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
{{-- <script> --}}
{{-- $(document).ready(function() { --}}
{{--   --}}
{{--    $('#butsave').on('click', function() { --}}
{{--      var url = '{{route("storeNotification")}}' --}}
{{--      var ticket = $('#sectionId').val(); --}}
{{--      var section = $('#ticketId').val(); --}}
{{--      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); --}}
{{-- //       var formData = new FormData(thisForm[0]); --}}
{{--      console.log(ticket); --}}
{{--      console.log(section); --}}
{{--          $.ajax({ --}}
{{--             headers: { --}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') --}}
{{--                }, --}}
{{--              url: url, --}}
{{--              type: "POST", --}}
{{--              processData: false, --}}
{{--              contentType: false, --}}
{{--              cache : false, --}}
{{--              data: { --}}
{{--                //  _token: $("#csrf-token").val(), --}}
{{--                  ticket: 1, --}}
{{--                  section: 2 --}}

{{--              }, --}}
{{--              success: function(data){ --}}
{{--                  console.log(data); --}}
{{--                --}}
{{--                  --}}
{{--              } --}}
{{--          }); --}}
{{--      --}}
{{--      --}}
{{--  }); --}}
{{-- }); --}}
{{-- </script> --}}

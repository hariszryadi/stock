<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="description"
        content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">

    <!-- OneUI framework -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/oneui.css') }}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/amethyst.min.css"> -->
    <!-- END Stylesheets -->
    <style>
        .form-control.is-invalid {
            border-color: #DC2626 !important;
        }
        .col-relative {
            position: relative;
        }
        .col-relative button {
            position: absolute;
            bottom: 5px;
        }
        .space {
            display: inline-block;
            width: 75px;
        }
    </style>
</head>

<body>
    <!-- Page Container -->
    <div id="page-container"
        class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- END Sidebar -->

        <!-- Header -->
        @include('layouts.header')
        <!-- END Header -->

        <!-- Main Container -->
        @yield('content')
        <!-- END Main Container -->

        <!-- Footer -->
        @include('layouts.footer')
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <!-- Modal -->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Konfirmasi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <p>Apakah anda yakin untuk menghapus data ini?</p>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <form method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-sm btn-danger">Ya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-invoice" tabindex="-1" role="dialog" aria-labelledby="modal-invoice" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title"></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm block-html"></div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- END Modal -->

    <!--
        JS

        Core libraries and functionality
        webpack is putting everything together at assets/_js/main/app.js
    -->
    <script src="{{ asset('assets/js/oneui.app.min.js') }}"></script>

    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/chart.js/chart.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets/js/pages/be_pages_dashboard.min.js') }}"></script>

    <!-- JS -->
    <script>
        $(document).on('click', '#delete', function () {
            $('#modal-delete').modal('show');
            $('#modal-delete').find('form').attr('action', $(this).data('url'));
        })
        
        $(document).on('click', '#invoice', function () {
            $('#modal-invoice').modal('show');
            $.ajax({
                url: $(this).data('url'),
                dataType: 'JSON',
                success: function (resp) {
                    console.log(resp.data);
                    var table = '';
                    $.each(resp.data, function (k, v) {
                        table += `<tr>
                                    <td>${v.CODE}</td>
                                    <td>${v.NAME}</td>
                                    <td align="center">${v.qty}</td>
                                </tr>`
                    })
                    console.log(table);
                    $('#modal-invoice').find('.block-title').text('Invoice');
                    $('#modal-invoice').find('.block-html').html(
                        `<p><span class="space">No. Invoice</span> : <b>${resp.data[0].invoice}</b></p>
                        <p><span class="space">Tanggal</span> : <b>${resp.data[0].date}</b></p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Qty</th>
                                </tr>
                            </thead>
                            ${table}
                        </table>`
                    );
                }
            })
        })

        $(function(){
            $(".price-format").keyup(function(e){
                this.value = this.value.replace(/[^0-9]/g, '');
                $(this).val(format($(this).val()));
            });
        });
        var format = function(num){
            var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
            if(str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for(var j = 0, len = str.length; j < len; j++) {
                if(str[j] != ",") {
                output.push(str[j]);
                if(i%3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
                }
            }
            formatted = output.reverse().join("");
            return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };
    </script>

    <!-- Page JS Helpers (Select2 plugins) -->
    <script>One.helpersOnLoad(['js-flatpickr', 'jq-datepicker', 'jq-select2']);</script>

    @yield('scripts')
</body>

</html>

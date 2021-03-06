<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta name="description" content="Shayna Admin Panel">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ public_path('logo-sk.jpeg') }}">
    {{-- style --}}
    @stack('before-style')
    @include('includes.style')
    @stack('after-style')
</head>

<body class="fix-header">
    <div id="wrapper">
        @include('includes.navbar')
        @include('includes.sidebar')
        @php
            $hari = [
                "Sunday" => "Minggu",
                "Monday" => "Senin",
                "Tuesday" => "Selasa",
                "Wednesday" => "Rabu",
                "Thursday" => "Kamis",
                "Friday" => "Jum'at",
                "Saturday" => "Sabtu"
            ];
            $bulan = [
                "January" => "Januari",
                "February" => "Februari",
                "March" => "Maret",
                "April" => "April",
                "May" => "Mei",
                "June" => "Juni",
                "July" => "Juli",
                "August" => "Agustus",
                "September" => "September",
                "October" => "Oktober",
                "November" => "November",
                "December" => "Desember"
            ];
            function convertDate($date, $bulan){
                $explode = explode(" ", $date);
                $explode[1] = $bulan[$explode[1]];
                return implode(" ", $explode);
            }
        @endphp
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">{{ $title }}</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                      <h4 class="page-time pull-right">{{ $hari[date('l', time())] }}, {{ convertDate(date('d F Y',time()), $bulan) }}</h4>
                    </div>
                </div>
                {{-- content --}}
                @yield('content')
            </div>
        </div>
        <div class="clearfix"></div>
        @include('includes.footer')
    </div>

    <div class="modal fade logoutModal" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <h5>Are you sure to logout?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" type="button" class="btn btn-danger waves-effect waves-light" href="#">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- script --}}
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')
</body>
</html>

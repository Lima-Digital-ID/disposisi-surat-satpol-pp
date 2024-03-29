<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>DISPOSISI | SATPOLPP</title>


    {{-- <!--[if lt IE 10]> --}}
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    {{-- <![endif]--> --}}

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="colorlib" />

    <link rel="icon" href="{{ asset('') }}png/satpol-pp.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('') }}css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('') }}css/waves.min.css" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="{{ asset('') }}css/feather.css">
    <link rel="stylesheet" href="{{ asset('') }}css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}css/bootstrap-multiselect.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}css/multi-select.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}css/custom.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}css/icofont.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}css/pages.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}css/morris.css">
    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <style>
        .kbw-signature {
            width: 100%;
            height: 180px;
        }

        #signaturePad canvas {
            width: 100% !important;
            height: auto;
        }

    </style>

    @stack('custom-styles')
</head>

<body>

    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            @include('components.navbar')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    @include('components.menu')

                    <div class="pcoded-content">

                        @yield('page-header')

                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="styleSelector">
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!--[if lt IE 10]>
    <div class="ie-warning">
        <h1>Warning!!</h1>
        <p>You are using an outdated version of Internet Explorer, please upgrade
            <br />to any of the following web browsers to access this website.
        </p>
        <div class="iew-container">
            <ul class="iew-download">
                <li>
                    <a href="http://www.google.com/chrome/">
                        <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                        <div>Chrome</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.mozilla.org/en-US/firefox/new/">
                        <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                        <div>Firefox</div>
                    </a>
                </li>
                <li>
                    <a href="http://www.opera.com">
                        <img src="../files/assets/images/browser/opera.png" alt="Opera">
                        <div>Opera</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.apple.com/safari/">
                        <img src="../files/assets/images/browser/safari.png" alt="Safari">
                        <div>Safari</div>
                    </a>
                </li>
                <li>
                    <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                        <img src="../files/assets/images/browser/ie.png" alt="">
                        <div>IE (9 & above)</div>
                    </a>
                </li>
            </ul>
        </div>
        <p>Sorry for the inconvenience!</p>
    </div>
    <![endif]-->
    @include('components.logout-modal')
    @include('components.js')
    @stack('custom-scripts')
    <script src="https://www.gstatic.com/firebasejs/8.9.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.9.0/firebase-database.js"></script>

    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyALUNb1D7VFKLFtLoINWyqKgl10adbUG1Q",
            authDomain: "disposisi-6c4af.firebaseapp.com",
            projectId: "disposisi-6c4af",
            storageBucket: "disposisi-6c4af.appspot.com",
            messagingSenderId: "1069243139166",
            appId: "1:1069243139166:web:b3fb5643218f769a6ba0cf",
            measurementId: "G-0JZ2VY7L9X"
        };
        firebase.initializeApp(firebaseConfig);
        let database = firebase.database();

        let data = {
            msg: "Surat Masuk dari David",
            id_user: '1'
        }
        // database.ref('disposisi').push(data)

        database.ref().child('disposisi').orderByChild('id_user').equalTo('1').on('value', function(res) {
            let countNotif = 0
            res.forEach((data) => {
                countNotif++
            })
            document.getElementById("count-notif").innerHTML = countNotif
        })
    </script>

</body>

<!-- Mirrored from colorlib.com/polygon/admindek/default/sample-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:10:10 GMT -->

</html>

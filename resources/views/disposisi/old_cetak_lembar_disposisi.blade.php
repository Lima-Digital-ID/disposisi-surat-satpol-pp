<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <title>DISPOSISI | SATPOLPP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description"
            content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
        <meta name="keywords"
            content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
        <meta name="author" content="colorlib" />

        <link rel="icon" href="{{ asset('') }}png/satpol-pp.png" type="image/x-icon">

        {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet"> --}}

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
    </head>

<body>
    <section class="sheet padding-10mm">

        <div class="header">
        </div>
        <center style="margin-top: 20px;">
            <table width="100%" style="border-bottom: 5px solid #000; padding:2px">
                <tr>
                    <td style="justify-content-end">
                        <img src="{{ asset('') }}png/jatim.png" alt="" width="80px">
                    </td>
                    <td style="text-align: center; line-height: 1px">
                        {{-- <h3 style="font-weight: 900;!important">PEMERINTAH PROVINSI JAWA TIMUR</h3> --}}
                        <h3 style="font-weight: bold;">PEMERINTAH PROVINSI JAWA TIMUR</h3>
                        {{-- <h2 style="font-weight: 900;!important">SATUAN POLISI PAMONG PRAJA</h2> --}}
                        <h2 style="font-weight: bold;">SATUAN POLISI PAMONG PRAJA</h2>
                        <p style="font-weight: bold;">Jl. Jagir Wonokromo No. 352 Telp. (031) 8412159 Fax. (031) 8412259</p>
                        <p style="font-weight: bold;"><u>Surabaya 60244</u></p>
                        <br>
                        <br>
                        <br>
                        <br>
                        <p>LEMBAR DISPOSISI</p>
                    </td>

                </tr>
                {{-- <table>
                    <tr><h3>PEMERINTAH PROVINSI JAWA TIMUR</h3></tr>
                    <tr><h1>SATUAN POLISI PAMONG PRAJA</h1></tr>
                    <tr><p>Jl. Jagir Wonokromo No. 352 Telp. (031) 8412159 Fax. (031) 8412259</p></tr>
                    <tr><p><u>Surabaya 60244</u></p></tr>
                </table> --}}
            </table>
            <table width="100%">
                <tr>
                    <td>
                        <table class="row justify-content-center">
                            <tr>
                                <td>Surat Dari &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; :
                                    {{ isset($data->masuk->id_pengirim) ? $data->masuk->id_pengirim : $data->masuk->pengirim }}
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Surat &nbsp; &nbsp; &nbsp; : {{ $data->masuk->tgl_pengirim }}</td>
                            </tr>
                            <tr>
                                <td>No Surat &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                                    {{ $data->masuk->no_surat }}
                                </td>
                            </tr>
                        </table>
                    </td>
                    {{-- <td width="5%"></td> --}}
                    <td>
                        <table class="row justify-content-center">
                            <tr>
                                <td>Diterima Tanggal : {{ $data->masuk->tgl_penerima }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Agenda : </td>
                            </tr>
                            <tr>
                                <td>Sifat Surat :
                                    <br>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="checkbox">
                                                <label for="">Sangat Segera</label>
                                            </td>
                                            <td>
                                                <input type="checkbox">
                                                <label for="">Segera</label>
                                            </td>
                                        </tr>
                                    </table>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="checkbox">
                                                <label for="">Penting</label>
                                            </td>
                                            <td>
                                                <input type="checkbox">
                                                <label for="">Biasa</label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                {{-- <td>Sifat Surat : {{ $data->sifat_surat }}</td> --}}
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
        <center class="center">
            <hr style="border-bottom:1px solid black; border-top:1px solid black">
            <h4 style="margin-top: 5px; margin-bottom: 5px;">Perihal : {{ $data->catatan }}</h4>
            <hr style="border-bottom:1px solid black; border-top:1px solid black">
        </center>
        <center>
            <table width="100%">
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td>Surat Dari &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; :
                                    {{ isset($data->masuk->id_pengirim) ? $data->masuk->id_pengirim : $data->masuk->pengirim }}
                                </td>
                            </tr>
                        </table>
                    </td>
                    {{-- <td width="5%"></td> --}}
                    <td>
                        <table class="row justify-content-center">
                            <tr>
                                <td>Diterima Tanggal : {{ $data->masuk->tgl_penerima }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
        <center class="center">
            <hr style="border-bottom:1px solid black; border-top:1px solid black">
            <h4 style="margin-top: 5px; margin-bottom: 5px;">Isi Disposisi : {{ $data->catatan }}</h4>
            <hr style="border-bottom:1px solid black; border-top:1px solid black">
        </center>
        </div>
    </section>

</body>


</html>

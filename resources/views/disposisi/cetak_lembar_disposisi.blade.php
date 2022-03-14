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
    </head>

<body class="A4">
    <section class="sheet padding-10mm">

        <div class="header">
        </div>
        <center style="margin-top: 20px;">
            <table width="100%">
                <tr>
                    <td>
                        <table>
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
                        <table class="row justify-content-end">
                            <tr>
                                <td>Diterima Tanggal : {{ $data->masuk->tgl_penerima }}</td>
                            </tr>
                            <tr>
                                {{-- <td>Nomor Agenda : </td> --}}
                                <td>
                                    <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                                    <label for="vehicle3"> I have a boat</label><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td>Sifat Surat : {{ $data->sifat_surat }}</td>
                                <td>
                                    <input type="checkbox" id="" name=""
                                        value="Penting {{ old('level', $data->sifat_surat) == 'Penting' ? ' selected' : '' }}">
                                    <label for="">Penting</label><br><br>
                                </td>
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
                        <table class="row justify-content-end">
                            <tr>
                                <td>Diterima Tanggal : {{ $data->masuk->tgl_penerima }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Agenda : </td>
                            </tr>
                            <tr>
                                <td>Sifat Surat : {{ $data->sifat_surat }}</td>
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

<?php
//--->get app url > start

if (
    isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
) {
    $ssl = 'https';
} else {
    $ssl = 'http';
}

$app_url = ($ssl)
    . "://" . $_SERVER['HTTP_HOST']
    //. $_SERVER["SERVER_NAME"]
    . (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
    . trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");

//--->get app url > end

header("Access-Control-Allow-Origin: *");

?>


<!DOCTYPE html>
<html>

<head>

    <title> Template </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="This ">

    <meta name="author" content="Code With Mark">
    <meta name="authorUrl" content="http://codewithmark.com">

    <!--[CSS/JS Files - Start]-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>


    <script src="{{ asset('js/af.min.js') }}"></script>


    <style>
        .invoice-box {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 12px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 2px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>



    <script type="text/javascript">
        $(document).ready(function($) {

            $(document).on('click', '.btn_print', function(event) {
                event.preventDefault();

                //credit : https://ekoopmans.github.io/html2pdf.js

                var element = document.getElementById('container_content');

                //easy
                //html2pdf().from(element).save();

                //custom file name
                //html2pdf().set({filename: 'code_with_mark_'+js.AutoCode()+'.pdf'}).from(element).save();


                //more custom settings
                var opt = {
                    margin: 0.1,
                    filename: 'pageContent_' + js.AutoCode() + '.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'portrait'
                    }
                };

                // New Promise-based usage:
                html2pdf().set(opt).from(element).save();


            });



        });
    </script>



</head>

<body>
    <div class="row">
        <div class="col-6">
            <div class="text-center" style="padding:20px;">
                <a href="{{ route('insiden') }}" class="btn btn-danger ms-2 addButton">Back</a>
            </div>
        </div>
        <div class="col-6">
            <div class="text-center" style="padding:20px;">
                <input type="button" id="rep" value="Print" class="btn btn-info btn_print">
            </div>
        </div>
    </div>




    <div class="container_content" id="container_content">


        <div class="invoice-box">



            <table cellpadding="0" cellspacing="0">
                <div class="row">
                    <div class="col-4">
                        <img src="{{ asset('/img/logo_login.svg') }}" class="navImg" alt="logo">
                    </div>
                    <div class="col-8">
                        <h4 class="text-center">Laporan Insiden Siber</h4>
                        <h4 class="text-center">(Cyber Incident Report)</h4>
                    </div>
                </div>


                <tr class="heading">
                    <td>INFORMASI UMUM</td>

                    <td></td>
                </tr>
                <tr class="heading">
                    <td>Identitas Pelapor</td>

                    <td></td>
                </tr>

                <tr class="item">
                    <td>ID</td>

                    <td>{{ $incident->id_pelapor }}</td>
                </tr>

                <tr class="item">
                    <td>Nama Pelapor</td>

                    <td>{{ $incident->nama_pelapor }}</td>
                </tr>

                <tr class="item">
                    <td>Email</td>
                    <td>{{ $incident->email }}</td>
                </tr>

                <tr class="item">
                    <td>Unit</td>
                    <td>{{ $incident->unit }}</td>
                </tr>

                <tr class="heading">
                    <td>Tipe Laporan</td>
                    <td></td>
                </tr>
                <tr class="item">
                    <td></td>
                    <td>{{ $incident->tipe_laporan }}</td>
                </tr>

                <tr class="heading">
                    <td>Waktu Insiden</td>
                    <td></td>
                </tr>
                <tr class="item">
                    <td></td>
                    <td>{{ $incident->waktu_insiden }}</td>
                </tr>

                <tr class="heading">
                    <td>Tipe</td>
                    <td></td>
                </tr>
                <tr class="item">
                    <td></td>
                    <td>{{ $incident->tipe }}</td>
                </tr>

                <tr class="heading">
                    <td>Deskripsi Insiden</td>
                    <td></td>
                </tr>
                <tr class="item">
                    <td></td>
                    <td>{{ $incident->deskripsi_insiden }}</td>
                </tr>

                <tr class="item">
                    <td>Screenshot Insiden</td>
                    <td>
                        @if($incident->screenshot_insiden)
                        <img src="{{ asset('storage/' . $incident->screenshot_insiden) }}" alt="Bukti" style="max-width: 200px; max-height: 200px;">
                        @else
                        No Image
                        @endif
                    </td>
                </tr>

                <tr class="item">
                    <td>Domainname Insiden</td>
                    <td>{{ $incident->domainname_insiden }}</td>
                </tr>

                <tr class="item">
                    <td>URL Insiden</td>
                    <td>{{ $incident->url_insiden }}</td>
                </tr>

                <tr class="item">
                    <td>Email Insiden</td>
                    <td>{{ $incident->email_insiden }}</td>
                </tr>

                <tr class="heading">
                    <td>Dampak Insiden</td>
                    <td></td>
                </tr>
                <tr class="item">
                    <td></td>
                    <td>{{ $incident->dampak_insiden }}</td>
                </tr>

                <tr class="heading">
                    <td>Tindakan Penanggulangan Insiden</td>
                    <td></td>
                </tr>

                <tr class="item">
                    <td>Respon Cepat/Awal (Jangka Pendek)</td>
                    <td>{{ $incident->tindakan_penanggulangan_jangka_pendek }}</td>
                </tr>

                <tr class="item">
                    <td>Tindakan Penanggulangan Jangka Panjang</td>
                    <td>{{ $incident->tindakan_penanggulangan_jangka_panjang }}</td>
                </tr>

                <tr class="item">
                    <td>Apakah perencanaan Backup system berhasil diimplementasikan?</td>
                    <td>{{ $incident->berhasil_rencana_backup_system }}</td>
                </tr>

                <tr class="item">
                    <td>Organisasi Lain Dilaporkan</td>
                    <td>{{ $incident->organisasi_lain_dilaporkan }}</td>
                </tr>
                <tr class="heading">
                    <td>INFORMASI KHUSUS</td>

                    <td></td>
                </tr>

                <tr class="heading">
                    <td>Aset Kritis Terdampak</td>
                    <td></td>
                </tr>
                <tr class="item">
                    <td></td>
                    <td>{{ $incident->aset_kritis_terdampak }}</td>
                </tr>

                <tr class="heading">
                    <td>Dampak Insiden Terhadap Aset</td>
                    <td></td>
                </tr>
                <tr class="item">
                    <td></td>
                    <td>{{ $incident->dampak_insiden_terhadap_aset }}</td>
                </tr>

                <tr class="heading">
                    <td>Jumlah Pengguna Terkena Dampak</td>
                    <td></td>
                </tr>
                <tr class="item">
                    <td></td>
                    <td>{{ $incident->jumlah_pengguna_terkena_dampak }}</td>
                </tr>

                <tr class="heading">
                    <td>Dampak Terhadap ICT</td>
                    <td></td>
                </tr>
                <tr class="item">
                    <td></td>
                    <td>{{ $incident->dampak_terhadap_ICT }}</td>
                </tr>

                <tr class="heading">
                    <td>Profil Penyerang</td>
                    <td></td>
                </tr>

                <tr class="item">
                    <td>IP Address Penyerang</td>
                    <td>{{ $incident->ip_address_penyerang }}</td>
                </tr>

                <tr class="item">
                    <td>Port yang Diserang</td>
                    <td>{{ $incident->port_yang_diserang }}</td>
                </tr>

                <tr class="heading">
                    <td>Tipe Serangan</td>
                    <td></td>
                </tr>
                <tr class="item">
                    <td></td>
                    <td>{{ $incident->tipe_serangan }}</td>
                </tr>
                <tr class="heading">
                    <td>Analisis</td>
                    <td></td>
                </tr>
                <tr class="item">
                    <td>Laporan Analisis Log</td>
                    <td>{{ $incident->laporan_analisis_log }}</td>
                </tr>

                <tr class="item">
                    <td>Laporan Forensik</td>
                    <td>{{ $incident->laporan_forensik }}</td>
                </tr>

                <tr class="item">
                    <td>Laporan Audit</td>
                    <td>{{ $incident->laporan_audit }}</td>
                </tr>

                <tr class="item">
                    <td>Laporan Analisis Network Traffic</td>
                    <td>{{ $incident->laporan_analisis_network_traffic }}</td>
                </tr>
                <tr class="heading">
                    <td>Rincian</td>
                    <td></td>
                </tr>
                <tr class="item">
                    <td>Nama dan Versi Perangkat</td>
                    <td>{{ $incident->nama_dan_versi_perangkat }}</td>
                </tr>

                <tr class="item">
                    <td>Lokasi Perangkat</td>
                    <td>{{ $incident->lokasi_perangkat }}</td>
                </tr>

                <tr class="item">
                    <td>Sistem Operasi</td>
                    <td>{{ $incident->sistem_operasi }}</td>
                </tr>

                <tr class="item">
                    <td>Terakhir Update Sistem</td>
                    <td>{{ $incident->terakhir_update_sistem }}</td>
                </tr>

                <tr class="item">
                    <td>IP Address</td>
                    <td>{{ $incident->ip_address }}</td>
                </tr>

                <tr class="item">
                    <td>MAC Address</td>
                    <td>{{ $incident->mac_address }}</td>
                </tr>

                <tr class="item">
                    <td>DNS Entry</td>
                    <td>{{ $incident->dns_entry }}</td>
                </tr>

                <tr class="item">
                    <td>Domain Workgroup</td>
                    <td>{{ $incident->domain_workgroup }}</td>
                </tr>

                <tr class="item">
                    <td>Perangkat Terhubung ke Jaringan</td>
                    <td>{{ $incident->perangkat_terhubung_ke_jaringan }}</td>
                </tr>

                <tr class="item">
                    <td>Perangkat Terhubung ke Modem</td>
                    <td>{{ $incident->perangkat_terhubung_ke_modem }}</td>
                </tr>

                <tr class="item">
                    <td>Pengamanan Fisik Perangkat</td>
                    <td>{{ $incident->pengamanan_fisik_perangkat }}</td>
                </tr>

                <tr class="item">
                    <td>Pengamanan Logik Perangkat</td>
                    <td>{{ $incident->pengamanan_logik_perangkat }}</td>
                </tr>

                <tr class="item">
                    <td>Perangkat Diputus</td>
                    <td>{{ $incident->perangkat_diputus }}</td>
                </tr>

                <tr class="item">
                    <td>Status Insiden</td>
                    <td>{{ $incident->status_insiden }}</td>
                </tr>

                <tr class="item">
                    <td>Pernah Ditawarkan ke SI Krisis</td>
                    <td>{{ $incident->pernah_ditawakan_ke_si_krisis }}</td>
                </tr>

                <tr class="item">
                    <td>
                        <div class="row">
                            <!-- TTD VP TI -->
                            <div class="col-4">
                                <p>Disetujui oleh <br /><strong>President Technology and Innovation</strong> </p>
                                @if($incident->ttd_vp_ti)
                                <img src="{{ asset('storage/' . $incident->ttd_vp_ti) }}" alt="TTD VP TI" class="img-fluid" style="max-width: 100%; max-height: 200px;">
                                @else
                                No Image
                                @endif
                            </div>

                            <!-- TTD TIS -->
                            <div class="col-4">
                                <p>Disetujui oleh <br /><strong>Technology and Innovation Specialist</strong> </p>
                                @if($incident->ttd_tis)
                                <img src="{{ asset('storage/' . $incident->ttd_tis) }}" alt="TTD TIS" class="img-fluid" style="max-width: 100%; max-height: 200px;">
                                @else
                                No Image
                                @endif
                            </div>

                            <!-- TTD TI Officer -->
                            <div class="col-4">
                                <p>Disetujui oleh <br /><strong>Technology and Innovation Officer</strong> </p>
                                @if($incident->ttd_ti_officer)
                                <img src="{{ asset('storage/' . $incident->ttd_ti_officer) }}" alt="TTD TI Officer" class="img-fluid" style="max-width: 100%; max-height: 200px;">
                                @else
                                No Image
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>



                <tr class="item">
                    <td>Created At</td>
                    <td>{{ $incident->created_at }}</td>
                </tr>

                <tr class="item">
                    <td>Updated At</td>
                    <td>{{ $incident->updated_at }}</td>
                </tr>

                <!-- <tr class="total">
                    <td></td>

                    <td>Total: $385.00</td>
                </tr> -->
            </table>
        </div>
    </div>



</body>

</html>
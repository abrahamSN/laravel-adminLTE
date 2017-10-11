<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Pemasukan</title>
    <style type="text/css">
        body {
            font-family: "Arial", Helvetica, sans-serif !important;;
        }

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            border-color: #ccc;
            width: 100%;
        }

        .tg td {
            font-family: Arial;
            font-size: 12px;
            padding: 8px 5px;
            border-style: solid;
            border-width: 0px;
            overflow: hidden;
            word-break: normal;
            border-color: #ccc;
            color: #333;
            background-color: #fff;
        }

        .tg th {
            font-family: Arial;
            font-size: 14px;
            font-weight: normal;
            padding: 8px 5px;
            border-style: solid;
            border-width: 0px;
            overflow: hidden;
            word-break: normal;
            border-color: #cc685e;
            color: #333;
            background-color: #f0f0f0;
        }

        .tg .tg-3wr7 {
            font-weight: bold;
            font-size: 12px;
            font-family: "Arial", Helvetica, sans-serif !important;;
            text-align: center
        }

        .tg .tg-ti5e {
            font-size: 10px;
            font-family: "Arial", Helvetica, sans-serif !important;;
            text-align: center
        }

        .tg .tg-rv4w {
            font-size: 10px;
            font-family: "Arial", Helvetica, sans-serif !important;
        }

        .report_t {
            width: 100%;
            height: auto;
            text-align: center;
            font-size: 25px;
        }

        .report_c {
            width: 100%;
            height: auto;
            text-align: center;
            font-size: 16px;
            line-height: 18px;
        }
    </style>
</head>
<body>
<div class="report_t">LAPORAN KELUHAN</div>
<div class="report_c">
    Report laporan keluhan {{ $show->created_at }}
    <br>
    Invoice : {{ $show->invoice }}
</div>
<br>
<hr>
<br>
<table class="tg" border="0">
    <tr>
        <th align="right"><b>Pelapor : </b></th>
        <th><b>{{ $show->user['name'] }}</b></th>
    </tr>
    <tr>
        <td align="right"><b>Nama Product : </b></td>
        <td><b>{{ $show->product['name'] }}</b></td>
    </tr>
    <tr>
        <th align="right"><b>Nama Pekerja : </b></th>
        <th>
            <b>
                @foreach($show->pekerja as $pkr)
                    {{ $pkr->name }}
                @endforeach
            </b>
        </th>
    </tr>
    <tr>
        <td align="right"><b>Keterangan Keluhan : </b></td>
        <td><b>{{ $show->keterangan }}</b></td>
    </tr>
    <tr>
        <th align="right"><b>Keterangan Keluhan : </b></th>
        <th>
            <b>
                @if($show->status == 1)
                    Belum di tanggapi
                @elseif($show->status == 2)
                    Sedang di proses
                @else
                    Masalah selesai
                @endif
            </b>
        </th>
    </tr>
</table>
</body>
</html>
<!-- resources/views/pdf/report.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>PDF Report</title>
    <style>
        /* CSS to center the h1 heading */
        body {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h1>Report Permintaan</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl. Permintaan</th>
                <th>Tematik Permintaan</th>
                <th>LOP</th>
                <th>No. Nota Dinas</th>
                <th>Nama Permintaan</th>
                <th>PIC Permintaan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp

            @foreach($reports as $report)
                @php
                    $count = isset($LOPCount[$report->id]) ? $LOPCount[$report->id] : 0;
                @endphp
                <tr>
                    <td style="text-align: center">{{ $no++ }}</td>
                    <td style="padding-left: 5px">{{ \Carbon\Carbon::parse($report->tanggal_permintaan)->format('j F Y') }}</td>
                    <td style="padding-left: 5px">{{ $report->tematik_permintaan }}</td>
                    <td style="text-align: center">{{ $count }}</td>
                    <td style="padding-left: 5px">
                        @if (!empty($item->no_nota_dinas) || !empty($item->refferal_permintaan))
                            {{ $report->no_nota_dinas }}
                        @else
                            <p>-</p>
                        @endif
                    </td>
                    <td style="padding-left: 5px">{{ $report->nama_permintaan }}</td>
                    <td style="padding-left: 5px">{{ $report->pic_permintaan }}</td>
                    <td style="padding-left: 5px">{{ $report->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

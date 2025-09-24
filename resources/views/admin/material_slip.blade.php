<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <title>ใบเบิกวัสดุ</title>

    <style>
        @font-face {
            font-family: "THSarabunNew";
            src: url("{{ $fontPath }}") format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'THSarabunNew';
            src: url("{{ $fontBoldPath }}") format('truetype');
            font-weight: bold;
        }

        @page {
            size: A4;
            margin: 40px;
        }

        html,
        body {
            width: 180mm;
            height: 270mm;
            margin: 0 auto;
            overflow: hidden;
        }

        body {
            font-family: "THSarabunNew", sans-serif;
            font-size: 13pt;
            line-height: 1.3;
            margin: 10mm 15mm;
            page-break-after: avoid;
        }

        body,
        h2,
        p,
        div,
        table,
        .signature-block,
        .signature-line,
        .footer {
            page-break-inside: avoid !important;
            page-break-before: avoid !important;
            page-break-after: avoid !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 3px;
            font-size: 13pt;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .signature-block {
            margin-top: 15px;
        }

        .signature-line {
            margin-top: 15px;
            text-align: center;
        }

        .column-2 {
            width: 100%;
            display: table;
            table-layout: fixed;
        }

        .column {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        .mt-3 {
            margin-top: 15px;
        }

        .mt-1 {
            margin-top: 5px;
        }

        .footer {
            margin-top: 30px;
            font-size: 11pt;
            text-align: center;
        }

        tr,
        td,
        th {
            page-break-inside: avoid;
        }

        .header-logo {
            width: 80px;
            height: auto;
            margin-bottom: -75px;
        }
    </style>
</head>

<body style="font-family: 'THSarabunNew';">
    <img src="{{ public_path('images/IT Logo.png') }}" alt="Logo" class="header-logo" />
    <h2 class="center" style="font-family: 'THSarabunNew'; font-weight: bold; font-size: 26;">ใบเบิกวัสดุ</h2>

    @php
        $doc_number = 'ทส.วทก.มทร.ล.ตก.' . str_pad($request->id, 3, '0', STR_PAD_LEFT) . '/' . (now()->format('Y') + 543);
        $date = $request->created_at->timezone('Asia/Bangkok')->locale('th');
        $day = $date->translatedFormat('j');
        $month = $date->translatedFormat('F');
        $year_be = $date->year + 543;

        switch ($request->user->position) {
            case 'student':
                $positionThai = 'นักศึกษา';
                break;
            case 'teacher':
                $positionThai = 'อาจารย์';
                break;
            case 'staff':
                $positionThai = 'เจ้าหน้าที่';
                break;
            default:
                $positionThai = 'ไม่ทราบตำแหน่ง';
        }
    @endphp

    <div class="right">
        <div>เลขที่ {{ $doc_number }}</div>
        <div>วันที่ {{ $day }} เดือน {{ $month }} พ.ศ. {{ $year_be }}</div>
    </div>

    <p>
        ข้าพเจ้ามีความประสงค์ขอเบิกวัสดุจากคลังพัสดุตามรายการดังต่อไปนี้เพื่อใช้ในการดำเนินงาน&nbsp;
        {{ $request->reason }}
    </p>

    <table border="1" style="font-family: 'THSarabunNew'; width: 100%;">
        <thead>
            <tr>
                <th width="10%">ลำดับ</th>
                <th>รายการวัสดุ</th>
                <th width="15%">จำนวน</th>
                <th width="20%">หน่วยนับ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center">1</td>
                <td>{{ $request->material->name ?? '-' }}</td>
                <td class="center">{{ $request->quantity }}</td>
                <td class="center">
                    @if (isset($request->material->unit) && strtolower($request->material->unit) === 'กล่อง')
                        กล่อง
                    @else
                        ชิ้น
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <div class="signature-block">
        <div class="signature-line">
            ลงชื่อ ....................................................<br />
            ผู้ขอเบิก<br />
            ( {{ $request->user->name }} {{ $request->user->surname }} )<br />
            ตำแหน่ง {{ $positionThai }}
        </div>

        <div class="signature-line">
            ลงชื่อ ....................................................<br />
            ผู้อนุมัติ<br />
            ({{ $head->name }} {{ $head->surname }})<br />
            ตำแหน่ง หัวหน้าหลักสูตรเทคโนโลยีสารสนเทศ
        </div>

        <div class="signature-block mt-3" style="margin-top: 15px;">
            <div class="column-2" style="page-break-inside: avoid;">
                <div class="column">
                    ลงชื่อ ....................................................<br>
                    ({{ $staff->name }} {{$staff->surname}})<br>
                    เจ้าหน้าที่จ่ายวัสดุ<br>
                    วันที่ ............. เดือน ................. พ.ศ. ............
                </div>

            </div>
        </div>
    </div>

    <div class="footer">
      &copy;  ลิขสิทธิ์ สาขาวิชาเทคโนโลยีสารสนเทศ มทร.ล้านนา ตาก
    </div>
</body>

</html>
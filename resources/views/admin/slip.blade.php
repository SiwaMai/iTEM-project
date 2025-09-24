<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>ใบขอยืมครุภัณฑ์</title>

    <style>
        @font-face {
            font-family: "THSarabunNew";
            src: url("{{ storage_path('fonts/THSarabunNew.ttf') }}") format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'THSarabunNew';
            src: url("{{ storage_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
            font-weight: bold;
            font-style: normal;
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
            margin-top: 1px;
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
            margin-top: 10px;
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

        .text-gray {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <img src="{{ public_path('images/IT Logo.png') }}" alt="Logo" class="header-logo">
    <h2 class="center" style="font-weight: bold; font-size: 26pt;">ใบขอยืมครุภัณฑ์</h2>

    @php
        use Carbon\Carbon;

        $doc_number = 'ทส.วทก.มทร.ล.ตก.' . str_pad($request->id, 3, '0', STR_PAD_LEFT) . '/' . (now()->year + 543);

        $date = $request->created_at->timezone('Asia/Bangkok')->locale('th');
        $day = $date->translatedFormat('j');
        $month = $date->translatedFormat('F');
        $year_be = $date->year + 543;

        $due_date = $request->due_date ? Carbon::parse($request->due_date)->locale('th') : null;
    @endphp

    <div class="right">เลขที่ {{$doc_number}}</div>
    <div class="right">วันที่ {{ $day }} เดือน {{ $month }} พ.ศ. {{ $year_be }}</div>

    <p>ข้าพเจ้าขอยืมพัสดุครุภัณฑ์ตามรายการต่อไปนี้เพื่อใช้ในราชการของ &nbsp;{{ $request->reason }}</p>

    <table border="1">
        <thead>
            <tr class="center" style="font-weight: bold;">
                <th width="7%">ลำดับ</th>
                <th>รายการ</th>
                <th width="7%">จำนวน</th>
                <th width="8%">หน่วยนับ</th>
                <th width="20%">หมายเหตุ</th>
            </tr>
        </thead>
        <tbody>
            @if($request->equipment)
                <tr>
                    <td class="center">1</td>
                    <td>
                        ครุภัณฑ์ : {{ $request->equipment->name }}<br>
                        รหัสครุภัณฑ์ : {{ $request->equipment->code ?? 'ไม่มีรหัส' }}
                    </td>
                    <td class="center">{{ $request->quantity ?? 1 }}</td>
                    <td class="center">
                        {{ !empty($request->equipment->unit) ? $request->equipment->unit : 'ไม่ระบุหน่วย' }}
                    </td>
                    <td></td>
                </tr>
            @else
                <tr>
                    <td colspan="5" class="center text-gray">ไม่มีรายการครุภัณฑ์</td>
                </tr>
            @endif
        </tbody>
    </table>

    <p class="mt-3">
        @if($due_date)
            กำหนดส่งคืน วันที่ {{ $due_date->translatedFormat('j') }}
            เดือน {{ $due_date->translatedFormat('F') }}
            พ.ศ. {{ $due_date->year + 543 }}
        @else
            <span class="text-gray">ยังไม่กำหนดวันคืน</span>
        @endif
    </p>

    <p style="text-indent: 2em;">
        ข้าพเจ้าขอรับรองว่าครุภัณฑ์ที่ยืมไปนี้ หากนำมาคืนจะต้องอยู่ในสภาพที่ใช้งานได้ หากเกิดการเสียหาย/ชำรุด
        ข้าพเจ้าจะเป็นผู้ออกค่าใช้จ่ายเอง<br>ทั้งหมดทุกกรณี
    </p>

    <div class="signature-block" style="display: flex; justify-content: flex-start; gap: 20px;">
        <div class="signature-line" style="flex: 1;">
            ลงชื่อ .................................................... ผู้ยืม<br>
            ( {{ $request->user->name }} {{ $request->user->surname }} )<br>

            @php
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
            ตำแหน่ง {{$positionThai}}
        </div>

        <div class="signature-line" style="flex: 1;">
            อนุญาตให้เบิกได้<br><br>
            ลงชื่อ .................................................... ผู้สั่งจ่าย<br>
            ({{ $head->name }} {{ $head->surname }})<br>
            ตำแหน่ง หัวหน้าหลักสูตรเทคโนโลยีสารสนเทศ
        </div>
    </div>

    <div class="signature-block mt-3">
        <div class="column-2">
            <div class="column">
                ลงชื่อ ....................................................<br>
                ({{ $staff->name }} {{$staff->surname}})<br>
                เจ้าหน้าที่จ่าย<br>
                วันที่ ............. เดือน ................. พ.ศ. ............
            </div>

            <div class="column">
                ลงชื่อ ....................................................<br>
                ( .................................................... )<br>
                ผู้รับของคืน<br>
                วันที่ ............. เดือน ................. พ.ศ. ............
            </div>
        </div>
    </div>

    <div class="footer">
       &copy; ลิขสิทธิ์ สาขาวิชาเทคโนโลยีสารสนเทศ มทร.ล้านนา ตาก 
    </div>
</body>

</html>
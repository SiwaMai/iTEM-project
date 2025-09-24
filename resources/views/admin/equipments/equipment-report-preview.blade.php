<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>รายงานข้อมูลครุภัณฑ์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            @page {
                size: A4 landscape;
                margin: 1cm;
            }
        }

        body {
            font-family: "TH Sarabun New", sans-serif;
            font-size: 18px;
            padding: 20px;
            background-color: #fff;
            position: relative;
        }

        h3 {
            font-size: 22px;
        }

        table {
            font-family: 'THSarabunNew';
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 6px;
            border-bottom: 1px solid #000;
        }

        th {
            text-align: center;
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .btn {
            font-size: 16px;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 100px;
            margin-bottom: 30px;
        }

        .title-with-logo {
            padding-left: 120px;
        }

        tr,
        td,
        th {
            page-break-inside: avoid;
        }

        .signature-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        width: 100%;
        max-width: 100%;
        padding: 0 60px; /* ขอบซ้าย-ขวา */
        box-sizing: border-box;
        margin-top: 60px;
        page-break-before: always; /* เริ่มหน้าใหม่ */
    }

    .signature-left,
    .signature-right {
        width: 300px;
        text-align: center;
        line-height: 1.8;
    }

        .column-2 {
            display: flex;
            justify-content: space-between;
            width: 700px;
            gap: 50px;
        }

        .column {
            width: 50%;
            text-align: left;
            box-sizing: border-box;
        }
    </style>
</head>

<body style="font-family: 'THSarabunNew';">
    <div class="container-fluid mt-3">
        <!-- โลโก้มุมซ้ายบน -->
        <img src="{{ public_path('images/IT Logo.png') }}" alt="IT Logo" class="logo">

        <!-- หัวเรื่อง -->
        <h3 class="text-center mb-4 title-with-logo" style="font-size: 32px;">รายงานข้อมูลครุภัณฑ์</h3>

        <br><br>
        <!-- ตารางข้อมูล -->
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="width: 10%; text-align: center;">ลำดับ</th>
                    <th style="width: 20%; text-align: center;">รหัสครุภัณฑ์</th>
                    <th style="width: 25%; text-align: center;">ชื่อครุภัณฑ์</th>
                    <th style="width: 20%; text-align: center;">หมวดหมู่</th>
                    <th style="width: 12.5%; text-align: center;">จำนวนคงเหลือ</th>
                    <th style="width: 12.5%; text-align: center;">หน่วยนับ</th>
                    <th style="width: 12.5%; text-align: center;">สถานะ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipments as $index => $equipment)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td style="text-align: center;">{{ $equipment->code }}</td>
                        <td>{{ $equipment->name }}</td>
                        <td>{{ $equipment->category->name ?? '-' }}</td>
                        <td style="text-align: center;">{{ $equipment->quantity }}</td>
                        <td style="text-align: center;">{{ $equipment->unit }}</td>
                        <td style="text-align: center;">{{ $equipment->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ส่วนท้ายรายงานหน้าใหม่ -->
    <div class="signature-wrapper">
    <!-- ฝั่งซ้าย: ผู้จัดทำ -->
    <div class="signature-left">
        ลงชื่อ ....................................................<br>
        ({{ $staff->name }} {{ $staff->surname }})<br>
        ผู้จัดทำ<br>
        วันที่ ............. เดือน ................. พ.ศ. ............
    </div>

    <!-- ฝั่งขวา: ผู้เห็นชอบ -->
    <div class="signature-right">
        ลงชื่อ ....................................................<br>
        ({{ $head->name }} {{ $head->surname }})<br>
        ผู้เห็นชอบ<br>
        วันที่ ............. เดือน ................. พ.ศ. ............
    </div>
</div>
</body>

</html>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>อนุมัติการยืม-คืนครุภัณฑ์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #f3f4f6;
            padding-top: 90px;
        }

        .main-navbar {
            background: linear-gradient(to left, #2c3e50, #bdc3c7);
            padding: 0.8rem 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .navbar-logo {
            width: 40px;
            height: auto;
            margin-right: 10px;
        }

        .navbar-logo2 {
            width: 58px;
            height: auto;
            margin-top: 18px;
        }

        .navbar-brand-custom {
            font-size: 1.3rem;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            text-transform: uppercase;
            flex-grow: 1;
            word-break: break-word;
            margin-left: 15px;
        }

        .navbar-right {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .navbar-item {
            margin-left: 1.5rem;
        }

        .navbar-link {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-item:hover .navbar-link {
            color: #ff8c00;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #fff;
            margin-right: 10px;
        }

        .footer {
            background-color: #f97316;
            color: white;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
            text-align: center;
        }

        input.form-control::placeholder {
            color: #a1a1aa;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .side-menu {
                position: fixed;
                top: 0;
                right: -250px;
                width: 250px;
                height: 100%;
                background-color: #2c3e50;
                transition: right 0.3s ease;
                z-index: 9999;
                box-shadow: -2px 0 10px rgba(0, 0, 0, 0.12);
                padding-top: 60px;
                display: block !important;
            }

            .side-menu.show {
                right: 0;
            }

            .navbar-toggler {
                position: absolute;
                top: 15px;
                right: 15px;
                z-index: 10000;
                display: block;
            }

            .navbar-right {
                flex-direction: column;
                margin-top: 1rem;
            }

            .navbar-item {
                margin: 0.5rem 0;
            }

            .navbar-brand-custom {
                text-align: center;
                margin: 0.5rem 0;
            }

            .navbar-item.dropdown .dropdown-menu {
                position: static;
                float: none;
                width: 100%;
                background-color: #2c3e50;
            }

            .dropdown-menu .dropdown-item {
                color: white;
                padding-left: 2rem;
            }

            .dropdown-menu .dropdown-item:hover {
                background-color: #ff8c00;
            }
        }

        @media (min-width: 768px) {
            .navbar-toggler {
                display: none;
            }

            .collapse.navbar-collapse {
                display: flex !important;
                justify-content: flex-end;
            }

            .navbar-right {
                flex-direction: row;
            }

            .navbar-container {
                flex-wrap: nowrap;
            }

            .side-menu {
                display: none !important;
            }
        }

        #nprogress .bar {
            background: #f97316 !important;
        }

        .user-info {
            display: flex;
            align-items: center;
            font-size: 1rem;
            color: white;
        }

        /* รูปภาพโปรไฟล์ */
        .user-avatar {
            width: 35px;
            /* ขนาดตามต้องการ */
            height: 35px;
            /* ต้องเท่ากับ width เพื่อให้เป็นวงกลม */
            object-fit: cover;
            /* ป้องกันภาพยืด */
            border-radius: 50%;
            /* ทำให้เป็นวงกลม */
            overflow: hidden;
            /* กันภาพล้นขอบ */
            object-position: top;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md main-navbar fixed-top">
        <div class="container-fluid">
            <div class="navbar-container">
                <div class="logo-container">
                    <img src="/images/rmutl_old.png" alt="Logo 1" class="navbar-logo">
                    <img src="/images/IT Logo.png" alt="Logo 2" class="navbar-logo2">
                </div>
                <a class="navbar-brand-custom">ระบบบริหารจัดการวัสดุและการยืม
                    คืนครุภัณฑ์ <br>ภายในสาขาวิชาเทคโนโลยีสารสนเทศ</a>
                <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse side-menu" id="navbarContent">
                    <ul class="navbar-right">
                        <li class="navbar-item">
                            <a class="navbar-link" href="{{ route('admin.dashboard') }}">หน้าแรก</a>
                        </li>

                        {{-- เมนูวัสดุ --}}
                        <li class="navbar-item dropdown">
                            <a class="navbar-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">บริหารจัดการวัสดุ</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.materials.index') }}">ข้อมูลวัสดุ</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('admin.materials.create') }}">เพิ่มวัสดุ</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.material-approvals.index') }}">อนุมัติเบิกจ่ายวัสดุ</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.materials.material-report.index') }}">ออกรายงานข้อมูลวัสดุ</a>
                                </li>
                            </ul>
                        </li>

                        {{-- เมนูครุภัณฑ์ --}}
                        <li class="navbar-item dropdown">
                            <a class="navbar-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">บริหารจัดการครุภัณฑ์</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.equipments.index') }}">ข้อมูลครุภัณฑ์</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.equipments.create') }}">เพิ่มครุภัณฑ์</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.borrow.requests') }}">อนุมัติการยืม-คืนครุภัณฑ์</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.equipments.equipment-report.index') }}">ออกรายงานครุภัณฑ์</a>
                                </li>
                            </ul>
                        </li>

                        <li class="navbar-item dropdown">
                            <a class="navbar-link dropdown-toggle user-info" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @php
                                    $user = Auth::guard('admin')->user();
                                @endphp

                                <img src="{{ $user && $user->profile_image
    ? asset('storage/' . $user->profile_image)
    : asset('images/default-avatar.png') }}" class="user-avatar shadow-sm">

                                <span class="user-name">
                                    สวัสดีคุณ {{ $user->name }} {{ $user->surname }} ({{ $user->position }})
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        ออกจากระบบ
                                    </a>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </nav>

    <div class="container mt-5 mb-5 pb-5">
        <h3 class="mb-4">รายการคำขอยืมครุภัณฑ์</h3>

        @if(session('success'))
            <script>
                Swal.fire({ icon: 'success', title: 'สำเร็จ', text: '{{ session('success') }}', timer: 2000, showConfirmButton: false });
            </script>
        @elseif(session('error'))
            <script>
                Swal.fire({ icon: 'error', title: 'เกิดข้อผิดพลาด', text: '{{ session('error') }}', timer: 2500, showConfirmButton: false });
            </script>
        @endif

        @foreach ($requests as $req)
            <div class="card mb-3 shadow rounded-xl">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1"><strong>👤 ผู้ใช้:</strong> {{ $req->user?->name }} {{ $req->user?->surname }}</p>
                        <p><strong>📦 รายการครุภัณฑ์ที่ยืม:</strong></p>
                        @if($req->equipment)
                            <strong>{{ $req->equipment->name }}</strong><br>
                            รหัสครุภัณฑ์: <strong>{{$req->equipment->code}}</strong> <br>
                            @if($req->equipment && !empty($req->equipment->unit))
    - จำนวนที่ยืม: {{ $req->quantity ?? 1 }} {{ $req->equipment->unit }}<br>
    - คงเหลือ: {{ $req->equipment->available_quantity ?? $req->equipment->quantity }} {{ $req->equipment->unit }}<br>
@elseif($req->equipment)
    - จำนวนที่ยืม: {{ $req->quantity ?? 1 }} <span class="text-muted">ไม่ระบุหน่วย</span><br>
    - คงเหลือ: {{ $req->equipment->available_quantity ?? $req->equipment->quantity }} <span class="text-muted">ไม่ระบุหน่วย</span><br>
@else
    <p class="text-muted">ไม่มีรายการครุภัณฑ์</p>
@endif
                        @else
                            <p class="text-muted">ไม่มีรายการครุภัณฑ์</p>
                        @endif
                        <p class="mb-1"><strong>📅 วันที่ขอ:</strong>
                            @php
                                $date = $req->created_at->timezone('Asia/Bangkok')->locale('th');
                                $dayMonth = $date->translatedFormat('j F');
                                $year_be = $date->year + 543;
                                $time = $date->format('H:i');
                            @endphp
                            {{ $dayMonth . ' ' . $year_be . ' เวลา ' . $time . ' น.' }}
                        </p>

                        <p class="mb-1"><strong>📅 วันที่ยืม:</strong>
{{ $req->borrow_date
    ? \Carbon\Carbon::parse($req->borrow_date)->timezone('Asia/Bangkok')->translatedFormat('j F Y เวลา H:i น.')
    : '-' }}                        </p>
                        <p class="mb-1"><strong>📅 วันที่คืน:</strong>
{{ $req->borrowed_at ? \Carbon\Carbon::parse($req->borrowed_at)->timezone('Asia/Bangkok')->translatedFormat('j F Y เวลา H:i น.') : '-' }}         </p>               
<p class="mb-1"><strong>📄 สถานะ:</strong>
                            @if ($req->status === 'pending')
                                <span class="text-warning">รออนุมัติ</span>
                            @elseif ($req->status === 'approved')
                                <span class="text-success">อนุมัติแล้ว</span>
                            @elseif ($req->status === 'returned')
                                <span class="text-primary">คืนแล้ว</span>
                            @else
                                <span class="text-danger">ถูกปฏิเสธ</span>
                            @endif
                        </p>
                    </div>

                    <div class="text-end">
                        @if ($req->status === 'pending')
                            <button class="btn btn-success btn-sm mb-1"
                                onclick="confirmApprove({{ $req->id }})">อนุมัติ</button><br>
                            <button class="btn btn-danger btn-sm" onclick="confirmReject({{ $req->id }})">ปฏิเสธ</button>

                            <form id="approve-form-{{ $req->id }}" action="{{ route('admin.borrow.approve', $req->id) }}"
                                method="POST" style="display: none;">@csrf</form>
                            <form id="reject-form-{{ $req->id }}" action="{{ route('admin.borrow.reject', $req->id) }}"
                                method="POST" style="display: none;">@csrf</form>
                        @elseif ($req->status === 'approved')
                            <a href="{{ route('admin.borrow.slip', $req->id) }}" class="btn btn-primary btn-sm mb-1"
                                target="_blank" rel="noopener">ออกใบยืม</a>
                            <a href="{{ route('admin.borrow.download-slippdf', $req->id) }}"
                                class="btn btn-secondary btn-sm mb-1">ดาวน์โหลด PDF</a>

                            <form class="return-form" data-id="{{ $req->id }}"
                                action="{{ route('admin.borrow.return', $req->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">คืนครุภัณฑ์</button>
                            </form>
                        @endif
                    </div>

                    <script>
$(document).ready(function () {
    $('.return-form').submit(function (e) {
        e.preventDefault();

        const form = $(this);
        const id = form.data('id');
        const actionUrl = form.attr('action');

        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณต้องการคืนครุภัณฑ์นี้ใช่หรือไม่",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ใช่, คืน!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: form.serialize(),
                    headers: {
                        'Accept': 'application/json' // ✅ Laravel จะส่ง JSON กลับ
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: response.message || 'คืนครุภัณฑ์เรียบร้อยแล้ว',
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // ✅ อัปเดต DOM แบบ real-time
                            form.find('button[type="submit"]')
                                .removeClass('btn-warning')
                                .addClass('btn-success')
                                .text('คืนแล้ว')
                                .prop('disabled', true);

                            // หรือซ่อน card ทั้งใบ
                            form.closest('.card').fadeOut();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: response.message || 'ไม่สามารถคืนครุภัณฑ์ได้',
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    },
                    error: function (xhr) {
                        let message = 'ไม่สามารถคืนครุภัณฑ์ได้';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: message,
                            confirmButtonText: 'ตกลง'
                        });
                    }
                });
            }
        });
    });
});
</script>
                </div>
            </div>
        @endforeach
    </div>

    <div class="footer">
        <p>&copy; 2568 พัฒนาโดย นายศิวกร จุลศิลป์ สาขาวิชาเทคโนโลยีสารสนเทศ | All Rights Reserved.</p>
    </div>

    <script>
        function confirmApprove(id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการอนุมัติคำขอนี้ใช่หรือไม่",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'ใช่, อนุมัติ!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => { if (result.isConfirmed) document.getElementById('approve-form-' + id).submit(); });
        }

        function confirmReject(id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการปฏิเสธคำขอนี้ใช่หรือไม่",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ใช่, ปฏิเสธ!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => { if (result.isConfirmed) document.getElementById('reject-form-' + id).submit(); });
        }

        document.addEventListener('DOMContentLoaded', function () {
            var toggler = document.querySelector('.navbar-toggler');
            var sideMenu = document.querySelector('.side-menu');
            if (toggler && sideMenu) {
                toggler.addEventListener('click', function (e) {
                    e.preventDefault();
                    sideMenu.classList.toggle('show');
                });
            }
        });

        NProgress.start();
        window.addEventListener('load', function () { setTimeout(function () { NProgress.done(); }, 500); });
    </script>

    @auth
    @if(auth()->user()->role === 'admin')
        <script>
            let timer;

            function startInactivityTimer() {
                timer = setTimeout(() => {
                    window.location.href = "/logout"; // ✅ redirect ไปตัด session จริง
                }, 3 * 60 * 1000); // ⏱ 3 นาที
            }

            function resetTimer() {
                clearTimeout(timer);
                startInactivityTimer();
            }

            // เรียกตอนโหลดหน้า
            window.onload = startInactivityTimer;

            // ตรวจทุก event ที่แสดงว่า user ยัง active
            ['mousemove', 'keypress', 'click', 'scroll', 'touchstart'].forEach(evt => {
                document.addEventListener(evt, resetTimer);
            });
        </script>
    @endif
@endauth
</body>

</html>
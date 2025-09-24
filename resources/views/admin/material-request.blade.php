<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>อนุมัติเบิกวัสดุ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Responsive: Small screens */
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

            .navbar-container {
                flex-direction: row;
                flex-wrap: wrap;
                align-items: flex-start;
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

            .logo-container {
                display: flex;
                align-items: center;
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

        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #f3f4f6;
            padding-top: 90px;
            /* เพื่อเว้นพื้นที่ด้านบนให้กับ navbar */
        }

        .toggle-option.selected {
            color: white;
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

        /* Navbar styles */
        .main-navbar {
            background: #bdc3c7;
            background: -webkit-linear-gradient(to left, #2c3e50, #bdc3c7);
            background: linear-gradient(to left, #2c3e50, #bdc3c7);
            padding: 0.8rem 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

            /* เพิ่มความโค้งมุมล่างซ้ายและขวา */
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

        /* Remove .navbar-collapse-custom styles */

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

        /* ทำให้เมื่อเมาส์ชี้จะเปลี่ยนสีในแบบนุ่มนวล */
        .navbar-item:hover .navbar-link {
            color: #ff8c00;
        }

        .user-info {
            display: flex;
            align-items: center;
            font-size: 1rem;
            color: white;
        }

        /* รูปภาพโปรไฟล์ */
        .user-avatar {
            width: 120px;
            /* ขนาดตามต้องการ */
            height: 120px;
            /* ต้องเท่ากับ width เพื่อให้เป็นวงกลม */
            object-fit: cover;
            /* ป้องกันภาพยืด */
            border-radius: 50%;
            /* ทำให้เป็นวงกลม */
            overflow: hidden;
            /* กันภาพล้นขอบ */
            object-position: top;
        }

        .user-name {
            font-size: 1rem;
        }

        .logout-text {
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            /* Removed flex-direction: column from .navbar-container */

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

            .logo-container {
                display: flex;
                align-items: center;
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

        input.form-control::placeholder {
            color: #a1a1aa;
            font-weight: 500;
        }

        /* ใช้ค่า default ของ Bootstrap ไม่ต้องมีลูกเล่น */
        .dropdown-menu {
            display: none;
            /* Bootstrap จะจัดการแสดงผลผ่าน JS */
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
                /* ซ่อนเมนูด้านข้างในจอใหญ่ */
            }
        }

        /* ปรับระยะห่างซ้าย-ขวาของ .dropdown-divider */
        .dropdown-divider {
            margin-left: 1rem;
            margin-right: 1rem;
            border-top: 1px solid #dee2e6;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #fff;
            margin-right: 10px;
        }

        #nprogress .bar {
            background: #f97316 !important;
            /* เปลี่ยนสีตามใจชอบ */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md main-navbar fixed-top">
        <div class="container-fluid">
            <div class="navbar-container">
                <!-- โลโก้ 2 อันด้านหน้า -->
                <div class="logo-container">
                    <img src="/images/rmutl_old.png" alt="Logo 1" class="navbar-logo">
                    <img src="/images/IT Logo.png" alt="Logo 2" class="navbar-logo2">
                </div>
                <!-- ชื่อแบรนด์ -->
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
                        <!-- เมนูวัสดุ -->
                        <li class="navbar-item dropdown">
                            <a class="navbar-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                บริหารจัดการวัสดุ
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('admin.materials.index')}}">ข้อมูลวัสดุ</a>
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
                                <li><a class="dropdown-item" href="#">ออกใบเบิกจ่ายวัสดุ</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.materials.material-report.index') }}">ออกรายงานข้อมูลวัสดุ</a>
                                </li>
                            </ul>
                        </li>
                        <!-- เมนูครุภัณฑ์ -->
                        <li class="navbar-item dropdown">
                            <a class="navbar-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                บริหารจัดการครุภัณฑ์
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="{{route('admin.equipments.index')}}">ข้อมูลครุภัณฑ์</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.equipments.create') }}">เพิ่มครุภัณฑ์</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{route('admin.borrow.requests')}}">อนุมัติการยืม-คืนครุภัณฑ์</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">ออกใบยืม ใบคืนครุภัณฑ์</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.equipments.equipment-report.index') }}">
                                        ออกรายงานครุภัณฑ์
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="navbar-item dropdown">
                            <a class="navbar-link dropdown-toggle user-info" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @php
                                    $user = Auth::user();
                                @endphp
                                <img src="{{ asset('storage/' . $user->profile_image) }}" class="user-avatar shadow-sm">
                                <span class="user-name">
                                    สวัสดีคุณ {{ Auth::user()->name }} {{ Auth::user()->surname }}
                                    ({{ Auth::user()->position ?? 'ผู้ใช้' }})
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
    </nav>
    <div class="container mt-5 mb-5 pb-5">
        <h3 class="mb-4">รายการคำขอเบิกวัสดุ</h3>

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @elseif(session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: '{{ session('error') }}',
                    timer: 2500,
                    showConfirmButton: false
                });
            </script>
        @endif

        @foreach ($requests as $req)
            <div class="card mb-3 shadow">
                <div class="card-body d-flex justify-content-between align-items-center">
                    {{-- ข้อมูลฝั่งซ้าย --}}
                    <div>
                        <p class="mb-1"><strong>👤 ผู้ใช้:</strong> {{ $req->user->name }} {{ $req->user->surname }}</p>
                        <p class="mb-1"><strong>📦 วัสดุ:</strong>
                            @if($req->material)
                                {{ $req->material->name }} — จำนวน {{ $req->quantity }} {{ $req->material->unit }}
                            @else
                                <span class="text-muted">ไม่มีข้อมูลวัสดุ</span>
                            @endif
                        </p>
                        <p class="mb-1">
                            <strong>📅 วันที่ขอ:</strong>
                            @php
                                $date = $req->created_at->timezone('Asia/Bangkok')->locale('th');
                                $dayMonth = $date->translatedFormat('j F');
                                $year_be = $date->year + 543;
                                $time = $date->format('H:i');
                            @endphp
                            {{ $dayMonth . ' ' . $year_be . ' เวลา ' . $time . ' น.' }}
                        </p>
                        <p class="mb-1">
                            <strong>📄 สถานะ:</strong>
                            @if ($req->status === 'pending')
                                <span class="text-warning">รอดำเนินการ</span>
                            @elseif ($req->status === 'approved')
                                <span class="text-success">อนุมัติแล้ว</span>
                            @else
                                <span class="text-danger">ปฏิเสธ</span>
                            @endif
                        </p>
                    </div>

                    {{-- ปุ่มฝั่งขวา --}}
                    <div class="text-end">
                        @if ($req->status === 'pending')
                            <button class="btn btn-success btn-sm mb-1"
                                onclick="confirmApprove({{ $req->id }})">อนุมัติ</button><br>
                            <button class="btn btn-danger btn-sm" onclick="confirmReject({{ $req->id }})">ปฏิเสธ</button>

                            <form id="approve-form-{{ $req->id }}"
                                action="{{ route('admin.material-approvals.approve', $req->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <form id="reject-form-{{ $req->id }}"
                                action="{{ route('admin.material-approvals.reject', $req->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        @elseif ($req->status === 'approved')
                            <a href="{{ route('material-slips.show', $req->id) }}" class="btn btn-primary btn-sm"
                        target="_blank" rel="noopener">ออกใบเบิก</a> @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2568 พัฒนาโดย นายศิวกร จุลศิลป์ สาขาวิชาเทคโนโลยีสารสนเทศ | All Rights Reserved.</p>
    </div>

    <!-- Function Loader -->
    <script>
        // เริ่มแสดงแถบโหลดทันทีเมื่อโหลดหน้า
        NProgress.start();

        // เมื่อโหลดหน้าเสร็จสิ้น ให้รออีกเล็กน้อยก่อนหยุด NProgress
        window.addEventListener('load', function () {
            setTimeout(function () {
                NProgress.done();
            }, 500); // หน่วงเวลา 500 มิลลิวินาที (0.5 วินาที)
        });
    </script>

    <!-- SweetAlert Script -->
    <script>
        function confirmApprove(id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการอนุมัติคำขอนี้ใช่หรือไม่",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'ใช่, อนุมัติ!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approve-form-' + id).submit();
                }
            });
        }

        function confirmReject(id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการปฏิเสธคำขอนี้ใช่หรือไม่",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ใช่, ปฏิเสธ!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reject-form-' + id).submit();
                }
            });
        }
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
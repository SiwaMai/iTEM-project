<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>รายงานครุภัณฑ์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- เปลี่ยนเป็น SweetAlert2 ล่าสุด -->
    <!-- NProgress CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
    <!-- NProgress JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                                <li><a class="dropdown-item" href="{{ route('admin.materials.create') }}">เพิ่มวัสดุ</a></li>
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
                                        href="{{ route('admin.materials.material-report.index') }}">
                                        ออกรายงานข้อมูลวัสดุ
                                    </a>
                                <li>
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
                                    <a class="dropdown-item" href="{{ route('admin.equipments.equipment-report.index') }}">
                                        ออกรายงานครุภัณฑ์
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="navbar-item dropdown">
                            <a class="navbar-link dropdown-toggle user-info" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @php
                                    $user = Auth::guard('admin')->user();
                                @endphp @if($user && $user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" class="user-avatar shadow-sm">
                                @else
                                @endif

                                <span class="user-name">
                                    @if($user)
                                        สวัสดีคุณ {{ $user->name }} {{ $user->surname ?? '' }}
                                        ({{ $user->position ?? 'ผู้ดูแลระบบ' }})
                                    @else
                                    @endif
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

    <div class="container mt-4">
        <h3 class="mt-4" style="text-align: center">รายงานข้อมูลครุภัณฑ์</h3>

        <div class="mb-3">
            <a href="{{ route('admin.equipments.equipment-report-preview') }}" target="_blank" class="btn btn-primary me-2">
                🔍 ดูตัวอย่างรายงาน (PDF)
            </a>
        </div>

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">รหัสครุภัณฑ์</th>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">ประเภท</th>
                    <th scope="col" class="text-end">จำนวน</th>
                    <th scope="col">หน่วยนับ</th>
                    <th scope="col">สถานะ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($equipments as $equipment)
                    <tr>
                        <td>{{ $equipment->code }}</td>
                        <td>{{ $equipment->name }}</td>
                        <td>{{ $equipment->category->name ?? '-' }}</td>
                        <td class="text-end">{{ $equipment->quantity }}</td>
                        <td>{{$equipment->unit}}</td>
                        <td>{{ $equipment->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">ไม่มีข้อมูลครุภัณฑ์</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3 gap-2 mb-3">
            @if ($equipments->onFirstPage() === false)
                <a href="{{ $equipments->previousPageUrl() }}" class="btn btn-outline-primary">ก่อนหน้า</a>
            @endif

            <span class="btn btn-outline-secondary disabled">
                หน้า {{ $equipments->currentPage() }} จาก {{ $equipments->lastPage() }}
            </span>

            @if ($equipments->hasMorePages())
                <a href="{{ $equipments->nextPageUrl() }}" class="btn btn-outline-primary">ถัดไป</a>
            @endif
        </div>
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
    <!-- jQuery dropdown slide effect removed for fade-in/scale-up CSS animation -->

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
<script>
    // Toggle side menu on small screens
    document.addEventListener('DOMContentLoaded', function () {
        var toggler = document.querySelector('.navbar-toggler');
        var sideMenu = document.querySelector('.side-menu');
        if (toggler && sideMenu) {
            toggler.addEventListener('click', function (e) {
                e.preventDefault();
                sideMenu.classList.toggle('show'); // เลื่อนเมนูออกมาและเก็บเมนูกลับ
            });
        }
    });
</script>
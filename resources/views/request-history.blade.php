<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>ประวัติการเบิกวัสดุ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- NProgress CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
    <!-- NProgress JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #f3f4f6;
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
            background: #f12711;
            background: -webkit-linear-gradient(to right, #f5af19, #f12711);
            background: linear-gradient(to right, #f5af19, #f12711);

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

        .navbar-collapse-custom {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width: 100%;
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
            transition: color 0.3s;
        }

        .navbar-link:hover {
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
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            overflow: hidden;
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
            .navbar-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .logo-container {
                justify-content: center;
                width: 100%;
            }

            .navbar-brand-custom {
                font-size: 1.1rem;
                margin-top: 0.5rem;
                margin-left: 0;
            }

            .navbar-collapse-custom {
                justify-content: center;
                margin-top: 1rem;
            }

            .navbar-right {
                flex-direction: column;
                align-items: center;
            }

            .navbar-item {
                margin: 0.5rem 0;
            }

            .user-info {
                flex-direction: column;
            }
        }

        input.form-control::placeholder {
            color: #a1a1aa;
            font-weight: 500;
        }

        /* ปรับระยะห่างซ้าย-ขวาของ .dropdown-divider */
        .dropdown-divider {
            margin-left: 1rem;
            margin-right: 1rem;
            border-top: 1px solid #dee2e6;
        }

        .sticky-top {
            z-index: 1030;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #fff;
            margin-right: 10px;
        }

        #nprogress .bar {
            background: #ffffff !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <nav class="main-navbar sticky-top">
        <div class="navbar-container">
            <!-- โลโก้ 2 อันด้านหน้า -->
            <div class="logo-container">
                <img src="/images/rmutl_old.png" alt="Logo 1" class="navbar-logo">
                <img src="/images/IT Logo.png" alt="Logo 2" class="navbar-logo2">
            </div>

            <!-- ชื่อแบรนด์ -->
            <a class="navbar-brand-custom">ระบบบริหารจัดการวัสดุและการยืม
                คืนครุภัณฑ์ภายในสาขาวิชาเทคโนโลยีสารสนเทศ</a>

            <div class="navbar-collapse-custom">
                <!-- เมนูขวา -->
                <ul class="navbar-right">
                    <li class="navbar-item">
                        <a class="navbar-link" href="{{ route('dashboard') }}">หน้าแรก</a>
                    </li>
                    @php
                        $position = Auth::user()->position;
                    @endphp

                    @if(in_array($position, ['teacher', 'staff']))
                        <li class="navbar-item">
                            <a class="navbar-link" href="{{ route('materials.history') }}">บริหารจัดการวัสดุ</a>
                        </li>
                    @endif
                    <li class="navbar-item">
                        <a class="navbar-link" href="{{ route('borrow.list') }}">การยืม คืนครุภัณฑ์</a>
                    </li>

                    <li class="navbar-item dropdown">
                        <a class="navbar-link dropdown-toggle user-info" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @php
                                $user = Auth::user();
                            @endphp
                            <img src="{{ asset('storage/' . $user->profile_image) }}" class="user-avatar shadow-sm">
                            <span class="user-name">
                                สวัสดีคุณ {{ $user->name }} {{ $user->surname }} ({{ $user->position ?? 'ผู้ใช้' }})
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{route('profile')}}">ข้อมูลส่วนตัว</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('borrow.list') }}">ประวัติการยืมครุภัณฑ์</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @if(in_array($position, ['teacher', 'staff']))
                                <li>
                                    <a class="dropdown-item" href="{{ route('materials.history') }}">ประวัติการเบิกวัสดุ</a>
                                </li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    ออกจากระบบ
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="mb-4">ประวัติการเบิกวัสดุของคุณ</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($materialRequests->isEmpty())
            <div class="alert alert-info">คุณยังไม่มีรายการเบิกวัสดุ</div>
        @else
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>ชื่อวัสดุ</th>
                        <th>จำนวน</th>
                        <th>สถานะ</th>
                        <th>วันที่ขอเบิก</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materialRequests as $req)
                        <tr>
                            <td>{{ $loop->iteration }}</td> 
                            <td>{{ $req->material->name }}</td>
                            <td>{{ $req->quantity }}</td>
                            <td>
                                @if($req->status === 'pending')
                                    <span class="badge bg-warning text-dark">รอดำเนินการ</span>
                                @elseif($req->status === 'approved')
                                    <span class="badge bg-success">อนุมัติแล้ว</span>
                                    <a href="{{ route('material-slips.show', $req->id) }}"
                                        class="btn btn-sm btn-outline-primary ms-2" target="_blank" rel="noopener">
                                        ออกใบเบิก
                                    </a>
                                @else
                                    <span class="badge bg-danger">ปฏิเสธ</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($req->created_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2568 พัฒนาโดย นายศิวกร จุลศิลป์ สาขาวิชาเทคโนโลยีสารสนเทศ | All Rights Reserved.</p>
    </div>

    <!-- Function Loader -->
    <script>
        NProgress.start();
        window.addEventListener('load', function () {
            setTimeout(function () {
                NProgress.done();
            }, 500);
        });
    </script>

    @auth
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
@endauth
</body>

</html>
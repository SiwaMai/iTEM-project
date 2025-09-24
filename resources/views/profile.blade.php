<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">    <title>ข้อมูลส่วนตัว</title>
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
        body {
            text-align: center;
            background-color: #f8f9fa;
            font-family: "Noto Sans Thai", sans-serif;
            padding-top: 100px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            /* เพิ่มความกว้างของฟอร์ม */
            margin-top: 200px;
            /* เพิ่มระยะห่างจากด้านบน */
            margin-bottom: 50px;
            /* เพิ่มระยะห่างด้านล่าง (ถ้าจำเป็น) */
        }

        .footer {
            background-color: #f97316;
            color: white;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .text-orange {
            color: #f97316;
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
            word-break: break-word;
            margin-left: 15px;
            text-align: left;
            /* เพิ่มบรรทัดนี้ */
            flex-grow: 0;
            /* ไม่ให้ขยายเต็มบล็อก */
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

        /* ฟอร์ม */
        #editProfileForm input,
        #editProfileForm select {
            width: 100%;
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
                justify-content: center;
                width: 100%;
            }

            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .col-md-8 {
                width: 100%;
                padding: 1rem;
            }

            .user-avatar {
                width: 100px;
                height: 100px;
            }

            .user-name {
                font-size: 1rem;
            }
        }

        /* ปรับรูปภาพในหน้าจอเล็ก */
        @media (max-width: 768px) {
            .col-md-6 img {
                max-width: 90%;
                height: auto;
                margin-bottom: 1rem;
            }
        }

        .btn-student {
            background-color:
                {{ $bgColor ?? '#28a745' }}
            ;
            border-color:
                {{ $bgColor ?? '#28a745' }}
            ;
            color: #fff;
        }

        .btn-student:hover {
            background-color:
                {{ $hoverColor ?? '#218838' }}
            ;
            border-color:
                {{ $hoverColor ?? '#218838' }}
            ;
            color: #fff;
        }

        .user-avatar {
            width: 35px;
            /* ลดขนาดความกว้าง */
            height: 35px;
            /* ลดขนาดความสูง */
            border-radius: 50%;
            /* ทำให้เป็นวงกลม */
            background-color: #fff;
            /* สีพื้นหลัง */
            margin-right: 10px;
            /* ระยะห่างด้านขวา */
        }

        .rounded-circle {
            object-fit: cover;
            object-position: top;
        }

        #nprogress .bar {
            background: #ffffff !important;
            /* เปลี่ยนสีตามใจชอบ */
        }
    </style>
</head>

<body>
    <nav class="main-navbar fixed-top">
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
                            <li><a class="dropdown-item" href="{{ route('borrow.list') }}">ประวัติการยืมครุภัณฑ์</a></li>
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

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 bg-white shadow-lg rounded-3 p-5">
                <div class="text-start mb-4">
                    <h2 class="fw-bold text-center">ข้อมูลส่วนตัว</h2>
                </div>

                @if (session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger text-center">{{ session('error') }}</div>
                @endif

                <div class="d-flex justify-content-center mb-4">
                    @if ($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" class="rounded-circle shadow"
                            style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-secondary d-flex justify-content-center align-items-center text-white shadow"
                            style="width: 120px; height: 120px;">
                            <i class="bi bi-person-fill fs-1"></i>
                        </div>
                    @endif
                </div>

                <div class="row mb-3">
                    <div class="col-4 text-end fw-bold">ชื่อ:</div>
                    <div class="col-8 text-start">{{ $user->name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 text-end fw-bold">นามสกุล:</div>
                    <div class="col-8 text-start">{{ $user->surname }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 text-end fw-bold">Email:</div>
                    <div class="col-8 text-start">{{ $user->email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 text-end fw-bold">เบอร์โทรศัพท์:</div>
                    <div class="col-8 text-start">{{ $user->phone }}</div>
                </div>
                <div class="row mb-4">
                    <div class="col-4 text-end fw-bold">ตำแหน่ง:</div>
                    <div class="col-8 text-start">
                        {{ $user->position == 'student' ? 'นักศึกษา' : ($user->position == 'teacher' ? 'อาจารย์' : ($user->position == 'staff' ? 'เจ้าหน้าที่' : 'ไม่ทราบ')) }}
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-warning mx-2" id="editProfileBtn">แก้ไขข้อมูล</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary mx-2">ย้อนกลับหน้าแรก</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('editProfileBtn').addEventListener('click', function () {
            Swal.fire({
                title: 'แก้ไขข้อมูลส่วนตัว',
                html: `
                <form id="editProfileForm" method="POST" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <label class="form-label text-start w-100">ชื่อ</label>
                    <input type="text" name="name" class="form-control mb-3" placeholder="ชื่อ" value="{{ $user->name }}" required>
                    
                    <label class="form-label text-start w-100">นามสกุล</label>
                    <input type="text" name="surname" class="form-control mb-3" placeholder="นามสกุล" value="{{ $user->surname }}" required>
                    
                    <label class="form-label text-start w-100">Email</label>
                    <input type="email" name="email" class="form-control mb-3" placeholder="Email" value="{{ $user->email }}" required>
                    
                    <label class="form-label text-start w-100">เบอร์โทรศัพท์</label>
                    <input type="text" name="phone" class="form-control mb-3" placeholder="เบอร์โทรศัพท์" value="{{ $user->phone }}" required>
                    
                    <label class="form-label text-start w-100">ตำแหน่ง</label>
                    <select name="position" class="form-select mb-3" required>
                        <option value="student" {{ $user->position == 'student' ? 'selected' : '' }}>นักศึกษา</option>
                        <option value="teacher" {{ $user->position == 'teacher' ? 'selected' : '' }}>อาจารย์</option>
                        <option value="staff" {{$user->position == 'staff' ? 'selected' : ''}}>เจ้าหน้าที่</option>
                    </select>

                    <label class="form-label text-start w-100">รูปโปรไฟล์ใหม่ (ถ้าต้องการเปลี่ยน)</label>
                    <input type="file" name="profile_image" class="form-control mb-3" accept="image/*">
                </form>
            `,
                showCancelButton: true,
                confirmButtonText: 'บันทึก',
                cancelButtonText: 'ยกเลิก',
                focusConfirm: false,
                preConfirm: () => {
                    document.getElementById('editProfileForm').submit();
                }
            });
        });
    </script>

    </div>
    <div class="footer">
        <p>&copy; 2568 พัฒนาโดย นายศิวกร จุลศิลป์ สาขาวิชาเทคโนโลยีสารสนเทศ | All Rights Reserved.</p>
    </div>

    @if(session('profile_success'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'บันทึกข้อมูลเรียบร้อยแล้ว',
                    text: '{{ session('profile_success') }}',
                    timer: 1800,
                    showConfirmButton: false
                });
            }, 400);
        </script>
    @endif

    @if(session('profile_error'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถบันทึกข้อมูลได้',
                    text: '{{ session('profile_error') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 400);
        </script>
    @endif

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
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>เข้าสู่ระบบ - ผู้ดูแลระบบ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- NProgress CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
    <!-- NProgress JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <style>
        body {
            text-align: center;
            background-color: #f8f9fa;
            font-family: "Noto Sans Thai", sans-serif;
        }

        .container {
            width: 100%;
            max-width: 500px;
            /* ให้ฟอร์มไม่กว้างเกินไป */
            margin: 0 auto;
        }

        .footer {
            background-color: #f97316;
            color: white;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .btn-admin {
            background-color:
                {{ $bgColor }}
            ;
            border-color:
                {{ $bgColor }}
            ;
            color: #fff;
        }

        .btn-admin:hover {
            background-color:
                {{ $hoverColor }}
            ;
            border-color:
                {{ $hoverColor }}
            ;
            color: #fff;
        }

        .h3,
        .h5 {
            color: black;
        }

        .text-orange {
            color: #f97316;
        }

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }

            .col-md-6 {
                width: 100%;
                padding: 1rem;
            }

            .img-fluid {
                max-width: 100%;
                height: auto;
            }

            .footer {
                position: relative;
                bottom: 0;
            }

            .navbar-container {
                flex-direction: column;
                align-items: center;
            }

            .form-control,
            .form-select {
                width: 100%;
            }

            .btn {
                width: 100%;
            }

            .col-md-6 img {
                max-width: 90%;
                height: auto;
                margin-bottom: 1rem;
            }

            .h1 {
                font-size: 1.5rem;
            }

            .text-orange {
                color: #f97316;
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
        }

        #nprogress .bar {
            background: #f97316 !important;
            /* เปลี่ยนสีตามใจชอบ */
        }
    </style>
</head>

<body class="bg-light">
    <div class="d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-75 shadow-lg rounded-3 overflow-hidden">
            <div class="col-md-6 d-flex align-items-center justify-content-center p-5 border-end position-relative">
                <!-- ปุ่มย้อนกลับอยู่ข้างบนด้านซ้ายของรูปภาพ -->
                <a href="/index" class="btn btn-secondary position-absolute top-0 start-0 m-3"
                    style="background-color: {{ $bgColor }}; border-color: {{ $bgColor }};">
                    <i class="bi bi-arrow-left"></i> ย้อนกลับหน้าแรก
                </a>
                <img src="/images/material.png" alt="Graphic Image" class="img-fluid"
                    style="max-width: 75%; max-height: 90%; object-fit: cover;">
            </div>
            <div
                class="col-md-6 bg-{{ $bgColor }} text-white p-5 d-flex flex-column justify-content-center align-items-center">
                <div class="mb-4 text-center">
                    <img src="/images/{{ $icon }}" alt="Icon" class="img-fluid w-25 mb-3">
                    <h1 class="h3">ลงชื่อเข้าใช้ระบบ</h1>
                    <p class="h5">{{ $userType }}</p>
                </div>
                <form action="{{ route('admin.login.submit') }}" method="POST" class="w-100 max-w-sm container">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="username" placeholder="Username" class="form-control p-3"
                            value="{{ old('username') }}">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" placeholder="Password" class="form-control p-3">
                    </div>
                    <button type="submit" class="btn btn-admin font-weight-bold">
                        เข้าสู่ระบบ <i class="bi bi-box-arrow-in-right"></i>
                    </button>

                </form>

            </div>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2568 พัฒนาโดย นายศิวกร จุลศิลป์ สาขาวิชาเทคโนโลยีสารสนเทศ | All Rights Reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert แจ้งเตือน -->
    @if(session('login_error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ session('login_error')['title'] }}',
                text: '{{ session('login_error')['text'] }}',
                confirmButtonText: 'ลองใหม่อีกครั้ง'
            });
        </script>
    @endif

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

</html>
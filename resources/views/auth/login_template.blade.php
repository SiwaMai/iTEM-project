<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>เข้าสู่ระบบ :: {{ $userType }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        .footer {
            background-color: #f97316;
            color: white;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        /* ปรับสีพื้นฐาน */
        .btn-student {
            background-color: {{ $bgColor }};
            border-color: {{ $bgColor }};
            color: #fff;
        }

        .btn-student:hover {
            background-color: {{ $hoverColor }};
            border-color: {{ $hoverColor }};
            color: #fff;
        }

        .h3, .h5 {
            color: black;
        }
        .text-orange {
             color: #f97316; /* สีส้ม */
        }
        #nprogress .bar {
    background: #f97316 !important; /* เปลี่ยนสีตามใจชอบ */
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
            <div class="col-md-6 bg-{{ $bgColor }} text-white p-5 d-flex flex-column justify-content-center align-items-center">
                <div class="mb-4 text-center">
                    <img src="{{asset('images/' .$icon)}}" alt="Icon" class="img-fluid w-25 mb-3">
                    <h1 class="h3">ลงชื่อเข้าใช้ระบบ</h1>
                    <p class="h5">{{ $userType }}</p>
                </div>
                <form action="{{ $userType === 'บุคลากร' ? route('login.staff.submit') : route('login.student.submit') }}" method="POST" class="w-100 max-w-sm">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="username" placeholder="Username" class="form-control p-3">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" placeholder="Password" class="form-control p-3">
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: {{ $bgColor }};">เข้าสู่ระบบ</button><i class="bi bi-box-arrow-in-right"></i>
                    <div class="mt-3 text-center">
                        <a href="{{ route('password.reset.form') }}"
                            class="text-decoration-underline"
                            style="color: #f97316; font-size: 0.9rem;">ลืมรหัสผ่าน?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2568 พัฒนาโดย นายศิวกร จุลศิลป์ สาขาวิชาเทคโนโลยีสารสนเทศ |  All Rights Reserved. </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert แจ้งเตือน -->
@if($errors->has('username'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'เข้าสู่ระบบไม่สำเร็จ',
            text: @json($errors->first('username')),
            timer: 2000, // แสดง 3 วินาที
            showConfirmButton: false
        });
    </script>
@endif
    

<!-- Function Loader -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(() => {
            NProgress.start();
        }, 100); 
    });
    window.addEventListener('load', function () {
        setTimeout(() => {
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
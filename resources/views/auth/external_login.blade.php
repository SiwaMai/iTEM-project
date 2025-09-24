<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>เข้าสู่ระบบ :: บุคคลภายนอก</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- NProgress CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />

    <!-- SweetAlert CSS (optional, for consistent styling) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .h3, .h5 { color: black; }

        #nprogress .bar {
            background: #f97316 !important; /* สีส้ม */
        }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-75 shadow-lg rounded-3 overflow-hidden">
            <!-- ด้านซ้าย -->
            <div class="col-md-6 d-flex align-items-center justify-content-center p-5 border-end position-relative">
                <a href="/index" class="btn btn-secondary position-absolute top-0 start-0 m-3" style="background-color: #f97316; border-color: #f97316;">
                    <i class="bi bi-arrow-left"></i> ย้อนกลับหน้าแรก
                </a>
                <img src="/images/material.png" alt="Graphic Image" class="img-fluid" style="max-width: 75%; max-height: 90%; object-fit: cover;">
            </div>

            <!-- ด้านขวา -->
            <div class="col-md-6 text-white p-5 d-flex flex-column justify-content-center align-items-center"
     style="background-color: #fff3e0;">
                <div class="mb-4 text-center">
                    <img src="{{ asset('images/group.png') }}" alt="Icon" class="img-fluid w-25 mb-3">
                    <h1 class="h3">เข้าสู่ระบบ</h1>
                    <p class="h5">บุคคลภายนอก</p>
                </div>

                <!-- Form login minimal -->
                <form action="{{ route('external.login') }}" method="POST" class="w-100 max-w-sm">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" placeholder="ชื่อ-นามสกุล" class="form-control p-3" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="phone" placeholder="เบอร์โทร" class="form-control p-3" required>
                    </div>
                    <button type="submit" class="btn btn-success font-weight-bold">
                        เข้าสู่ระบบ <i class="bi bi-box-arrow-in-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2568 พัฒนาโดย นายศิวกร จุลศิลป์ สาขาวิชาเทคโนโลยีสารสนเทศ | All Rights Reserved.</p>
    </div>

    <!-- NProgress JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

    <script>
        // Loader เริ่มตอน DOM พร้อม
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(() => { NProgress.start(); }, 100); 
        });

        // Loader เสร็จเมื่อโหลดหน้าเสร็จ
        window.addEventListener('load', function () {
            setTimeout(() => { NProgress.done(); }, 500); 
        });
    </script>

    <!-- SweetAlert Success -->
    @if(session('register_success') && session('sweetalert'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ session('register_success') }}',
            showConfirmButton: false,
            timer: 2000
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
</html>
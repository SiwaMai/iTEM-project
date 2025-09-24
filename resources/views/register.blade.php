<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>สมัครสมาชิก ::</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .text-orange {
            color: #f97316;
        }

        @media (max-width: 768px) {
            .row {
                width: 90%;
                /* ปรับขนาดให้เหมาะสมกับจอเล็ก */
                margin: 0 auto;
            }

            .col-12 {
                width: 100%;
                padding: 1rem;
            }

            .form-control,
            .form-select,
            .btn {
                width: 100%;
                padding: 1rem;
            }

            .footer {
                font-size: 0.8rem;
                padding: 5px 0;
            }
        }
        #nprogress .bar {
    background: #f97316 !important; /* เปลี่ยนสีตามใจชอบ */
}
    </style>
</head>

<body>
    <div class="d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-50 shadow-lg rounded-3 overflow-hidden">
            <div class="col-12 bg-white p-5 d-flex flex-column justify-content-center align-items-center mb-5">
                <div class="mb-4 text-center">
                    <img src="/images/memo.png" alt="Icon" class="img-fluid w-25 mb-3">
                    <h1 class="h3">สมัครสมาชิก</h1>
                </div>

                <!-- แสดงข้อความ error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="w-100">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control p-3" placeholder="ชื่อ"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="surname" class="form-control p-3" placeholder="นามสกุล"
                            value="{{ old('surname') }}" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control p-3" placeholder="Email"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="phone" class="form-control p-3" placeholder="เบอร์โทรศัพท์"
                            value="{{ old('phone') }}" required>
                    </div>
                    <div class="mb-3">
                        <select name="position" class="form-select p-3" required>
                            <option value="" disabled selected>ตำแหน่ง</option>
                            <option value="student" {{ old('position') == 'student' ? 'selected' : '' }}>นักศึกษา</option>
                            <option value="teacher" {{ old('position') == 'teacher' ? 'selected' : '' }}>อาจารย์</option>
                            <option value="staff" {{ old('position') == 'staff' ? 'selected' : '' }}>บุคลากร</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">อัปโหลดรูปภาพโปรไฟล์ (ไม่บังคับ)</label>
                        <input type="file" name="profile_image" class="form-control p-3" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control p-3" placeholder="Username"
                            value="{{ old('username') }}" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control p-3" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password_confirmation" class="form-control p-3"
                            placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="btn  fw-bold"
                        style="background-color: #f97316; color: white;">
                        ลงทะเบียน <i class="bi bi-person-plus-fill ms-1"></i>
                    </button>
                    <a href="/index" class="text-decoration-none">
                        <button type="button" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> ย้อนกลับหน้าแรก
                        </button>
                    </a>
                </form>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2568 พัฒนาโดย นายศิวกร จุลศิลป์ สาขาวิชาเทคโนโลยีสารสนเทศ | All Rights Reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
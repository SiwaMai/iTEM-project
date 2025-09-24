<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>รีเซ็ตรหัสผ่าน</title>
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
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
            font-family: "Noto Sans Thai", sans-serif;
            text-align: center;
        }

        .container {
            width: 100%;
            max-width: 500px; /* ให้ฟอร์มไม่กว้างเกินไป */
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .btn-student {
            background-color: {{ $bgColor ?? '#007bff' }};
            border-color: {{ $bgColor ?? '#007bff' }};
            color: #fff;
        }

        .btn-student:hover {
            background-color: {{ $hoverColor ?? '#0056b3' }};
            border-color: {{ $hoverColor ?? '#0056b3' }};
            color: #fff;
        }

        .form-container {
            width: 100%;
            max-width: 500px;
            margin: auto;
            background-color: #ffffff;
            color: #212529;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            .form-container {
                width: 100%;
                max-width: 90%; /* ลดความกว้างฟอร์ม */
                padding: 1rem;
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

            .footer {
                padding: 1rem 0;
                font-size: 0.8rem;
            }

            /* ปรับรูปภาพในหน้าจอเล็ก */
            .col-md-6 img {
                max-width: 90%;
                height: auto;
                margin-bottom: 1rem;
            }
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
        #nprogress .bar {
    background: #f97316 !important; /* เปลี่ยนสีตามใจชอบ */
}
    </style>
</head>

<body class="bg-light">
    <div class="form-container shadow-lg rounded-3 p-5 container">
        <div class="mb-4 text-center">
            <img src="/images/reset-password.png" alt="Icon" class="img-fluid w-25 mb-3">
            <h1 class="h3">เปลี่ยนรหัสผ่าน</h1>
            <p class="h5">กรุณากรอกข้อมูลด้านล่างเพื่อเปลี่ยนรหัสผ่าน</p>
        </div>

        {{-- แสดงข้อความสถานะ หากมี --}}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        {{-- แสดงข้อความ error หากมี --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.reset') }}" method="POST">
            @csrf
            {{-- Username --}}
            <div class="mb-3">
                <input type="text" name="username" placeholder="Username" class="form-control p-3"
                    value="{{ old('username') }}" required>
                @error('username')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- New Password --}}
            <div class="mb-3">
                <input type="password" name="password" placeholder="รหัสผ่านใหม่" class="form-control p-3" required>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-3">
                <input type="password" name="password_confirmation" placeholder="ยืนยันรหัสผ่านใหม่"
                    class="form-control p-3" required>
                @error('password_confirmation')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-student w-100 p-3 fw-bold">
                เปลี่ยนรหัสผ่าน <i class="bi bi-box-arrow-in-right"></i>
            </button>
        </form>

        {{-- ป้องกัน error จาก $userType ที่ไม่มีค่า --}}
        @php
            $typeMap = [
                'นักศึกษา' => 'student',
                'อาจารย์' => 'teacher',
            ];

            $typeKey = isset($userType) && is_string($userType) ? ($typeMap[$userType] ?? 'student') : 'student';
            $loginRoute = route('login.' . $typeKey);
        @endphp

        <a href="{{ $loginRoute }}" class="btn btn-secondary w-100 mt-3">
            กลับไปที่หน้าเข้าสู่ระบบ
        </a>
    </div>

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
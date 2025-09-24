<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>ระบบบริหารจัดการวัสดุและการยืม คืนครุภัณฑ์ภายในสาขาวิชาเทคโนโลยีสารสนเทศ :: index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
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

        .card {
            border-radius: 10px;
            transition: 0.3s;
        }

        .card:hover {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .footer {
            background-color: #f97316;
            color: white;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            margin-right: 15px;
        }

        .logo_rmutl {
            width: 130px;
            height: 130px;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .logo_it {
            width: 110px;
            height: 110px;
            object-fit: contain;
            margin-left: -30px;
            margin-bottom: -10px;
        }

        .text-orange {
            color: #f97316;
        }

        /* ปรับระยะห่างของหัวข้อและคำอธิบาย */
        h2.fw-bold {
            margin-bottom: 20px;
        }

        .container p:nth-of-type(1) {
            margin-bottom: 40px;
        }

        .row.mt-4 {
            margin-bottom: 20px;
        }

        p.mt-4 {
            margin-bottom: 10px;
        }

        /* สไตล์สำหรับส่วนข้อมูลติดต่อ */
        .contact-section {
            margin-top: 60px;
            margin-bottom: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            font-size: 14px;
            color: #333;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding-right: 20px;
            border-right: 1px solid #ccc;
        }

        .contact-item:last-child {
            border-right: none;
            padding-right: 0;
        }

        .contact-item a {
            color: #333;
            text-decoration: none;
        }

        .contact-item a:hover {
            text-decoration: underline;
        }

        /* ปรับแต่งไอคอนในปุ่มเข้าสู่ระบบ */
        .btn i {
            margin-left: 5px;
            font-size: 14px;
        }

        /* ปรับสีปุ่มเมื่อ hover ตามสีวงกลมของแต่ละ user */
        .btn-student:hover {
            background-color: #28a745;
            /* สีเขียวสำหรับนักศึกษา */
            border-color: #28a745;
            color: #fff;
        }

        .btn-student:hover i {
            color: #fff;
        }

        .btn-staff:hover {
            background-color: #007bff;
            /* สีน้ำเงินสำหรับบุคลากร */
            border-color: #007bff;
            color: #fff;
        }

        .btn-staff:hover i {
            color: #fff;
        }

        .btn-admin:hover {
            background-color: #6c757d;
            /* สีเลือดหมูสำหรับบุคคลภายนอก */
            border-color: #6c757d;
            color: #fff;
        }

        .btn-admin:hover i {
            color: #fff;
        }

        #nprogress .bar {
            background: #f97316 !important;
            /* เปลี่ยนสีตามใจชอบ */
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="logo-container">
            <img src="/images/rmutl_old.png" alt="โลโก้มหาวิทยาลัย" class="logo_rmutl">
            <img src="/images/IT Logo.png" alt="โลโก้สาขา" class="logo_it">
        </div>
        <h1 class="fw-bold">ระบบบริหารจัดการวัสดุ</h1>
        <p style="margin-top: -1px;">และการยืม คืนครุภัณฑ์ภายในสาขาวิชาเทคโนโลยีสารสนเทศ</p>

        <div class="row mt-4 justify-content-center">
            <div class="col-md-3">
                <div class="card p-4">
                    <img src="/images/students.png" class="mx-auto d-block" width="60" height="60">
                    <h5 class="mt-3">นักศึกษา</h5>
                    <a href="{{ route('login.student') }}" class="btn btn-outline-secondary btn-student">
                        เข้าสู่ระบบ <i class="bi bi-box-arrow-in-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4">
                    <img src="/images/team.png" class="mx-auto d-block" width="60" height="60">
                    <h5 class="mt-3">บุคลากร</h5>
                    <a href="{{ route('login.staff') }}" class="btn btn-outline-secondary btn-staff">
                        เข้าสู่ระบบ <i class="bi bi-box-arrow-in-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4">
                    <img src="/images/ad.png" class="mx-auto d-block" width="60" height="60">
                    <h5 class="mt-3">ผู้ดูแลระบบ</h5>
                    <a href="{{route('admin.login')}}" class="btn btn-outline-secondary btn-admin">
                        เข้าสู่ระบบ <i class="bi bi-box-arrow-in-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="d-inline mt-4">
            <p class="d-inline me-4">
                หากไม่มีข้อมูลผู้ใช้
                <a href="{{ route('register') }}" class="text-orange fw-bold">สมัครได้ที่นี่</a>
            </p>
            <!--
            <p class="d-inline me-4">
                บุคคลภายนอก
                <a href="{{ route('external.login') }}" class="text-orange fw-bold">เข้าสู่ระบบได้ที่นี่</a>
            </p>
        -->
            <p class="d-inline">
                พบปัญหาการใช้งาน
                <a href="https://www.facebook.com/Pemai.siwakorn" class="text-orange fw-bold"
                    target="_blank">ติดต่อได้ที่นี่</a>
            </p>
        </div>
        <!-- เพิ่มส่วนข้อมูลติดต่อ -->
        <div class="contact-section">
            <div class="contact-item">
                <i class="bi bi-facebook"></i>
                <a href="https://www.facebook.com/iT.RMUTLT" target="_blank">เทคโนโลยีสารสนเทศ มทร.ล้านนา ตาก</a>
            </div>
            <div class="contact-item">
                <i class="bi bi-telephone-fill"></i>
                <a href="tel:053921444">055 515 900</a>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2568 พัฒนาโดย นายศิวกร จุลศิลป์ สาขาวิชาเทคโนโลยีสารสนเทศ | All Rights Reserved. </p>
    </div>


    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('logout_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'ออกจากระบบสำเร็จ!',
                text: '{{ session('logout_success') }}',
                confirmButtonColor: '#f97316'
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
</body>

</html>
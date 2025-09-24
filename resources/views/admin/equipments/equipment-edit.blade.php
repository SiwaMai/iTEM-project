<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>ข้อมูลครุภัณฑ์</title>
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

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #fff;
            margin-right: 10px;
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

        #nprogress .bar {
            background: #f97316 !important;
            /* เปลี่ยนสีตามใจชอบ */
        }

        /* รูปภาพโปรไฟล์ */
        .user-avatar {
            width: 35px;
            /* ขนาดตามต้องการ */
            height: 35px;
            /* ต้องเท่ากับ width เพื่อให้เป็นวงกลม */
            object-fit: cover;
            /* ป้องกันภาพยืด */
            border-radius: 50%;
            /* ทำให้เป็นวงกลม */
            overflow: hidden;
            /* กันภาพล้นขอบ */
            object-position: top;
        }

        /* ปรับ container ให้ยาวขึ้น */
        .container {
            max-width: 1400px;
            /* จาก 1000px เพิ่มเป็น 1400px */
            margin: 0 auto;
        }

        table {
            table-layout: fixed;
            width: 100%;
            word-wrap: break-word;
        }

        /* กำหนดความกว้างของคอลัมน์ */
        table th,
        table td {
            padding: 8px 12px;
            vertical-align: middle;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* คอลัมน์: checkbox */
        table th:nth-child(1),
        table td:nth-child(1) {
            width: 50px;
        }

        /* คอลัมน์: ลำดับ */
        table th:nth-child(2),
        table td:nth-child(2) {
            width: 80px;
        }

        /* รหัสครุภัณฑ์ */
        table th:nth-child(3),
        table td:nth-child(3) {
            width: 180px;
        }

        /* ชื่อครุภัณฑ์ */
        table th:nth-child(4),
        table td:nth-child(4) {
            width: 220px;
        }

        /* ประเภทครุภัณฑ์ */
        table th:nth-child(5),
        table td:nth-child(5) {
            width: 150px;
        }

        /* จำนวน */
        table th:nth-child(6),
        table td:nth-child(6) {
            width: 100px;
        }

        /* สถานะ */
        table th:nth-child(7),
        table td:nth-child(7) {
            width: 140px;
        }

        /* รูปภาพ */
        table th:nth-child(8),
        table td:nth-child(8) {
            width: 160px;
        }

        /* รูปภาพภายในเซลล์ */
        table td img {
            max-width: 100px;
            max-height: 70px;
            object-fit: contain;
        }

        /* ปรับความสูงและ padding ให้สั้นลง */
        input.form-control,
        select.form-control {
            height: 35px;
            /* ลดความสูง */
            padding: 4px 8px;
            /* ปรับ padding ให้พอดี */
            font-size: 14px;
            /* ปรับขนาดฟอนต์ด้วย (ถ้าต้องการ) */
            width: 100;
        }

        /* ปรับ label ให้ตัวเล็กลงนิดหน่อยด้วย */
        label {
            font-size: 14px;
            font-weight: 600;
        }

        /* สไตล์สำหรับ fade-in */
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.5s ease-in-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
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
                                        href="{{ route('admin.materials.material-report.index') }}">
                                        ออกรายงานข้อมูลวัสดุ
                                    </a></li>
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
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    ออกจากระบบ
                                </a>
                        </ul>
                        < </ul>
                </div>
            </div>
        </div>
    </nav>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">แก้ไขข้อมูลครุภัณฑ์</h2>
            <div class="container">
                <form id="equipmentForm"
                      action="{{ route('admin.equipments.update', $equipment->id) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    {{-- ❌ ไม่ต้องใช้ @method('PUT') เพราะใช้ fetch() จัดการแล้ว --}}

                    <div class="mb-3">
                        <label for="code">รหัสครุภัณฑ์</label>
                        <input type="text" name="code" id="code" class="form-control"
                               value="{{ old('code', $equipment->code) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="name">ชื่อครุภัณฑ์</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ old('name', $equipment->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="category_id">ประเภท</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="" disabled>-- กรุณาเลือกประเภท --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $equipment->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity">จำนวน</label>
                        <input type="number" name="quantity" id="quantity" class="form-control"
                               value="{{ old('quantity', $equipment->quantity) }}" required min="1">
                    </div>

                    <div class="mb-3">
                        <label for="status">สถานะ</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="" disabled>-- กรุณาเลือกสถานะ --</option>
                            @foreach(['พร้อมใช้งาน', 'กำลังยืม', 'ชำรุด'] as $status)
                                <option value="{{ $status }}"
                                    {{ old('status', $equipment->status) == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="unit">หน่วยนับ</label>
                        <select name="unit" id="unit" class="form-control" required>
                            <option value="" disabled>-- กรุณาเลือกหน่วยนับ --</option>
                            @foreach(['อัน', 'ตัว', 'เครื่อง', 'แพ็ค', 'ชิ้น', 'กล่อง'] as $unit)
                                <option value="{{ $unit }}"
                                    {{ old('unit', $equipment->unit) == $unit ? 'selected' : '' }}>
                                    {{ $unit }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="location">ที่จัดเก็บ</label>
                        <input type="text" name="location" id="location" class="form-control"
                               value="{{ old('location', $equipment->location) }}">
                    </div>

                    <div class="mb-3">
                        <label for="image">รูปภาพ</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @if($equipment->image)
                            <img src="{{ asset('storage/' . $equipment->image) }}" alt="รูปครุภัณฑ์" class="mt-2" width="120">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <a href="{{ route('admin.equipments.index') }}" class="btn btn-secondary">ยกเลิก</a>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const equipmentForm = document.getElementById('equipmentForm');

    equipmentForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(equipmentForm);
        formData.append('_method', 'PUT'); // ✅ Laravel จะเข้า route update ได้

        console.log([...formData.entries()]); // ✅ debug

        fetch(equipmentForm.action, {
            method: 'POST', // ✅ ใช้ POST จริง
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(async response => {
            const contentType = response.headers.get("content-type");
            if (contentType && contentType.includes("application/json")) {
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || 'เกิดข้อผิดพลาดจากเซิร์ฟเวอร์');
                return data;
            } else {
                const text = await response.text(); // ✅ fallback
                throw new Error('เซิร์ฟเวอร์ส่งกลับข้อมูลที่ไม่ใช่ JSON:\n' + text);
            }
        })
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ!',
                    text: data.message,
                    confirmButtonText: 'ตกลง'
                }).then(() => {
                    window.location.href = "{{ route('admin.equipments.index') }}";
                });
            } else {
                throw new Error(data.message || 'ไม่สามารถบันทึกข้อมูลได้');
            }
        })
        .catch(error => {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: error.message,
                confirmButtonText: 'ตกลง'
            });
        });
    });
});
</script>


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
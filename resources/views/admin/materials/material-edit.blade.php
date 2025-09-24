<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>ข้อมูลวัสดุ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <!-- NProgress CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
    <!-- NProgress JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- เปลี่ยนเป็น SweetAlert2 ล่าสุด -->
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
            width: 70px;
        }

        /* สถานะ */
        table th:nth-child(7),
        table td:nth-child(7) {
            width: 100px;
        }

        /* รูปภาพ */
        table th:nth-child(8),
        table td:nth-child(8) {
            width: 110px;
        }

        /* รูปภาพภายในเซลล์ */
        table td img {
            max-width: 100px;
            max-height: 70px;
            object-fit: contain;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                <a class="dropdown-item" href="{{ route('admin.materials.material-report.index') }}">
                                    ออกรายงานข้อมูลวัสดุ
                                </a>
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
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">แก้ไขข้อมูลวัสดุ</h2>
                <div class="container">
                    <form id="materialForm" action="{{ route('admin.materials.update', $material->id) }}" method="POST"
                        enctype="multipart/form-data" class="shadow-sm p-4 bg-white rounded">
                        @csrf

                        <div class="mb-3">
                            <label for="material_code">รหัสวัสดุ (Barcode)</label>
                            <input type="text" name="material_code" id="material_code" class="form-control"
                                value="{{ old('material_code', $material->material_code) }}"
                                placeholder="ยิงบาร์โค้ดหรือกรอกเอง">
                        </div>

                        <div class="mb-3">
                            <label for="name">ชื่อวัสดุ</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $material->name) }}">
                        </div>

                        <div class="mb-3">
                            <label for="category_id">ประเภท</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $material->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantity">จำนวน</label>
                            <div class="d-flex gap-2">
                                <input type="number" name="quantity" id="quantity" class="form-control"
                                    value="{{ old('quantity', $material->quantity) }}" min="1" readonly>
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#addQuantityModal">
                                    เพิ่มจำนวน
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status">สถานะ</label>
                            <input type="text" name="status" id="status" class="form-control"
                                value="{{ old('status', $material->status) }}">
                        </div>

                        <div class="mb-3">
                            <label for="unit">หน่วยนับ</label>
                            <div class="d-flex gap-2">
                                <input type="text" id="unitDisplay" class="form-control"
                                    value="{{ old('unit', $material->unit) }}" readonly disabled>
                                <button type="button" class="btn btn-outline-secondary" disabled>
                                    เลือกหน่วยนับ
                                </button>
                            </div>
                            <input type="hidden" name="unit" id="unit" value="{{ old('unit', $material->unit) }}">
                        </div>

                        <div class="mb-3">
                            <label for="location">สถานที่จัดเก็บ</label>
                            <input type="text" name="location" id="location" class="form-control"
                                value="{{ old('location', $material->location) }}">
                        </div>

                        <div class="mb-3">
                            <label for="image">รูปภาพ</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            @if($material->image)
                                <img src="{{ asset('storage/' . $material->image) }}" alt="รูปวัสดุ" width="100"
                                    class="mt-2">
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="bi bi-save"></i> บันทึกข้อมูล
                            </button>
                            <a href="{{ route('admin.materials.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> ยกเลิก
                            </a>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal เพิ่มจำนวณครุภัณฑ์ -->
    <div class="modal fade" id="addQuantityModal" tabindex="-1" aria-labelledby="addQuantityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="addQuantityForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuantityModalLabel">เพิ่มจำนวนวัสดุ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                </div>
                <div class="modal-body">
                    <p>จำนวนปัจจุบัน: <strong id="currentQuantity">{{ $material->quantity }}</strong>
                        {{$material->unit}}</p>
                    <div class="mb-3">
                        <label for="addAmount">จำนวนที่ต้องการเพิ่ม</label>
                        <input type="number" id="addAmount" class="form-control" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">เพิ่มจำนวน</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal เพิ่มจำนวณครุภัณฑ์ -->
    <div class="modal fade" id="unitModal" tabindex="-1" aria-labelledby="unitModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="unitModalLabel">เลือกหน่วยนับ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                </div>
                <div class="modal-body">
                    <div class="d-grid gap-2">
                        @foreach(['อัน', 'ชิ้น', 'กล่อง', 'แพ็ค'] as $unitOption)
                            <button type="button" class="btn btn-outline-primary" onclick="selectUnit('{{ $unitOption }}')">
                                {{ $unitOption }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const materialForm = document.getElementById('materialForm');
            if (!materialForm) return console.error('ไม่พบฟอร์ม materialForm');

            materialForm.addEventListener('submit', function (event) {
                event.preventDefault();

                const actionUrl = materialForm.action;
                const formData = new FormData(materialForm);
                formData.append('_method', 'PUT'); // ✅ Laravel จะเข้า route update ได้

                console.log([...formData.entries()]); // ✅ debug

                fetch(actionUrl, {
                    method: 'POST', // ✅ ใช้ POST จริง
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData,
                })
                    .then(async response => {
                        const contentType = response.headers.get("content-type");
                        if (contentType && contentType.includes("application/json")) {
                            const data = await response.json();
                            if (!response.ok) throw new Error(data.message || 'เกิดข้อผิดพลาดจากเซิร์ฟเวอร์');
                            return data;
                        } else {
                            throw new Error('ไม่สามารถประมวลผลการตอบกลับจากเซิร์ฟเวอร์ได้');
                        }
                    })
                    .then(data => {
                        if (data.success) {
                            let icon = 'success';
                            let title = 'สำเร็จ!';
                            let text = data.message;

                            if (data.mode === 'merged') {
                                icon = 'info';
                                title = 'รวมวัสดุแล้ว';
                                text = 'มีวัสดุประเภทเดียวกันอยู่แล้ว ระบบได้รวมจำนวนให้เรียบร้อย';
                            }

                            Swal.fire({ icon, title, text, confirmButtonText: 'ตกลง' })
                                .then(() => window.location.href = "{{ route('admin.materials.index') }}");
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById("id");

            input.addEventListener("input", function (e) {
                let value = input.value.replace(/\D/g, ''); // ลบทุกอย่างที่ไม่ใช่ตัวเลข
                if (value.length > 7) value = value.slice(0, 7); // จำกัด 7 ตัวเลข

                // เติมขีดอัตโนมัติ
                let formatted = '';
                if (value.length > 0) formatted += value.substring(0, 2);
                if (value.length >= 3) formatted += '-' + value.substring(2, 4);
                if (value.length >= 5) formatted += '-' + value.substring(4, 7);

                input.value = formatted;
            });
        });
    </script>

    <script>
        document.getElementById('addQuantityForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const current = parseInt(document.getElementById('currentQuantity').textContent);
            const added = parseInt(document.getElementById('addAmount').value);
            if (!isNaN(added) && added > 0) {
                const newTotal = current + added;
                document.getElementById('quantity').value = newTotal;
                document.getElementById('currentQuantity').textContent = newTotal;

                // ✅ ปลดล็อก input ทั้งหมด
                const form = document.getElementById('materialForm');
                form.querySelectorAll('input, select, textarea').forEach(el => {
                    el.removeAttribute('readonly');
                    el.removeAttribute('disabled');
                });

                // ✅ เปิดปุ่ม submit
                document.getElementById('submitBtn').disabled = false;

                // ✅ ปิด modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('addQuantityModal'));
                modal.hide();


                const unit = document.getElementById('unit').value || document.getElementById('unitDisplay').value;

                // ✅ SweetAlert แจ้งผล
                Swal.fire({
                    icon: 'success',
                    title: 'เพิ่มจำนวนสำเร็จ',
                    text: `จำนวนใหม่คือ ${newTotal} ${unit}`,
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    </script>

    <script>
        function selectUnit(unit) {
            document.getElementById('unitDisplay').value = unit;
            document.getElementById('unit').value = unit;

            const modal = bootstrap.Modal.getInstance(document.getElementById('unitModal'));
            modal.hide();

            // ✅ SweetAlert แจ้งผล
            Swal.fire({
                icon: 'success',
                title: 'เลือกหน่วยนับสำเร็จ',
                text: `คุณเลือก "${unit}" เป็นหน่วยนับ`,
                timer: 2000,
                showConfirmButton: false
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('materialForm');
            const submitBtn = document.getElementById('submitBtn');

            // ✅ ตรวจจับการแก้ไขช่องใดช่องหนึ่ง
            form.querySelectorAll('input, select, textarea').forEach(el => {
                el.addEventListener('input', unlockSubmit);
                el.addEventListener('change', unlockSubmit);
            });

            function unlockSubmit() {
                submitBtn.disabled = false;
            }
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
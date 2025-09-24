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

        .pagination .page-link {
            border-radius: 6px;
            margin: 0 2px;
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
                                    </a>
                                <li>
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
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">ข้อมูลครุภัณฑ์</h2>

                <!-- 🔍 แถบค้นหาแบบสั้นลง -->
                <form method="GET" action="{{ route('admin.equipments.index') }}"
                    class="mb-4 d-flex justify-content-center">
                    <div class="input-group shadow-sm" style="max-width: 500px; width: 100%;">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="keyword" class="form-control border-start-0"
                            placeholder="ค้นหาครุภัณฑ์..." value="{{ request('keyword') }}">
                        @if(request('keyword'))
                            <a href="{{ route('admin.equipments.index') }}" class="btn btn-outline-secondary">ล้าง</a>
                        @endif
                    </div>
                </form>

                <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
                    <a href="{{ route('admin.equipments.index') }}"
                        class="btn {{ request('status') ? 'btn-outline-secondary' : 'btn-secondary' }}">
                        ทั้งหมด ({{ $totalCount }})
                    </a>

                    <a href="{{ route('admin.equipments.index', ['status' => 'พร้อมใช้งาน']) }}"
                        class="btn {{ request('status') == 'พร้อมใช้งาน' ? 'btn-success' : 'btn-outline-success' }}">
                        พร้อมใช้งาน ({{ $statusSummary['พร้อมใช้งาน'] ?? 0 }})
                    </a>

                    <a href="{{ route('admin.equipments.index', ['status' => 'กำลังยืม']) }}"
                        class="btn {{ request('status') == 'กำลังยืม' ? 'btn-warning text-dark' : 'btn-outline-warning' }}">
                        กำลังยืม ({{ $statusSummary['กำลังยืม'] ?? 0 }})
                    </a>

                    <a href="{{ route('admin.equipments.index', ['status' => 'ชำรุด']) }}"
                        class="btn {{ request('status') == 'ชำรุด' ? 'btn-danger' : 'btn-outline-danger' }}">
                        ชำรุด ({{ $statusSummary['ชำรุด'] ?? 0 }})
                    </a>
                </div>

                <!-- ตารางข้อมูล -->
                <div id="equipment-table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th><input type="checkbox" id="selectAll"></th>
                                <th style="width: 5%">ลำดับ</th>
                                <th>รหัสครุภัณฑ์</th>
                                <th>ชื่อครุภัณฑ์</th>
                                <th>ประเภทครุภัณฑ์</th>
                                <th style="width: 5%">จำนวน</th>
                                <th style="width: 8%">สถานะ</th>
                                <th style="width: 8%">หน่วยนับ</th>
                                <th>สถานที่จัดเก็บครุภัณฑ์</th>
                                <th>รูปภาพ</th>
                                <th>การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($equipments as $equipment)
                                <tr>
                                    <td><input type="checkbox" class="selectItem" value="{{ $equipment->id }}"></td>
                                    <td class="text-center">
                                        {{ ($equipments->currentPage() - 1) * $equipments->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="text-center">{{ $equipment->code }}</td>
                                    <td>{{ $equipment->name }}</td>
                                    <td class="text-center">{{ $equipment->category->name ?? 'ไม่พบหมวดหมู่' }}</td>
                                    <td class="text-center">{{ $equipment->quantity }}</td>
                                    <td>{{ $equipment->status }}</td>
                                    <td>{{ $equipment->unit }}</td>
                                    <td class="text-center">{{ $equipment->location ?? '-' }}</td>
                                    <td class="text-center">
                                        @if($equipment->image)
                                            <img src="{{ asset('storage/' . $equipment->image) }}" alt="รูปภาพครุภัณฑ์"
                                                width="100">
                                        @else
                                            <span>ไม่มีรูปภาพ</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="{{ route('admin.equipments.edit', $equipment->id) }}"
                                                class="btn btn-warning btn-sm me-1">
                                                <i class="bi bi-pencil"></i> แก้ไข
                                            </a>
                                            <form action="{{ route('admin.equipments.destroy', $equipment->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i> ลบ
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($equipments->hasPages())
                    <nav class="d-flex justify-content-center mt-4">
                        <ul class="pagination">
                            {{-- ก่อนหน้า --}}
                            @if ($equipments->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="bi bi-arrow-left"></i> ก่อนหน้า
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $equipments->previousPageUrl() }}" rel="prev">
                                        <i class="bi bi-arrow-left"></i> ก่อนหน้า
                                    </a>
                                </li>
                            @endif

                            {{-- ถัดไป --}}
                            @if ($equipments->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $equipments->nextPageUrl() }}" rel="next">
                                        ถัดไป <i class="bi bi-arrow-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        ถัดไป <i class="bi bi-arrow-right"></i>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>

    <!-- ✅ JS สำหรับกรองตาราง -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('#equipment-table tbody tr');

            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase();

                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(keyword) ? '' : 'none';
                });
            });
        });

        const noResultMessage = document.createElement('tr');
        noResultMessage.innerHTML = `<td colspan="11" class="text-center text-muted">ไม่พบรายการที่ตรงกับคำค้นหา</td>`;
        noResultMessage.style.display = 'none';
        document.querySelector('#equipment-table tbody').appendChild(noResultMessage);

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            let found = false;

            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const match = text.includes(keyword);
                row.style.display = match ? '' : 'none';
                if (match) found = true;
            });

            noResultMessage.style.display = found ? 'none' : '';
        });
    </script>



    <!-- JQuery & AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.pagination-btn', function (e) {
            e.preventDefault();
            const url = $(this).data('url');
            if (!url) return;

            // เริ่มด้วย fadeOut ตาราง
            $('#equipment-table').fadeOut(200, function () {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        const newTable = $(response).find('#equipment-table').html();
                        const newPagination = $(response).find('#pagination-buttons').html();

                        // อัปเดตตารางและแสดงใหม่
                        $('#equipment-table').html(newTable).fadeIn(300);

                        // อัปเดตปุ่มหน้า
                        $('#pagination-buttons').html(newPagination);

                        // รอให้ DOM ตารางอัปเดตเสร็จก่อนค่อย scroll
                        setTimeout(() => {
                            const row5 = $('#equipment-table table tbody tr').eq(4); // แถวที่ 5 (index 4)
                            if (row5.length) {
                                $('html, body').animate({
                                    scrollTop: row5.offset().top - 100
                                }, 500);
                            }
                        }, 300); // รอให้ fadeIn เสร็จก่อนค่อย scroll
                    },
                    error: function () {
                        alert('เกิดข้อผิดพลาดในการโหลดข้อมูล');
                        $('#equipment-table').fadeIn(200);
                    }
                });
            });
        });
    </script>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('selectAll');
            const selectItemCheckboxes = document.querySelectorAll('.selectItem');
            const deleteSelectedButton = document.getElementById('deleteSelectedButton');

            // เลือก/ยกเลิกเลือกทั้งหมด
            selectAllCheckbox.addEventListener('change', function () {
                selectItemCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            // ลบรายการที่เลือก
            deleteSelectedButton.addEventListener('click', function () {
                const selectedIds = Array.from(selectItemCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                if (selectedIds.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'กรุณาเลือกรายการที่ต้องการลบ',
                        confirmButtonText: 'ตกลง'
                    });
                    return;
                }

                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: 'คุณต้องการลบรายการที่เลือกหรือไม่?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'ใช่, ลบเลย!',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('{{ route('admin.equipments.destroySelected') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ ids: selectedIds })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ลบสำเร็จ!',
                                        text: 'รายการที่เลือกถูกลบเรียบร้อยแล้ว',
                                        confirmButtonText: 'ตกลง'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'เกิดข้อผิดพลาด',
                                        text: 'ไม่สามารถลบรายการที่เลือกได้',
                                        confirmButtonText: 'ตกลง'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'ไม่สามารถลบรายการที่เลือกได้',
                                    confirmButtonText: 'ตกลง'
                                });
                            });
                    }
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
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>ข้อมูลผู้ใช้</title>
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
                                <span class="user-name">
                                    @php
                                        $user = Auth::guard('admin')->user();
                                    @endphp @if($user && $user->profile_image)
                                        <img src="{{ asset('storage/' . $user->profile_image) }}"
                                            class="user-avatar shadow-sm">
                                    @else
                                    @endif

                                    <span class="user-name">
                                        @if($user)
                                            สวัสดีคุณ {{ $user->name }} {{ $user->surname ?? '' }}
                                            ({{ $user->position ?? 'ผู้ดูแลระบบ' }})
                                        @else
                                            สวัสดีผู้เยี่ยมชม
                                        @endif
                                    </span>
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
                <h2 class="text-center mb-4">ข้อมูลผู้ใช้ทั้งหมด</h2>
                <div class="mb-3 text-end">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="bi bi-person-plus-fill"></i> เพิ่มผู้ใช้
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center shadow-sm">
                        <thead class="table-success">
                            <tr>
                                <th style="width: 5%;">ID</th>
                                <th style="width: 15%;">ชื่อ</th>
                                <th style="width: 15%;">นามสกุล</th>
                                <th style="width: 15%;">เบอร์โทร</th>
                                <th style="width: 10%;">ตำแหน่ง</th>
                                <th style="width: 10%;">รูปโปรไฟล์</th>
                                <th style="width: 10%;">Username</th>
                                <th style="width: 15%;">การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->surname }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        @php
                                            $badgeColor = match ($user->position) {
                                                'student' => '#28a745',
                                                'teacher', 'staff' => '#007bff',
                                                'admin' => '#6c757d',
                                                default => '#17a2b8',
                                            };

                                            $positionThai = match ($user->position) {
                                                'student' => 'นักศึกษา',
                                                'teacher' => 'อาจารย์',
                                                'staff' => 'เจ้าหน้าที่',
                                                'admin' => 'ผู้ดูแลระบบ',
                                                default => $user->position, // ถ้าไม่มีแปล ใช้ค่าเดิม
                                            };
                                        @endphp

                                        <span class="badge text-light" style="background-color: {{ $badgeColor }}">
                                            {{ $positionThai }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($user->profile_image)
                                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image"
                                                width="60" height="60">
                                        @else
                                            <span class="text-muted fst-italic">ไม่มีรูป</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning btn-edit me-1" data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}" data-surname="{{ $user->surname }}"
                                            data-phone="{{ $user->phone }}" data-position="{{ $user->position }}"
                                            data-username="{{ $user->username }}"
                                            data-profile_image="{{ asset('storage/' . $user->profile_image) }}"
                                            type="button" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                            <i class="bi bi-pencil-square"></i> แก้ไข
                                        </button>

                                        <button type="button" class="btn btn-sm btn-danger btn-delete-user"
                                            data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
                                            <i class="bi bi-trash"></i> ลบ
                                        </button>

                                        <form id="delete-form-{{ $user->id }}"
                                            action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            window.addEventListener('load', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ!',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    // เพิ่ม animation สวย ๆ (optional)
                    didOpen: (toast) => {
                        // สามารถใส่โค้ดเพิ่มเติมตอนเปิดได้
                    }
                });
            });
        </script>
    @endif

    <!-- Modal เพิ่มผู้ใช้ -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addUserForm" method="POST" action="{{ route('admin.users.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">เพิ่มผู้ใช้ใหม่</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"><label for="addName" class="form-label">ชื่อ</label>
                            <input type="text" class="form-control" id="addName" name="name" required>
                        </div>
                        <div class="mb-3"><label for="addSurname" class="form-label">นามสกุล</label>
                            <input type="text" class="form-control" id="addSurname" name="surname" required>
                        </div>
                        <div class="mb-3"><label for="addPhone" class="form-label">เบอร์โทร</label>
                            <input type="text" class="form-control" id="addPhone" name="phone" required>
                        </div>
                        <div class="mb-3"><label for="addPosition" class="form-label">ตำแหน่ง</label>
                            <select class="form-control" id="addPosition" name="position" required>
                                <option value="student">นักศึกษา</option>
                                <option value="teacher">อาจารย์</option>
                                <option value="staff">เจ้าหน้าที่</option>
                                <option value="admin">ผู้ดูแลระบบ</option>
                            </select>
                        </div>
                        <div class="mb-3"><label for="addUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="addUsername" name="username" required>
                        </div>
                        <div class="mb-3"><label for="addPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="addPassword" name="password" required>
                        </div>
                        <div class="mb-3"><label for="addProfileImage" class="form-label">รูปโปรไฟล์</label>
                            <input type="file" class="form-control" name="profile_image" id="addProfileImage"
                                accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal แก้ไขผู้ใช้ -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editUserForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editUserId">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">แก้ไขข้อมูลผู้ใช้</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"><label for="editName" class="form-label">ชื่อ</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="mb-3"><label for="editSurname" class="form-label">นามสกุล</label>
                            <input type="text" name="surname" id="editSurname" class="form-control" required>
                        </div>
                        <div class="mb-3"><label for="editPhone" class="form-label">เบอร์โทร</label>
                            <input type="text" name="phone" id="editPhone" class="form-control">
                        </div>
                        <div class="mb-3"><label for="editPosition" class="form-label">ตำแหน่ง</label>
                            <select name="position" id="editPosition" class="form-control" required>
                                <option value="student">นักศึกษา</option>
                                <option value="teacher">อาจารย์</option>
                                <option value="staff">เจ้าหน้าที่</option>
                                <option value="admin">ผู้ดูแลระบบ</option>
                            </select>
                        </div>
                        <div class="mb-3"><label for="editUsername" class="form-label">Username</label>
                            <input type="text" name="username" id="editUsername" class="form-control" required>
                        </div>
                        <div class="mb-3"><label for="editProfileImage" class="form-label">รูปโปรไฟล์ใหม่
                                (ถ้ามี)</label>
                            <input type="file" name="profile_image" id="editProfileImage" class="form-control"
                                accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">บันทึกการเปลี่ยนแปลง</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- JQuery & AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ===== Modal แก้ไขผู้ใช้ =====
            const editButtons = document.querySelectorAll('.btn-edit');
            const editForm = document.getElementById('editUserForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.dataset.id;

                    document.getElementById('editUserId').value = userId;
                    document.getElementById('editName').value = this.dataset.name;
                    document.getElementById('editSurname').value = this.dataset.surname;
                    document.getElementById('editPhone').value = this.dataset.phone;
                    document.getElementById('editPosition').value = this.dataset.position;
                    document.getElementById('editUsername').value = this.dataset.username;

                    editForm.action = `/admin/users/${userId}`;
                });
            });

            editForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(editForm);
                formData.append('_method', 'PUT');

                fetch(editForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(response => {
                        if (!response.ok) return response.json().then(err => Promise.reject(err));
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: 'แก้ไขผู้ใช้เรียบร้อยแล้ว'
                        }).then(() => location.reload());
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด!',
                            text: error.message || 'ไม่สามารถอัปเดตได้'
                        });
                    });
            });

            // ===== Modal เพิ่มผู้ใช้ =====
            const addForm = document.getElementById('addUserForm');
            addForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(addForm);

                fetch(addForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(response => {
                        if (!response.ok) return response.json().then(err => Promise.reject(err));
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มผู้ใช้สำเร็จ!',
                            text: data.message || 'เพิ่มผู้ใช้เรียบร้อยแล้ว'
                        }).then(() => location.reload());
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด!',
                            text: error.message || 'ไม่สามารถเพิ่มผู้ใช้ได้'
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
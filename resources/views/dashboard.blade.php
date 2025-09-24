<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>แดชบอร์ด</title>
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
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #f3f4f6;
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
            background: #f12711;
            background: -webkit-linear-gradient(to right, #f5af19, #f12711);
            background: linear-gradient(to right, #f5af19, #f12711);

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

        .navbar-collapse-custom {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width: 100%;
        }

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
            transition: color 0.3s;
        }

        .navbar-link:hover {
            color: #ff8c00;
        }

        .user-info {
            display: flex;
            align-items: center;
            font-size: 1rem;
            color: white;
        }

        /* รูปภาพโปรไฟล์ */
        .user-avatar {
            width: 120px;
            /* ขนาดตามต้องการ */
            height: 120px;
            /* ต้องเท่ากับ width เพื่อให้เป็นวงกลม */
            object-fit: cover;
            /* ป้องกันภาพยืด */
            border-radius: 50%;
            /* ทำให้เป็นวงกลม */
            overflow: hidden;
            /* กันภาพล้นขอบ */
            object-position: top;
        }

        .user-name {
            font-size: 1rem;
        }

        .logout-text {
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .logo-container {
                justify-content: center;
                width: 100%;
            }

            .navbar-brand-custom {
                font-size: 1.1rem;
                margin-top: 0.5rem;
                margin-left: 0;
            }

            .navbar-collapse-custom {
                justify-content: center;
                margin-top: 1rem;
            }

            .navbar-right {
                flex-direction: column;
                align-items: center;
            }

            .navbar-item {
                margin: 0.5rem 0;
            }

            .user-info {
                flex-direction: column;
            }
        }

        input.form-control::placeholder {
            color: #a1a1aa;
            font-weight: 500;
        }

        /* ปรับระยะห่างซ้าย-ขวาของ .dropdown-divider */
        .dropdown-divider {
            margin-left: 1rem;
            margin-right: 1rem;
            border-top: 1px solid #dee2e6;
        }

        .sticky-top {
            z-index: 1030;
        }

        .user-avatar {
            width: 35px;
            /* ลดขนาดความกว้าง */
            height: 35px;
            /* ลดขนาดความสูง */
            border-radius: 50%;
            /* ทำให้เป็นวงกลม */
            background-color: #fff;
            /* สีพื้นหลัง */
            margin-right: 10px;
            /* ระยะห่างด้านขวา */
        }

        #nprogress .bar {
            background: #ffffff !important;
            /* เปลี่ยนสีตามใจชอบ */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <nav class="main-navbar sticky-top">
        <div class="navbar-container">
            <!-- โลโก้ 2 อันด้านหน้า -->
            <div class="logo-container">
                <img src="/images/rmutl_old.png" alt="Logo 1" class="navbar-logo">
                <img src="/images/IT Logo.png" alt="Logo 2" class="navbar-logo2">
            </div>

            <!-- ชื่อแบรนด์ -->
            <a class="navbar-brand-custom">ระบบบริหารจัดการวัสดุและการยืม
                คืนครุภัณฑ์ภายในสาขาวิชาเทคโนโลยีสารสนเทศ</a>

            <div class="navbar-collapse-custom">
                <!-- เมนูขวา -->
                <ul class="navbar-right">
                    <li class="navbar-item">
                        <a class="navbar-link" href="{{ route('dashboard') }}">หน้าแรก</a>
                    </li>
                    @php
                        $position = Auth::user()->position;
                    @endphp

                    @if(in_array($position, ['teacher', 'staff']))
                        <li class="navbar-item">
                            <a class="navbar-link" href="{{ route('materials.history') }}">บริหารจัดการวัสดุ</a>
                        </li>
                    @endif
                    <li class="navbar-item">
                        <a class="navbar-link" href="{{ route('borrow.list') }}">การยืม คืนครุภัณฑ์</a>
                    </li>

                    <li class="navbar-item dropdown">
                        <a class="navbar-link dropdown-toggle user-info" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @php
                                $user = Auth::user();
                            @endphp
                            <img src="{{ asset('storage/' . $user->profile_image) }}" class="user-avatar shadow-sm">
                            <span class="user-name">
                                สวัสดีคุณ {{ $user->name }} {{ $user->surname }} ({{ $user->position ?? 'ผู้ใช้' }})
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{route('profile')}}">ข้อมูลส่วนตัว</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('borrow.list') }}">ประวัติการยืมครุภัณฑ์</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @if(in_array($position, ['teacher', 'staff']))
                                <li>
                                    <a class="dropdown-item" href="{{ route('materials.history') }}">ประวัติการเบิกวัสดุ</a>
                                </li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    ออกจากระบบ
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5 mb-4">
        <div class="bg-white shadow-sm p-4 rounded-4 text-center">
            <h4 class="fw-bold mb-4">ค้นหาข้อมูล</h4>

            <!-- ฟอร์มค้นหา -->
            <div class="d-flex justify-content-center position-relative">
                <form id="searchForm" class="d-flex justify-content-center w-100 position-relative">
                    <input type="text" name="query" id="searchQuery"
                        class="form-control form-control-lg me-2 w-50 rounded-start-pill pe-5"
                        placeholder="ค้นหาได้ทางนี้" required>

                    <!-- ปุ่มกากบาท -->
                    <button id="clearSearch" type="button"
                        style="position: absolute; right: 370px; top: 50%; transform: translateY(-50%);
                   background: transparent; border: none; font-size: 1.2rem; color: #aaa; cursor: pointer; display: none;">
                        &times;
                    </button>

                    <button type="submit" class="btn btn-lg text-white rounded-end-pill px-4"
                        style="background-color: #f97316;">ค้นหา</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const clearSearch = document.getElementById('clearSearch');
            const searchInput = document.getElementById('searchQuery');

            // แสดงหรือซ่อนปุ่มกากบาทเมื่อพิมพ์
            searchInput.addEventListener('input', function () {
                clearSearch.style.display = searchInput.value ? 'block' : 'none';
            });

            // เมื่อคลิกปุ่มกากบาท
            clearSearch.addEventListener('click', function () {
                searchInput.value = '';
                clearSearch.style.display = 'none';
                searchInput.focus();
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchForm = document.getElementById('searchForm');
            const searchQuery = document.getElementById('searchQuery');

            searchForm.addEventListener('submit', function (event) {
                event.preventDefault();

                const query = searchQuery.value;

                fetch('{{ route('dashboard.search') }}?query=' + encodeURIComponent(query), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.materials.length === 0 && data.equipments.length === 0) {
                            Swal.fire({
                                icon: 'info',
                                title: 'ไม่พบผลลัพธ์',
                                text: `ไม่พบข้อมูลที่ตรงกับ "${data.query}"`,
                                confirmButtonText: 'ตกลง'
                            });
                        } else {
                            let materialsTable = '';
                            let equipmentsTable = '';

                            if (data.materials.length > 0) {
                                materialsTable = `
                            <h5>วัสดุ</h5>
                            <table border="1" cellpadding="8" cellspacing="0" style="width:100%; margin-bottom: 20px;">
                                <thead>
                                    <tr style="background-color:#f3f4f6;">
                                        <th>ชื่อวัสดุ</th>
                                        <th>หมวดหมู่</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>`;
                                data.materials.forEach(material => {
                                    materialsTable += `
                                <tr>
                                    <td>${material.name}</td>
                                    <td>${material.category?.name || '-'}</td>
                                    <td><button class="swal2-confirm swal2-styled" onclick="handleWithdraw('${material.id}')">ทำการเบิก</button></td>
                                </tr>`;
                                });
                                materialsTable += `</tbody></table>`;
                            }

                            if (data.equipments.length > 0) {
                                equipmentsTable = `
                            <h5>ครุภัณฑ์</h5>
                            <table border="1" cellpadding="8" cellspacing="0" style="width:100%;">
                                <thead>
                                    <tr style="background-color:#f3f4f6;">
                                        <th>ชื่อครุภัณฑ์</th>
                                        <th>หมวดหมู่</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>`;
                                data.equipments.forEach(equipment => {
                                    equipmentsTable += `
                                <tr>
                                    <td>${equipment.name}</td>
                                    <td>${equipment.category?.name || '-'}</td>
                                    <td><button class="swal2-confirm swal2-styled" style="background-color:#3b82f6;" onclick="handleRequest('${equipment.id}')">ทำการขอยืม</button></td>
                                </tr>`;
                                });
                                equipmentsTable += `</tbody></table>`;
                            }

                            Swal.fire({
                                title: `ผลการค้นหา: "${data.query}"`,
                                html: materialsTable + equipmentsTable,
                                showConfirmButton: true,
                                confirmButtonText: 'ปิด',
                                width: '700px',
                                didOpen: () => {
                                    const confirmBtn = Swal.getConfirmButton();
                                    confirmBtn.style.backgroundColor = '#ef4444';
                                    confirmBtn.style.color = '#fff';
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถค้นหาข้อมูลได้',
                            confirmButtonText: 'ตกลง'
                        });
                    });
            });
        });

        function handleRequest(equipmentId) {
            if (confirm("คุณต้องการยืมครุภัณฑ์ ID: " + equipmentId + " ใช่หรือไม่?")) {
                window.location.href = `/borrow/confirm/${equipmentId}`;
            }
        }
        function handleWithdraw(materialId) {
            if (confirm("คุณต้องการเบิกวัสดุ ID: " + materialId + " ใช่หรือไม่?")) {
                window.location.href = `/materials/confirm/${materialId}`;
            }
        }
    </script>

    <div class="container mb-5">
        <div class="row">
            <!-- กราฟเบิกจ่ายวัสดุ -->
            <div class="col-md-6 mb-4">
                <div class="bg-white shadow-sm p-4 rounded-4">
                    <h5 class="fw-bold text-center mb-3">ข้อมูลสถิติเบิกจ่ายวัสดุ</h5>
                    <canvas id="materialChart" height="200"></canvas>
                </div>
            </div>

            <!-- กราฟยืม-คืนครุภัณฑ์ -->
            <div class="col-md-6 mb-4">
                <div class="bg-white shadow-sm p-4 rounded-4">
                    <h5 class="fw-bold text-center mb-3">ข้อมูลสถิติการยืม-คืนครุภัณฑ์</h5>
                    <canvas id="equipmentChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2568 พัฒนาโดย นายศิวกร จุลศิลป์ สาขาวิชาเทคโนโลยีสารสนเทศ | All Rights Reserved.</p>
    </div>


    <!-- เช็คว่า login_status มีค่าหรือไม่ -->
    @if(session('login_status'))
        <script>
            setTimeout(function () {
                Swal.fire({
                    title: 'เข้าสู่ระบบสำเร็จ!',
                    text: '{{ session('login_status') }}',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false,
                });
            }, 500);
        </script>
    @endif


    @if(session('logout_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'ออกจากระบบสำเร็จ!',
                    text: @json(session('logout_success')),
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false, // ✅ ปิดปุ่ม OK
                    didClose: () => {
                        window.location.href = "/index";
                    }
                });
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // วัสดุ
    fetch("{{ route('dashboard.material.usage') }}")
        .then(res => res.json())
        .then(data => {
            console.log('วัสดุ:', data); // ✅ debug
            const ctx = document.getElementById('materialChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'จำนวนเบิกจ่าย (รายการ)',
                        data: data.data,
                        borderColor: '#f97316',
                        backgroundColor: 'rgba(249, 115, 22, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } }
                    }
                }
            });
        });

    // ครุภัณฑ์
    fetch("{{ route('dashboard.equipment.usage') }}")
        .then(res => res.json())
        .then(data => {
            console.log('ครุภัณฑ์:', data); // ✅ debug
            const ctx = document.getElementById('equipmentChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'จำนวนการยืม-คืน (ครั้ง)',
                        data: data.data,
                        borderColor: '#f12711',
                        backgroundColor: 'rgba(241, 39, 17, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } }
                    }
                }
            });
        });
});
</script>
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
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <title>ยืนยันการเบิกวัสดุ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
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
    <div class="container mt-5">
        <h3>ยืนยันการเบิกวัสดุ</h3>

        <div class="card mb-3">
            <div class="card-body">
                <strong>ชื่อวัสดุ:</strong> {{ $material->name }}<br>
                <strong>สถานะ:</strong> {{ $material->status }}<br>
                <strong>จำนวนคงเหลือ:</strong> {{ $material->quantity }}
                <strong>{{$material->unit}}</strong>
            </div>
        </div>

        <form id="requestForm" method="POST" action="{{ route('admin.material-requests.store') }}">
            @csrf

            <input type="hidden" name="material_id" value="{{ $material->id }}">

            <div class="mb-3">
                <label for="quantity">จำนวนที่ต้องการเบิก:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1"
                    max="{{ $material->quantity }}" required>
            </div>

            <div class="mb-3">
                <label for="reason">เหตุผลในการเบิก:</label>
                <textarea name="reason" id="reason" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">ยืนยันการเบิก</button>
        </form>

        <div id="request-status" class="mt-3"></div>
    </div>

    <script>
    document.getElementById('requestForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        fetch('{{ route("admin.material-requests.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async response => {
            const contentType = response.headers.get("content-type");

            if (!response.ok) {
                if (contentType && contentType.includes("application/json")) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'ไม่สามารถส่งคำร้องได้');
                } else {
                    throw new Error('เซิร์ฟเวอร์ส่งข้อมูลที่ไม่ใช่ JSON กลับมา');
                }
            }

            return response.json();
        })
        .then(data => {
            const quantity = data.data?.quantity || formData.get('quantity');
            const unit = data.data?.unit || document.getElementById('unit')?.value || 'หน่วย';
            const reason = data.data?.reason || formData.get('reason') || '-';

            Swal.fire({
                title: 'ส่งคำร้องสำเร็จ!',
                html: `
                    <p>จำนวนที่เบิก: <strong>${quantity} ${unit}</strong></p>
                    <p>เหตุผล: ${reason}</p>
                `,
                icon: 'success',
                confirmButtonText: 'ตกลง'
            }).then(() => {
                window.location.href = "{{ route('materials.history') }}";
            });

            form.style.display = 'none';
            document.getElementById('request-status').innerHTML = `
                <div class="alert alert-info mt-3">
                    <strong>สถานะคำร้อง:</strong> ${data.data?.status || 'รออนุมัติ'}
                </div>
            `;
        })
        .catch(error => {
            Swal.fire({
                title: 'เกิดข้อผิดพลาด',
                text: error.message,
                icon: 'error',
                confirmButtonText: 'ตกลง'
            });
        });
    });
</script>

    <div class="footer">
        <p>&copy; 2568 พัฒนาโดย นายศิวกร จุลศิลป์ สาขาวิชาเทคโนโลยีสารสนเทศ | All Rights Reserved.</p>
    </div>

    <script>
        NProgress.start();
        window.addEventListener('load', function () {
            setTimeout(() => NProgress.done(), 500);
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
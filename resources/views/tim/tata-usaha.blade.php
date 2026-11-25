
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subbagian Tata Usaha </title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f8fc;
            color: #26364a;
        }

        .container {
            max-width: 1180px;
            margin: auto;
            padding: 40px 25px;
        }

        /* HERO */
        .hero {
            background: linear-gradient(120deg, #123d65, #287ba0);
            padding: 55px 45px;
            border-radius: 22px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-tag {
            font-size: 12px;
            letter-spacing: 2px;
            color: #c5e8f5;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .hero h1 {
            font-size: 34px;
            line-height: 1.35;
            max-width: 650px;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 14px;
            line-height: 1.8;
            max-width: 620px;
            color: #e0edf5;
        }

        .hero-icon {
            position: absolute;
            right: 55px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 100px;
            opacity: .15;
        }

        /* SECTION */
        .section {
            margin-top: 55px;
        }

        .section-heading {
            margin-bottom: 25px;
        }

        .section-heading span {
            color: #2783a5;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .section-heading h2 {
            font-size: 25px;
            margin-top: 8px;
            color: #173b5a;
        }

        .section-heading p {
            font-size: 13px;
            color: #718096;
            margin-top: 8px;
            line-height: 1.7;
        }

        /* ANGGOTA */
        .member-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .member-card {
            background: white;
            border-radius: 17px;
            overflow: hidden;
            border: 1px solid #e8edf3;
            transition: .3s;
        }

        .member-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(24, 65, 100, .10);
        }

        .member-photo {
            height: 230px;
            background: #e8f0f5;
            overflow: hidden;
        }

        .member-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
        }

        .member-info {
            padding: 20px;
        }

        .member-info h3 {
            font-size: 15px;
            color: #173b5a;
            margin-bottom: 9px;
        }

        .member-info span {
            display: inline-block;
            font-size: 10px;
            background: #e9f4f8;
            color: #287b9c;
            padding: 7px 11px;
            border-radius: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .member-info p {
            color: #8290a0;
            font-size: 12px;
            line-height: 1.6;
        }

        /* VISI MISI */
        .vision-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .vision-card {
            padding: 30px;
            background: white;
            border: 1px solid #e8edf3;
            border-radius: 17px;
        }

        .vision-card .icon {
            font-size: 28px;
            margin-bottom: 18px;
        }

        .vision-card h3 {
            font-size: 19px;
            color: #1c5275;
            margin-bottom: 15px;
        }

        .vision-card p,
        .vision-card li {
            font-size: 13px;
            color: #69798b;
            line-height: 1.9;
        }

        .vision-card ul {
            padding-left: 20px;
        }

        .vision-card li {
            padding-bottom: 8px;
        }

        /* TUGAS */
        .task-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .task-item {
            display: flex;
            gap: 15px;
            padding: 22px;
            background: white;
            border: 1px solid #e8edf3;
            border-radius: 15px;
            align-items: flex-start;
        }

        .task-number {
            min-width: 38px;
            height: 38px;
            border-radius: 11px;
            background: #e8f3f8;
            color: #247b9d;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 13px;
        }

        .task-item p {
            font-size: 13px;
            line-height: 1.8;
            color: #64748b;
        }

        /* JABATAN */
        .position-box {
            background: white;
            border-radius: 17px;
            border: 1px solid #e8edf3;
            padding: 30px;
        }

        .position-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .position-item {
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 15px;
            background: #f7fafc;
            border-radius: 12px;
        }

        .position-item i {
            color: #2783a5;
            font-size: 20px;
        }

        .position-item p {
            font-size: 13px;
            font-weight: 600;
            color: #38536c;
        }

        .back-link {
            display: inline-block;
            margin-top: 40px;
            text-decoration: none;
            color: #277c9e;
            font-size: 13px;
            font-weight: 600;
        }

        .back-link:hover {
            color: #123d65;
        }

        @media(max-width: 850px) {
            .member-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 600px) {
            .container {
                padding: 25px 16px;
            }

            .hero {
                padding: 35px 25px;
            }

            .hero h1 {
                font-size: 25px;
            }

            .hero-icon {
                display: none;
            }

            .member-grid,
            .vision-grid,
            .task-list,
            .position-list {
                grid-template-columns: 1fr;
            }

            .member-photo {
                height: 280px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HERO -->
    <section class="hero">
        <div class="hero-tag">UNIT KERJA</div>

        <h1>Tim Kerja Pemetaan Usaha dan Investasi</h1>

        <p>
            Mengenal lebih dekat tim kerja yang berperan
            dalam pemetaan potensi usaha dan investasi
            untuk mendukung pengembangan kewirausahaan.
        </p>

        <div class="hero-icon">⌖</div>
    </section>


    <!-- ANGGOTA TIM -->
    <section class="section">

        <div class="section-heading">
            <span>OUR TEAM</span>
            <h2>Anggota Tim Kerja</h2>
            <p>
                Kenali anggota dan personel yang berperan
                dalam pelaksanaan tugas Tim Kerja Pemetaan
                Usaha dan Investasi.
            </p>
        </div>

        <div class="member-grid">

            <div class="member-card">
                <div class="member-photo">
                    <img src="{{ asset('images/tim/anggota1.jpg') }}" alt="Anggota 1">
                </div>
                <div class="member-info">
                    <h3>Nama Anggota 1</h3>
                    <span>Ketua Tim Kerja</span>
                    <p>Tim Kerja Pemetaan Usaha dan Investasi</p>
                </div>
            </div>

            <div class="member-card">
                <div class="member-photo">
                    <img src="{{ asset('images/tim/anggota2.jpg') }}" alt="Anggota 2">
                </div>
                <div class="member-info">
                    <h3>Nama Anggota 2</h3>
                    <span>Anggota Tim</span>
                    <p>Tim Kerja Pemetaan Usaha dan Investasi</p>
                </div>
            </div>

            <div class="member-card">
                <div class="member-photo">
                    <img src="{{ asset('images/tim/anggota3.jpg') }}" alt="Anggota 3">
                </div>
                <div class="member-info">
                    <h3>Nama Anggota 3</h3>
                    <span>Anggota Tim</span>
                    <p>Tim Kerja Pemetaan Usaha dan Investasi</p>
                </div>
            </div>

            <div class="member-card">
                <div class="member-photo">
                    <img src="{{ asset('images/tim/anggota4.jpg') }}" alt="Anggota 4">
                </div>
                <div class="member-info">
                    <h3>Nama Anggota 4</h3>
                    <span>Anggota Tim</span>
                    <p>Tim Kerja Pemetaan Usaha dan Investasi</p>
                </div>
            </div>

        </div>
    </section>


    <!-- TUGAS -->
    <section class="section">

        <div class="section-heading">
            <span>OUR RESPONSIBILITIES</span>
            <h2>Tugas dan Fungsi</h2>
            <p>
                Ruang lingkup pekerjaan dan tanggung jawab
                Tim Kerja Pemetaan Usaha dan Investasi.
            </p>
        </div>

        <div class="task-list">

            <div class="task-item">
                <div class="task-number">01</div>
                <p>
                    Melakukan identifikasi dan pemetaan potensi
                    usaha serta peluang investasi.
                </p>
            </div>

            <div class="task-item">
                <div class="task-number">02</div>
                <p>
                    Mengumpulkan dan mengelola data serta
                    informasi terkait potensi usaha.
                </p>
            </div>

            <div class="task-item">
                <div class="task-number">03</div>
                <p>
                    Melakukan analisis terhadap potensi dan
                    peluang pengembangan usaha.
                </p>
            </div>

            <div class="task-item">
                <div class="task-number">04</div>
                <p>
                    Menyusun bahan informasi hasil pemetaan
                    usaha dan investasi.
                </p>
            </div>

            <div class="task-item">
                <div class="task-number">05</div>
                <p>
                    Melakukan koordinasi dengan pihak terkait
                    dalam pengembangan potensi usaha.
                </p>
            </div>

            <div class="task-item">
                <div class="task-number">06</div>
                <p>
                    Melaksanakan tugas lain sesuai arahan
                    dan ketentuan yang berlaku.
                </p>
            </div>

        </div>
    </section>
    <a href="{{ url('/') }}" class="back-link">
        ← Kembali ke Halaman Utama
    </a>

</div>

</body>
</html>

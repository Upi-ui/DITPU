<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DITPU - Employee Digital Hub</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest"></script>

<style>
:root {
    --navy: #293d70;
    --blue: #526da8;
    --soft: #f3f5fb;
    --text: #293653;
    --muted: #8994aa;
    --white: #ffffff;
}
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--soft); color:var(--text); }
button,input,select,textarea { font:inherit; }
.layout { min-height:100vh; display:block; }

/* TOPBAR */
.topbar {
    height:76px; width:100%; background:#fff; display:flex; align-items:center;
    justify-content:space-between; gap:24px; padding:0 32px;
    border-bottom:1px solid #edf0f5; position:sticky; top:0; z-index:1000;
}
.topbar-left { display:flex; align-items:center; gap:15px; flex-shrink:0; }
.menu-toggle {
    width:40px; height:40px; border:0; background:#f1f4fa; color:var(--navy);
    border-radius:11px; display:grid; place-items:center; cursor:pointer; transition:.2s;
}
.menu-toggle:hover { background:#e5ebf8; }
.brand { display:flex; align-items:center; gap:11px; }
.brand-logo {
    width:42px; height:42px; border-radius:13px;
    background:linear-gradient(135deg,#526da8,#8299d0); color:white;
    display:grid; place-items:center; flex-shrink:0;
}
.brand h2 { font-size:17px; letter-spacing:1px; color:var(--navy); }
.brand small { display:block; font-size:9px; color:#9ba5b7; letter-spacing:1px; }
.top-menu { display:flex; align-items:center; gap:3px; margin:auto; }
.top-link {
    border:0; background:transparent; cursor:pointer; font:inherit;
    display:flex; align-items:center; gap:7px; padding:11px 10px;
    border-radius:10px; text-decoration:none; color:#78849a;
    font-size:11px; font-weight:700; white-space:nowrap; transition:.2s;
}
.top-link:hover,.top-link.active,.top-dropdown.open .top-link { color:var(--navy); background:#edf1fc; }
.top-link i { width:15px; height:15px; }
.top-dropdown { position:relative; }
.dropdown-chevron { width:12px!important; height:12px!important; transition:transform .2s; }
.top-dropdown.open .dropdown-chevron { transform:rotate(180deg); }
.dropdown-menu {
    position:absolute; top:calc(100% + 9px); left:0; min-width:220px; padding:8px;
    background:white; border:1px solid #edf0f5; border-radius:13px;
    box-shadow:0 14px 35px rgba(31,45,80,.13); display:none; z-index:1200;
}
.top-dropdown.open .dropdown-menu { display:block; animation:dropdownIn .15s ease; }
.dropdown-menu a {
    display:block; padding:11px 12px; border-radius:8px; text-decoration:none;
    color:#68758d; font-size:11px; font-weight:600; white-space:nowrap;
}
.dropdown-menu a:hover { background:#edf1fc; color:var(--navy); }
@keyframes dropdownIn { from {opacity:0;transform:translateY(-5px)} to {opacity:1;transform:translateY(0)} }
.topbar-profile { display:flex; align-items:center; gap:10px; flex-shrink:0; }
.profile-avatar {
    width:38px; height:38px; display:grid; place-items:center;
    background:#e4eafa; color:#526da8; border-radius:50%; flex-shrink:0;
}
.profile-name { font-size:11px; font-weight:800; }
.profile-role { font-size:9px; color:var(--muted); margin-top:4px; }

/* SIDEBAR */
.sidebar {
    position:fixed; top:76px; left:0; width:270px; height:calc(100vh - 76px);
    background:#fff; padding:25px 19px; display:flex; flex-direction:column;
    border-right:1px solid #edf0f6; box-shadow:8px 8px 28px rgba(31,45,80,.12);
    z-index:1101; overflow-y:auto; transform:translateX(-105%); transition:transform .28s ease;
}
.sidebar.show { transform:translateX(0); }
.sidebar-brand-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:32px; }
.sidebar-brand-row .brand { padding:0 4px; }
.sidebar-close {
    width:32px; height:32px; border:0; border-radius:9px; background:#f1f4fa;
    color:#64748b; display:grid; place-items:center; cursor:pointer;
}
.menu-label { font-size:9px; color:#a2aabc; font-weight:800; letter-spacing:1.4px; padding:0 12px; margin:8px 0 13px; }
.sidebar nav + .menu-label { margin-top:27px; }
.sidebar .nav-link {
    display:flex; align-items:center; gap:13px; padding:13px; margin-bottom:5px;
    text-decoration:none; color:#8792a8; font-size:11px; font-weight:600;
    border-radius:12px; transition:.2s;
}
.sidebar .nav-link i { width:18px; height:18px; }
.sidebar .nav-link:hover,.sidebar .nav-link.active { color:var(--navy); background:#edf1fc; }
.sidebar .nav-link.active { font-weight:800; }
.sidebar-info {
    margin-top:auto; background:linear-gradient(145deg,#edf1ff,#f6f4ff);
    padding:18px; border-radius:17px; color:var(--text);
}
.sidebar-info i { color:#647cb8; margin-bottom:9px; }
.sidebar-info h4 { font-size:11px; margin-bottom:7px; }
.sidebar-info p { font-size:10px; line-height:1.8; color:#8290a7; }
.sidebar-overlay {
    position:fixed; inset:76px 0 0; background:rgba(20,30,55,.28);
    z-index:1100; opacity:0; visibility:hidden; transition:.25s;
}
.sidebar-overlay.show { opacity:1; visibility:visible; }
body.sidebar-open { overflow:hidden; }

/* MAIN & WELCOME */
.main { width:100%; min-width:0; padding:28px 42px; max-width:1600px; margin:0 auto; }
.welcome {
    position:relative; overflow:hidden; border-radius:23px; margin-bottom:30px;
    height:clamp(280px,34vw,420px); background:#293d70; color:white;
}
.welcome-slides { position:relative; height:100%; }
.welcome-slide { position:absolute; inset:0; opacity:0; visibility:hidden; transition:opacity .7s ease,visibility .7s ease; }
.welcome-slide.active { opacity:1; visibility:visible; }
.welcome-slide img { width:100%; height:100%; object-fit:cover; display:block; }
.welcome-slide::after {
    content:""; position:absolute; inset:0;
    background:linear-gradient(90deg,rgba(13,25,52,.88) 0%,rgba(20,37,72,.64) 48%,rgba(20,37,72,.08) 100%);
}
.welcome-content { position:absolute; z-index:2; left:clamp(24px,5vw,58px); top:50%; transform:translateY(-50%); max-width:620px; }
.welcome-tag {
    display:inline-block; font-size:10px; letter-spacing:1.8px; font-weight:800;
    color:#dbe7ff; margin-bottom:14px; padding:8px 12px; border-radius:30px;
    background:rgba(255,255,255,.13); backdrop-filter:blur(5px);
}
.welcome h1 { font-size:clamp(25px,3.5vw,42px); line-height:1.25; margin-bottom:12px; }
.welcome p { font-size:clamp(12px,1.2vw,15px); color:#e5edff; line-height:1.8; max-width:520px; }
.carousel-controls { position:absolute; z-index:4; left:clamp(24px,5vw,58px); bottom:22px; display:flex; align-items:center; gap:10px; }
.carousel-arrow {
    width:34px; height:34px; border-radius:50%; border:1px solid rgba(255,255,255,.55);
    background:rgba(255,255,255,.15); color:white; cursor:pointer; display:grid;
    place-items:center; backdrop-filter:blur(5px); transition:.2s;
}
.carousel-arrow:hover { background:rgba(255,255,255,.3); }
.carousel-dots { display:flex; align-items:center; gap:7px; margin-left:5px; }
.carousel-dot { border:0; width:8px; height:8px; border-radius:10px; background:rgba(255,255,255,.5); cursor:pointer; transition:.25s; }
.carousel-dot.active { width:23px; background:#fff; }

/* SECTION COMMON */
.section-header { display:flex; justify-content:space-between; align-items:end; margin-bottom:18px; }
.section-header h2 { font-size:18px; color:var(--navy); }
.section-header p { color:var(--muted); font-size:10px; margin-top:6px; line-height:1.7; }

/* TEAM CAROUSEL */
.team-section { margin-top:30px; margin-bottom:35px; }
.team-carousel { position:relative; overflow:hidden; padding:5px 2px 15px; }
.team-track { display:flex; gap:16px; transition:transform .4s ease; }
.team-card {
    flex:0 0 calc((100% - 32px)/3); min-width:0; min-height:190px; padding:21px;
    background:white; border:1px solid #edf0f5; border-radius:18px;
    text-decoration:none; color:var(--text); display:flex; flex-direction:column; transition:.25s;
}
.team-card:hover { transform:translateY(-5px); border-color:#cbd6ed; box-shadow:0 12px 28px rgba(54,75,120,.09); }
.team-icon { width:46px; height:46px; border-radius:14px; display:grid; place-items:center; margin-bottom:17px; }
.team-icon i { width:22px; height:22px; }
.team-card h3 { font-size:12px; line-height:1.7; margin-bottom:8px; }
.team-card p { font-size:10px; color:var(--muted); line-height:1.7; }
.team-link { margin-top:auto; padding-top:15px; color:#526da8; font-size:10px; font-weight:800; display:flex; justify-content:space-between; align-items:center; }
.team-link i { width:15px; }
.team-controls { display:flex; justify-content:center; align-items:center; gap:12px; margin-top:12px; }
.team-arrow {
    width:35px; height:35px; border:1px solid #e5eaf2; border-radius:50%;
    background:white; color:var(--navy); cursor:pointer;
}
.team-arrow:hover { background:var(--navy); color:white; }
.team-dots { display:flex; gap:6px; }
.team-dot { width:8px; height:8px; border:0; border-radius:10px; background:#d5ddec; cursor:pointer; transition:.2s; }
.team-dot.active { width:22px; background:var(--navy); }

/* COMPLAINT */
.complaint-section { background:white; border:1px solid #edf0f5; border-radius:22px; padding:25px; margin-top:35px; }
.complaint-heading { display:flex; align-items:center; gap:14px; margin-bottom:22px; }
.complaint-heading-icon {
    width:48px; height:48px; display:grid; place-items:center;
    background:#edf1fc; color:#526da8; border-radius:15px; flex-shrink:0;
}
.complaint-heading h2 { font-size:17px; color:var(--navy); }
.complaint-heading p { font-size:10px; color:var(--muted); margin-top:6px; line-height:1.7; }
.complaint-tabs { display:flex; gap:8px; border-bottom:1px solid #edf0f5; margin-bottom:22px; }
.complaint-tab {
    border:0; background:transparent; color:#8994aa; font-size:11px;
    font-weight:700; padding:12px 16px; cursor:pointer; border-bottom:3px solid transparent;
}
.complaint-tab.active { color:var(--navy); border-color:var(--navy); }
.complaint-tab i { width:14px; height:14px; vertical-align:middle; margin-right:5px; }
.complaint-panel { display:none; }
.complaint-panel.active { display:block; }
.complaint-form { max-width:750px; }
.form-group { margin-bottom:17px; }
.form-group label { display:block; font-size:11px; font-weight:700; margin-bottom:8px; }
.form-group input,.form-group select,.form-group textarea {
    width:100%; padding:12px 14px; border:1px solid #e5eaf2; border-radius:11px;
    outline:none; font-family:inherit; font-size:11px; color:var(--text); background:#fff;
}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus {
    border-color:#8299d0; box-shadow:0 0 0 3px #526da815;
}
.form-group textarea { min-height:130px; resize:vertical; }
.anonymous-option {
    display:flex; align-items:flex-start; gap:10px; padding:14px;
    border-radius:12px; background:#f5f7fc; margin-bottom:18px;
}
.anonymous-option input { margin-top:3px; accent-color:var(--navy); }
.anonymous-option label { font-size:10px; line-height:1.7; color:#64748b; }
.submit-complaint {
    border:0; border-radius:11px; background:var(--navy); color:white;
    padding:13px 22px; font-size:11px; font-weight:700; cursor:pointer; transition:.2s;
}
.submit-complaint:hover { background:#405b96; }
.submit-complaint i { width:14px; height:14px; vertical-align:middle; margin-right:5px; }
.public-complaint { padding:18px; border:1px solid #edf0f5; border-radius:14px; margin-bottom:12px; }
.public-complaint h3 { font-size:12px; margin:9px 0; }
.public-complaint p { font-size:10px; line-height:1.8; color:#78849a; white-space:pre-line; }
.complaint-meta { display:flex; align-items:center; gap:9px; flex-wrap:wrap; font-size:9px; color:#8994aa; }
.complaint-category { padding:5px 9px; background:#edf1fc; color:#526da8; border-radius:20px; font-weight:700; }
.complaint-empty { text-align:center; padding:35px 15px; color:#8994aa; font-size:11px; }
.validation-message { color:#c24141; font-size:10px; margin-top:6px; }

/* FOOTER */
footer {
    display:flex; justify-content:space-between; gap:10px; margin-top:30px;
    padding-top:18px; border-top:1px solid #e7ebf2; font-size:9px; color:#9aa4b6;
}

/* RESPONSIVE */
@media(max-width:1100px) {
    .topbar { gap:10px; padding:0 20px; }
    .top-link { padding:9px 6px; font-size:9px; }
    .brand h2 { font-size:15px; }
    .main { padding:25px; }
    .team-card { flex-basis:calc((100% - 16px)/2); }
}
@media(max-width:700px) {
    .topbar { height:68px; padding:0 14px; gap:10px; margin-bottom:47px; }
    .topbar .brand small { font-size:8px; }
    .top-menu {
        display:flex; position:absolute; top:68px; left:0; right:0; background:#fff;
        padding:8px 12px; overflow-x:auto; border-bottom:1px solid #edf0f5;
        justify-content:flex-start; gap:3px;
    }
    .top-link { font-size:10px; padding:9px 10px; }
    .dropdown-menu { position:fixed; top:115px; left:auto; max-width:calc(100vw - 20px); }
    .top-menu::-webkit-scrollbar { height:3px; }
    .top-menu::-webkit-scrollbar-thumb { background:#dce3f2; border-radius:10px; }
    .topbar-profile .profile-name,.topbar-profile .profile-role { display:none; }
    .sidebar { top:68px; height:calc(100vh - 68px); }
    .sidebar-overlay { inset:68px 0 0; }
    .main { padding:17px 14px; }
    .welcome { height:330px; border-radius:17px; }
    .welcome-content { left:22px; right:20px; }
    .welcome h1 { font-size:27px; }
    .welcome p { font-size:12px; }
    .carousel-controls { left:22px; bottom:17px; }
    .team-card { flex-basis:100%; }
    .section-header { align-items:flex-start; flex-direction:column; gap:13px; }
    .complaint-section { padding:17px; }
    .complaint-heading h2 { font-size:15px; }
    .complaint-tab { padding:12px 9px; font-size:10px; }
    footer { flex-direction:column; }
}
</style>
</head>

<body>
<!-- TOP NAVIGATION -->
<header class="topbar">
    <div class="topbar-left">
        <button class="menu-toggle" id="menuToggle" type="button" aria-label="Buka menu navigasi" aria-expanded="false">
            <i data-lucide="menu"></i>
        </button>
        <div class="brand">
            <div class="brand-logo"><i data-lucide="sparkles"></i></div>
            <div>
                <h2>DITPU</h2>
                <small>EMPLOYEE DIGITAL HUB</small>
            </div>
        </div>
    </div>

    <nav class="top-menu" aria-label="Navigasi utama">
        <a href="#" class="top-link active">Home</a>

        <div class="top-dropdown">
            <button class="top-link dropdown-toggle" type="button" aria-expanded="false">
                Profil <i data-lucide="chevron-down" class="dropdown-chevron"></i>
            </button>
            <div class="dropdown-menu">
                <a href="#tentang-ditpu">Tentang DITPU</a>
                <a href="#struktur-organisasi">Struktur Organisasi</a>
                <a href="#profil-pegawai">Profil Pegawai</a>
            </div>
        </div>

        <div class="top-dropdown">
            <button class="top-link dropdown-toggle" type="button" aria-expanded="false">
                Akuntabilitas Kinerja <i data-lucide="chevron-down" class="dropdown-chevron"></i>
            </button>
            <div class="dropdown-menu">
                <a href="#perencanaan-kinerja">Perencanaan Kinerja</a>
                <a href="#pengukuran-kinerja">Pengukuran Kinerja</a>
                <a href="#pelaporan-kinerja">Pelaporan Kinerja</a>
                <a href="#evaluasi-kinerja">Evaluasi Kinerja</a>
            </div>
        </div>

        <div class="top-dropdown">
            <button class="top-link dropdown-toggle" type="button" aria-expanded="false">
                Informasi <i data-lucide="chevron-down" class="dropdown-chevron"></i>
            </button>
            <div class="dropdown-menu">
                <a href="#agenda-event">Agenda &amp; Event</a>
                <a href="#kepegawaian">Kepegawaian</a>
                <a href="#keuangan">Keuangan</a>
                <a href="#aset-bmn">Aset BMN</a>
                <a href="#peraturan">Peraturan</a>
                <a href="#knmp">KNMP</a>
            </div>
        </div>

        <a href="#zona-integritas" class="top-link">Zona Integritas</a>
        <a href="#kontak-kami" class="top-link">Kontak Kami</a>
    </nav>

    <div class="topbar-profile">
        <div class="profile-avatar"><i data-lucide="user-round"></i></div>
        <div>
            <div class="profile-name">Rekan Pegawai</div>
            <div class="profile-role">Employee Workspace</div>
        </div>
    </div>
</header>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar" aria-hidden="true">
    <div class="sidebar-brand-row">
        <div class="brand">
            <div class="brand-logo"><i data-lucide="sparkles"></i></div>
            <div>
                <h2>DITPU</h2>
                <small>EMPLOYEE DIGITAL HUB</small>
            </div>
        </div>
        <button class="sidebar-close" id="closeSidebar" type="button" aria-label="Tutup menu">
            <i data-lucide="x"></i>
        </button>
    </div>

    <div class="menu-label">WORKSPACE</div>
    <nav>
        <a href="#" class="nav-link active"><i data-lucide="layout-dashboard"></i> Beranda</a>
        <a href="#tim-kerja" class="nav-link"><i data-lucide="users"></i> Tim Kerja & Subbagian</a>
        <a href="#pengaduan" class="nav-link"><i data-lucide="messages-square"></i> Ruang Pengaduan</a>
    </nav>

    <div class="menu-label">INFORMASI</div>
    <nav>
        <a href="#pengumuman" class="nav-link"><i data-lucide="megaphone"></i> Pengumuman</a>
        <a href="#agenda-event" class="nav-link"><i data-lucide="calendar-days"></i> Agenda</a>
        <a href="#akuntabilitas" class="nav-link"><i data-lucide="chart-no-axes-combined"></i> Akuntabilitas Kinerja</a>
    </nav>

    <div class="sidebar-info">
        <i data-lucide="heart-handshake"></i>
        <h4>Work better together!</h4>
        <p>Satu ruang digital untuk mendukung pekerjaan yang lebih mudah dan terorganisasi.</p>
    </div>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="layout">
<main class="main">

    <!-- WELCOME CAROUSEL -->
    <section class="welcome" aria-label="Informasi DITPU">
        <div class="welcome-slides">
            <article class="welcome-slide active">
                <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1600&q=85" alt="Suasana ruang kerja modern">
                <div class="welcome-content">
                    <div class="welcome-tag">✦ DITPU EMPLOYEE DIGITAL HUB</div>
                    <h1>Selamat Datang di Ruang Digital DITPU</h1>
                    <p>Temukan informasi, layanan, dan berbagai kebutuhan kerja dalam satu ruang digital yang terintegrasi untuk mendukung aktivitas kerja sehari-hari.</p>
                </div>
            </article>
            <article class="welcome-slide">
                <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1600&q=85" alt="Kolaborasi tim di lingkungan kerja">
                <div class="welcome-content">
                    <div class="welcome-tag">✦ KOLABORASI &amp; SINERGI</div>
                    <h1>Bersama, Mewujudkan Kinerja yang Lebih Baik</h1>
                    <p>Ruang untuk berbagi informasi, berkolaborasi, dan memperkuat sinergi antarpegawai dalam menjalankan tugas.</p>
                </div>
            </article>
            <article class="welcome-slide">
                <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1600&q=85" alt="Dokumen dan perencanaan kerja">
                <div class="welcome-content">
                    <div class="welcome-tag">✦ INFORMASI &amp; AKUNTABILITAS</div>
                    <h1>Informasi Kerja dalam Satu Akses</h1>
                    <p>Akses informasi kegiatan, kepegawaian, keuangan, aset, peraturan, serta akuntabilitas kinerja DITPU dengan lebih mudah.</p>
                </div>
            </article>
        </div>
        <div class="carousel-controls">
            <button class="carousel-arrow" id="slidePrev" type="button" aria-label="Slide sebelumnya"><i data-lucide="chevron-left"></i></button>
            <button class="carousel-arrow" id="slideNext" type="button" aria-label="Slide berikutnya"><i data-lucide="chevron-right"></i></button>
            <div class="carousel-dots" id="carouselDots">
                <button class="carousel-dot active" type="button" aria-label="Slide 1"></button>
                <button class="carousel-dot" type="button" aria-label="Slide 2"></button>
                <button class="carousel-dot" type="button" aria-label="Slide 3"></button>
            </div>
        </div>
    </section>

    <!-- TIM KERJA & SUBBAGIAN -->
    <section class="team-section" id="tim-kerja">
        <div class="section-header">
            <div>
                <h2>Tim Kerja &amp; Subbagian ✨</h2>
                <p>Kenali unit kerja dan akses informasi masing-masing bagian DITPU.</p>
            </div>
        </div>

        @php
        $teams = [
            ['Tim Kerja Pemetaan Usaha dan Investasi', 'map-pinned', '#edf1fc', '#526da8', '/pemetaan-usaha'],
            ['Tim Kerja Kewirausahaan', 'lightbulb', '#f0eafe', '#8768bb', '/tim-kerja/kewirausahaan'],
            ['Tim Kerja Kurasi Usaha', 'badge-check', '#e2f6ed', '#399775', '/tim-kerja/kurasi-usaha'],
            ['Tim Kerja Kelembagaan Kemitraan Usaha', 'handshake', '#fff1df', '#c58b42', '/tim-kerja/kelembagaan-kemitraan-usaha'],
            ['Tim Kerja Literasi Keuangan dan Akses Pembiayaan', 'wallet', '#e7efff', '#526da8', '/tim-kerja/literasi-keuangan'],
            ['Tim Kerja Perizinan dan Pendampingan Investasi', 'file-check', '#fff0eb', '#c47b67', '/tim-kerja/perizinan-investasi'],
            ['Subbagian Tata Usaha', 'briefcase-business', '#e9f4f5', '#438b91', '/tim-kerja/tata-usaha'],
        ];
        @endphp

        <div class="team-carousel">
            <div class="team-track" id="teamTrack">
                @foreach($teams as $team)
                <a href="{{ $team[4] }}" class="team-card">
                    <div class="team-icon" style="background:{{ $team[2] }};color:{{ $team[3] }}">
                        <i data-lucide="{{ $team[1] }}"></i>
                    </div>
                    <h3>{{ $team[0] }}</h3>
                    <p>Akses informasi, kegiatan, dan dokumen unit kerja.</p>
                    <div class="team-link">
                        <span>Lihat halaman</span>
                        <i data-lucide="arrow-up-right"></i>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <div class="team-controls">
            <button class="team-arrow" id="teamPrev" type="button" aria-label="Tim sebelumnya"><i data-lucide="chevron-left"></i></button>
            <div class="team-dots" id="teamDots"></div>
            <button class="team-arrow" id="teamNext" type="button" aria-label="Tim berikutnya"><i data-lucide="chevron-right"></i></button>
        </div>
    </section>

    <!-- RUANG PENGADUAN -->
    <section class="complaint-section" id="pengaduan">
        <div class="complaint-heading">
            <div class="complaint-heading-icon"><i data-lucide="messages-square"></i></div>
            <div>
                <h2>Ruang Pengaduan</h2>
                <p>Sampaikan aspirasi, laporan, maupun pengaduan untuk mendukung lingkungan kerja yang lebih baik.</p>
            </div>
        </div>

        <div class="complaint-tabs">
            <button class="complaint-tab active" type="button" data-tab="kirim">
                <i data-lucide="send"></i> Kirim Pengaduan
            </button>
            <button class="complaint-tab" type="button" data-tab="baca">
                <i data-lucide="message-circle"></i> Baca Pengaduan
            </button>
        </div>

        <!-- FORM PENGADUAN -->
        <div class="complaint-panel active" id="panel-kirim">
            <form class="complaint-form" action="{{ url('/pengaduan') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="kategori">Kategori Pengaduan</label>
                    <select name="kategori" id="kategori" required>
                        <option value="">Pilih kategori</option>
                        <option value="Sarana dan Prasarana">Sarana dan Prasarana</option>
                        <option value="Administrasi">Administrasi</option>
                        <option value="Pelayanan">Pelayanan</option>
                        <option value="Lingkungan Kerja">Lingkungan Kerja</option>
                        <option value="Saran dan Masukan">Saran dan Masukan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    @error('kategori') <div class="validation-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Judul Pengaduan</label>
                    <input type="text" name="judul" id="judul" maxlength="150"
                           value="{{ old('judul') }}" placeholder="Masukkan judul pengaduan" required>
                    @error('judul') <div class="validation-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="isi">Isi Pengaduan</label>
                    <textarea name="isi" id="isi" placeholder="Ceritakan pengaduan atau masukan Anda..." required>{{ old('isi') }}</textarea>
                    @error('isi') <div class="validation-message">{{ $message }}</div> @enderror
                </div>

                <div class="anonymous-option">
                    <input type="checkbox" name="anonim" value="1" id="anonim">
                    <label for="anonim">
                        <strong>Kirim secara anonim</strong><br>
                        Identitas Anda tidak ditampilkan kepada pembaca pengaduan yang dipublikasikan.
                    </label>
                </div>

                <button type="submit" class="submit-complaint">
                    <i data-lucide="send"></i> Kirim Pengaduan
                </button>
            </form>
        </div>

        <!-- DAFTAR PENGADUAN PUBLIK -->
        <div class="complaint-panel" id="panel-baca">
            <div style="margin-bottom:18px">
                <h3 style="font-size:13px;color:var(--navy)">Pengaduan yang Dipublikasikan</h3>
                <p style="font-size:10px;color:var(--muted);margin-top:6px">
                    Hanya pengaduan yang telah disetujui untuk ditampilkan. Identitas pelapor anonim tidak ditampilkan.
                </p>
            </div>

            @forelse(($pengaduans ?? []) as $pengaduan)
                <article class="public-complaint">
                    <div class="complaint-meta">
                        <span class="complaint-category">{{ $pengaduan->kategori }}</span>
                        <span>{{ $pengaduan->created_at->format('d M Y') }}</span>
                        <span>{{ $pengaduan->anonim ? 'Anonim' : 'Pegawai' }}</span>
                    </div>
                    <h3>{{ $pengaduan->judul }}</h3>
                    <p>{{ $pengaduan->isi }}</p>
                </article>
            @empty
                <div class="complaint-empty">
                    <i data-lucide="messages-square" style="width:35px;height:35px;margin-bottom:12px"></i>
                    <p>Belum ada pengaduan yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- PENGUMUMAN -->
    <section class="complaint-section" id="pengumuman" style="margin-top:25px">
        <div class="complaint-heading" style="margin-bottom:0">
            <div class="complaint-heading-icon" style="background:#fff2e2;color:#ce9550">
                <i data-lucide="megaphone"></i>
            </div>
            <div>
                <h2>Ruang Informasi Pegawai</h2>
                <p>Nantikan informasi, pengumuman, dan agenda terbaru melalui portal digital ini.</p>
            </div>
        </div>
    </section>

    <footer>
        <span>© 2026 DITPU · Employee Digital Hub</span>
        <span>Designed for better collaboration ♡</span>
    </footer>

</main>
</div>

<script>
/* ICONS */
lucide.createIcons();

/* TOPBAR DROPDOWN */
document.querySelectorAll('.dropdown-toggle').forEach(button => {
    button.addEventListener('click', event => {
        event.stopPropagation();
        const parent = button.closest('.top-dropdown');
        const wasOpen = parent.classList.contains('open');

        document.querySelectorAll('.top-dropdown.open').forEach(item => {
            item.classList.remove('open');
            item.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
        });

        if (!wasOpen) {
            parent.classList.add('open');
            button.setAttribute('aria-expanded', 'true');
        }
    });
});

document.addEventListener('click', event => {
    if (!event.target.closest('.top-dropdown')) {
        document.querySelectorAll('.top-dropdown.open').forEach(item => {
            item.classList.remove('open');
            item.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
        });
    }
});

document.querySelectorAll('.dropdown-menu a').forEach(link => {
    link.addEventListener('click', () => {
        document.querySelectorAll('.top-dropdown.open').forEach(item => {
            item.classList.remove('open');
            item.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
        });
    });
});

/* SIDEBAR OPEN/CLOSE */
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');
const menuToggle = document.getElementById('menuToggle');
const closeSidebar = document.getElementById('closeSidebar');

function openSidebar() {
    sidebar.classList.add('show');
    sidebarOverlay.classList.add('show');
    sidebar.setAttribute('aria-hidden', 'false');
    menuToggle.setAttribute('aria-expanded', 'true');
    document.body.classList.add('sidebar-open');
}
function hideSidebar() {
    sidebar.classList.remove('show');
    sidebarOverlay.classList.remove('show');
    sidebar.setAttribute('aria-hidden', 'true');
    menuToggle.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('sidebar-open');
}
menuToggle.addEventListener('click', () => {
    sidebar.classList.contains('show') ? hideSidebar() : openSidebar();
});
closeSidebar.addEventListener('click', hideSidebar);
sidebarOverlay.addEventListener('click', hideSidebar);
sidebar.querySelectorAll('a').forEach(link => link.addEventListener('click', hideSidebar));
document.addEventListener('keydown', event => {
    if (event.key === 'Escape') hideSidebar();
});

/* WELCOME CAROUSEL */
const slides = [...document.querySelectorAll('.welcome-slide')];
const dots = [...document.querySelectorAll('.carousel-dot')];
let currentSlide = 0;
let slideTimer;

function showSlide(index) {
    currentSlide = (index + slides.length) % slides.length;
    slides.forEach((slide, i) => slide.classList.toggle('active', i === currentSlide));
    dots.forEach((dot, i) => dot.classList.toggle('active', i === currentSlide));
}
function restartSlideTimer() {
    clearInterval(slideTimer);
    slideTimer = setInterval(() => showSlide(currentSlide + 1), 6000);
}
document.getElementById('slidePrev').addEventListener('click', () => {
    showSlide(currentSlide - 1);
    restartSlideTimer();
});
document.getElementById('slideNext').addEventListener('click', () => {
    showSlide(currentSlide + 1);
    restartSlideTimer();
});
dots.forEach((dot, i) => dot.addEventListener('click', () => {
    showSlide(i);
    restartSlideTimer();
}));
restartSlideTimer();

/* TEAM CAROUSEL */
const teamTrack = document.getElementById('teamTrack');
const teamCards = [...document.querySelectorAll('.team-card')];
const teamDots = document.getElementById('teamDots');
let teamIndex = 0;

function getTeamVisible() {
    if (window.innerWidth <= 600) return 1;
    if (window.innerWidth <= 900) return 2;
    return 3;
}
function renderTeamCarousel() {
    const visible = getTeamVisible();
    const maxIndex = Math.max(0, teamCards.length - visible);
    teamIndex = Math.min(teamIndex, maxIndex);

    if (!teamCards.length) return;

    const cardWidth = teamCards[0].getBoundingClientRect().width;
    const gap = 16;
    teamTrack.style.transform = `translateX(-${teamIndex * (cardWidth + gap)}px)`;

    const pages = maxIndex + 1;
    teamDots.innerHTML = '';

    for (let i = 0; i < pages; i++) {
        const dot = document.createElement('button');
        dot.className = 'team-dot' + (i === teamIndex ? ' active' : '');
        dot.type = 'button';
        dot.setAttribute('aria-label', 'Halaman ' + (i + 1));
        dot.addEventListener('click', () => {
            teamIndex = i;
            renderTeamCarousel();
        });
        teamDots.appendChild(dot);
    }

    document.getElementById('teamPrev').disabled = teamIndex === 0;
    document.getElementById('teamNext').disabled = teamIndex === maxIndex;
    document.getElementById('teamPrev').style.opacity = teamIndex === 0 ? '.45' : '1';
    document.getElementById('teamNext').style.opacity = teamIndex === maxIndex ? '.45' : '1';
}
document.getElementById('teamNext').addEventListener('click', () => {
    const maxIndex = Math.max(0, teamCards.length - getTeamVisible());
    teamIndex = Math.min(teamIndex + 1, maxIndex);
    renderTeamCarousel();
});
document.getElementById('teamPrev').addEventListener('click', () => {
    teamIndex = Math.max(teamIndex - 1, 0);
    renderTeamCarousel();
});
window.addEventListener('resize', renderTeamCarousel);

/* COMPLAINT TABS */
const complaintTabs = document.querySelectorAll('.complaint-tab');
const complaintPanels = document.querySelectorAll('.complaint-panel');

complaintTabs.forEach(tab => {
    tab.addEventListener('click', () => {
        complaintTabs.forEach(item => item.classList.remove('active'));
        complaintPanels.forEach(panel => panel.classList.remove('active'));

        tab.classList.add('active');
        document.getElementById('panel-' + tab.dataset.tab).classList.add('active');
    });
});

renderTeamCarousel();
</script>
</body>
</html>

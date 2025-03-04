<!DOCTYPE html>
<html>

<head>
    <title>HVAC - Free Website Template for HVAC</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="templatesjungle">
    <meta name="keywords" content="website template">
    <meta name="description" content="website template">

    <!--Bootstrap ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsLandingPage/css/bootstrap.min.css') }}">

    <!--vendor css ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsLandingPage/css/vendor.css') }}">


    <!--Link Swiper's CSS ================================================== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- Style Sheet ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsLandingPage/style.css') }}">

    <!-- Google Fonts ================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/wireframe/css/wireframe2.css')}}">

</head>

<body>
    <header id="header">
        <nav class="header-top">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center py-3">
                    <!-- Logo dan Nama -->
                    <a class="navbar-brand d-flex align-items-center" href="/">
                        <img src="{{ asset('assetsLandingPage/images/bpslogo.png') }}" class="logo img-fluid" style="max-width: 50px; height: auto;">
                        <span class="ms-2 fw-bold" style="font-size: 15px; font-style: italic; color: black;">BPS Kota Pekalongan</span>
                    </a>
                    <!-- Tombol Login -->
                    <a href="{{ route('login') }}"><i class="bi bi-person-circle"></i><u>Login</u></a>
                </div>
            </div>
        </nav>


        <hr class="m-0">
        <nav id="primary-header" class="navbar navbar-expand-lg py-3">
            <div class="container justify-content-end">
                <button class="nav  bar-toggler d-flex d-lg-none justify-content-end border-0 shadow-none p-0"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar"
                    aria-expanded="false">
                    <svg class="navbar-icon" width="60" height="60">
                        <use xlink:href="#navbar-icon"></use>
                    </svg>
                </button>
                <div class="header-bottom offcanvas offcanvas-end" id="bdNavbar"
                    aria-labelledby="bdNavbarOffcanvasLabel">
                    <div class="offcanvas-header px-4 mt-3 mb-1">
                        <button type="button" class="btn-close btn-close-black shadow-none" data-bs-dismiss="offcanvas"
                            aria-label="Close" data-bs-target="#bdNavbar"></button>
                    </div>
                    <div class="offcanvas-body align-items-center justify-content-center">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item px-3 py-1 py-lg-0">
                                <a class="nav-link active p-0" aria-current="page" href="#home">Home</a>
                            </li>
                            <li class="nav-item px-3 py-1 py-lg-0">
                                <a class="nav-link p-0" href="#about">About</a>
                            </li>
                            <li class="nav-item px-3 py-1 py-lg-0">
                                <a class="nav-link p-0" href="#register-information">Information</a>
                            </li>
                            <li class="nav-item px-3 py-1 py-lg-0">
                                <a class="nav-link p-0" href="#contact">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <section id="home">
        <div class="row align-items-center g-0 bg-secondary">
            <div class="col-lg-6">
                <div class="m-4 p-4 m-lg-5 p-lg-5">
                    <h2 class="display-4 fw-bold text-white my-4">
                        Jadilah Bagian dari Tim Kami, Daftar untuk Magang Sekarang!
                    </h2>
                    <a href="{{ route('internRegister.daftar') }}"
                        class="btn btn-light btn-bg btn-slide hover-slide-right mt-4">
                        <span>Click Here To Register</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-end">
                <img src="{{ asset('assetsLandingPage/images/bpspicture.jpeg') }}"
                     alt="img"
                     class="img-fluid"
                     style="padding-right: 80px;">
            </div>
        </div>
    </section>

    <section id="about" class="mt-5">
        <div class="container">
            <div class="row g-md-5 align-items-center">
                <div class="col-lg-5">
                    <div class="imageblock position-relative">
                       <img class="img-fluid" src="{{ asset('assetsLandingPage/images/team.png') }}" alt="img" style="max-width: 100%; height: auto; width: 450px;">
                    </div>
                </div>
                <div class="col-lg-7 mt-5">
                    <h6><span class="text-primary">|</span>About</h6>
                    <h3 class="display-6 fw-semibold mb-4">Magang di BPS Kota Pekalongan</h3>
                    <p style="text-align: justify;">
                        Kegiatan magang di BPS Kota Pekalongan adalah program pembelajaran praktis yang memberikan
                        kesempatan bagi mahasiswa dan pelajar untuk mendapatkan pengalaman kerja langsung di bidang
                        statistik. <span class="fw-semibold">Program ini dirancang untuk</span> memperkenalkan peserta
                        pada kegiatan operasional BPS, seperti pengumpulan, pengolahan, dan analisis data, serta
                        pemanfaatan teknologi informasi dalam penyusunan statistik. Melalui bimbingan dari tenaga ahli
                        profesional, peserta magang diharapkan dapat mengembangkan keterampilan teknis dan non-teknis
                        yang relevan, memahami peran penting data statistik dalam pembangunan daerah, serta
                        mempersiapkan diri untuk memasuki dunia kerja.
                    </p>
                    <p class="fw-semibold m-0">Our Mission</p>
                    <p style="text-align: justify;">
                        Tujuan dari kegiatan magang di BPS Kota Pekalongan adalah untuk memberikan pemahaman mendalam
                        kepada peserta mengenai peran penting data statistik dalam perencanaan dan evaluasi pembangunan.
                        Program ini bertujuan untuk membekali peserta dengan keterampilan teknis di bidang pengumpulan,
                        pengolahan, dan analisis data, serta meningkatkan kemampuan komunikasi, kerja sama tim, dan
                        pemecahan masalah di lingkungan profesional. Selain itu, kegiatan magang ini bertujuan
                        menciptakan generasi muda yang lebih siap menghadapi dunia kerja, mampu menerapkan ilmu
                        pengetahuan yang diperoleh di bangku kuliah, dan berkontribusi dalam pengembangan statistik yang
                        akurat dan bermanfaat bagi masyarakat.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section id="register-information" class="padding-small">
        {{-- Langkah Pendaftaran --}}
        <div class="container">
            <h3 class="text-center" style="margin-bottom: 50px;">Langkah Pendaftaran Magang Di BPS Kota Pekalongan
            </h3>
            <div class="swiper testimonial-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="step-item">
                            <div class="step">
                                <h5 class="step-title">Langkah 1: Pendaftaran</h5>
                                <p class="step-description">Isi formulir pendaftaran yang tersedia melalui website atau
                                    dengan datang langsung ke kantor BPS Kota Pekalongan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="step-item">
                            <div class="step">
                                <h5 class="step-title">Langkah 2: Seleksi Pendaftaran</h5>
                                <p class="step-description">Tim BPS akan menyeleksi data pendaftaran yang diterima,
                                    kemudian menginformasikan status penerimaan atau penolakan kepada calon peserta.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="step-item">
                            <div class="step">
                                <h5 class="step-title">Langkah 3: Antrian</h5>
                                <p class="step-description">Setelah pendaftaran disetujui, calon peserta tinggal
                                    menunggu waktu yang ditentukan untuk memulai kegiatan magang di BPS Kota Pekalongan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="step-item">
                            <div class="step">
                                <h5 class="step-title">Langkah 4: Penetapan Unit</h5>
                                <p class="step-description">Pada awal kegiatan magang, para peserta akan diarahkan ke
                                    divisi mana mereka akan ditempatkan selama magang berlangsung.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="step-item">
                            <div class="step">
                                <h5 class="step-title">Langkah 5: Magang</h5>
                                <p class="step-description">Peserta akan melaksanakan kegiatan magang dengan membantu
                                    tugas-tugas di divisi yang telah ditetapkan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="step-item">
                            <div class="step">
                                <h5 class="step-title">Langkah 6: Pelepasan dan Penilaian</h5>
                                <p class="step-description">Peserta akan dinilai berdasarkan kinerja selama magang dan
                                    diberikan sertifikat sebagai tanda penyelesaian program sebelum dilepas.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination position-relative pt-5"></div>
            </div>
        </div>

        {{-- Langkah Kegiatan Magang --}}
        <div class="container my-4">
            <h3 class="text-center" style="margin-bottom: 20px;">Apa Saja Sih Yang Dilakukan Ketika Magang di BPS?
            </h3>
            <div class="row text-center">
                <div class="col my-4" style="flex: 1;">
                    <img src="{{ asset('assetsLandingPage/images/pengumpulan data.png') }}"
                        class="brand-image img-fluid mb-3" alt="Langkah 2" style="max-width: 30%; height: auto;">
                    <h5>Pengumpulan Data</h5>
                    <p style="text-align: left; margin-top: 20px;">Peserta magang dapat terlibat langsung dalam
                        pengumpulan data yang diperlukan untuk survei dan penelitian yang dilakukan oleh BPS.</p>
                </div>
                <div class="col my-4" style="flex: 1;">
                    <img src="{{ asset('assetsLandingPage/images/pengolahan data.png') }}"
                        class="brand-image img-fluid mb-3" alt="Langkah 3" style="max-width: 30%; height: auto;">
                    <h5>Pengolahan Data</h5>
                    <p style="text-align: left; margin-top: 20px;">Peserta magang akan diajarkan bagaimana cara data
                        diolah, dianalisis, dan disajikan dengan menggunakan perangkat lunak statistik untuk
                        menghasilkan informasi yang berguna.</p>
                </div>
                <div class="col my-4" style="flex: 1;">
                    <img src="{{ asset('assetsLandingPage/images/documentation.png') }}"
                        class="brand-image img-fluid mb-3" alt="Langkah 4" style="max-width: 30%; height: auto;">
                    <h5>Pengelolaan Berkas</h5>
                    <p style="text-align: left; margin-top: 20px;">Peserta magang akan membantu dalam berbagai kegiatan
                        yang berkaitan dengan pengelolaan berkas, seperti penataan, pengorganisasian, serta penyimpanan
                        dokumen atau data yang ada.</p>
                </div>
                <div class="col my-4" style="flex: 1;">
                    <img src="{{ asset('assetsLandingPage/images/task.png') }}" class="brand-image img-fluid mb-3"
                        alt="Langkah 5" style="max-width: 30%; height: auto;">
                    <h5>Tugas Umum</h5>
                    <p style="text-align: left; margin-top: 20px;">Peserta magang akan terlibat dalam berbagai tugas
                        umum lainnya yang mendukung kegiatan operasional BPS, seperti desain, pembuatan laporan, serta
                        kegiatan administratif lainnya.</p>
                </div>
            </div>
        </div>

        {{-- Benefit Kegiatan Magang --}}
        <div class="container">
            <h3 class="text-center mb-5" style="margin-bottom: 20px;">Apa Benefit Dari Magang di BPS?</h3>
            <div class="row">
                <div class="text-center col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <img src="{{ asset('assetsLandingPage/images/job.png') }}" class="brand-image img-fluid mb-3"
                        alt="Langkah 4" style="max-width: 30%; height: auto;">
                    <h5 class="mt-3">Pengalaman Kerja Nyata</h5>
                    <p style="text-align: left; margin-top: 20px;">Peserta magang mendapatkan pengalaman langsung dalam
                        dunia kerja profesional di bidang statistik dan analisis data.</p>
                </div>
                <div class="text-center col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <img src="{{ asset('assetsLandingPage/images/teach.png') }}" class="brand-image img-fluid mb-3"
                        alt="Langkah 4" style="max-width: 30%; height: auto;">
                    <h5 class="mt-3">Bimbingan Profesional</h5>
                    <p style="text-align: left; margin-top: 20px;">Peserta akan dibimbing oleh tenaga profesional yang
                        berpengalaman di bidang statistik.</p>
                </div>
                <div class="text-center col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <img src="{{ asset('assetsLandingPage/images/network.png') }}" class="brand-image img-fluid mb-3"
                        alt="Langkah 4" style="max-width: 30%; height: auto;">
                    <h5 class="mt-3">Peluang Networking</h5>
                    <p style="text-align: left; margin-top: 20px;">Kesempatan untuk membangun relasi dengan para
                        profesional dan sesama peserta magang.</p>
                </div>
                <div class="text-center col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <img src="{{ asset('assetsLandingPage/images/certificate.png') }}"
                        class="brand-image img-fluid mb-3" alt="Langkah 4" style="max-width: 30%; height: auto;">
                    <h5 class="mt-3">Sertifikat Program</h5>
                    <p style="text-align: left; margin-top: 20px;">Sertifikat resmi yang dapat digunakan sebagai bukti
                        pengalaman dalam dunia kerja.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="padding-small" style="margin-top: -30px;">
        <div class="container text-center">
            <h3 class="display-6 fw-semibold mb-4">Kirim Pesan Kepada Kami</h3>
            <form class="contact-form row mt-5">
                <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                    <input type="text" name="name" placeholder="Full Name*"
                        class="form-control w-100 ps-3 py-2 rounded-0" required>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                    <input type="email" name="email" placeholder="Email*"
                        class="form-control w-100 ps-3 py-2 rounded-0" required>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                    <input type="text" name="phone" placeholder="Phone*"
                        class="form-control w-100 ps-3 py-2 rounded-0" required>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                    <input type="text" name="address" placeholder="Address*"
                        class="form-control w-100 ps-3 py-2 rounded-0" required>
                </div>
                <div class="col-md-12 col-sm-12 mb-4">
                    <textarea class="form-control w-100 ps-3 py-2 rounded-0" rows="6" type="text" name="message"
                        placeholder="Message"></textarea>
                </div>
                <div class="col-12">
                    <a href="index.html" class="btn btn-primary btn-slide hover-slide-right mt-4">
                        <span>Send now</span>
                    </a>
                </div>
            </form>
        </div>
    </section>

    <footer id="footer">
        <hr class="m-0">
        <div class="container">
            <div class="footer-bottom d-md-flex justify-content-between py-4">
                <p class=" mb-0">© 2024 HVAC - All rights reserved</p>
                <p class=" mb-0">HTML Templates by: <a href="https://templatesjungle.com/" target="_blank"
                        class="text-decoration-underline fw-semibold "> TemplatesJungle</a> Distributed by: <a
                        href="https://themewagon.com" target="blank"
                        class="text-decoration-underline fw-semibold">ThemeWagon</a> </p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assetsLandingPage/js/jquery-1.11.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assetsLandingPage/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('assetsLandingPage/js/script.js') }}"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>

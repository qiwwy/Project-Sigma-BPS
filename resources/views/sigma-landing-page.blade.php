<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Logis Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets-sigma/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets-sigma/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets-sigma/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-sigma/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-sigma/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-sigma/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-sigma/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-sigma/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-sigma/css/main.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="{{asset('assets/wireframe/css/wireframe2.css')}}"> --}}
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="#hero" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('assetsLandingPage/images/logo bps.png') }}" alt="">
                <h1 class="sitename">BPS Kota Pekalongan</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home<br></a></li>
                    <li><a href="#about">About</a></li>
                    <li class="dropdown"><a href="#"><span>Pedoman</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#magang">Program Magang</a></li>
                            <li class="dropdown"><a href="#program-magang"><span>Pendaftaran Magang</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#online">Pendaftaran Online</a></li>
                                    <li><a href="#offline">Pendaftaran Offline</a></li>
                                </ul>
                            </li>
                            <li><a href="#program">Program Tersedia</a></li>
                            <li><a href="#galeri">Galeri</a></li>
                        </ul>
                    </li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <img src="{{ asset('assets-sigma/img/world-dotted-map.png') }}" alt="" class="hero-bg"
                data-aos="fade-in">

            <div class="container">
                <div class="row gy-4 d-flex justify-content-between">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2 data-aos="fade-up">Jadilah Bagian dari Tim Kami, Daftar untuk Magang Sekarang!</h2>
                        <a href="{{ route('internRegister.daftar') }}" class="btn btn-primary btn-lg mt-4"
                            style="width: 100%; max-width: 400px;">
                            <strong>Detail Informasi Magang</strong>
                        </a>
                    </div>

                    <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                        <img src="{{ asset('assets-sigma/img/hero-img.svg') }}" class="img-fluid mb-3 mb-lg-0"
                            alt="">
                    </div>
                </div>
            </div>
        </section><!-- /Hero Section -->


        <section id="about" class="about section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 position-relative align-self-start order-lg-last order-first"
                        data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ asset('assets-sigma/img/bpspicture.jpeg') }}" class="img-fluid" alt="">
                        <a href="{{ asset('assetsLandingPage/images/bpsvidio.mp4') }}"
                            class="glightbox pulsating-play-btn"></a>
                    </div>

                    <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100">
                        <h3>About Us</h3>
                        <p>
                            <strong>Badan Pusat Statistik Kota Pekalongan</strong> (BPS Kota Pekalongan) adalah lembaga
                            pemerintah yang bertugas menyediakan data statistik yang akurat dan terpercaya untuk
                            mendukung perencanaan pembangunan di Kota Pekalongan. BPS Kota Pekalongan menghasilkan
                            informasi penting terkait berbagai sektor, seperti ekonomi, sosial, dan kependudukan, yang
                            digunakan oleh pemerintah daerah dan masyarakat untuk pengambilan keputusan berbasis data.
                            Terletak di Jl. Singosari, Podosugih, Kota Pekalongan, BPS Kota Pekalongan berperan aktif
                            dalam menyajikan data statistik yang relevan untuk mendukung pembangunan kota yang lebih
                            baik dan berkelanjutan.
                        </p>
                        <h5>Magang ?</h5>
                        <p>
                            Seiring dengan perannya, BPS Kota Pekalongan juga membuka kesempatan magang bagi pelajar dan
                            mahasiswa untuk memperoleh pengalaman langsung dalam pengolahan data statistik dan berbagai
                            kegiatan terkait, sehingga peserta dapat mengembangkan keterampilan serta pengetahuan di
                            bidang statistik sambil mendukung kegiatan statistik di tingkat kota.
                        </p>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

        <section id="magang" class="about section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 position-relative align-self-start order-lg-first order-last"
                        data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ asset('assets-sigma/img/magang2.jpg') }}" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 content order-lg-last order-first" data-aos="fade-up" data-aos-delay="100">
                        <h3>Program Magang</h3>
                        <p>
                            Kegiatan magang di BPS Kota Pekalongan memberikan kesempatan bagi pelajar dan mahasiswa
                            untuk terlibat langsung dalam berbagai proses pengolahan dan analisis data statistik. Selama
                            magang, peserta akan mempelajari cara pengumpulan data melalui survei, sensus, dan
                            penelitian, serta bagaimana data tersebut dianalisis untuk menghasilkan informasi yang
                            berguna bagi perencanaan pembangunan kota. Program magang ini juga memungkinkan peserta
                            untuk bekerja dengan alat statistik modern dan mendapatkan pengalaman praktis yang dapat
                            meningkatkan keterampilan mereka di bidang statistik, penelitian, dan analisis data.
                        </p>
                        <h5>Tujuan dan Manfaat</h5>
                        <p>
                            Program magang di BPS Kota Pekalongan bertujuan memberikan pengalaman langsung kepada
                            pelajar dan mahasiswa dalam pengolahan data statistik, serta memperkenalkan mereka pada
                            peran penting data dalam perencanaan pembangunan kota. Selain itu, program ini memberikan
                            kesempatan kepada peserta untuk mengembangkan keterampilan teknis dalam analisis data,
                            penggunaan perangkat statistik, dan pengolahan informasi, yang berguna untuk memperkaya
                            portofolio mereka. Melalui program magang ini, peserta juga akan mendapatkan wawasan praktis
                            yang dapat mendukung karier mereka di bidang statistik, penelitian, dan analisis data,
                            sekaligus memperluas jaringan profesional di sektor pemerintahan.
                        </p>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

        <section id="online" class="features section">
            <div class="container">
                <div class="row gy-4 align-items-center features-item">
                    <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                        <h3>Pendaftaran Online</h3>
                        <p>
                            Untuk menjadi anggota magang di BPS Kota Pekalongan, calon peserta dapat melakukan
                            pendaftaran secara online melalui situs magang yang dimiliki BPS Kota Pekalongan.
                            Pendaftaran yang dilakukan secara online tentu memberikan kemudahan tersendiri bagi pelajar
                            dan mahasiswa untuk mendaftar dan bergabung dalam program magang yang menawarkan pengalaman
                            langsung di bidang statistik dan pengolahan data.
                        </p>
                        <h6 style="margin-top: 20px;">Langkah Pendaftaran Online</h6>
                        <ul style="list-style-type: none; padding-left: 0;">
                            <li style="margin-bottom: 20px;">
                                <div class="row align-items-start">
                                    <div class="col-auto">
                                        <i class="bi bi-1-circle-fill" style="font-size: 1.5rem; color: #007bff;"></i>
                                    </div>
                                    <div class="col">
                                        <span>Calon peserta dapat mengakses website resmi magang BPS Kota Pekalongan dan
                                            mengisi <a href="" style="text-decoration: underline;">formulir</a>
                                            pendaftaran yang tersedia di sana untuk memulai proses pendaftaran. Pastikan
                                            untuk melengkapi semua informasi yang diminta agar proses pendaftaran
                                            berjalan lancar.</span>
                                    </div>
                                </div>
                            </li>
                            <li style="margin-bottom: 20px;">
                                <div class="row align-items-start">
                                    <div class="col-auto">
                                        <i class="bi bi-2-circle-fill" style="font-size: 1.5rem; color: #007bff;"></i>
                                    </div>
                                    <div class="col">
                                        <span>Setelah mengirim formulir pendaftaran, calon peserta akan menerima email
                                            konfirmasi yang berisi informasi penting mengenai status pendaftaran mereka.
                                            Email tersebut dapat digunakan untuk memantau apakah pendaftaran berhasil
                                            diterima atau masih dalam proses verifikasi.</span>
                                    </div>
                                </div>
                            </li>
                            <li style="margin-bottom: 20px;">
                                <div class="row align-items-start">
                                    <div class="col-auto">
                                        <i class="bi bi-3-circle-fill" style="font-size: 1.5rem; color: #007bff;"></i>
                                    </div>
                                    <div class="col">
                                        <span>Jika calon peserta menerima konfirmasi bahwa pendaftarannya diterima,
                                            calon peserta dapat mengunjungi website untuk memeriksa informasi lebih
                                            lanjut mengenai <a href=""
                                                style="text-decoration: underline;">jadwal keberangkatan</a>, termasuk
                                            tanggal kapan kegiatan akan dimulai.</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row align-items-start">
                                    <div class="col-auto">
                                        <i class="bi bi-4-circle-fill" style="font-size: 1.5rem; color: #007bff;"></i>
                                    </div>
                                    <div class="col">
                                        <span>Setelah calon peserta mengetahui jadwal keberangkatan melalui pengecekan
                                            di website, langkah selanjutnya adalah mengikuti instruksi lebih lanjut dari
                                            BPS Kota Pekalongan mengenai persiapan sebelum magang dimulai, seperti
                                            orientasi atau pelatihan yang diperlukan.</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div><!-- Features Item -->
            </div>
        </section>

        <section id="offline" class="features section">
            <div class="container">
                <div class="row gy-4 align-items-center features-item">
                    <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                        <h3>Pendaftaran Offline</h3>
                        <p>
                            Selain dapat dilakukan secara <a href="#online">online</a>, calon peserta yang tertarik
                            untuk menjadi anggota magang di BPS Kota Pekalongan juga memiliki opsi untuk melakukan
                            pendaftaran secara offline. Pendaftaran ini dapat dilakukan dengan cara langsung mendatangi
                            gedung BPS Kota Pekalongan yang terletak di Jl. Singosari, Podosugih, Kota Pekalongan. Di
                            sana, peserta dapat mengisi formulir pendaftaran yang tersedia dan menyerahkan
                            dokumen-dokumen yang diperlukan secara langsung kepada petugas yang bertugas.
                        </p>
                        <h6 style="margin-top: 20px;">Langkah Pendaftaran Offline</h6>
                        <ul style="list-style-type: none; padding-left: 0;">
                            <li style="margin-bottom: 20px;">
                                <div class="row align-items-start">
                                    <div class="col-auto">
                                        <i class="bi bi-1-circle-fill" style="font-size: 1.5rem; color: #007bff;"></i>
                                    </div>
                                    <div class="col">
                                        <span>
                                            Calon peserta yang ingin melakukan pendaftaran kegiatan magang di BPS Kota
                                            Pekalongan dapat langsung mendatangi gedung BPS untuk mendapatkan informasi
                                            lengkap mengenai program magang yang sedang berlangsung. Di sana, peserta
                                            dapat memperoleh penjelasan mengenai persyaratan pendaftaran, jumlah kuota
                                            peserta yang tersedia, dan tahapan seleksi yang harus dilalui.</span>
                                    </div>
                                </div>
                            </li>
                            <li style="margin-bottom: 20px;">
                                <div class="row align-items-start">
                                    <div class="col-auto">
                                        <i class="bi bi-2-circle-fill" style="font-size: 1.5rem; color: #007bff;"></i>
                                    </div>
                                    <div class="col">
                                        <span>
                                            Jika informasi yang diberikan sudah sesuai dengan kebutuhan calon peserta,
                                            mereka dapat meminta formulir pendaftaran kepada petugas. Setelah itu, calon
                                            peserta diharapkan untuk mengisi formulir tersebut dengan lengkap dan
                                            menyerahkan dokumen-dokumen yang dibutuhkan untuk melengkapi proses
                                            pendaftaran.
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <li style="margin-bottom: 20px;">
                                <div class="row align-items-start">
                                    <div class="col-auto">
                                        <i class="bi bi-3-circle-fill" style="font-size: 1.5rem; color: #007bff;"></i>
                                    </div>
                                    <div class="col">
                                        <span>Setelah calon peserta mengisi formulir pendaftaran dan menyerahkannya
                                            kepada petugas, mereka dapat pulang dan menunggu konfirmasi lebih lanjut
                                            terkait status pendaftaran melalui nomor WhatsApp yang telah
                                            disediakan.</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row align-items-start">
                                    <div class="col-auto">
                                        <i class="bi bi-4-circle-fill" style="font-size: 1.5rem; color: #007bff;"></i>
                                    </div>
                                    <div class="col">
                                        <span>Apabila calon peserta telah diterima, mereka akan menerima pesan melalui
                                            nomor WhatsApp yang berisi informasi mengenai status penerimaan mereka,
                                            serta rincian terkait jadwal keberangkatan yang akan datang, termasuk
                                            tanggal dan waktu yang telah ditentukan untuk memulai kegiatan
                                            magang.</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="program" class="pricing section">

            <div class="container section-title" data-aos="fade-up">
                <span>Apa Saja Sih Yang Dilakukan Ketika Magang</span>
                <h2>Apa Saja Sih Yang Dilakukan Ketika Magang di BPS?</h2>
            </div>

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6 col-sm-12" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pricing-item featured" style="text-align: center;">
                            <img src="{{ asset('assetsLandingPage/images/pengumpulan data.png') }}"
                                class="brand-image img-fluid mb-3" alt="Langkah 2"
                                style="max-width: 75%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                            <h6>Pengumpulan Data</h6>
                            <span style="text-align: between; display: block; margin-top: 5%">Peserta magang di BPS
                                Kota Pekalongan akan terlibat langsung dalam pengumpulan data untuk survei dan
                                penelitian yang dilakukan oleh BPS, memberikan mereka pemahaman tentang pentingnya data
                                yang akurat dalam mendukung perencanaan dan kebijakan publik.</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pricing-item featured" style="text-align: center;">
                            <img src="{{ asset('assetsLandingPage/images/pengolahan data.png') }}"
                                class="brand-image img-fluid mb-3" alt="Langkah 2"
                                style="max-width: 75%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                            <h6>Pengolahan Data</h6>
                            <span style="text-align: between; display: block; margin-top: 5%">Peserta magang akan
                                diajarkan bagaimana cara mengolah, menganalisis, dan menyajikan data menggunakan
                                perangkat lunak statistik, sehingga dapat menghasilkan informasi yang akurat dan berguna
                                untuk mendukung keputusan dan perencanaan yang lebih baik.</span>
                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="col-lg-3 col-md-6 col-sm-12" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pricing-item featured" style="text-align: center;">
                            <img src="{{ asset('assetsLandingPage/images/documentation.png') }}"
                                class="brand-image img-fluid mb-3" alt="Langkah 2"
                                style="max-width: 75%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                            <h6>Pengelolaan Berkas</h6>
                            <span style="text-align: between; display: block; margin-top: 5%">Peserta magang akan
                                terlibat dalam pengelolaan berkas, termasuk penataan, pengorganisasian, dan penyimpanan
                                dokumen serta data, baik secara fisik maupun digital, untuk mendukung kelancaran
                                administrasi di BPS Kota Pekalongan.</span>
                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="col-lg-3 col-md-6 col-sm-12" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pricing-item featured" style="text-align: center;">
                            <img src="{{ asset('assetsLandingPage/images/task.png') }}"
                                class="brand-image img-fluid mb-3" alt="Langkah 2"
                                style="max-width: 75%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                            <h6>Tugas Umum</h6>
                            <span style="text-align: between; display: block; margin-top: 5%">Peserta magang akan
                                terlibat dalam berbagai tugas
                                umum lainnya yang mendukung kegiatan operasional BPS, seperti desain, pembuatan laporan,
                                serta
                                kegiatan administratif lainnya.</span>
                        </div>
                    </div><!-- End Pricing Item -->
                </div>


            </div>

        </section>

        <section id="galeri" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Galeri Kegiatan Magang<br></span>
                <h2>Galeri Kegiatan Magang</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ asset('assetsLandingPage/images/desain.jpg') }}" alt=""
                                    class="img-fluid"
                                    style="object-fit: cover; object-position: center; height: 250px; width: 100%;">
                            </div>
                            <h3>Desain</h3>
                            <p>Dokumentasi peserta magang yang sedang membuat desain inforgrafis dengan data yang sudah
                                disediakan dari BPS.</p>
                        </div>
                    </div><!-- End Card Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ asset('assetsLandingPage/images/pelayanan.jpg') }}" alt=""
                                    class="img-fluid"
                                    style="object-fit: cover; object-position: center; height: 250px; width: 100%;">
                            </div>
                            <h3>Pelayanan</h3>
                            <p>Foto dari peserta magang yang sedang melakukan pelayanan di pojok statistik kepada
                                masyarakat yang membutuhan data dari BPS.</p>
                        </div>
                    </div><!-- End Card Item -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ asset('assetsLandingPage/images/pojok.jpg') }}" alt=""
                                    class="img-fluid"
                                    style="object-fit: cover; object-position: center; height: 250px; width: 100%;">
                            </div>
                            <h3>Kerjasama</h3>
                            <p>Potret para peserta magang yang saling bekerjasama dalam mempersiapkan launching pojok
                                statistik yang merupakan program dari BPS.</p>
                        </div>
                    </div><!-- End Card Item -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ asset('assetsLandingPage/images/sampah.jpg') }}" alt=""
                                    class="img-fluid"
                                    style="object-fit: cover; object-position: center; height: 250px; width: 100%;">
                            </div>
                            <h3>Sosialisasi</h3>
                            <p>Peserta magang bersama BPS Kota Pekalongan ikut melestarikan dan meramaikan program bank
                                sampak melalui bank sampah rintisan.</p>
                        </div>
                    </div><!-- End Card Item -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ asset('assetsLandingPage/images/setuppc.jpg') }}" alt=""
                                    class="img-fluid"
                                    style="object-fit: cover; object-position: center; height: 250px; width: 100%;">
                            </div>
                            <h3>Perbaikan</h3>
                            <p>Dokumentasi peserta magang yang sedang melakukan perbaikan terhadap salah satu komputer
                                yang ada di kantor BPS.</p>
                        </div>
                    </div><!-- End Card Item -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ asset('assetsLandingPage/images/pelepasan.jpg') }}" alt=""
                                    class="img-fluid"
                                    style="object-fit: cover; object-position: center; height: 250px; width: 100%;">
                            </div>
                            <h3>Pelepasan</h3>
                            <p>Potret lepas sambut dari peserta magang waktu kegiatan magang sudah berakhir.</p>
                        </div>
                    </div><!-- End Card Item -->
                </div>

            </div>

        </section><!-- /Services Section -->

        <section id="contact" class="contact section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
                    <iframe style="border:0; width: 100%; height: 270px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9674976703145!2d109.66065147475682!3d-6.894491193104644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70242aec8fe921%3A0xa9a082c02717dfdd!2sBadan%20Pusat%20Statistik%20Kota%20Pekalongan!5e0!3m2!1sen!2sid!4v1734701213589!5m2!1sen!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" frameborder="0" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div><!-- End Google Maps -->

                <div class="row gy-4">

                    <div class="col-lg-4">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Alamat Lengkap</h3>
                                <p>Jl. Singosari, Podosugih, Kec. Pekalongan Bar., Kota Pekalongan, Jawa Tengah 51111
                                </p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Hubungi Kami</h3>
                                <p>(0285) 423504</p>
                            </div>
                        </div><!-- End Info Item -->



                    </div>
                    <div class="col-lg-4">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Alamat Email</h3>
                                <p>bps3375@bps.go.id</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <a href="https://www.instagram.com/bpspklkota/"><i
                                    class="bi bi-instagram flex-shrink-0"></i>
                            </a>
                            <div>
                                <h3>Instagram</h3>
                                <p>@bpspklkota</p>
                            </div>
                        </div><!-- End Info Item -->



                    </div>
                    <div class="col-lg-4">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                            <a href="https://www.facebook.com/bpspklkota/?locale=id_ID"> <i
                                    class="bi bi-facebook flex-shrink-0"></i>
                            </a>
                            <div>
                                <h3>Facebook</h3>
                                <p>BPS Kota Pekalongan</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <a href="https://x.com/bpspklkota"> <i class="bi bi-twitter flex-shrink-0"></i>
                            </a>
                            <div>
                                <h3>Twitter</h3>
                                <p>@bpspkllota</p>
                            </div>
                        </div><!-- End Info Item -->
                    </div>
                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer dark-background">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-7 col-md-12 footer-about" style="display: flex; align-items: flex-start;">
                    <a href="#hero" class="logo d-flex align-items-center" style="margin-right: 8px;">
                        <img src="{{ asset('assetsLandingPage/images/logo bps.png') }}" alt="Logo BPS" style="max-width: 40px; height: auto;">
                    </a>
                    <div>
                        <span class="sitename" style="font-size: 1.5rem; font-weight: bold; display: block; margin-bottom: 10px;">
                            BPS Kota Pekalongan
                        </span>
                        <p style="margin: 0; font-size: 0.9rem; line-height: 1.6;">
                            BPS Kota Pekalongan adalah lembaga pemerintah yang menyediakan data statistik akurat untuk
                            mendukung perencanaan pembangunan di Kota Pekalongan. Berlokasi di Jl. Singosari, Podosugih,
                            lembaga ini menghasilkan informasi penting tentang ekonomi, sosial, dan kependudukan untuk
                            pengambilan keputusan berbasis data, mendukung pembangunan kota yang berkelanjutan.
                        </p>
                        <div class="social-links d-flex mt-4" style="margin-top: 20px;">
                            <a href="https://x.com/bpspklkota" style="margin-right: 10px;"><i class="bi bi-twitter"></i></a>
                            <a href="https://www.facebook.com/bpspklkota/?locale=id_ID" style="margin-right: 10px;"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/bpspklkota/"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                </div>



                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#hero">Home</a></li>
                        <li><a href="#about">About us</a></li>
                        <li><a href="#online">Pendaftaran Online</a></li>
                        <li><a href="#offline">Pendaftaran Offline</a></li>
                        <li><a href="#program">Program Tersedia</a></li>
                        <li><a href="#galeri">Galeri</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>Jl. Singosari, Podosugih<br>Kota Pekalongan, Jawa Tengah<br>Indonesia</p>
                    <p class="mt-4"><strong>Phone:</strong> <span>+62 285 424123</span></p>
                    <p><strong>Email:</strong> <span>bpspklkota@bps.go.id</span></p>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">BPS Kota Pekalongan</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
            </div>
        </div>
    </footer>


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets-sigma/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-sigma/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets-sigma/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets-sigma/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets-sigma/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets-sigma/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets-sigma/js/main.js') }}"></script>

</body>

</html>

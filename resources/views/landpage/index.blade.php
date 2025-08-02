<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>BIOSHILD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Description website">
    <meta name="author" content="Maksym Blank">
    <meta name="keywords" content="website, with, meta, tags">
    <meta name="robots" content="noindex, follow">
    <meta name="revisit-after" content="5 month">
    <meta name="image" content="http://mywebsite.com/image.jpg">
    <meta name="og:title" content="Title website">
    <meta name="og:description" content="Description website">
    <meta name="og:image" content="http://mywebsite.com/image.jpg">
    <meta name="og:site_name" content="My Website">
    <meta name="og:type" content="website">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Title website">
    <meta name="twitter:description" content="Description website">
    <link href="{{ asset('/landpage/css/plugins/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/landpage/css/plugins/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('/landpage/css/plugins/ion.rangeSlider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/landpage/css/plugins/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('/landpage/css/plugins/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('/landpage/css/style.css') }}" class="color-changing" rel="stylesheet">
    <!--<link href="{{ asset('/landpage/css/plugins/custom-style.css') }}" class="color-changing" rel="stylesheet">-->

    <link href="{{ asset('/landpage/fonts/font-awesome.min.css') }}" class="color-changing" rel="stylesheet">
    <link href="{{ asset('/landpage/fonts/flaticon/flaticon.css') }}" class="color-changing" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">

</head>

<body class="btn-style-5 sigma_header-absolute btn-rounded sidebar-style-3">
    <div class="sigma_aside-overlay aside-trigger">
    </div>
    <header class="sigma_header header-absolute style-5 other can-sticky">
        <div class="sigma_header-top dark-bg d-none d-md-block">
            <div class="container-fluid">
                <div class="sigma_header-top-inner">
                    <div class="sigma_header-top-links">
                        <ul class="sigma_header-top-nav">
                            <li>
                                <a href="#">
                                    <i class="fal fa-envelope"></i>
                                    financeiro@bioshild.com.br
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fal fa-map-marker-alt"></i>
                                    Presidente Prudente, São Paulo
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="sigma_header-middle">
            <div class="container-fluid">
                <div class="navbar">
                    <div class="sigma_logo-wrapper">
                        <a class="sigma_logo">
                            <img src="{{ asset('landpage/img/logo-light.png') }}" alt="logo">
                        </a>
                    </div>
                    <div class="sigma_header-controls style-2">
                        <ul class="sigma_header-controls-inner">
                            <li class="contact-btn">
                                <a href="{{ route('login.view') }}" target="_blank" class="sigma_btn btn-sm">
                                    Área Restrita
                                    <i class="fal fa-arrow-right"></i>
                                </a>
                            </li>
                            <li class="aside-toggle aside-trigger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="search-form-wrapper">
        <div class="search-trigger sigma_close">
            <span></span>
            <span></span>
        </div>
        <form class="search-form" method="post">
            <input type="text" placeholder="Search..." value="">
            <button type="submit" class="search-btn">
                <i class="fal fa-search m-0"></i>
            </button>
        </form>
    </div>
    <!--Section End-->
    <!--Section Start-->
    <div class="sigma_banner style-8">
        <div class="sigma_banner-slider">
            <div class="banner-slider-inner bg-center bg-cover secondary-overlay"
                style="background-image: url({{ asset('landpage/img/home-1/1920x1280.jpg') }});">
                <div class="sigma_banner-text text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <h5 class="text-white">Tecnologia e Expertise para Reduzir Riscos e Proteger Pacientes
                                </h5>
                                <h1 class="title text-white">

                                    Segurança e Saúde em Primeiro Lugar

                                </h1>
                                <div class="banner-links d-flex align-items-center justify-content-center">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="banner-slider-inner bg-center bg-cover secondary-overlay"
                style="background-image: url({{ asset('landpage/img/home-1/1920x1280-1.jpg') }});">
                <div class="sigma_banner-text text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <h5 class="text-white">Protegendo Vidas com Controle Eficaz de Infecções Hospitalares
                                </h5>
                                <h1 class="title text-white">

                                    Soluções Integradas para Manter Seu Hospital Seguro e Saudável

                                </h1>
                                <div class="banner-links d-flex align-items-center justify-content-center">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="sigma_banner-info style-2">
        <div class="container">
            <div class="sigma_cta style-13">
                <h4>Bem-vindo à <span>BIOSHILD</span></h4>
                <p>Segurança e saúde são prioridades absolutas no cuidado com o paciente. A BIOSHILD 
                é a solução ideal para instituições de saúde que buscam excelência no controle da CCIH,  
                gestão hospitalar integrada e promoção da segurança do paciente. Desenvolvido com foco em qualidade e eficiência, 
                nosso sistema reúne funcionalidades avançadas para garantir um atendimento seguro, padronizado e em conformidade com as melhores práticas.</p>
            </div>
        </div>
    </div>
    <!--Section End-->
    <!--Section Start-->
    <div class="section" style="padding: 60px 0; background-color: #ffffff;">
        <div class="container" style="position: relative; z-index: 1;">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="sigma_about style-16" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 30px; margin: 20px 0; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); backdrop-filter: blur(5px);">
                        <div class="text-center">
                            <h6 class="title" style="font-size: 2rem; margin-bottom: 30px;">Soluções Inteligentes para um Ambiente Hospitalar Seguro</h6>
                        </div>
                        <div class="sigma_about-content">
                            <p class="text-center" style="font-size: 1.2rem; line-height: 1.8;">O Bioshild é uma plataforma completa e integrada voltada à gestão hospitalar, com foco em Segurança do Paciente e na Comissão de Controle de Infecção Hospitalar (CCIH). Com módulos especializados, o sistema proporciona controle total sobre os processos assistenciais, reduzindo riscos, melhorando a gestão e promovendo a conformidade com normas sanitárias.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Section End-->
    <!--Section Start-->
    <div class="section sigma_about-sec style-16" style="padding: 120px 0; position: relative; overflow: hidden;">
        <div class="sigma_about-sec-bg secondary-overlay" style="background-image: url({{ asset('landpage/img/home-1/1920x1280-4.jpg') }}); background-attachment: fixed; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="info-balloon" style="background: rgba(255, 255, 255, 0.95); border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                                <h2 class="mb-4 text-center">Benefícios Reais para sua Gestão Hospitalar</h2>
                                <div class="benefits-list" style="font-size: 1.1rem; line-height: 1.8;">
                                    <p><i class="fas fa-check-circle" style="color: #4CAF50; margin-right: 10px;"></i> Redução de infecções hospitalares</p>
                                    <p><i class="fas fa-check-circle" style="color: #4CAF50; margin-right: 10px;"></i> Melhoria na rastreabilidade e auditorias</p>
                                    <p><i class="fas fa-check-circle" style="color: #4CAF50; margin-right: 10px;"></i> Conformidade com a ANVISA e CNES</p>
                                    <p><i class="fas fa-check-circle" style="color: #4CAF50; margin-right: 10px;"></i> Capacitação contínua da equipe</p>
                                    <p><i class="fas fa-check-circle" style="color: #4CAF50; margin-right: 10px;"></i> Otimização da assistência e redução de custos</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-balloon" style="background: rgba(255, 255, 255, 0.95); border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                                <h2 class="mb-4 text-center">Tecnologia de Ponta com Alta Segurança</h2>
                                <div class="security-list" style="font-size: 1.1rem; line-height: 1.8;">
                                    <p><i class="fas fa-shield-alt" style="color: #4CAF50; margin-right: 10px;"></i> Hospedagem em nuvem com Data Center TIER 3+</p>
                                    <p><i class="fas fa-shield-alt" style="color: #4CAF50; margin-right: 10px;"></i> Certificações ISO 27001 / SOC 1, 2 e 3</p>
                                    <p><i class="fas fa-shield-alt" style="color: #4CAF50; margin-right: 10px;"></i> Acesso por HTTPS com autenticação por perfil e registro de IP</p>
                                    <p><i class="fas fa-shield-alt" style="color: #4CAF50; margin-right: 10px;"></i> Conformidade com regulamentações sanitárias (ANVISA, RDCs, CNES)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <div class="info-balloon" style="background: rgba(255, 255, 255, 0.95); border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                                <h2 class="mb-4 text-center">Serviços Incluídos</h2>
                                <div class="services-list" style="font-size: 1.1rem; line-height: 1.8; columns: 2;">
                                    <p><i class="fas fa-star" style="color: #4CAF50; margin-right: 10px;"></i> Plataforma Web (sem necessidade de instalação local)</p>
                                    <p><i class="fas fa-star" style="color: #4CAF50; margin-right: 10px;"></i> Suporte técnico contínuo</p>
                                    <p><i class="fas fa-star" style="color: #4CAF50; margin-right: 10px;"></i> Hospedagem segura e manutenção</p>
                                    <p><i class="fas fa-star" style="color: #4CAF50; margin-right: 10px;"></i> 12 treinamentos presenciais anuais</p>
                                    <p><i class="fas fa-star" style="color: #4CAF50; margin-right: 10px;"></i> AVA completo com trilhas, testes e certificados</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--Section Start-->
    <div class="section section-padding sigma_service-sec style-16">
        <div class="container">
            <div class="text-center mb-5">
                <h2>O que o Bioshild faz?</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="feature-card text-center" style="background: #f8f9fa; padding: 25px; border-radius: 15px; height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-chart-line mb-3" style="color: #4CAF50; font-size: 2rem;"></i>
                                <p>Monitora e analisa indicadores clínicos e epidemiológicos</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-card text-center" style="background: #f8f9fa; padding: 25px; border-radius: 15px; height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-flask mb-3" style="color: #2196F3; font-size: 2rem;"></i>
                                <p>Gerencia culturas microbiológicas e uso de antibióticos</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-card text-center" style="background: #f8f9fa; padding: 25px; border-radius: 15px; height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-clipboard-list mb-3" style="color: #FF9800; font-size: 2rem;"></i>
                                <p>Centraliza notificações compulsórias e assistenciais</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-card text-center" style="background: #f8f9fa; padding: 25px; border-radius: 15px; height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-users mb-3" style="color: #9C27B0; font-size: 2rem;"></i>
                                <p>Organiza e capacita equipes via AVA e treinamentos presenciais</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-card text-center" style="background: #f8f9fa; padding: 25px; border-radius: 15px; height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-lock mb-3" style="color: #F44336; font-size: 2rem;"></i>
                                <p>Garante segurança de dados com infraestrutura em nuvem certificada</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-card text-center" style="background: #f8f9fa; padding: 25px; border-radius: 15px; height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-chart-bar mb-3" style="color: #607D8B; font-size: 2rem;"></i>
                                <p>Gera dashboards e relatórios em tempo real para tomada de decisão</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Section End-->

    <!--Section Start-->
    <div class="section secondary-overlay">
        <video autoplay muted loop id="myVideo">
            <source src="{{ asset('/landpage/video/hydrogen-molecule.mp4') }}" type="video/mp4">
        </video>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 order-2 order-lg-1">
                    <div class="sigma_about style-21">
                        <div class="section-title">
                            <h3 class="title text-white">Por que Escolher BIOSHILD?</h3>
                        </div>
                        <div class="sigma_about-content">
                            <p>Optar pelo BIOSHILD é escolher uma solução moderna e confiável, desenvolvida para colocar a segurança e a qualidade da assistência à saúde em primeiro lugar.</p>
                            <div class="sigma_info style-15">
                                <div class="sigma_info-title">
                                    <i class="flaticon-heartbeat sigma_info-icon"></i>
                                </div>
                                <div class="sigma_info-description">
                                    <h5>Foco Total na Segurança do Paciente</h5>
                                    <p>BIOSHILD oferece ferramentas avançadas para prevenir riscos, gerenciar ocorrências e garantir um atendimento seguro e eficiente.</p>
                                </div>
                            </div>
                            <div class="sigma_info style-15 mb-0">
                                <div class="sigma_info-title">
                                    <i class="flaticon-group sigma_info-icon"></i>
                                </div>
                                <div class="sigma_info-description">
                                    <h5>Treinamento e Desenvolvimento</h5>
                                    <p>Capacite sua equipe com cursos e treinamentos integrados, fortalecendo a qualificação profissional.</p>
                                </div>
                            </div><br>
                            <p>BIOSHILD é mais do que um sistema; é uma solução completa para transformar a gestão hospitalar, priorizando segurança, qualidade e inovação.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1 order-1 order-lg-2">
                    <div class="sigma_about style-21 mt-0 w-100 h-100 .ellipse-container">
                        <div class="sigma_about-image-1 moving-div">
                            <img src="{{ asset('landpage/img/home-1/724x483.png') }}" alt="img1">
                        </div>
                        <div class="sigma_about-image-2 d-none d-sm-block moving-div">
                            <img src="{{ asset('landpage/img/home-1/673x378.png') }}" alt="img2">
                        </div>
                    </div>
                </div>
            </div>

            <div class="margin-negative style-5" style="padding: 40px;">
                <div class="container">
                    <div class="sigma_info-wrapper style-26 mb-5">
                        <div class="sigma_info style-26">
                            <div class="sigma_info-title">
                                <span class="sigma_info-icon">

                                    <i class="fal fa-map-marker-alt"></i>

                                </span>
                            </div>
                            <div class="sigma_info-description">
                                <p>Localização</p>
                                <p class="secondary-color"><b>Presidente Prudente, São Paulo</b>
                                </p>
                            </div>
                        </div>
                        <div class="sigma_info style-26">
                            <div class="sigma_info-title">
                                <span class="sigma_info-icon">

                                    <i class="fal fa-envelope"></i>

                                </span>
                            </div>
                            <div class="sigma_info-description">
                                <p>E-mail</p>
                                <p class="secondary-color"><b>financeiro@bioshild.com.br</b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Section End-->

    <div class="section pb-0 bg-gray"></div>

    <!--Section Start-->
    <footer class="sigma_footer style-5 pb-0 mt-6">
        <div class="container">
            <div class="sigma_footer-bottom d-flex align-items-center justify-content-center">
                <div class="sigma_footer-copyright text-center mt-0 mb-6 mb-sm-0">
                    <div class="sigma_footer-logo mb-4">
                            <img src="{{ asset('landpage/img/logo-ligth-verde.png') }}" alt="logo">
                            {{-- <img src="assets/img/logo.png" alt="logo"> --}}
                    </div>
                    <p class="mb-0">© RockSky
                        <a href="https://www.rocksky.com.br" target="_blank">2024</a>
                        | All Rights Reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!--Section End-->

    <!--Section Start-->
    <div class="sigma_top style-4">
        <i class="far fa-angle-double-up"></i>
        <i class="far fa-angle-double-up"></i>
    </div>
    <!--Section End-->

    <!-- Theme skins -->

    <script src="{{ asset('/landpage/js/plugins/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('/landpage/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('/landpage/js/plugins/bootstrap.min.js') }}"></script>

    <script src="{{ asset('/landpage/js/plugins/slick.min.js') }}"></script>
    <script src="{{ asset('/landpage/js/plugins/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('/landpage/js/plugins/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('/landpage/js/plugins/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/landpage/js/plugins/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('/landpage/js/plugins/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('/landpage/js/plugins/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('/landpage/js/plugins/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('/landpage/js/main.js') }}"></script>
    <!-- <script src="{{ asset('/landpage/js/plugins/animations.js') }}"></script> -->
    
    <script src="assets/"></script>
    <script src="assets/"></script>
    <script src="assets/js/plugins/"></script>
    <script src="assets/js/plugins/"></script>
    <script src="assets/js/plugins/"></script>
    <script src="assets/js/plugins/"></script>
    <script src="assets/js/plugins/"></script>
    <script src="assets/js/plugins/"></script>
    <script src="assets/"></script>
</body>

</html>

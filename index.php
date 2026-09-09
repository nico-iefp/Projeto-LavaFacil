<?php
/* public/index.php

// 1. Get the URL the user is trying to visit
$route = $_GET['route'] ?? 'home';

// 2. Decide what to show based on the URL
switch ($route) {
    // --- STATIC PUBLIC PAGES ---
    case 'home':
        // Just look inside the views folder and show the plain page
        include '../app/views/home/home.php'; 
        break;

    case 'about':
        include '../app/views/home/about.php';
        break;

    // --- SECURE/DYNAMIC PAGES ---
    case 'customer-login':
        // Call your controller to handle the database login
        require_once '../app/controllers/CustomerController.php';
        $controller = new CustomerController();
        $controller->login();
        break;

    case 'employee-dashboard':
        // Call your controller to load AdminLTE 4
        require_once '../app/controllers/EmployeeController.php';
        $controller = new EmployeeController();
        $controller->dashboard();
        break;

    default:
        echo "404 Page Not Found";
        break;
}*/

?>

<!DOCTYPE html>

<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Lava Fácil - Lavandaria com serviços de lavagem, secagem, engomadoria e recolha e entrega de roupa." />
    <meta name="keywords" content="lavandaria, lavagem de roupa, secagem, engomadoria, recolha de roupa, Lava Fácil" />
    <meta name="author" content="Lava Fácil" />
    <title>Lavandaria Lava Fácil</title>
    <link rel="stylesheet" href="public/assets/css/homepage.css" />
    <link rel="stylesheet" href="public/assets/css/lib/bootstrap.min.css" />
    <link rel="stylesheet" href="public/assets/css/lib/datatables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
</head>

<body>
    <?php include('app/views/layouts/public_navbar.php'); ?>

    <header class="hero-section position-relative" style="height: 92vh;">
        <div id="heroCarousel" class="carousel slide carousel-fade h-100" data-bs-ride="carousel"
            data-bs-interval="5000">

            <!-- CAROUSEL -->
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100"
                    style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('public/assets/img/loja_fora.png'); background-size: cover; background-position: center;">
                </div>

                <div class="carousel-item h-100"
                    style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('public/assets/img/loja_dentro.png'); background-size: cover; background-position: center;">
                </div>

                <div class="carousel-item h-100"
                    style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('public/assets/img/servico_secagem.png'); background-size: cover; background-position: center;">
                </div>

                <div class="carousel-item h-100"
                    style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('public/assets/img/imagem03.png'); background-size: cover; background-position: center;">
                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"
                style="z-index: 3;">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"
                style="z-index: 3;">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"></span>
            </button>

        </div>

        <!-- UNIQUE TEXT -->
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center text-white p-3" style="z-index: 2; pointer-events: none;">
            <div style="pointer-events: auto;">
                <h1 class="display-3 fw-bold">Lavagem profissional para toda <br> a roupa do dia-a-dia.</h1>
                <p class="lead">Tratamos da sua roupa com todo o cuidado.</p>
            </div>
        </div>

    </header>

    <section id="nossos_servicos">
        <div class="container">

            <div class="text-center my-5">

                <h2 class="fw-bold display-5">
                    Os nossos serviços
                </h2>

            </div>


            <div class="row g-4">

                <!-- LAVAGEM -->

                <div class="col-lg-4 col-md-6">

                    <div class="service-card">

                        <div class="icon">
                            <i class="bi bi-droplet"></i>
                        </div>

                        <h4>
                            Lavagem
                        </h4>

                        <p>
                            Lavagem profissional para toda a roupa do dia-a-dia.
                        </p>

                    </div>

                </div>


                <!-- SECAGEM -->

                <div class="col-lg-4 col-md-6">

                    <div class="service-card">

                        <div class="icon">
                            <i class="bi bi-fan"></i>
                        </div>

                        <h4>
                            Secagem
                        </h4>

                        <p>
                            Secagem cuidada para camisas, calças,
                            vestidos e muito mais.
                        </p>

                    </div>

                </div>


                <!-- PASSAR A FERRO -->

                <div class="col-lg-4 col-md-6">

                    <div class="service-card">

                        <div class="icon">
                            <i class="bi bi-thermometer-high"></i>
                        </div>

                        <h4>
                            Passar a ferro
                        </h4>

                        <p>
                            Ideal para fatos, vestidos e roupa delicada.
                        </p>
                    </div>
                </div>


                <!-- LAVAGEM + SECAGEM -->

                <div class="col-lg-4 col-md-6">

                    <div class="service-card">

                        <div class="icon">
                            <i class="bi bi-wind"></i>
                        </div>

                        <h4>
                            Lavagem + Secagem
                        </h4>

                        <p>
                            Um serviço completo para deixar a sua roupa
                            limpa e pronta a usar.
                        </p>

                    </div>

                </div>

                <!-- LAVAGEM + SECAGEM + FERRO -->

                <div class="col-lg-4 col-md-6">

                    <div class="service-card">

                        <div class="icon">
                            <i class="bi bi-layers"></i>
                        </div>

                        <h4>
                            Lavagem + Secagem + Ferro
                        </h4>

                        <p>
                            O serviço completo para quem procura
                            praticidade e comodidade.
                        </p>

                    </div>

                </div>


                <!-- PACKS -->

                <div class="col-lg-4 col-md-6">

                    <div class="service-card">

                        <div class="icon">
                            <i class="bi bi-boxes"></i>
                        </div>

                        <h4>
                            Packs
                        </h4>

                        <p>
                            Escolha um dos nossos packs mensais
                            e simplifique o cuidado da sua roupa.
                        </p>

                    </div>

                </div>

            </div>

        </div>
    </section>

    <!--  COMO FUNCIONA  -->

    <section id="como" class="py-5 my-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="display-5 fw-bold">
                    Como Funciona
                </h2>

                <p class="text-muted">
                    Quatro passos simples.
                </p>

            </div>


            <div class="row text-center">


                <div class="col-lg-3">

                    <div class="step">

                        <div class="step-number">
                            1
                        </div>

                        <i class="bi bi-phone display-4 text-primary"></i>

                        <h5 class="mt-3">
                            Faz a marcação
                        </h5>

                    </div>

                </div>


                <div class="col-lg-3">

                    <div class="step">

                        <div class="step-number">
                            2
                        </div>

                        <i class="bi bi-truck display-4 text-primary"></i>

                        <h5 class="mt-3">
                            Recolhemos
                        </h5>

                    </div>

                </div>


                <div class="col-lg-3">

                    <div class="step">

                        <div class="step-number">
                            3
                        </div>

                        <i class="bi bi-droplet-fill display-4 text-primary"></i>

                        <h5 class="mt-3">
                            Lavamos
                        </h5>

                    </div>

                </div>


                <div class="col-lg-3">

                    <div class="step">

                        <div class="step-number">
                            4
                        </div>

                        <i class="bi bi-house-check-fill display-4 text-primary"></i>

                        <h5 class="mt-3">
                            Entregamos
                        </h5>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  TESTEMUNHOS  -->

    <section class="py-5 bg-light">


        <div class="container">

            <div class="text-center mb-5">

                <h2 class="display-5 fw-bold">
                    O que dizem os nossos clientes
                </h2>

            </div>


            <div class="row">


                <div class="col-lg-4 mb-4">

                    <div class="testimonial">

                        <img src="" class="testimonial-img" alt="Mario Santos" loading="lazy">

                        <h5>
                            Mario Santos
                        </h5>

                        <div class="stars" aria-label="5 estrelas">
                            ★★★★★
                        </div>

                        <p>
                            Excelente serviço. Muito rápidos e a roupa
                            vem sempre impecável.
                        </p>

                    </div>

                </div>

                <div class="col-lg-4 mb-4">

                    <div class="testimonial">

                        <img src="" class="testimonial-img" alt="Joana Costa" loading="lazy">

                        <h5>
                            Joana Costa
                        </h5>

                        <div class="stars" aria-label="5 estrelas">
                            ★★★★★
                        </div>

                        <p>
                            Serviço de recolha fantástico.
                            Nunca mais precisei de perder tempo.
                        </p>

                    </div>

                </div>

                <div class="col-lg-4 mb-4">

                    <div class="testimonial">

                        <img src="img/imagem a.png" class="testimonial-img" alt="André Martins" loading="lazy">

                        <h5>
                            André Martins
                        </h5>

                        <div class="stars" aria-label="5 estrelas">
                            ★★★★★
                        </div>

                        <p>
                            Muito profissionais.
                            Recomendo a toda a gente.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- ACCORDION -->

    <section>
        <div class="accordion-wrapper d-flex justify-content-center align-items-center vh-100">
            <div class="accordion w-50" id="myCenteredAccordion">
                <h2>FAQ</h2>
                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Pergunta #1
                        </button>
                    </h3>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlush">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate
                            the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Pergunta #2
                        </button>
                    </h3>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlush">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate
                            the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's
                            imagine
                            this being filled with some actual content.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                            aria-controls="flush-collapseThree">
                            Até que distância fazem entregas?
                        </button>
                    </h3>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlush">
                        <div class="accordion-body"> Entregamos ...
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section style="display: flex; justify-content: center; margin-bottom: 1%;">
        <div id="map" style="height: 400px; width: 50%; "></div>
    </section>


    <?php include('app/views/layouts/public_footer.php'); ?>

    <script src="public/assets/js/scripts.js"></script>
    <script src="public/assets/js/lib/bootstrap.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <script src="public/assets/js/mapa.js"></script>
    <script src="public/assets/js/lib/jquery.js"></script>
</body>

</html>
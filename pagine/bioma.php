<?php 

    session_start();

    if(isset($_SESSION['user'])){$user = $_SESSION['user'];} else{$user = ""; }
    // if(isset($_SESSION['pass'])){$pass = $_SESSION['pass'];} else{$pass = ""; }
    $nomepagina = __FILE__;
    $nomepagina = substr($nomepagina, -4,5)
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Biomi
        </title>

        <link rel="icon" type="image/x-icon" href="../immagini/mappa-icona.png">
        <link rel="stylesheet" href="../style.css">
        <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    </head>

    <body class="loading">
        <img src="../immagini/background_image5.jpg" alt="immagine non disponibile" class="img_res" id="back-ground">
        <div class="cover">
            <div class="cover__content">

                <header> 
                    <?php 
                        require("nav.php")
                    ?>
                </header>

                
                <main>
                    <div class="container" id="biomi">  
                        
                            <?php
                                $cod_bioma = $_GET["cod_bioma"];
                                require("../data/connessione_db.php");
                                $sql = "SELECT biomi.cod_bioma, biomi.categoria, biomi.background, bioma.bioma, bioma.immagine, bioma.descrizione, bioma.style 
                                        FROM biomi JOIN bioma ON biomi.cod_bioma = bioma.cod_categoria
                                        WHERE cod_bioma = $cod_bioma";
                                
                                $ris = $conn->query($sql) or die("<p>Query fallita!</p>");
                                
                                foreach($ris as $riga){
                                    $categoria = $riga['categoria'];
                                    $background = $riga['background'];
                                }

                                if ($ris->num_rows == 0) {
                                    // decidere che cosa fare
                                    die ("Biomi non trovati!");
                                } else {
                                    echo "<div class='container' id='Titolo1' style='background: url(../immagini/$background)'>";
                                    echo "<div class='container__container'><h2 class='Grande_Titolo' id='$categoria'>$categoria</h2></div> ";
                                    foreach($ris as $riga){
                                        $bioma = $riga['bioma'];
                                        $descrizione = $riga['descrizione'];
                                        $immagine = $riga["immagine"];
                                        $style = $riga["style"];
            
                                        echo <<<EOD
                                            <div class="container__container" >
                                                <div class="cover2 reveal">
                                                    <h2>$bioma</h2>
                                                    <div class="card2" id="$style">
                                                        <div class="card2__img">
                                                            <img src="../immagini/biomi/$immagine" alt="" class="img_res">
                                                        </div>
                                                        <div class="card2__copy">
                                                            <p>$descrizione</p>
                                                        </div>
                                                    </div>  
                                                </div>
                                            </div>      
                                        EOD;
                                                                        
                                    }
                                    echo "</div>";
                                }
                            ?>


                    </div>

                    <div class="boxsu">
                        <a href=#cover>
                            <img src="../immagini/frecciasu.png" alt="immagine non disponibile" class="img_res">
                        </a>
                    </div>
                </main>    
                <footer class="footer">
                    <div class="grid" id="contatti">
                        <div class="footer__column">
                            <h3>Chi siamo</h3>

                            <p >Riccardo Germanò - Abraham La Rosa.
                                Studenti del Liceo A. Banfi di Vimercate.
                            </p>
                            <p >
                                Questo è un sito che è stato creato per un progetto, il percorso di costruzione è stato molto divertente.
                            </p>
                        </div>
                        <div class="footer__column">
                            <h3 >Email 1</h3>
                            <p >riccardo.germano@liceobanfi.eu</p>
                            <p >
                                - Non scrivere, tanto non ti rispondo
                            </p>
                            <a href="https://github.com/Furoooo">
                                <img src="../immagini/thecock.jfif" alt="">
                            </a>
                        </div>
                        <div class="footer__column">
                            
                            <h3 >
                                Email 2
                            </h3>
                            <p >abraham.larosa@liceobanfi.eu</p>
                            <p>
                                - Prof la prego ci metta 10. 🗿🍷
                            </p>
                            <a href="https://github.com/G1gg4N1qq4">
                                <img src="../immagini/giganigga.jfif" alt="">
                            </a>
                        </div>

                    </div>
                </footer>
            </div>
        </div>
    </body>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.pkgd.min.js" integrity="sha512-achKCfKcYJg0u0J7UDJZbtrffUwtTLQMFSn28bDJ1Xl9DWkl/6VDT3LMfVTo09V51hmnjrrOTbtg4rEgg0QArA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.min.css" integrity="sha512-fJcFDOQo2+/Ke365m0NMCZt5uGYEWSxth3wg2i0dXu7A1jQfz9T4hdzz6nkzwmJdOdkcS8jmy2lWGaRXl+nFMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <script>
            $(document).ready(function(){
                $(".loading-image").toggleClass("loading-image--deactive")
                $(".loading").toggleClass("deactive")
                $(".boxsu").hide(400);

                $(".Global__header__line-menu").width = 100
                $(".Global__header__line-menu").position().left=100

                $(".Global__header__icon-bar").on("click", function() {
                    $(".Global__header__menu").toggleClass("Global__header__menu--open");
                    console.log("ciao")
                });

                
                $(window).scroll(function() {
                    
                    if ($(window).scrollTop() >($(".Global__header").offset().top)){
                        $(".Global__header").addClass("Global__header--fixed");
                        console.log("edge+cum")
                    };
                    
                    if($(window).scrollTop() < 60){
                        $(".Global__header").removeClass("Global__header--fixed");
                        console.log("edge+cum")
                    }
                    
                    if($(window).scrollTop() <= 1980){
                        $(".boxsu").hide(600);
                        console.log("edge+cum")
                    }

                    if($(window).scrollTop() > 1980){
                        $(".boxsu").show(600);
                        console.log("edge+cum")
                    }

                
                });

                var nav = $(".Global__header__menu")
                var pos = 0
                var wid = ""
                var line = $(".Global__header__line-menu")
                
                
                nav.find(".Global__header__menu__item").hover( function(){
                    
                    var this_nav = $(this)
                    line.animate({
                        left: this_nav.position().left,
                        width: this_nav.width() + 10
                    }, 50)
                });
                
                $(".boxsu").on("click", function() {
                    $("html, body").animate({
                        scrollTop: 0
                    }, 1000)

                });

                // $('.cta').click(function(event) {
                //     // Preventing default action of the event
                //     event.preventDefault();
                //     // Getting the height of the document
                //     var n = $(document).height();
                //     $('html, body').animate({ scrollTop: n }, 1000);
                // });
                
                if($(window).width() > 0){
                    ScrollReveal().reveal('.reveal', {distance: '50px', duration: '1500', origin: 'bottom', easing: 'cubic-bezier(0.215, .61, .355, 1)', interval: '50'});
                };
                ScrollReveal().reveal('.zoom', {duration: '1500', easing: 'cubic-bezier(0.215, .61, .355, 1)', interval: '200', scale: 0.65, mobile: false})

                if($(window).width() > 1366){
                    $('.Tendina').hover(function(){
                        $(this).toggleClass('menubiomi--open')
                    });
                    $('.menubiomi a').hover(function(){
                        $(this).toggleClass('menubiomi__a--open')
                    });
                    
                };

                if(($(window).width() <= 1366)){ 
                    if(($(window).width() > 767)){
                        $('.main_page_link').click(function (e) {
                            e.preventDefault();
                        });
                        $('.Tendina').off('hover')
                        $('.Tendina').on('click', function(){
                            $('.Tendina').not(this).removeClass('menubiomi--open')
                            $(this).toggleClass('menubiomi--open')
                        });
    
                        var width = $(window).width();
                        var height = $(window).height() - $('.Global__header').height();
                        $('.menubiomi').width(width);
                        $('.menubiomi').height(height);
    
                    };      
                }

                
                if($(window).width() <= 767){
                    $('.main_page_link').click(function (e) {
                        e.preventDefault();
                    });
                }
            });
        </script>
</html>
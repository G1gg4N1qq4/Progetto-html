<?php 

    session_start();

    if(isset($_POST['user'])){$user = $_POST['user'];} else{$user = ""; }
    if(isset($_POST['pass'])){$pass = $_POST['pass'];} else{$pass = ""; }
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
            Mobs
        </title>

        <link rel="icon" type="image/icon" href="../immagini/zombie.jpg">
        <link rel="stylesheet" href="../style.css">
        <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    </head>

    <body>
        <!-- <img src="../immagini/background_image5.jpg" alt="immagine non disponibile" class="img_res" id="back-ground"> -->
        <div class="cover">
            <div class="cover__content">
                
                <header> 
                    <?php 
                        require("nav.php")
                    ?>
                </header>


                
                
                <main>
                    <div class="container" id="mods">     
                        <?php
                            require("../data/connessione_db.php");
                            if(isset($ricerca) && $ricerca != ""){

                                $myquery1 = "SELECT cod_mod, nome, username_utente, descrizione_txt, immagine
                                            FROM mods
                                            WHERE nome LIKE '%$ricerca%'";
                                
                                $ris1 = $conn->query($myquery1) or die("<p>Query fallita:".$conn->connect_error."</p>");
                                
                                $myquery2 = "SELECT cod_mod, nome, username_utente, descrizione_txt, immagine
                                            FROM mods
                                            WHERE username_utente LIKE '%$ricerca%'";
                                
                                $ris2 = $conn->query($myquery2) or die("<p>Query fallita:".$conn->connect_error."</p>");

                                
                                if($ris1->num_rows>0 || $ris2->num_rows>0){

                                    echo "<div class='copertura' id='search_results'><h2 class='Grande_Titolo' id='search_title' style='font-size: 22px'>Risultati della tua ricerca per nome delle mods: <b class='medium_text' style='font-size: 22px'>$ricerca</b></h2><div class='container__container' >";
                                    foreach($ris1 as $riga){
                                        $cod_mod = $riga["cod_mod"];
                                        $nome = $riga["nome"];                            
                                        $user = $riga["username_utente"];
                                        $descrizione = $riga["descrizione_txt"];
                                        $immagine = $riga["immagine"];
                                        echo '<a href="mod.php?cod_mod='.$cod_mod.'" class="mobs__card">
                                            <div class="mobs__card__img">
                                                <img src="../immagini/mods/'.$immagine.'" alt="" class="img_res">
                                            </div>
                                            
                                            <h2>'.$nome.'</h2>
                                            <p>Da: '.$user.'</p>

                                            </a>';
                                    }
                                    echo "</div></div>";
                                    echo "<br>";
                                    echo "<div class='copertura' id='search_results'><h2 class='Grande_Titolo' id='search_title' style='font-size: 22px'>Risultati della tua ricerca per utenti come: <b class='medium_text' style='font-size: 22px'>$ricerca</b></h2><div class='container__container' >";
                                    foreach($ris2 as $riga){
                                        $cod_mod = $riga["cod_mod"];
                                        $nome = $riga["nome"];                            
                                        $user = $riga["username_utente"];
                                        $descrizione = $riga["descrizione_txt"];
                                        $immagine = $riga["immagine"];
                                        echo '<a href="mod.php?cod_mod='.$cod_mod.'" class="mobs__card">
                                            <div class="mobs__card__img">
                                                <img src="../immagini/mods/'.$immagine.'" alt="" class="img_res">
                                            </div>
                                            
                                            <h2>'.$nome.'</h2>
                                            <p>Da: '.$user.'</p>

                                            </a>';
                                    }
                                    echo "</div></div>";
                                }
                                else{
                                    echo "<div class='copertura' id='search_results'><h2 class='Grande_Titolo' id='search_title' style='font-size: 22px'>Nessun risultato per la tua ricerca</h2><div class='container__container' >";

                                }
                            }

                            $myquery = "SELECT cod_mod, nome, username_utente, descrizione_txt, immagine, link
                                        FROM mods";
                            
                            $ris = $conn->query($myquery) or die("<p>Query fallita:".$conn->connect_error."</p>");
                            
                            echo "<div class='copertura'><h2 class='Grande_Titolo' id='Foreste' style='font-size:50px; margin-top:30px; border-bottom:0px'>Mods</h2><div class='container__container' >";
                                foreach($ris as $riga){
                                    $cod_mod = $riga["cod_mod"];
                                    $nome = $riga["nome"];                            
                                    $user = $riga["username_utente"];
                                    $descrizione = $riga["descrizione_txt"];
                                    $immagine = $riga["immagine"];
                                    $link = $riga["link"];
                                    echo "<div class='cover2 reveal'>
                                            <h2 class='Titolo_mod' style='font-size: 35px'>$nome</h2>
                                            <p style='font-size: 27px; margin-top:10px'>Da: $user</p>
                                            <div class='card'>

                                                <div class='card__img'>
                                                    <img src='../immagini/mods/$immagine' alt='L'immagine non e' disponibile :/' class='img_res'>
                                                </div>
                                                <div class='card__copy'>  
                                                    <p>
                                                        $descrizione
                
                                                    </p>
                                                </div> 
                                                
                                            </div>
                                            <div class='small_text'><a href='$link' class='button' id='discover_button'>Download mod</a></div>
                                        </div>";
                                }
                            echo "</div></div>";
                        ?>
                
                    <!-- <div class="container" id="Titolo1_mobs">

                        
                        <div class="container__container">
                            <h2 class="Grande_Titolo" id="Overworld">Overworld</h2>
                            <div class="cover2 reveal">
                                <h2>Mucca</h2>
                                <div class="card2" id="cow">
                                    <div class="card2__copy">
                                        <p>La mucca e' un animale che può essere trovato in quasi tutti i biomi (quelli più comuni sono le foreste e le pianure). Le mucche forniscono risorse importanti per il giocatore, come carne e pelle, utilizzabile per creare libri e cornici. Dalla mucca si può ottenere il latte. Questo può essere utilizzato per craftare torte e per rimuovere tutti gli effetti al giocatore. Per far accoppiare le mucche bisogna utilizzare il grano.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/mucca.avif" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">
                                <h2>Maiale</h2>  
                                <div class="card2" id="pig">
                                    <div class="card2__copy">
                                        <p>Il maiale e' un'ottima fonte di carne nel gioco. Il giocatore può uccidere i maiali per ottenere carne cruda, che può essere cotta e consumata come fonte di cibo.
                                            I maiali possono essere allevati utilizzando carote o patate.
                                            I maiali possono essere montati usando una sella, ma non rispondono ai comandi! Per muoversi servirà una canna da pesca con carota. 
                                            </p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/maiale.jpg" alt="" class="img_res">
                                    </div>
                                </div>
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Pecora</h2>
                                <div class="card2" id="sheep">
                                    <div class="card2__copy">
                                        <p>La pecora e' un altro animale comune. Le pecore possono essere trovate in vari colori, come bianco, nero, grigio, marrone, rosa, blu, viola, rosso, giallo e verde. I giocatori possono tosare le pecore utilizzando le forbici per ottenere la lana, che e' un materiale molto utile per la creazione di tappeti, letti, stendardi e altri oggetti decorativi. Come alla mucca, anche alla pecora piace il grano!</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/pecora.png" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Gallina</h2>
                                <div class="card2" id="chicken">
                                    <div class="card2__copy">
                                        <p>I polli sono mob passivi presenti in molti biomi . Sono completamente innocui, ma estremamente utili. In questa guida sui polli di Minecraft ti insegneremo tutto ciò che devi sapere, come trovare i polli, come allevarli, suggerimenti rapidi e fatti che potresti non sapere, nonche' i bottini disponibili.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/chicken.png" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Tartaruga</h2>
                                <div class="card2" id="turtle">
                                    <div class="card2__copy">
                                        <p>La tartarugha e' un mob passivo in Minecraft. E' l'unica fonte per creare una pozione specifica. 
                                            Le tartarughe vengono utilizzate principalmente per creare pozioni. Quando muoiono lasciano cadere i loro gusci che possono essere usati per creare la pozione del Signore delle Tartarughe .</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/tartaruga.webp" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Gatto</h2>
                                <div class="card2" id="cat">
                                    <div class="card2__copy">
                                        <p>I gatti sono un mob utile da avere in giro, sono noti per tenere lontani i creeper. I gatti possono anche essere addomesticati e, come i lupi addomesticati, puoi comandare loro di seguirti o di restare fermi. Ma a differenza dei lupi, i gatti possono essere di vari colori.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/gatto.avif" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Volpe</h2>
                                <div class="card2" id="fox">
                                    <div class="card2__copy">
                                        <p>Le volpi sono un ottimo mob da avere se vuoi essere sorpreso dagli oggetti. La volpe lascerà cadere qualunque oggetto abbia in mano se ci sono tre o quattro cespugli di bacche entro un raggio di sedici isolati da essi. Le volpi sono una delle poche creature notturne e sono note per andare nei villaggi di notte e uccidere i polli. Puoi guadagnare la loro fiducia e, così facendo, attaccheranno alcuni mob che ti feriscono.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/volpe.jpg" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Axolotl</h2>
                                <div class="card2" id="axolotl">
                                    <div class="card2__copy">
                                        <p>Oltre ad apparire carini e ad uccidere altri mob acquatici, gli Axolotl non hanno nessun altro scopo. Puoi tenerli come animali domestici, ma come detto prima, assicurati che siano lontani dagli altri mob oceanici. Gli Axolotl si generano in uno dei cinque colori.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/axolotl.jpg" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Panda</h2>
                                <div class="card2" id="panda">
                                    <div class="card2__copy">
                                        <p>I panda non hanno ancora alcuno scopo importante in Minecraft. Ma ciò non significa che non siano carini da guardare e siano divertenti animali domestici. I giocatori possono provocare un panda colpendolo. I panda sono un animale raro da trovare, ma possono essere trovati nel bioma della giungla dove e' presente il bambù.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/panda.webp" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Orso Polare</h2>
                                <div class="card2" id="polar_bear">
                                    <div class="card2__copy">
                                        <p>Gli orsi polari non fanno nulla di importante nel gioco. Di solito si trovano in giro, ma possono essere provocati se attacchi loro o il loro cucciolo. Se stai giocando su Bedrock, ti attaccheranno se ti avvicini troppo a loro. Gli orsi polari si generano solo nei biomi ghiacciati.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/orso-polare.png" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Ragno</h2>
                                <div class="card2" id="spider">
                                    <div class="card2__copy">
                                        <p>I ragni sono un mob neutrale in Minecraft. Come altri mob aggressivi, i ragni si generano nell'oscurità e possono quindi essere prevenuti illuminando le aree. I ragni, tuttavia, non prendono fuoco alla luce del sole. A differenza dei creeper, però, durante il giorno, non restano ostili e agiscono passivamente a meno che non vengano attaccati.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/ragno.webp" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Zombie</h2>
                                <div class="card2" id="zombie">
                                    <div class="card2__copy">
                                        <p>Lo zombie e' un mostro ostile che si genera di notte o in aree non illuminate e brucia fino alla morte alla luce del sole. Gli zombie sono i mob più facili da affrontare poiche' non hanno abilità speciali e si muovono abbastanza lentamente. Sembrano simili al modello di giocatore predefinito. </p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/zombi.jpg" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Creeper</h2>
                                <div class="card2" id="creeper">
                                    <div class="card2__copy">
                                        <p>Il Creeper e' l'unico mob che fa esplodere se stesso e tutto ciò che lo circonda. A differenza degli zombie o degli scheletri, i creeper possono sopravvivere al sole, ma tendono a trovarsi in aree scarsamente illuminate. I Creeper forniscono alcuni materiali utili quando vengono uccisi dai giocatori o da determinati Mob ostili. Se un Creeper viene colpito da un fulmine, diventerà un Creeper Caricato. Saprai quando un creeper diventa un Creeper Caricato in base al suo aspetto, avrà un bagliore di elettricità attorno a se'.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/creeper2.png" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Scheletro</h2>
                                <div class="card2" id="skeleton">
                                    <div class="card2__copy">
                                        <p>Lo scheletro usa arco e frecce per attaccare. Se una freccia colpisce un altro mob, detto mob attaccherà lo scheletro e i due inizieranno a combattere. e' noto che gli scheletri subiscono danni al sole, ma spesso li troverai anche di giorno mentre si nascondono sotto agli alberi per non prendere fuoco.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/skeleton.png" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                            <div class="cover2 reveal">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                <h2>Slime</h2>
                                <div class="card2" id="slime">
                                    <div class="card2__copy">
                                        <p>Lo slime e' un mob ostile che si moltiplica quanto più lo colpisci. Quando incontri uno slime, noterai che e' un grande cubo e più danni gli fai, più si rompe in piccoli cubetti. Più grande e' uno slime, più salterà in alto e maggiore sarà il danno che farà.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/slime.png" alt="" class="img_res">
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    
                    <div class="container" id="Titolo2_mobs">    
                        
                        <div class="container__container">
                            <h2 class="Grande_Titolo" id="Nether">Nether</h2>
                            <div class="cover2 reveal">
                                <h2>Zombie Pigman</h2>  
                                <div class="card2" id="pigman">
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/pigman_mobs.png" alt="" class="img_res">
                                    </div>
                                    <div class="card2__copy">
                                        <p>I pigman sono una variante non-morta dei piglin e dei piglin bruti che abitano nel Nether. Un pigman diventa ostile quando lui, o un altro pigman nelle vicinanze viene colpito. I pigman possono generarsi nel Nether, nei portali del Nether o dai maiali colpiti da un fulmine.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cover2 reveal">
                                <h2>Piglin</h2>  
                                <div class="card2" id="piglin">
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/piglin.png" alt="" class="img_res">
                                    </div>
                                    <div class="card2__copy">
                                        <p>e' noto che i piglin attaccano qualsiasi giocatore senza equipaggiamento dorato. Attaccheranno anche i giocatori che attaccano altri Piglin o Pigline Bruti. Se rompi qualsiasi tipo di minerale d'oro attorno a loro, ciò li spingerà ad attaccarti.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cover2 reveal">
                                <h2>Blaze</h2>  
                                <div class="card2" id="blaze">
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/blaze.png" alt="" class="img_res">
                                    </div>
                                    <div class="card2__copy">
                                        <p>I Blaze sono mob volanti che si trovano solo nel Nether. Sono essenziali perche' sono l'unica fonte di Blaze Rods che servono per trovare il portale dell'end. Non appena un Blaze ti vedrà, inizierà ad attaccarti e lancerà tre palle di fuoco verso di te.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cover2 reveal">
                                <h2>Scheletro Wither</h2>  
                                <div class="card2" id="wither_skeleton">
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/witherskeleton.png" alt="" class="img_res">
                                    </div>
                                    <div class="card2__copy">
                                        <p>Lo scheletro wither attacca con la spada e può forse essere scambiato per uno scheletro più standard che scivola e cade in una pozza di inchiostro. Gli scheletri wither sono anche leggermente più alti di te o di uno scheletro normale. Se vieni colpito da uno di loro, perderai lentamente la tua salute a causa dell'effetto "wither". Gli scheletri wither, quando muoiono, hanno una piccola probabilità di lasciar cadere la loro testa, utile per far generare il Wither.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cover2 reveal">
                                <h2>Cubo di Magma</h2>  
                                <div class="card2" id="magma_cube">
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/magmacube.png" alt="" class="img_res">
                                    </div>
                                    <div class="card2__copy">
                                        <p>I Cubi di Magma sono essenziali perche' sono gli unici mob che rilasciano Magma Cream nel gioco (la Magma Cream serve per fare le pozioni di resistenza al fuoco). E se un cubo di magma più piccolo viene mangiato da una rana, verrà trasformato in una Froglight . Quando i cubi di magma vengono inizialmente generati, hanno una forma grande, poi dopo alcuni attacchi, saranno di forma media e, se continui ad attaccare, si trasformeranno in una forma più piccola fino a morire definitivamente.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container" id="Titolo3_mobs"> 
                        <div class="container__container">
                            <h2 class="Grande_Titolo" id="End">End</h2>
                            <div class="cover2 reveal">
                                <h2>Enderman</h2>  
                                <div class="card2" id="enderman">
                                    <div class="card2__copy">
                                        <p>Gli Enderman sono mob che possono sopravvivere al sole, sono noti per teletrasportarsi in giro. Puoi provocare un Enderman guardandolo direttamente negli occhi che verrà ad attaccarti. Gli Enderman fanno molto danno ma non possono toccare l'acqua, altrimenti prendono danno.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/enderman_mobs.png" alt="" class="img_res">
                                    </div>
                                </div>
                            </div>
                            <div class="cover2 reveal">
                                <h2>Endermite</h2>  
                                <div class="card2" id="endermite">
                                    <div class="card2__copy">
                                        <p>Endermite e' un piccolo mob ostile senza alcuno scopo significativo nel gioco se non quello di cercare di ucciderti.
                                            Gli Endermite hanno una piccola possibilità di generarsi ogni qualvolta che un giocatore lancia una Perla di Ender.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/endermite.png" alt="" class="img_res">
                                    </div>
                                </div>
                            </div>
                            <div class="cover2 reveal">
                                <h2>Shulker</h2>  
                                <div class="card2" id="shulker">
                                    <div class="card2__copy">
                                        <p>Gli shulker sono un mob ostile che si genera in una scatola. Gli Shulker sono l'unica fonte di Conchiglie Shulker, che possono essere utilizzate per creare Scatole Shulker. Gli shulker non infliggono troppi danni, ma i loro proiettili seguono i giocatori e, quando colpiti, subiscono la levitazione per 10 secondi. I giocatori possono distruggere i proiettili sparandogli con una freccia o bloccandoli con uno scudo. Gli Shulker si generano solamente nelle città dell'End.</p>
                                    </div>
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/shulker.png" alt="" class="img_res">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container" id="Titolo4_mobs"> 
                        <div class="container__container">
                            <h2 class="Grande_Titolo" id="Boss">Boss</h2>
                            <div class="cover2 reveal">
                                <h2>Wither</h2>  
                                <div class="card2" id="wither">
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/wither.jpg" alt="" class="img_res">
                                    </div>
                                    <div class="card2__copy">
                                        <p>Per generare il Wither, dovrai fare un viaggio nel Nether. Mentre sei lì, raccogli 4 Soul Sand per costruire il corpo del boss. Questi materiale dovrebbe essere abbondante in tutto il Nether e quindi non difficile da trovare. Il materiale più difficile da raccogliere sono le teste di Wither Skeleton, di cui te ne serviranno 3. Per ottenere i teschi, dovrai sconfiggere i Wither Skeletons, che si generano esclusivamente nelle Fortezze del Nether.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cover2 reveal">
                                <h2>Warden</h2>  
                                <div class="card2" id="warden">
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/warden_mobs.jpg" alt="" class="img_res">
                                    </div>
                                    <div class="card2__copy">
                                        <p>Il Warden e' uno dei mob più recenti del gioco. Apparendo come una mucca eretta e dai colori strani, il Warden e' in realtà un mob ostile che e' cieco e cerca il giocatore rilevando rumori e vibrazioni dal giocatore che si muove o esegue azioni.
                                            Il Warden può essere trovato nelle Grotte Oscure Profonde, facili da individuare grazie all'abbondanza del nuovo blocco, Sculk. Le Grotte Oscure e Profonde appaiono ai livelli più bassi della generazione del mondo, appena pochi livelli sopra Bedrock.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cover2 reveal">
                                <h2>Drago dell'End</h2>  
                                <div class="card2" id="ender_dragon">
                                    <div class="card2__img">
                                        <img src="../immagini/mobs/enderdragon.png" alt="" class="img_res">
                                    </div>
                                    <div class="card2__copy">
                                        <p>Lo scontro con il Drago dell'End e' considerata la fase finale del gioco perche' dopo aver ucciso il drago, verrai accolto con un testo speciale sullo schermo.
                                            Il drago dell'End e' un mob che può generarsi solo in un bioma di Minecraft. La dimensione dell'End.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

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
                        <div class="footer__column ">
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
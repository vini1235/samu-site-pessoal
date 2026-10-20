<?PHP
header('Content-Type: text/html; charset=utf-8');
?>
<?php
session_start();
include_once("seguranca.php");
include_once("../conexao/conexao.php");
seguranca_adm();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Cesar Szpak - Celke">
    <link rel="icon" href="../imagens/favicon.jpg">
    <title>TI-SAUDE</title>

    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="../css/theme.css" rel="stylesheet">
    <link href="estilo.css" rel="stylesheet">
    <script src="../js/ie-emulation-modes-warning.js"></script>

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/demo.css">
    <!-- Pushy CSS -->
    <link rel="stylesheet" href="../css/pushy.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body role="document">
<?php
if(isset($_SESSION['msg'])){
    echo "<p>".$_SESSION['msg']."</p>";
    unset($_SESSION['msg']);
}
?>

<header class="site-header push">TI-SAÚDE</header>

<?php require_once dirname(__DIR__) . '/navigation.php'; samuAuxiliaryMenu(); ?>



<div class="site-overlay"></div>

<!-- Your Content -->
<div id="container">
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>


    <div align="center">
        <img src="../imagens/logo-jandira.png"  alt="some_text"/>
    </div>
    <h1 id="centro">Arquivos  Download</h1>
    <br>
    <br>

    <div class="section group">
        <br>

        <br>

        <div class="container marketing">



            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">


        </div>



        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">Driver de impressoras  <span class="text-muted"></span></h2>
                <p class="lead">segue os driver de impressoras na secretaria da saúde</p>
            </div>

            <div class="col-md-5">
                <div class="table-responsive">
                <table class="table">


                    <thead>
                    <tr>
                        <th>IMPRESSORAS</th>
                        <th>DRIVER</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>brother8080DN WIN7 64X </td>
                        <td><?php if (is_file(__DIR__ . '/../Download/DCP-8080DN-inst-win7-A2.rar')): ?><a class="btn btn-success"style="color:White;" href="../Download/DCP-8080DN-inst-win7-A2.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>brother8080DN WIN10 64X</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/DCP-8080DN-inst-win8-A1.rar')): ?><a class="btn btn-success"style="color:White;" href="../Download/DCP-8080DN-inst-win8-A1.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>brother8085DN WIN07 64X</td>
                        <td>  <?php if (is_file(__DIR__ . '/../Download/DCP-8085DN-inst-win7-A2.rar')): ?><a class="btn btn-success"style="color:White;" href="../Download/DCP-8085DN-inst-win7-A2.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>brother8085DN WIN10 64X</td>
                        <td><?php if (is_file(__DIR__ . '/../Download/DCP-8085DN-inst-win8-A1.rar')): ?><a class="btn btn-success"style="color:White;" href="../Download/DCP-8085DN-inst-win8-A1.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>hp_P2030_Full_Solution</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/hp_P2030_Full_Solution.rar')): ?><a class="btn btn-success"style="color:White;" href="../Download/hp_P2030_Full_Solution.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td> M2020_Series_WIN_UPD</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/M2020_Series_WIN_UPD_V3.00.05.01.01.rar')): ?><a class="btn btn-success"style="color:White;" href="../Download/M2020_Series_WIN_UPD_V3.00.05.01.01.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>hp m3035</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/hp m3035.rar')): ?><a class="btn btn-success"style="color:White;" href="../Download/hp m3035.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>HP LaserJet P2055dn win07 64x</td>
                        <td><?php if (is_file(__DIR__ . '/../Download/upd-pcl5-x64-6.1.0.20062.rar')): ?><a class="btn btn-success"style="color:White;" href="../Download/upd-pcl5-x64-6.1.0.20062.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>  HP LaserJet P2055dn win 10 64x</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/upd-pcl6-x64-6.6.0.23029.rar')): ?><a class="btn btn-success"style="color:White;" href="../Download/upd-pcl6-x64-6.6.0.23029.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>  HP LaserJet P2055dn completa</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/ P2055_default_install_v6.1_ww.rar')): ?><a class="btn btn-success"style="color:White;" href="../Download/ P2055_default_install_v6.1_ww.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>



                    </tbody>
                </table>



</div>
            </div>





            </div>
        </div>
        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">Arquivos  <span class="text-muted">T.I SÁUDE</span></h2>
                <p class="lead">Arquivos e programas </p>
            </div>
            <div class="col-md-7">
                <div class="table-responsive">
                <table class="table" >


                    <thead>
                    <tr>
                        <th scope="col">ARQUIVOS</th>
                        <th scope="col" >Download</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>manual-GC420d-Windows2</td>
                        <td><?php if (is_file(__DIR__ . '/../Download/manual-GC420d-Windows2.rar')): ?><a class="btn btn-primary"style="color:White;" href="../Download/manual-GC420d-Windows2.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>manual ultrassom ft412</td>
                        <td><?php if (is_file(__DIR__ . '/../Download/FT412_b.rar')): ?><a class="btn btn-primary"style="color:White;" href="../Download/FT412_b.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>Office_2007_PT-BR</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/Office_2007_PT-BR.zip')): ?><a class="btn btn-primary"style="color:White;" href="../Download/Office_2007_PT-BR.zip">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?> </td>

                    </tr>
                    <tr>
                        <td> SMS_Power_View_Windows_(Requer_JRE)</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/SMS_Power_View_Windows_(Requer_JRE).rar')): ?><a class="btn btn-primary"style="color:White;" href="../Download/SMS_Power_View_Windows_(Requer_JRE).rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?> </td>

                    </tr>
                    <tr>
                        <td>VNC 6.0.1</td>
                        <td><?php if (is_file(__DIR__ . '/../Download/VNC 6.0.1.rar')): ?><a class="btn btn-primary"style="color:White;" href="../Download/VNC 6.0.1.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?> </td>

                    </tr>
                    <tr>
                        <td>Firebird-1.5.5.4926-3-Win32</td>
                        <td>  <?php if (is_file(__DIR__ . '/../Download/Firebird-1.5.5.4926-3-Win32.rar')): ?><a class="btn btn-primary"style="color:White;" href="../Download/Firebird-1.5.5.4926-3-Win32.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?> </td>

                    </tr>
                    <tr>
                        <td> Conam</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/Conam.rar')): ?><a class="btn btn-primary"style="color:White;" href="../Download/Conam.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?> </td>

                    </tr>
                    <tr>
                        <td> comandos-de-rede-prompt-windows</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/comandos-de-rede-prompt-windows.rar')): ?><a class="btn btn-primary"style="color:White;" href="../Download/comandos-de-rede-prompt-windows.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td> bluescreenview</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/bluescreenview.zip')): ?><a class="btn btn-primary"style="color:White;" href="../Download/bluescreenview.zip">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td> accuchek</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/accuchek.rar')): ?><a class="btn btn-primary"style="color:White;" href="../Download/accuchek.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>  ATIVADOR W10 By</td>
                        <td> <?php if (is_file(__DIR__ . '/../Download/AT W10 By PHDowns (1).rar')): ?><a class="btn btn-primary"style="color:White;" href="../Download/AT W10 By PHDowns (1).rar">Download</td>

                    </tr>
                    <tr>
                        <td>ATIVADOR W7</td>
                        <td><a class="btn btn-primary"style="color:White;" href="../Download/AtvdR W7 By PH Downs.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?> </td>

                    </tr>
                    <tr>
                        <td>100-comandos-para-executar</td>
                        <td><?php if (is_file(__DIR__ . '/../Download/100-comandos-para-executar-no-seu-windows-10.rar')): ?><a class="btn btn-primary"style="color:White;" href="../Download/100-comandos-para-executar-no-seu-windows-10.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>CID 10</td>
                        <td><?php if (is_file(__DIR__ . '/../Download/InstPesq.rar')): ?><a class="btn btn-primary"style="color:White;" href="../Download/InstPesq.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>
                    <tr>
                        <td>SIPNI - Sistema</td>
                        <td><?php if (is_file(__DIR__ . '/../Download/SIPNI - Sistema.rar')): ?><a class="btn btn-primary"style="color:White;" href="../Download/SIPNI - Sistema.rar">Download</a><?php else: ?><span class="text-muted">Arquivo indisponível nesta cópia</span><?php endif; ?></td>

                    </tr>

                    </tbody>
                </table>

            </div>

            </div>

        </div>



        </div>
      

        <br>


<div class="site-overlay"></div>

<!--Footer-->


<footer id="footer" class="clearfix">
    <div id="footer-widgets">

        <div class="container">

            <div id="footer-wrapper">



            </div> <!-- end #footer-wrapper -->

        </div> <!-- end .container -->
    </div> <!-- end #footer-widgets -->

    <div id="sub-floor">
        <div class="container">
            <div class="col-md-4 copyright">
                </br>
                TI-SAUDE  © 2018</br>
                -------------------------</br>
                Tel: (11)4619-9433</br>

                suporte.ti.saude@jandira.sp.gov.br</br>
                </br>
                </br>
            </div>
            <div class="col-md-4 col-md-offset-4 attribution">
                Developer by Renato Cristian Gonçalves  <a target="_blank" href="#"></a></br>
                </br>
                <p>(11)97736-7521 <span class="glyphicon glyphicon-phone-alt"></span></p>

                renatocristiang@gmail.com  <span class="glyphicon glyphicon-envelope"></span>
                renatocristian@hotmail.com  <span class="glyphicon glyphicon-envelope"></span>
                </br>


                </br>
                </br>
            </div>
        </div>
    </div>

</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/pushy.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../js/jquery.min.js"><\/script>')</script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/docs.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../js/ie10-viewport-bug-workaround.js"></script>

</body>
</html>

<?php
	$ini = 2;
    global $whitelist, $base_url, $ini;

    // $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    // $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    // $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    // $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    // $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    // $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    // $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

    //require_once("config/funcoes.php"); 
?>

<!doctype html>
<html lang="pt-en">
<head>
    <title>MONEY HUB</title>
    <base href="http://localhost/money-hub/>">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <!-- ================================ FAVICON ================================ -->
    <!-- ========================================================================= -->
    <!-- <link rel='shortcut icon' type='image/x-icon' href='img/logo-cinza.png'/> -->
    <!-- ========================================================================= -->
    <!-- ================================ FAVICON ================================ -->
    <link rel="stylesheet" href="css/validador.css">
    <link rel="stylesheet" href="css/swiper.min.css">
    <link rel="stylesheet" href="js/fancybox/jquery.fancybox.css" />
    <link rel="stylesheet" href="css/jssocials.css">
    <link rel="stylesheet" href="css/bootstrap.3.3.7.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
    $server = explode("/",$_SERVER["REQUEST_URI"]);
    $pag = $server[$ini];

    require_once 'menu.php';

    $server = explode("/",$_SERVER["REQUEST_URI"]);
    $pag = $server[$ini];

    if(strpos($pag,"?") !== false) {
        $pag = explode("?",$pag);
        $pag = $pag[0];
    }

    if($pag == null or $pag == "index.php" or !file_exists($pag.".php")) {
        $pag = "login";
    }
?>

</body>

<?php if(file_exists($pag.".php")) { require_once($pag.".php"); } ?>
<footer>
    <?php //require_once 'footer.php';?>
</footer>
<div id="fb-root"></div>

<script type="text/javascript">
    var base_url = "{{ url('/') }}";
</script>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.3.3.7.min.js"></script>
<script type="text/javascript" src="js/maskedinput.js"></script>
<script type="text/javascript" src="js/pace.min.js"></script>
<script type="text/javascript" src="js/jssocials.min.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"></script>
<script type="text/javascript" src="cript.js"></script>
<script type="text/javascript" src="transacoes.js"></script>
<script type="text/javascript" src="js/validador.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>


<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery("#menu-fixo").hide();

    jQuery('a#menu-fixo').click(function () {
         jQuery('body,html').animate({
           scrollTop: 0
         }, 800);
        return false;
    });

    jQuery(window).scroll(function () {
         if (jQuery(this).scrollTop() > 100) {
            jQuery('#menu-fixo').fadeIn();
         } else {
            jQuery('#menu-fixo').fadeOut();
         }
     });
});

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if(d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.6&appId=1718657101724003";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

</html>
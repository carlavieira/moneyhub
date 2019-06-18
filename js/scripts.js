(function(){ 
    // ajustes();
    // var wow = new WOW().init();
    var isMobile = window.matchMedia("only screen and (max-width: 767px)");

// ===================== if for mobile version ====================== //
// ===================== if(isMobile.matches) { ===================== //
// ===================== }else{ ===================================== //
// ===================== } ========================================== //
// ===================== if for mobile version ====================== //

$(document).ready(function() {
    $(".email-envio").validador({
        placeholder: false,
        url: "formulario-envio-email.php",
        callback: function (data) {
            if ($.trim(data) == "sucesso") {
                $(".email-envio")[0].reset();
                swal("Dados Enviados com Sucesso!", "Em breve entraremos em contato!", "success");
            }
            if ($.trim(data) == "erro") {
                $('.giro').hide();
                $('.enviando').hide();
                swal("Erro. Tente Novamente!", "Erro ao enviar!", "error");
            }
        }
    })

    $(".form-newsletter").validador({
        placeholder: false,
        url: "newsletter-cadastro.php",
        callback: function (data) {
            if ($.trim(data) == "sucesso") {
                $(".form-newsletter")[0].reset();
                swal("Email cadastrado com Sucesso!", "Foi enviado um e-mail de confirmação para o seu endereço de e-mail.", "success");
            }
            if ($.trim(data) == "erro") {
                $('.giro').hide();
                $('.enviando').hide();
                swal("Erro. Tente Novamente!", "Erro ao cadastrar!", "error");
            }
        }
    })
})

})(jQuery);

// =========================== MENU-MOBILE================================= //
 

$('.menu-mobile').click(function () {
    var css_right = $('.logo-mobile').css("left");

    if (css_right == "-500px;") {
        $(".logo-mobile").animate({"left": '0px'});
    } else {
        if (css_right == "0px") {
            $(".logo-mobile").animate({"left": '-500px'});
        }
    }
});

$('.menu-mobile').click(function () {
    var css_right = $('.logo-mobile').css("left");
});

$('.expande-clica').click(function () {
    var id = $(this).attr('id').replace('lista-', '');

    $(".expandido").hide();
    $("#aba-" + id).show();
    $(".abre").slideDown();
})


$(document).ready(function () {
    var id = location.hash.replace('#', '');
    
    if(id!='') {
        $('.area-int').fadeOut('fast', function () {

            $('.a-detalhes').hide();
            $('.area-detalhes' + id).show();
            $('.area-int').fadeIn('fast');
        });

        $('.colorir').removeClass('ativo');
        $('#area-' + id).find('.colorir').addClass('ativo');
    }
})


$('.menu-mobile').click(function () {
    var css_right = $('.logo-mobile').css("left");

    if (css_right == "-500px") {
        $(".logo-mobile").animate({"left": '0px'});
    } else {
        if (css_right == "0px") {
            $(".logo-mobile").animate({"left": '-500px'});
        }
    }
});
// =========================== MENU-MOBILE================================= //
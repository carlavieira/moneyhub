(function ( $ ) {
 
    $.fn.validador = function( options ) {
 
        // Plugin criado por Thales de Assis Trindade
        ok = 1;
        var settings = $.extend({
            placeholder: false,
            url: false,
            callback: false
        }, options );
        
    
        var form = this;

        !function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a){var b,c=navigator.userAgent,d=/iphone/i.test(c),e=/chrome/i.test(c),f=/android/i.test(c);a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},autoclear:!0,dataName:"rawMaskFn",placeholder:"_"},a.fn.extend({caret:function(a,b){var c;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof a?(b="number"==typeof b?b:a,this.each(function(){this.setSelectionRange?this.setSelectionRange(a,b):this.createTextRange&&(c=this.createTextRange(),c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select())})):(this[0].setSelectionRange?(a=this[0].selectionStart,b=this[0].selectionEnd):document.selection&&document.selection.createRange&&(c=document.selection.createRange(),a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length),{begin:a,end:b})},unmask:function(){return this.trigger("unmask")},mask:function(c,g){var h,i,j,k,l,m,n,o;if(!c&&this.length>0){h=a(this[0]);var p=h.data(a.mask.dataName);return p?p():void 0}return g=a.extend({autoclear:a.mask.autoclear,placeholder:a.mask.placeholder,completed:null},g),i=a.mask.definitions,j=[],k=n=c.length,l=null,a.each(c.split(""),function(a,b){"?"==b?(n--,k=a):i[b]?(j.push(new RegExp(i[b])),null===l&&(l=j.length-1),k>a&&(m=j.length-1)):j.push(null)}),this.trigger("unmask").each(function(){function h(){if(g.completed){for(var a=l;m>=a;a++)if(j[a]&&C[a]===p(a))return;g.completed.call(B)}}function p(a){return g.placeholder.charAt(a<g.placeholder.length?a:0)}function q(a){for(;++a<n&&!j[a];);return a}function r(a){for(;--a>=0&&!j[a];);return a}function s(a,b){var c,d;if(!(0>a)){for(c=a,d=q(b);n>c;c++)if(j[c]){if(!(n>d&&j[c].test(C[d])))break;C[c]=C[d],C[d]=p(d),d=q(d)}z(),B.caret(Math.max(l,a))}}function t(a){var b,c,d,e;for(b=a,c=p(a);n>b;b++)if(j[b]){if(d=q(b),e=C[b],C[b]=c,!(n>d&&j[d].test(e)))break;c=e}}function u(){var a=B.val(),b=B.caret();if(a.length<o.length){for(A(!0);b.begin>0&&!j[b.begin-1];)b.begin--;if(0===b.begin)for(;b.begin<l&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}else{for(A(!0);b.begin<n&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}h()}function v(){A(),B.val()!=E&&B.change()}function w(a){if(!B.prop("readonly")){var b,c,e,f=a.which||a.keyCode;o=B.val(),8===f||46===f||d&&127===f?(b=B.caret(),c=b.begin,e=b.end,e-c===0&&(c=46!==f?r(c):e=q(c-1),e=46===f?q(e):e),y(c,e),s(c,e-1),a.preventDefault()):13===f?v.call(this,a):27===f&&(B.val(E),B.caret(0,A()),a.preventDefault())}}function x(b){if(!B.prop("readonly")){var c,d,e,g=b.which||b.keyCode,i=B.caret();if(!(b.ctrlKey||b.altKey||b.metaKey||32>g)&&g&&13!==g){if(i.end-i.begin!==0&&(y(i.begin,i.end),s(i.begin,i.end-1)),c=q(i.begin-1),n>c&&(d=String.fromCharCode(g),j[c].test(d))){if(t(c),C[c]=d,z(),e=q(c),f){var k=function(){a.proxy(a.fn.caret,B,e)()};setTimeout(k,0)}else B.caret(e);i.begin<=m&&h()}b.preventDefault()}}}function y(a,b){var c;for(c=a;b>c&&n>c;c++)j[c]&&(C[c]=p(c))}function z(){B.val(C.join(""))}function A(a){var b,c,d,e=B.val(),f=-1;for(b=0,d=0;n>b;b++)if(j[b]){for(C[b]=p(b);d++<e.length;)if(c=e.charAt(d-1),j[b].test(c)){C[b]=c,f=b;break}if(d>e.length){y(b+1,n);break}}else C[b]===e.charAt(d)&&d++,k>b&&(f=b);return a?z():k>f+1?g.autoclear||C.join("")===D?(B.val()&&B.val(""),y(0,n)):z():(z(),B.val(B.val().substring(0,f+1))),k?b:l}var B=a(this),C=a.map(c.split(""),function(a,b){return"?"!=a?i[a]?p(b):a:void 0}),D=C.join(""),E=B.val();B.data(a.mask.dataName,function(){return a.map(C,function(a,b){return j[b]&&a!=p(b)?a:null}).join("")}),B.one("unmask",function(){B.off(".mask").removeData(a.mask.dataName)}).on("focus.mask",function(){if(!B.prop("readonly")){clearTimeout(b);var a;E=B.val(),a=A(),b=setTimeout(function(){z(),a==c.replace("?","").length?B.caret(0,a):B.caret(a)},10)}}).on("blur.mask",v).on("keydown.mask",w).on("keypress.mask",x).on("input.mask paste.mask",function(){B.prop("readonly")||setTimeout(function(){var a=A(!0);B.caret(a),h()},0)}),e&&f&&B.off("input.mask").on("input.mask",u),A()})}})});
        !function($){"use strict";$.browser||($.browser={},$.browser.mozilla=/mozilla/.test(navigator.userAgent.toLowerCase())&&!/webkit/.test(navigator.userAgent.toLowerCase()),$.browser.webkit=/webkit/.test(navigator.userAgent.toLowerCase()),$.browser.opera=/opera/.test(navigator.userAgent.toLowerCase()),$.browser.msie=/msie/.test(navigator.userAgent.toLowerCase()));var a={destroy:function(){return $(this).unbind(".maskMoney"),$.browser.msie&&(this.onpaste=null),this},mask:function(a){return this.each(function(){var b,c=$(this);return"number"==typeof a&&(c.trigger("mask"),b=$(c.val().split(/\D/)).last()[0].length,a=a.toFixed(b),c.val(a)),c.trigger("mask")})},unmasked:function(){return this.map(function(){var a,b=$(this).val()||"0",c=-1!==b.indexOf("-");return $(b.split(/\D/).reverse()).each(function(b,c){return c?(a=c,!1):void 0}),b=b.replace(/\D/g,""),b=b.replace(new RegExp(a+"$"),"."+a),c&&(b="-"+b),parseFloat(b)})},init:function(a){return a=$.extend({prefix:"",suffix:"",affixesStay:!0,thousands:".",decimal:",",precision:2,allowZero:!1,allowNegative:!1},a),this.each(function(){function b(){var a,b,c,d,e,f=s.get(0),g=0,h=0;return"number"==typeof f.selectionStart&&"number"==typeof f.selectionEnd?(g=f.selectionStart,h=f.selectionEnd):(b=document.selection.createRange(),b&&b.parentElement()===f&&(d=f.value.length,a=f.value.replace(/\r\n/g,"\n"),c=f.createTextRange(),c.moveToBookmark(b.getBookmark()),e=f.createTextRange(),e.collapse(!1),c.compareEndPoints("StartToEnd",e)>-1?g=h=d:(g=-c.moveStart("character",-d),g+=a.slice(0,g).split("\n").length-1,c.compareEndPoints("EndToEnd",e)>-1?h=d:(h=-c.moveEnd("character",-d),h+=a.slice(0,h).split("\n").length-1)))),{start:g,end:h}}function c(){var a=!(s.val().length>=s.attr("maxlength")&&s.attr("maxlength")>=0),c=b(),d=c.start,e=c.end,f=c.start!==c.end&&s.val().substring(d,e).match(/\d/)?!0:!1,g="0"===s.val().substring(0,1);return a||f||g}function d(a){s.each(function(b,c){if(c.setSelectionRange)c.focus(),c.setSelectionRange(a,a);else if(c.createTextRange){var d=c.createTextRange();d.collapse(!0),d.moveEnd("character",a),d.moveStart("character",a),d.select()}})}function e(b){var c="";return b.indexOf("-")>-1&&(b=b.replace("-",""),c="-"),c+a.prefix+b+a.suffix}function f(b){var c,d,f,g=b.indexOf("-")>-1&&a.allowNegative?"-":"",h=b.replace(/[^0-9]/g,""),i=h.slice(0,h.length-a.precision);return i=i.replace(/^0*/g,""),i=i.replace(/\B(?=(\d{3})+(?!\d))/g,a.thousands),""===i&&(i="0"),c=g+i,a.precision>0&&(d=h.slice(h.length-a.precision),f=new Array(a.precision+1-d.length).join(0),c+=a.decimal+f+d),e(c)}function g(a){var b,c=s.val().length;s.val(f(s.val())),b=s.val().length,a-=c-b,d(a)}function h(){var a=s.val();s.val(f(a))}function i(){var b=s.val();return a.allowNegative?""!==b&&"-"===b.charAt(0)?b.replace("-",""):"-"+b:b}function j(a){a.preventDefault?a.preventDefault():a.returnValue=!1}function k(a){a=a||window.event;var d,e,f,h,k,l=a.which||a.charCode||a.keyCode;return void 0===l?!1:48>l||l>57?45===l?(s.val(i()),!1):43===l?(s.val(s.val().replace("-","")),!1):13===l||9===l?!0:!$.browser.mozilla||37!==l&&39!==l||0!==a.charCode?(j(a),!0):!0:c()?(j(a),d=String.fromCharCode(l),e=b(),f=e.start,h=e.end,k=s.val(),s.val(k.substring(0,f)+d+k.substring(h,k.length)),g(f+1),!1):!1}function l(c){c=c||window.event;var d,e,f,h,i,k=c.which||c.charCode||c.keyCode;return void 0===k?!1:(d=b(),e=d.start,f=d.end,8===k||46===k||63272===k?(j(c),h=s.val(),e===f&&(8===k?""===a.suffix?e-=1:(i=h.split("").reverse().join("").search(/\d/),e=h.length-i-1,f=e+1):f+=1),s.val(h.substring(0,e)+h.substring(f,h.length)),g(e),!1):9===k?!0:!0)}function m(){r=s.val(),h();var a,b=s.get(0);b.createTextRange&&(a=b.createTextRange(),a.collapse(!1),a.select())}function n(){setTimeout(function(){h()},0)}function o(){var b=parseFloat("0")/Math.pow(10,a.precision);return b.toFixed(a.precision).replace(new RegExp("\\.","g"),a.decimal)}function p(b){if($.browser.msie&&k(b),""===s.val()||s.val()===e(o()))a.allowZero?a.affixesStay?s.val(e(o())):s.val(o()):s.val("");else if(!a.affixesStay){var c=s.val().replace(a.prefix,"").replace(a.suffix,"");s.val(c)}s.val()!==r&&s.change()}function q(){var a,b=s.get(0);b.setSelectionRange?(a=s.val().length,b.setSelectionRange(a,a)):s.val(s.val())}var r,s=$(this);a=$.extend(a,s.data()),s.unbind(".maskMoney"),s.bind("keypress.maskMoney",k),s.bind("keydown.maskMoney",l),s.bind("blur.maskMoney",p),s.bind("focus.maskMoney",m),s.bind("click.maskMoney",q),s.bind("cut.maskMoney",n),s.bind("paste.maskMoney",n),s.bind("mask.maskMoney",h)})}};$.fn.maskMoney=function(b){return a[b]?a[b].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof b&&b?($.error("Method "+b+" does not exist on jQuery.maskMoney"),void 0):a.init.apply(this,arguments)}}(window.jQuery||window.Zepto);

        $(".mask-data").mask("99/99/9999",{placeholder:"DD/MM/AAAA"});
        $(".mask-datahora").mask("99/99/9999 99:99",{placeholder:"DD/MM/AAAA HH:MM"});
        $(".mask-cpf").mask("999.999.999-99");
        $(".mask-cnpj").mask("99.999.999/9999-99");
        $(".mask-cep").mask("99999-999");
        $(".mask-ssj").mask("9.99.9999");
        $(".mask-processo").mask("9999999-99.9999");
        $(".mask-telefone").focusout(function(){
            var phone, element;
            element = $(this);
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if(phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }

            if(settings.placeholder) {
                $(this).blur(function() {
                    var nome = $(this).attr("name");
                    var txt_original = normalizarString(nome);
                    if($(this).val() == "") {
                        $(this).val(txt_original);
                    }
                })
            }
        }).trigger('focusout');
        $(".mask-fax").focusout(function(){
            var phone, element;
            element = $(this);
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if(phone.length > 10) {
                element.mask("(99) 999-9999");
            } else {
                element.mask("(99) 999-9999");
            }

            if(settings.placeholder) {
                $(this).blur(function() {
                    var nome = $(this).attr("name");
                    var txt_original = normalizarString(nome);
                    if($(this).val() == "") {
                        $(this).val(txt_original);
                    }
                })
            }
        }).trigger('focusout');
        $(".mask-dinheiro").maskMoney();


        form.find("input[type=text],input[type=email],input[type=number],select,input[type=file],input[type=password],textarea").each(function() {
            var nome = $(this).attr("name");
            var txt_original = normalizarString(nome);
            var tipo = $(this).attr("type");

            if(settings.placeholder && tipo != "file") {
                $(this).val(txt_original);
                $(this).focus(function() {
                    if($(this).val() == txt_original) {
                        $(this).val('');
                    }
                })
                $(this).blur(function() {
                    if($(this).val() == '') {
                        $(this).val(txt_original);
                    }
                })
            }
            
            if(tipo != "file") {
                $(this).wrap("<span class='validacao'></span>");
            }
        })

        form.submit(function(e) {
            ok = 1;
            var nome_inicial = "";

            form.find(".form-erro").remove();
            form.find(".borda-erro").removeClass("borda-erro");
            $('.giro').show();
            $('#bt-enviar').addClass('bt-enviando').val('Enviando');

            form.find("input[type=text],select,input[type=number],input[type=password],input[type=file],input[type=email],textarea,input[type=radio],input[type=checkbox]").each(function() {
                
                var nome = $(this).attr("name");
                var txt_original = normalizarString(nome);
                var tipo = $(this).attr("type");
                var opcional = $(this).attr("opcional");
                var valor = $(this).val();

                $(this).click(function() {
                    $(this).closest(".validacao").find(".form-erro").fadeOut('fast', function() { $(this).remove(); });
                    $(this).removeClass("borda-erro");
                    
                    $(this).parent().removeClass("borda-erro");
                    $(this).parent().find(".form-erro").fadeOut('fast', function() { $(this).remove(); });
                    $(this).parent().find(".anexar-btn").removeClass("borda-btn");
                })
                
                $(".grupo-opt .opt").click(function() {
                    $(this).parent().find(".form-erro").fadeOut('fast', function() { $(this).remove(); });
                    $(this).parent().removeClass("borda-erro");
                })


                if(typeof tipo == "undefined") { tipo = "textarea"; } 
                if(typeof opcional == "undefined") { opcional = false; } else { opcional = true; }

                if(tipo == "text" || tipo == "number" || tipo == "password" || tipo == "textarea" || tipo == "file") {


                    if(!opcional) {
                        var campo_vazio = false;

                        if(valor == "") {
                            campo_vazio = true;
                        }

                        if(settings.placeholder) {
                            if(valor == txt_original) {
                                campo_vazio = true;
                            }
                        }

                        if(campo_vazio) {
                            ok = 0;
                            
                            if(tipo == "file") {
                                $(this).after("<div class='form-erro'>Obrigatório</div>");
                                $(this).parent().addClass("borda-erro");
                                $(this).parent().find(".anexar-btn").addClass("borda-btn");
                            } else {
                                $(this).after("<div class='form-erro'>Obrigatório</div>");
                                $(this).addClass("borda-erro");
                            }
                        } else {

                            if($(this).hasClass('valida-cnj')) {
                                $.ajax({
                                   url:  API_URL + '../validarCnj.php',
                                   type: 'POST',
                                   async: false,
                                   data: { cnj:valor }
                                }).done(function(data) {
                                    if(data == 'false') {
                                        ok = 0;
                                        $(".valida-cnj").after("<div class='form-erro'>Número Inválido</div>");
                                        $(".valida-cnj").addClass("borda-erro");
                                    }
                                });
    
                            }

                            if($(this).parent().hasClass('mask-data')) {

                                if(!validaData(txt_value)) {
                                    ok = 0;
                                    var erro = "Data inválida";
                                    $(this).after("<div class='form-erro'>"+erro+"</div>");
                                    $(this).addClass("borda-erro");
                                }
                            }

                            if($(this).parent().hasClass('mask-cpf')) {

                                if(!valida_cpf_cnpj(txt_value)) {
                                    ok = 0;
                                    var erro = "CPF inválido";
                                    $(this).after("<div class='form-erro'>"+erro+"</div>");
                                    $(this).addClass("borda-erro");
                                }
                            }

                            if($(this).parent().hasClass('mask-cnpj')) {

                                if(!valida_cpf_cnpj(txt_value)) {
                                    ok = 0;
                                    var erro = "CNPJ inválido";
                                    $(this).after("<div class='form-erro'>"+erro+"</div>");
                                    $(this).addClass("borda-erro");
                                }
                            }
                            
                            if(txt_original == "E-mail" || txt_original == "Email") {
                                er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
                                if(!er.exec($(this).val())) {
                                    ok = 0;
                                    var erro = "E-mail inválido";
                                    $(this).after("<div class='form-erro'>"+erro+"</div>");
                                    $(this).addClass("borda-erro");
                                }
                            }

                            if(tipo == "file") {
                                ok = 0;
                                var nome_arq = $(this).val();
                                nome_arq = nome_arq.split('.')
                                ext = nome_arq[nome_arq.length-1];
                                ext = ext.toLowerCase();

                                ext_validas = $(this).attr("ext").split(";");

                                if($.inArray( ext, ext_validas ) == -1) {
                                    if(typeof ext_validas != "undefined") {
                                        $(this).after("<div class='form-erro'>Extensões válidas: "+$.unique(ext_validas).join(", ")+"</div>");
                                        $(this).parent().addClass("borda-erro");
                                        $(this).parent().find(".anexar-btn").addClass("borda-btn");
                                    }
                                }
                            }


                        }
                    }

                }

                if(tipo == "radio" || tipo == "checkbox") {
                    
                    if(nome != nome_inicial) {
                        nome_inicial = nome; 
                        
                        if(!opcional) {
                            if($(this).closest(".grupo").find("input[name='"+nome+"']:checked").length == 0) {
                                ok = 0;
                                $(this).parent().next().append("<div class='form-erro' style='left: 0px; right: auto'>Obrigatório</div>");
                                //$(this).parent().next().addClass("borda-erro")
                            }
                        }
                    }

                }

            })
        
            if(ok == 0) {
                $(".form-erro").animate({ opacity: 1}, 300);

                $('#bt-enviar').removeClass('bt-enviando').val('Enviar');

                $('.giro').hide();
                e.preventDefault();
            } else {
                if(settings.url) {
                    e.preventDefault();
                    $.ajax({
                       afterSend: function() {
                           //$(".loading-contato").fadeIn();
                           $('#bt-enviar').removeClass('bt-enviando').addClass('bt-enviado').val('Enviado!');
                           $('.giro').hide();
                       },
                       url: settings.url,
                       type: 'POST',
                       data: form.serialize()
                    }).done(function(data) {
                        //$(".loading-contato").fadeOut();
                        $('#bt-enviar').removeClass('bt-enviando').addClass('bt-enviado').val('Enviado!');
                        $('.giro').hide();
                       // form[0].reset();
                        settings.callback(data);
                    });
                }
            }
            
        })


        function normalizarString(string) {
            if(typeof string != "undefined") {
                string = string.split("_").join(" ");
                string = string.split("-").join(" ");
                if(string == "email" || string == "Email") { string = "e-mail"; }
                string = string.charAt(0).toUpperCase() + string.slice(1);
                return string;
            }
        }

        function verifica_cpf_cnpj(valor) {
            valor = valor.toString();
            valor = valor.replace(/[^0-9]/g, '');
            if ( valor.length === 11 ) {
                return 'CPF';
            } 
            else if ( valor.length === 14 ) {
                return 'CNPJ';
            } 
            else {
                return false;
            }
        }

        function calc_digitos_posicoes(digitos,posicoes,soma_digitos) {
            if(soma_digitos == null) { soma_digitos = 0; }
            if(posicoes == null) { posicoes = 10; }

            digitos = digitos.toString();

            for ( var i = 0; i < digitos.length; i++  ) {
                soma_digitos = soma_digitos + ( digitos[i] * posicoes );

                posicoes--;
                if ( posicoes < 2 ) {
                    posicoes = 9;
                }
            }

            soma_digitos = soma_digitos % 11;

            if ( soma_digitos < 2 ) {
                soma_digitos = 0;
            } else {
                soma_digitos = 11 - soma_digitos;
            }

            var cpf = digitos + soma_digitos;
            return cpf;
        }

        function valida_cpf( valor ) {

            valor = valor.toString();
            valor = valor.replace(/[^0-9]/g, '');
            var digitos = valor.substr(0, 9);
            var novo_cpf = calc_digitos_posicoes( digitos );
            var novo_cpf = calc_digitos_posicoes( novo_cpf, 11 );

            if ( novo_cpf === valor ) {
                return true;
            } else {
                return false;
            }
            
        }

        function valida_cnpj ( valor ) {

            valor = valor.toString();
            valor = valor.replace(/[^0-9]/g, '');
            var cnpj_original = valor;
            var primeiros_numeros_cnpj = valor.substr( 0, 12 );
            var primeiro_calculo = calc_digitos_posicoes( primeiros_numeros_cnpj, 5 );
            var segundo_calculo = calc_digitos_posicoes( primeiro_calculo, 6 );
            var cnpj = segundo_calculo;
            if ( cnpj === cnpj_original ) {
                return true;
            }
            
            return false;
            
        }

        function valida_cpf_cnpj ( valor ) {

            var valida = verifica_cpf_cnpj( valor );
            valor = valor.toString();
            valor = valor.replace(/[^0-9]/g, '');

            if ( valida === 'CPF' ) {
                return valida_cpf( valor );
            } 
            
            else if ( valida === 'CNPJ' ) {
                return valida_cnpj( valor );
            } 
            
            else {
                return false;
            }
            
        }

        function formata_cpf_cnpj( valor ) {

            var formatado = false;
            var valida = verifica_cpf_cnpj( valor );
            valor = valor.toString();
            valor = valor.replace(/[^0-9]/g, '');

            if ( valida === 'CPF' ) {
            
                if ( valida_cpf( valor ) ) {

                    formatado  = valor.substr( 0, 3 ) + '.';
                    formatado += valor.substr( 3, 3 ) + '.';
                    formatado += valor.substr( 6, 3 ) + '-';
                    formatado += valor.substr( 9, 2 ) + '';
                    
                }
                
            }
            else if ( valida === 'CNPJ' ) {
            
                if ( valida_cnpj( valor ) ) {
                
                    formatado  = valor.substr( 0,  2 ) + '.';
                    formatado += valor.substr( 2,  3 ) + '.';
                    formatado += valor.substr( 5,  3 ) + '/';
                    formatado += valor.substr( 8,  4 ) + '-';
                    formatado += valor.substr( 12, 14 ) + '';
                    
                }
                
            } 
            return formatado;
            
        }

 
    };
 
}( jQuery ));
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TrebolNEWS / Perfil</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="shortcut icon" href="favicon.ico">
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css'>

        {{ HTML::style('internas/css/style.css') }}

        {{ HTML::script('js/jquery-1.11.0.min.js') }}
        {{ HTML::script('js/jquery-ui-1.10.4.min.js') }}
        {{ HTML::script('js/jquery.form.min.js') }}
        {{ HTML::script('js/jquery.noty.packaged.min.js') }}

        {{ HTML::script('ckeditor/ckeditor.js') }}
        {{ HTML::script('ckeditor/adapters/jquery.js') }}
        <script>
            $(function(){
                $('.btn_guardar').hide();

                $('.btn_editar').on('click', function(e){
                    e.preventDefault();

                    $('[editable]').prop('contenteditable', true).animate({
                        color: 'black'
                    });
                    $('.btn_editar').fadeOut(function(){
                        $('.btn_guardar').fadeIn();
                        $('.btn_guardar').one('click', guardar_perfil_handler);
                    });
                });

                function guardar_perfil_handler(e) {
                    e.preventDefault();

                    $('#frm_perfil').ajaxSubmit({
                        success: function(data) {
                            if(data.status == 'ok') {
                                noty({
                                    type: 'success',
                                    text: data.mensaje,
                                    layout: 'topCenter',
                                    callback: {
                                        afterShow: function(){
                                            location.reload();
                                        }
                                    }
                                });
                            } else {
                                notys(data.validator);
                                $('.btn_guardar').one('click', guardar_perfil_handler);
                            }
                        },
                        complete: function() {

                        }
                    });
                }

                $('[editable]').on('blur', function(e){
                    var campo = $(e.target);
                    var input = $('input[name="' + campo.attr('editable') + '"]', $('#frm_perfil'));
                    input.val($.trim(campo.text()));
                });
            });
        </script>
        {{ HTML::script('js/trebolnews.js') }}

        <!--chat-->
        {{ HTML::script('home/js/modernizr.custom.js') }}
        <!--chat-->

        {{ HTML::script('internas/js/modernizr.custom.04022.js') }}

<!--mostrar y ocultar-->
<script type="text/javascript">
function ocultar_mostrar(div){
owurl7 = document.getElementById(div);
//Verificamos si la capa esta oculta o no y como resultado
//indicamos que cambie su valor distinto al actual. "none" o "block"
owurl7.style.display!='none'?
owurl7.style.display='none':owurl7.style.display='block';
}
</script>
<!--mostrar y ocultar-->

        <!--[if lt IE 9]>
            <style>
                .content{
                    height: auto;
                    margin: 0;
                }
                .content div {
                    position: relative;
                }
            </style>
        <![endif]-->
    </head>
    <body>
       <header>
    <div id="conheader">
    <h1>TrebolNEWS</h1>

<div id="menu" class="cbp-fbscroller" >
    @include('menu')
    <input type="hidden" id="menu_principal" value="" />
    <div class="cleaner"></div>
</div>

    </div><!-- #BeginLibraryItem "/Library/chat.lbi" --><div id="chat">
    <button id="showRight">Chatee con un operador</button>

            <div class="cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
            <h3>Consultas</h3><div id="formah3"></div>
            <div class="cleaner"></div>

       <form id="consultachat"  action="" method="post">

        <ul>
        <li  class="izq_consultachat" ><input name="nombre" type="text" placeholder="&nbsp;*Nombre:" /></li>

        <li class="der_consultachat" ><input name="apellido" type="text" placeholder="&nbsp;*Apellido:" /></li>

        <div class="cleaner"></div>

        <li class="izq_consultachat" ><input name="telefono" type="text" placeholder="Tel&eacute;fono:"  /></li>


        <li class="der_consultachat" ><input name="empresa" type="text" placeholder="Empresa:" /></li>

        <div class="cleaner"></div>

        <li class="email_chat"><input name="email" type="text" placeholder="&nbsp;*Email:"  /></li>


        <li><textarea name="comentario" placeholder="&nbsp;*Comentario:"></textarea></li>

        </ul>

        <p>*&nbsp;Campos obligatorios</p>

        <div id="botones_consultachat">
        <input class="btn"  id="borrar" type="reset" value="BORRAR" name="borrar" />
        <input type="button" value="ENVIAR" name="enviar" id="saveForm2" />
        <div class="cleaner"></div>
        </div><!--botones_consultachat-->
        </form>

        </div><!--cbp-spmenu-s2-->

    </div><!--chat--><!-- #EndLibraryItem --></header>
<div id="container">

            <section class="tabs">

              <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
              <label for="tab-1" class="tab-label-1">Perfil</label>

              <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
              <label for="tab-2" class="tab-label-2">Facturación</label>

               <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
              <label for="tab-3" class="tab-label-3">Edici&oacute;n de env&iacute;os </label>


                <div class="clear-shadow"></div>

              <div class="content">
                <form id="frm_perfil" action="{{ action('UsuarioController@editar_perfil') }}" method="post">
                    <input type="hidden" name="nombre" value="{{ Auth::user()->nombre }}" />
                    <input type="hidden" name="apellido" value="{{ Auth::user()->apellido }}" />
                    <input type="hidden" name="telefono" value="{{ Auth::user()->telefono }}" />
                    <input type="hidden" name="empresa" value="{{ Auth::user()->empresa }}" />
                    <input type="hidden" name="ciudad" value="{{ Auth::user()->ciudad }}" />
                    <input type="hidden" name="pais" value="{{ Auth::user()->pais }}" />
                </form>
              <div class="content-1">
              <h2>Edita tu perfil</h2>
                <div class="infocont">
                    <table width="100%"  cellpadding="0" cellspacing="0" class="perfiltabla">
                        <tr class="primeraperfil">
                            <th scope="col" width="200px" class="tipoperfil">Nombre:</th>
                            <th class="datoperfil" scope="col" width="684px" editable="nombre">
                                {{ Auth::user()->nombre }}
                            </th>
                        </tr>
                        <tr>
                            <td class="tipoperfil">Apellido:</td>
                            <td class="datoperfil" editable="apellido">
                                {{ Auth::user()->apellido }}
                            </td>
                        </tr>
                        <tr>
                            <td class="tipoperfil">Tel&eacute;fono:</td>
                            <td class="datoperfil" editable="telefono">
                                {{ Auth::user()->telefono }}
                            </td>
                        </tr>
                        <tr>
                            <td class="tipoperfil">Email:</td>
                            <td class="datoperfil">
                                {{ Auth::user()->email }}
                            </td>
                        </tr>
                        <tr>
                            <td class="tipoperfil">Empresa:</td>
                            <td class="datoperfil" editable="empresa">
                                {{ Auth::user()->empresa }}
                            </td>
                        </tr>
                        <tr>
                            <td class="tipoperfil">Ciudad:</td>
                            <td class="datoperfil" editable="ciudad">
                                {{ Auth::user()->ciudad }}
                            </td>
                        </tr>
                        <tr>
                            <td class="tipoperfil">Pa&iacute;s:</td>
                            <td class="datoperfil" editable="pais">
                                {{ Auth::user()->pais }}
                            </td>
                        </tr>
                    </table>
                    <div class="editarperfil">
                        <a href="#" class="btn_editar">EDITAR PERFIL</a>
                        <a href="#" class="btn_guardar">GUARDAR PERFIL</a>
                    </div>
                </div> <!--infocont-->
              </div>  <!--content-1-->

        <div class="content-2">
        <h2>Edita la informaci&oacute;n de tu empresa</h2>
        <div class="infocont">
                <table width="100%"  cellpadding="0" cellspacing="0" class="perfiltabla">
                    <tr class="primeraperfil">
                        <th scope="col" width="350px" class="tipoperfil">Nombre de la empresa:</th>
                        <th class="datoperfil" scope="col" width="504px" editable="nombre_empresa">
                            Nocturna
                        </th>
                    </tr>
                    <tr>
                        <td class="tipoperfil">CUIT Empresa:</td>
                        <td class="datoperfil" editable="cuit">
                            22-5555741713-4
                        </td>
                    </tr>
                    <tr>
                        <td class="tipoperfil">Tipo de factura:</td>
                        <td class="datoperfil" editable="tipo_factura">
                            Tipo "A"
                        </td>
                    </tr>
                    <tr>
                        <td class="tipoperfil">Tel&eacute;fono:</td>
                        <td class="datoperfil" editable="telefono_empresa">
                            (011) 555-1713
                        </td>
                    </tr>
                    <tr>
                        <td class="tipoperfil">Direcci&oacute;n de facturaci&oacute;n:</td>
                        <td class="datoperfil" editable="direccion_empresa">
                            Juana Azurduy N&deg;1713
                        </td>
                    </tr>
                    <tr>
                        <td class="tipoperfil">C&oacute;digo postal:</td>
                        <td class="datoperfil" editable="cp_empresa">
                            2385
                        </td>
                    </tr>
                    <tr>
                        <td class="tipoperfil">Ciudad y Pa&iacute;s:</td>
                        <td class="datoperfil" editable="ciudad_empresa">
                            Buenos Aires - Argentina
                        </td>
                    </tr>
                    <tr>
                        <td class="tipoperfil">Nombre de la persona responsable:</td>
                        <td class="datoperfil" editable="nombre_responsable">
                            Juan Carlos Ertchert
                        </td>
                    </tr>
                    <tr>
                        <td class="tipoperfil">Email del responsable:</td>
                        <td class="datoperfil" editable="email_responsable">
                            juanertchert@ejemplo.com
                        </td>
                    </tr>
                </table>

                <div class="editarperfil">
                    <a href="#" class="btn_editar">EDITAR PERFIL</a>
                    <a href="#" class="btn_guardar">GUARDAR PERFIL</a>
                </div>

              </div><!--infocont-->
        </div> <!--content-2-->

        <div class="content-3">
        <h2>Edita tus env&iacute;os</h2>
        <div class="infocont">
        <h3>Pie de Campa&ntilde;a</h3>
        <p>S&oacute;lo para cuentas pagas. Las cuentas free no pueden editarse.</p>


<div id="configurar_piecam">

<div id="mostrar_piecam">
<a class="verpiedecam usarpie">Usar Pie por default</a>
<a class="verpiedecam editarpiecam" href="#" onclick="ocultar_mostrar('mostrar_piecam'); return false;">Editar Pie</a>
<div class="divparaocultar"></div>
</div>


<div id="info_piecam">
<a class="verpiedecam usarpie" href="#" onclick="ocultar_mostrar('mostrar_piecam'); return false;">Usar Pie por default</a>
<a class="verpiedecam editarpiecam">Editar Pie</a>

<form id="formularioperfil"  action="" method="post">

        <input name="empresa" type="text" class="text" id="" placeholder="Empresa:" />
        <input name="logo" type="file" class="text der" id="file" placeholder="Logo" />
        <div class="cleaner"></div>
        <input name="email" type="text" class="text" id=""   placeholder="Email:" />
        <input name="direccion" type="text" class="text der" id="" placeholder="Direcci&oacute;n:" />
        <div class="cleaner"></div>

        <div id="botonesform" class="buttons">
        <p class="indicacion">* Especificar medidas m&aacute;xima del logo en px.</p>
        <input type="button" value="GUARDAR" name="submit" onClick="enviar(this.form)" id="saveForm" />
        <input class="btn"  id="borrar" type="reset" value="BORRAR" name="Enviar2" />
        <div class="cleaner"></div>
        </div>

        </form>
<div class="cleaner"></div>
</div><!--info_piecam-->
</div><!--configurar_piecam-->




        </div><!--infocont-->
        </div> <!--content-3-->



        </div>
        </section>
        </div><!--conteiner--><!-- #BeginLibraryItem "/Library/footer_internas.lbi" --><div id="foo">
      <div id="foo_text">

        <div id="foo_izq">
        <h6>TrebolNEWS</h6>
        <p>www.trebolnews.com - Copyright 2013</p>
        </div>

        <div id="foo_der">
        <a href="#" class="twe">Seguinos por Tweter</a>
        <a href="#" class="face">Estamos en Facebook</a>

        <form id="subanewsletter" method="post"  action=""> <!-- es necesario que coincida el nombre de este archivo php con el que aparece en el campo action -->
        <input type="text" name="email" class="compo-form" id="newsletter" placeholder="Suscr&iacute;bete a nuestro Newsletter"  style=" color:#FFF; font-size:12px;"  />
        <input type="submit" id="button" value="ENVIAR" />
        </form>

        <div class="cleaner"></div>
        </div>

      <div class="cleaner"></div>

       <div id="botones_footer">
       <ul>
       <li><a href="campanias.html">Campa&ntilde;as</a></li>
       <li><a href="listascontactos.html">Suscriptores</a></li>
       <li><a href="libreria.html">Libre&iacute;as</a></li>
       <li><a href="planes.html">Planes</a></li>
       <li><a href="soporte.html">Soporte</a></li>
       <li><a href="terminosycondiciones.html" class="ultimo_boton_footer" target="_blank">Terminos y Condiciones</a></li>
       </ul>
       <div class="cleaner"></div>
       </div><!--botones_footer-->

      </div><!--fin de foo_text-->
      </div>

      <!--fin de footer--><!-- #EndLibraryItem --><!--input file-->
      <script type="text/javascript">
        ;(function( $ ) {

          // Browser supports HTML5 multiple file?
          var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
              isIE = /msie/i.test( navigator.userAgent );

          $.fn.customFile = function() {

            return this.each(function() {

              var $file = $(this).addClass('customfile'), // the original file input
                  $wrap = $('<div class="customfile-wrap">'),
                  $input = $('<input type="text" class="customfile-filename" placeholder="Cargar logo" />'),
                  // Button that will be used in non-IE browsers
                  $button = $('<button type="button" class="customfile-upload">EXAMINAR</button>'),
                  // Hack for IE
                  $label = $('<label class="customfile-upload" for="'+ $file[0].id +'">EXAMINAR</label>');

              // Hide by shifting to the left so we
              // can still trigger events
              $file.css({
                position: 'absolute',
                left: '-9999px'
              });

              $wrap.insertAfter( $file )
                .append( $file, $input, ( isIE ? $label : $button ) );

              // Prevent focus
              $file.attr('tabIndex', -1);
              $button.attr('tabIndex', -1);

              $button.click(function () {
                $file.focus().click(); // EXAMINAR dialog
              });

              $file.change(function() {

                var files = [], fileArr, filename;

                // If multiple is supported then extract
                // all filenames from the file array
                if ( multipleSupport ) {
                  fileArr = $file[0].files;
                  for ( var i = 0, len = fileArr.length; i < len; i++ ) {
                    files.push( fileArr[i].name );
                  }
                  filename = files.join(', ');

                // If not supported then just take the value
                // and remove the path to just show the filename
                } else {
                  filename = $file.val().split('\\').pop();
                }

                $input.val( filename ) // Set the value
                  .attr('title', filename) // Show filename in title tootlip
                  .focus(); // Regain focus

              });

              $input.on({
                blur: function() { $file.trigger('blur'); },
                keydown: function( e ) {
                  if ( e.which === 13 ) { // Enter
                    if ( !isIE ) { $file.trigger('click'); }
                  } else if ( e.which === 8 || e.which === 46 ) { // Backspace & Del
                    // On some browsers the value is read-only
                    // with this trick we remove the old input and add
                    // a clean clone with all the original events attached
                    $file.replaceWith( $file = $file.clone( true ) );
                    $file.trigger('change');
                    $input.val('');
                  } else if ( e.which === 9 ){ // TAB
                    return;
                  } else { // All other keys
                    return false;
                  }
                }
              });

            });

          };

          // Old browser fallback
          if ( !multipleSupport ) {
            $( document ).on('change', 'input.customfile', function() {

              var $this = $(this),
                  // Create a unique ID so we
                  // can attach the label to the input
                  uniqId = 'customfile_'+ (new Date()).getTime(),
                  $wrap = $this.parent(),

                  // Filter empty input
                  $inputs = $wrap.siblings().find('.customfile-filename')
                    .filter(function(){ return !this.value }),

                  $file = $('<input type="file" id="'+ uniqId +'" name="'+ $this.attr('name') +'"/>');

              // 1ms timeout so it runs after all other events
              // that modify the value have triggered
              setTimeout(function() {
                // Add a new input
                if ( $this.val() ) {
                  // Check for empty fields to prevent
                  // creating new inputs when changing files
                  if ( !$inputs.length ) {
                    $wrap.after( $file );
                    $file.customFile();
                  }
                // Remove and reorganize inputs
                } else {
                  $inputs.parent().remove();
                  // Move the input so it's always last on the list
                  $wrap.appendTo( $wrap.parent() );
                  $wrap.find('input').focus();
                }
              }, 1);

            });
          }

        }( jQuery ));

        $('input[type=file]').customFile();
    </script>
       <!--input file-->



      <!--chat-->
        {{ HTML::script('home/js/chat.js') }}
        <script>
            var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
                showRight = document.getElementById( 'showRight' ),
                showTop = document.getElementById( 'showTop' ),
                body = document.body;

            showRight.onclick = function() {
                classie.toggle( this, 'active' );
                classie.toggle( menuRight, 'cbp-spmenu-open' );
                disableOther( 'showRight' );
            };

            function disableOther( button ) {

                if( button !== 'showRight' ) {
                    classie.toggle( showRight, 'disabled' );
                }
            }
        </script>
       <!--chat-->





      <!--explorer placeholder-->

        <script type="text/javascript">
/* <![CDATA[ */
$(function() {
    var input = document.createElement("input");
    if(('placeholder' in input)==false) {
        $('[placeholder]').focus(function() {
            var i = $(this);
            if(i.val() == i.attr('placeholder')) {
                i.val('').removeClass('placeholder');
                if(i.hasClass('password')) {
                    i.removeClass('password');
                    this.type='password';
                }
            }
        }).blur(function() {
            var i = $(this);
            if(i.val() == '' || i.val() == i.attr('placeholder')) {
                if(this.type=='password') {
                    i.addClass('password');
                    this.type='text';
                }
                i.addClass('placeholder').val(i.attr('placeholder'));
            }
        }).blur().parents('form').submit(function() {
            $(this).find('[placeholder]').each(function() {
                var i = $(this);
                if(i.val() == i.attr('placeholder'))
                    i.val('');
            })
        });
    }
});
/* ]]> */
</script>

 <!--explorer placeholder-->

    </body>
</html>
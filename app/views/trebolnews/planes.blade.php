@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Campañas

@stop

@section('script')
    {{ HTML::style('css/general.css') }} {{-- oops --}}
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    <script>
    $(function(){

        $('.plan').click(function(e){
            e.preventDefault();
            $('.plan').find('input').prop('checked', '');
            var $this = $(this);
            var input;
            if($this.data('plan'))
                input = $this;
            else
                input = $this.find('input');
            input.prop('checked', 'checked');
            var planId = input.data('plan');
            var planName = input.data('plan-name');
            $('#comprar').attr('href', '/checkout/' + planId);
        });

        $('#comprar').click(function(e){
            e.preventDefault();
            var input = $('.plan').find('input:checked');
            var planId = input.data('plan');
            var planName = input.data('plan-name');

            if(confirm('Esta seguro que desea comprar ' + planName)) {
                window.top.location.href = $(e.target).attr('href');
            }
        });

    });
    </script>
@stop

@section('data')

    @parent
    <input type="hidden" id="menu_principal" value="planes" />

@stop

@section('contenido')

<div id="container">
    <section class="tabs">
        <div class="content">
            <h2>Precios y Planes</h2>
            <select class="select-precios">
                <option value='USD'>Dolares estadounidenses</option>
                <option value='ARS'>Pesos Argentinos</option>
            </select>
            <script>
            var moneda = 'USD';
            var ARS_rate = 0;
            function precio(moneda){
                switch (moneda) {
                case 'ARS':
                    $('.moneda').html('AR$');
                    break;
                case 'USD':
                    $('.moneda').html('US$');
                    break;
                }
            }

            $(".select-precios").change(function(e) {
                if(moneda != 'ARS' && $(".select-precios").val() == 'ARS' && ARS_rate != 0){
                    $('.price').each(function(n,o){
                        var new_price = (parseFloat( $(this).data('price') ) * ARS_rate);
                        $(this).html( new_price.toFixed(2) );
                    });

                    precio($(this).val());
                    moneda = 'ARS';
                }else if(moneda != 'USD' && $(".select-precios").val() == 'USD' && ARS_rate != 0){
                    $('.price').each(function(n,o){
                        $(this).html( parseFloat( $(this).data('price') ));
                    });

                    precio($(this).val());
                    moneda = 'USD';
                }else{
                    $(".select-precios").val('USD');
                    e.preventDefault();
                }
                
            });

            $(document).ready(function(){
                precio('USD');

                $.ajax({
                    url: 'https://api.mercadolibre.com/currency_conversions/search',
                    method: 'get',
                    dataType: "jsonp",
                    data:{
                        from: 'USD',
                        to: 'ARS'
                    },
                    success: function(data){
                        ARS_rate = data[2].ratio;
                    }
                });
            });
            </script>
            <div class="infocont">
                <div id="planes">
                    <div id="pfree">
                        <h3>Plan Gratuito</h3>
                        <p>Dise&ntilde;ado para negocios o proyectos peque&ntilde;os, este plan permite experimentar la plataforma y los servicios que ofrece TrebolNews.<br>
                        No se requieren los datos de la tarjeta de cr&eacute;dito. &iexcl;Prueba gratis hasta 500 env&iacute;os! </p>
                        <div class="infoplanes">
                            <div class="verdeinfo">
                                <div class="radioplanes radioplanes_gratis">
                                    <!--<input type="radio" id="radio1" name="opcion" tipo-plan="gratis" /> -->
                                    <!-- <label for="radio1"></label> -->
                                </div>
                                <h4><span class="hastaplan">Hasta</span><img src="imagenes/plane.png" width="18px" height="18px" alt="icono">500</h4>
                                <div class="cleaner"></div>
                                <h4 class="segundalinea_plan"><span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;Gratis</span></h4>
                                <div class="cleaner"></div>
                            </div>
                            <div class="grisinfo"><img class="xicon" src="imagenes/cruzicongris.png" width="38px" height="38px" alt="icono"></div>
                            <div class="verdeinfo"><img class="xicon" src="imagenes/cruziconverde.png" width="38px" height="38px" alt="icono"></div>
                            <div class="grisinfo"><img class="xicon" src="imagenes/cruzicongris.png" width="38px" height="38px" alt="icono"></div>
                            <div class="verdeinfo"><img class="xicon" src="imagenes/cruziconverde.png" width="38px" height="38px" alt="icono"></div>
                            <div class="grisinfo"><img class="xicon" src="imagenes/cruzicongris.png" width="38px" height="38px" alt="icono"></div>
                            <div class="verdeinfo"><img class="xicon" src="imagenes/cruziconverde.png" width="38px" height="38px" alt="icono"></div>
                        </div><!--infoplanes-->
                    </div><!--pfree-->
                    <div id="individual">
                        <h3>Plan Mensual</h3>
                        <p>Ideal para grandes campa&ntilde;as. Se abona s&oacute;lo la cantidad de env&iacute;os que necesita. Adem&aacute;s, no hay l&iacute;mite de env&iacute;os. Compra m&iacute;nima 3 meses.<br> </p>
                        <div class="infoplanes">
                            <?php
                            $class = 'verde';
                            $icon = '';
                            $i = 0;
                            foreach ($plans as $plan) {
                                if (!$plan->isSuscription) {
                            ?>
                            <div class="{{ $class }}info single plan">
                                <div class="radioplanes radioplanes_corto">
                                    <input type="radio" name="opcion" tipo-plan="envio" data-plan="{{ $plan->id }}" data-plan-name="{{ $plan->nombre }}" />
                                    <label></label>
                                </div>
                                <h4><span class="hastaplan">Hasta</span><img src="imagenes/plane{{ $icon }}.png" width="18px" height="18px" alt="icono">{{ $plan->envios }}</h4>
                                <div class="cleaner"></div>
                                <h4 class="segundalinea_plan"><span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;<span class="moneda"></span><span class="price" data-price="{{ $plan->precio }}">{{ $plan->precio }}</span></span></h4>
                                <div class="cleaner"></div>
                            </div>
                            <?php
                                $class = ($class==='verde')? 'gris' : 'verde';
                                $icon = ($icon==='')? 'gris' : '';
                                $i++;
                                }
                            }
                            ?>
                        </div><!--infoplanes-->
                    </div><!--individual-->
                    <div id="mensuales">
                         <h3>Planes Individual</h3>
                        <p>Exclusivo paquete preparado para realizar env&iacute;os con poca frecuencia. Se contrata la cantidad de suscriptores que necesite para sus env&iacute;os.</p>
                        <div class="infoplanes">
                            <?php
                            $class = 'verde';
                            $icon = '';
                            $i = 0;
                            foreach ($plans as $plan) {
                                if ($plan->isSuscription) {
                            ?>
                            <div class="{{ $class }}info suscription plan">
                                <div class="radioplanes radioplanes_corto">
                                    <input type="radio" id="radio{{ $i }}" name="opcion" tipo-plan="suscriptor" data-plan="{{ $plan->id }}" data-plan-name="{{ $plan->nombre }}" />
                                    <label for="radio{{ $i }}"></label>
                                </div>
                                <h4><span class="hastaplan">Hasta</span><img src="imagenes/plane{{$icon}}.png" width="18px" height="18px" alt="icono">{{$plan->envios}}</h4>
                                <div class="cleaner"></div>
                                <h4 class="segundalinea_plan"><span class="hastaenv">Suscriptores</span><span class="precioplan">&nbsp;<span class="moneda"></span><span class="price" data-price="{{ $plan->precio }}">{{ $plan->precio }}</span></span></h4>
                                <div class="cleaner"></div>
                            </div>
                            <?php
                                $class = ($class === 'verde') ? 'gris' : 'verde';
                                $icon = ($icon === '') ? 'gris' : '';
                                $i++;
                                }
                            }
                            ?>
                            
                        </div><!--infoplanes-->
                    </div><!--mensuales-->
                    <div class="cleaner"></div>
                </div>
                <div class="content-medios-de-pago">
                        <img src="imagenes/formasdepago2.png" width="934" height="80" alt="formas de pago">
                    </div>
                <div class="formasdepago">
                    <h4>ELIGE LA FORMA DE PAGO</h4>
                    <div class="select-forma-de-pago active">
                        <input checked type="radio" id="tarjeta-de-credito" name="forma-de-pago">
                        <label for="tarjeta-de-credito"></label>
                        <p for="tarjeta-de-credito">Compra con tarjeta</p>
                    </div>
                    <div class="select-forma-de-pago">
                        <input type="radio" id="transferencia-bancaria" name="forma-de-pago">
                        <label for="transferencia-bancaria"></label>
                        <p>Transferencia bancaria</p>
                    </div>
                    <p class="aclaracion-text tarjeta">Los paquetes que compres con tarjeta de crédito, se activarán inmeditamente en tu cuenta. Los mismos tienen una validez de 30 días para ser utilizados. Muchos éxitos en tus campañas!!!</p>
                    <p class="aclaracion-text transferencia">Al enviar tus datos te llegará un email con la factura y datos para realizar la transferencia bancaria.<br>Envíanos el comprobante de transferencia para poder activar tu compra. Muchos éxitos!</p>
                    
                    <div class="transferencia-bancaria">
                        <div class="content-select">
                            <div class="select-custom">
                                <ul id="select-tipo-factura">
                                    <li>
                                        <a href="#" class="boton">SELECCIONA TIPO DE FACTURA</a>
                                        <ul class="opciones-select">
                                            <li><a href="#" tipo="consumidor-final">CONSUMIDOR FINAL</a></li>
                                            <li><a href="#" tipo="responsable-inscripto">RESPONSABLE INSCRIPTO</a></li>
                                        </ul>
                                    </li>
                                </ul> 
                                <div class="cleaner"></div>
                            </div>
                           
                        </div>

                        <div class="content-form-deposito">
                            <div class="wrapper">
                                <form>
                                    <div class="forms-afip responsable-inscripto">
                                        <div class="col-left">
                                            <input type="text" placeholder="NOMBRE Y APELLIDO RESPONSABLE*">
                                            <input type="text" placeholder="NOMBRE DE LA EMPRESA*">
                                            <input type="text" placeholder="DIRECCIÓN DE FACTURACIÓN*">
                                        </div>
                                        <div class="col-right">
                                            <input type="text" placeholder="MAIL DE CONTACTO*">
                                            <input type="text" placeholder="CUIT EMPRESA*">
                                            <input type="text" placeholder="TELÉFONO DE CONTACTO">
                                        </div>
                                    </div>
                                    <div class="forms-afip consumidor-final">
                                        <div class="col-left">
                                            <input type="text" placeholder="NOMBRE Y APELLIDO RESPONSABLE*">
                                            <input type="text" placeholder="EMPRESA">
                                            <input type="text" placeholder="DIRECCIÓN">
                                        </div>
                                        <div class="col-right">
                                            <input type="text" placeholder="MAIL DE CONTACTO*">
                                            <input type="text" placeholder="TELÉFONO DE CONTACTO">
                                        </div>
                                    </div>
                                        
                                    
                                </form>
                            </div>                        
                        </div>
                    </div>
                    
                    
                    <script>
                        $(document).ready(function(){
                            $('.tarjeta').show();
                            $('.transferencia').hide();
                        });
                       function reiniciarForm(){
                           $('.tarjeta').show();
                            $('.transferencia').hide();
                       }
                        $('#select-tipo-factura').find('a').click(function(e){
                            e.preventDefault();
                            
                        });
                        $('#select-tipo-factura').find('.boton').hover(function(e){
                            $('#select-tipo-factura').find('.opciones-select').css('pointer-events', 'all');
                        });
                        
                        $('#select-tipo-factura').find('.opciones-select').find('a').click(function(e){
                            e.preventDefault();
                            $('#select-tipo-factura').find('.boton').html($(this).html());
                            $('#select-tipo-factura').find('.opciones-select').css('pointer-events', 'none');
                           
                            $('.forms-afip').hide();
                            $('.'+this.getAttribute('tipo')).fadeIn();
                            if(this.getAttribute('tipo') == 'consumidor-final'){
                                $('.consumidor-final').show();
                                $('.responsable-inscripto').hide();
                                $('.detalle-factura').show();
                            }else if(this.getAttribute('tipo') == 'responsable-inscripto'){
                                $('.consumidor-final').hide();
                                $('.responsable-inscripto').show();
                                $('.detalle-factura').show();
                            }
                        });
                        
                        
                        $(".select-forma-de-pago").find('input').change(function() {
                            
                            if(this.getAttribute('id') == 'transferencia-bancaria'){
                                $('.transferencia-bancaria').fadeIn();
                                $('.detalle-factura').hide();
                                $('.tarjeta').hide();
                                $('.transferencia').show();
                                
                            }else{
                                $('.transferencia-bancaria').fadeOut();
                                $('.detalle-factura').hide();       
                                $('.tarjeta').show();
                                $('.transferencia').hide();
                            }
                            $(".select-forma-de-pago").removeClass('active');
                            if(this.checked) {
                                $(this).parent().addClass('active');
                                
                            }
                        });
                        
                       
                    </script>
                    <div class="content-codigo-de-promocion" >
                        <input type="checkbox" id="codigo-promocion" name="codigo-promocion">
                        <label for="codigo-promocion"></label>                       
                        <p>Si tenés un código promoción, indicarlo.</p>
                        <input id="codigo-promocion-input" type="text" placeholder="CÓDIGO DE PROMOCIÓN">
                    </div>
                    
                    <!-- ENVIOS -->
                    
                    <div class="comprar-envios-content">
                        <div class="seleccion-meses solo-envio">
                            <div class="titulo">
                                <p>SELECCIONAR CANTIDAD DE MESES</p>
                            </div>
                            <div class="meses">
                                <div class="select-mes solo-envio" title="10% Descuento" descripcion="3 meses 10% Desc">
                                    <input checked type="radio"  id="cantidad-meses-3" name="cantidad-meses">
                                    <label for="cantidad-meses-3"></label>
                                    <p for="cantidad-meses">3</p>
                                </div>
                                <div class="select-mes solo-envio" title="25% Descuento" descripcion="6 meses 25% Desc">
                                    <input type="radio" id="cantidad-meses-6" name="cantidad-meses">
                                    <label for="cantidad-meses-6"></label>
                                    <p for="cantidad-meses">6</p>
                                </div>
                                <div class="select-mes solo-envio" title="35% Descuento" descripcion="12 meses 30% Desc">
                                    <input type="radio" id="cantidad-meses-12" name="cantidad-meses">
                                    <label for="cantidad-meses-12"></label>
                                    <p for="cantidad-meses">12</p>
                                </div>
                                <script>
                                $( document ).tooltip({
      position: {
        my: "center bottom-10",
        at: "center top",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      }
    });
                                    </script>
                            </div>
                        </div>
                        <div class="detalle-factura">
                            <div class="content-titulo">
                                <h4>DETALLE FACTURA</h4>
                            </div>
                            <div class="content-descripcion-compra">
                                <div class="fila solo-envio" style="width: 99% !important;">
                                    <div><p>Paquete</p></div>
                                    <div><p class="decripcion-plan">3 meses 10% Desc</p></div>
                                    <div><p style="text-align: right;">Envios 1.500</p></div>
                                    <div><p style="text-align: right;">Subtotal</p></div>
                                    <div><p style="text-align: right;"> $125.00</p></div>
                                </div>
                                
                                <div class="fila solo-suscriptor">
                                    <div><p>Paquete</p></div>
                                    <div><p>Hasta</p></div>
                                    <div><p>3.000</p></div>
                                    <div><p style="text-align: right;">Subtotal</p></div>
                                    <div><p style="text-align: right;"> $125.00</p></div>
                                </div>
                                <div class="fila responsable-inscripto">
                                    <div><p>Inpuestos</p></div>
                                    <div><p></p></div>
                                    <div><p></p></div>
                                    <div><p style="text-align: right;">IVA 21%</p></div>
                                    <div><p style="text-align: right;"> $125.00</p></div>
                                </div>
                                <div class="fila">
                                    <div><p></p></div>
                                    <div><p></p></div>
                                    <div><p></p></div>
                                    <div><p style="text-align: right;"><b>Total:</b></p></div>
                                    <div><p style="text-align: right;"> $125.00</p></div>
                                </div>
                            </div>  
                        </div>
                        <div class="detalle-factura-envios-tarjeta solo-envio tarjeta">
                            <div class="content-titulo solo-envio">
                                <h4>DETALLE FACTURA</h4>
                            </div>
                            <div class="content-descripcion-compra solo-envio">
                                
                                <div class="fila solo-envio" style="width: 99% !important;">
                                    <div><p>Paquete</p></div>
                                    <div><p class="decripcion-plan">3 meses 10% Desc</p></div>
                                    <div><p style="text-align: right;">Envios 1.500</p></div>
                                    <div><p style="text-align: right;">Subtotal</p></div>
                                    <div><p style="text-align: right;"> $125.00</p></div>
                                </div>
                               
                            </div>  
                        </div>
                        
                    </div>
                    
                    <!-- END ENVIOS -->
                    
                    <div class="bto_planes">
                    <a href="#" id="comprar">
                        <span class="tarjeta">COMPRAR AHORA</span>
                        <span class="transferencia">ENVIAR AHORA</span>
                    </a>
                    <div class="cleaner"></div>
                    </div>
                    
                    
                    <div class="cleaner"></div>
                </div><!--formasdepago-->
            </div> <!--infocont-->
        </div>
    </section>
    <script>
  $(function() {
     $(".select-mes").click(function(){
         $('.decripcion-plan').html($(this).attr('descripcion'));
         
     });
     $("#codigo-promocion").click(function(){
         if($("#codigo-promocion").is(':checked')){
             $('#codigo-promocion-input').fadeIn();
         }else{
             $('#codigo-promocion-input').fadeOut();
         }
         
     });
    $(".radioplanes").find('label').click(function () {
         $('.detalle-factura').hide();
         reiniciarForm();
            var tipoPlan = $(this).parent().find('input').attr('tipo-plan');
            //envio
            //suscriptor
            if (tipoPlan == 'envio'){
                $('.solo-envio').show();
                $('.solo-suscriptor').hide();
            }
            if (tipoPlan == 'suscriptor'){
                $('.solo-envio').hide();
                $('.solo-suscriptor').show();
            }
            if (tipoPlan == 'gratis'){
                $('.formasdepago').fadeOut();
            }else{
                $('.formasdepago').fadeIn();
            }
            
    });
    
  });
  
  </script>
</div><!--conteiner-->

@stop

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
                    url: 'http://www.freecurrencyconverterapi.com/api/v2/convert',
                    method: 'post',
                    dataType: "jsonp",
                    data:{
                        q: 'USD_ARS',
                    },
                    success: function(data){
                        ARS_rate = data.results.USD_ARS.val;
                    }
                });
            });
            </script>
            <div class="infocont">
                <div id="planes">
                    <div id="pfree">
                        <h3>Plan Gratuito</h3>
                        <p>Dise&ntilde;ado para negocios o proyectos peque&ntilde;os, este plan permite experimentar la plataforma y los servicios que ofrece TrebolNews.<br>No se requieren los datos de la tarjeta de cr&eacute;dito. &iexcl;Prueba gratis hasta 500 env&iacute;os!</p>
                        <div class="infoplanes">
                            <div class="verdeinfo">
                                <div class="radioplanes radioplanes_gratis">
                                    <input type="radio" id="radio1" name="opcion" />
                                    <label for="radio1"></label>
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
                        <h3>Plan Individual</h3>
                        <p>Exclusivo paquete preparado para realizar envíos con poca frecuencia. S contrata la cantidad de envíos que necesite. No hay límite de tiempo ni vencimientos de la compra.<br> </p>
                        <div class="infoplanes">
                            <?php
                            $class = 'verde';
                            $icon = '';
                            $i = 0;
                            foreach ($plans as $plan) {
                                if (!$plan->isSuscription) {
                            ?>
                            <div class="{{ $class }}info single plan">
                                <div class="radioplanes radioplanes_largo">
                                    <input type="radio" name="opcion" data-plan="{{ $plan->id }}" data-plan-name="{{ $plan->nombre }}" />
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
                        <h3>Planes Mensuales</h3>
                        <p>Ideal para grandes envíos de campañas. Se abona sólo la cantidad de suscriptores que necesita. Además, no hay límite de envíos. Estos planes tienen una validez de 30 día para ser consumidos.</p>
                        <div class="infoplanes">
                            <?php
                            $class = 'verde';
                            $icon = '';
                            $i = 0;
                            foreach ($plans as $plan) {
                                if ($plan->isSuscription) {
                            ?>
                            <div class="{{ $class }}info suscription plan">
                                <div class="radioplanes radio   es_largo">
                                    <input type="radio" id="radio{{ $i }}" name="opcion" data-plan="{{ $plan->id }}" data-plan-name="{{ $plan->nombre }}" />
                                    <label for="radio{{ $i }}"></label>
                                </div>
                                <h4><span class="hastaplan">Hasta</span><img src="imagenes/plane{{$icon}}.png" width="18px" height="18px" alt="icono">{{$plan->envios}}</h4>
                                <div class="cleaner"></div>
                                <h4 class="segundalinea_plan"><span class="hastaenv"> Suscriptores</span><span class="precioplan">&nbsp;<span class="moneda"></span><span class="price" data-price="{{ $plan->precio }}">{{ $plan->precio }}</span></span></h4>
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
                    <div class="select-forma-de-pago">
                        <input type="radio" id="tarjeta-de-credito" name="forma-de-pago">
                        <label for="tarjeta-de-credito"></label>
                        <p for="tarjeta-de-credito">Compra con tarjeta</p>
                    </div>
                    <div class="select-forma-de-pago">
                        <input type="radio" id="transferencia-bancaria" name="forma-de-pago">
                        <label for="transferencia-bancaria"></label>
                        <p>Transferencia bancaria</p>
                    </div>
                    <p class="aclaracion-text">Los paquetes que compres con tarjeta de crédito, se activarán inmeditamente en tu cuenta. Los mismos tienen una validez de 30 días para ser utilizados. Muchos éxitos en tus campañas!!!</p>
                    
                    <div class="transferencia-bancaria">
                        <div class="content-select">
                            <select class="select-tipo-factura">
                                <option>SELECCIONA TIPO DE FACTURA</option>
                                <option value="consumidor-final">CONSUMIDOR FINAL</option>
                                <option value="responsable-inscripto">RESPONSABLE INSCRIPTO</option>
                            </select>
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
                        $(".select-forma-de-pago").find('input').change(function() {
                            
                            if(this.getAttribute('id') == 'transferencia-bancaria'){
                                $('.transferencia-bancaria').fadeIn();
                            }else{
                                $('.transferencia-bancaria').fadeOut();
                            }
                            $(".select-forma-de-pago").removeClass('active');
                            if(this.checked) {
                                $(this).parent().addClass('active');
                                
                            }
                        });
                        $('.select-tipo-factura').change(function() {
                            var formVer = '.'+$(this).val();
                            $('.forms-afip').hide();
                               // $('.forms-afip').show();
                            $(formVer).fadeIn();
                        });
                    </script>
                    <div class="content-codigo-de-promocion" >
                        <input type="checkbox" id="codigo-promocion" name="codigo-promocion">
                        <label for="codigo-promocion"></label>                       
                        <p>Si tenés un código promoción, indicarlo.</p>
                    </div>
                    
                    <!-- ENVIOS -->
                    
                    <div class="comprar-envios-content">
                        <div class="seleccion-meses">
                            <div class="titulo">
                                <p>SELECCIONAR CANTIDAD DE MESES</p>
                            </div>
                            <div class="meses">
                                <div class="select-mes" title="10% Descuento">
                                    <input type="radio" id="cantidad-meses-3" name="cantidad-meses">
                                    <label for="cantidad-meses-3"></label>
                                    <p for="cantidad-meses">3</p>
                                </div>
                                <div class="select-mes">
                                    <input type="radio" id="cantidad-meses-6" name="cantidad-meses">
                                    <label for="cantidad-meses-6"></label>
                                    <p for="cantidad-meses">6</p>
                                </div>
                                <div class="select-mes" >
                                    <input type="radio" id="cantidad-meses-12" name="cantidad-meses">
                                    <label for="cantidad-meses-12"></label>
                                    <p for="cantidad-meses">12</p>
                                </div>
                            </div>
                        </div>
                        <div class="content-descripcion-compra">
                            <div><p>Paquete</p></div>
                            <div><p>3 meses 10% Desc</p></div>
                            <div><p>1.500</p></div>
                            <div><p>Envíos</p></div>
                            <div><p><b>Total:</b> $125.00</p></div>
                        </div>
                    </div>
                    
                    <!-- END ENVIOS -->
                    
                    <div class="bto_planes">
                    <a href="#" id="comprar">COMPRAR AHORA</a>
                    <div class="cleaner"></div>
                    </div>
                    
                    
                    <div class="cleaner"></div>
                </div><!--formasdepago-->
            </div> <!--infocont-->
        </div>
    </section>
    <script>
  $(function() {
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
  });
  </script>
</div><!--conteiner-->

@stop

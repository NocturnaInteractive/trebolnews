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
            function precio(moneda){
                switch (moneda) {
                case 'ARS':
                    $('.moneda').html('$');
                    break;
                case 'USD':
                    $('.moneda').html('U$S');
                    break;
                }
            }

            $(".select-precios").change(function() {
                precio($(this).val());
            });

            $(document).ready(function(){
                precio('USD');

                /*$.ajax({
                    url: 'http://www.geoplugin.net/currency_converter.gp?from=USD&to=ARS&amount=1',
                    method: 'get',
                    dataType: "jsonp",
                    data:{
                        from: 'USD',
                        to:   'ARS', 
                        amount: 1
                    },
                    success: function(data){
                        console.log(data);
                    }
                });*/
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
                                <h4 class="segundalinea_plan"><span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;<span class="moneda"></span>{{ $plan->precio }}</span></h4>
                                <div class="cleaner"></div>
                            </div>
                            <?php
                                $class = ($class==='verde')? 'gris' : 'verde';
                                $icon = ($icon==='')? 'gris' : '';
                                $i++;
                                }
                            }
                            ?>
                            <div class="{{ $class }}info">
                                <div class="radioplanes radioplanes_largo">
                                    <input type="radio"  id="radio{{ $i }}" name="opcion" />
                                    <label for="radio{{$i}}"></label>
                                </div>
                                <h4><span class="hastaplan">M&aacute;s</span><img src="imagenes/plane{{ $icon }}.png" width="18px" height="18px" alt="icono">100.000</h4>
                                <div class="cleaner"></div>
                                <h4 class="segundalinea_plan"><span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;<span class="moneda"></span>0</span></h4>
                                <div class="cleaner"></div>
                            </div>
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
                                <h4 class="segundalinea_plan"><span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;<span class="moneda"></span>{{$plan->precio}}</span></h4>
                                <div class="cleaner"></div>
                            </div>
                            <?php
                                $class = ($class === 'verde') ? 'gris' : 'verde';
                                $icon = ($icon === '') ? 'gris' : '';
                                $i++;
                                }
                            }
                            ?>
                            <div class="{{ $class }}info">
                                <div class="radioplanes radioplanes_largo">
                                    <input type="radio"  id="radio9" name="opcion" />
                                    <label for="radio9"></label>
                                </div>
                                <h4><span class="hastaplan">M&aacute;s</span><img src="imagenes/plane{{ $icon }}.png" width="18px" height="18px" alt="icono">100.000</h4>
                                <div class="cleaner"></div>
                                <h4 class="segundalinea_plan"><span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;<span class="moneda"></span>0</span></h4>
                                <div class="cleaner"></div>
                            </div>
                        </div><!--infoplanes-->
                    </div><!--mensuales-->
                    <div class="cleaner"></div>
                </div><!--planes-->
                <div id="bto_planes">
                    <a href="#" id="comprar">COMPRAR AHORA</a>
                    <div class="cleaner"></div>
                </div><!--bto_planes-->
                <div id="formasdepago">
                    <h6>Medios de pagos online</h6>
                    <img src="imagenes/formasdepago.png" width="934" height="80" alt="formas de pago">
                    <div class="cleaner"></div>
                </div><!--formasdepago-->
            </div> <!--infocont-->
        </div>
    </section>
</div><!--conteiner-->

@stop

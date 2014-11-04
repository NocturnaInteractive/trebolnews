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
                <option value='pesos'>Pesos Argentinos</option>
                <option value='dolares'>Dolares estadounidenses</option>
            </select>
            <script>
            var moneda = 'pesos';
            function precio(moneda){
                switch (moneda) {
                case 'pesos':
                    $('.moneda').html('$');
                    break;
                case 'dolares':
                    $('.moneda').html('U$S');
                    break;
                }
            }

            $(".select-precios").change(function() {
                precio($(this).val());
            });

            $(document).ready(function(){
                precio('pesos');
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
                        <p>Ideal para env&iacute;os de emails con poca frecuencia, porque se abona s&oacute;lo la cantidad de env&iacute;os que necesita el usuario. Adem&aacute;s, no hay l&iacute;mite de tiempo para efectuarlos.<br> </p>
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
                        <p>Exclusivo paquete preparado para realizar grandes env&iacute;os. Con una suscripci&oacute;n mensual se contrata una cantidad de env&iacute;os y no hay l&iacute;mite de tiempo para hacerlos.</p>
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

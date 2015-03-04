@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Campañas

@stop

@section('script')
    {{ HTML::style('css/general.css') }} {{-- oops --}}
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
            <select id="currency-dropdown" class="select-precios"></select>
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
                    <h4>FORMA DE PAGO</h4>
                    <!-- div class="select-forma-de-pago active">
                        <input checked type="radio" id="tarjeta-de-credito" name="forma-de-pago">
                        <label for="tarjeta-de-credito"></label>
                        <p for="tarjeta-de-credito">Compra con tarjeta</p>
                    </div>
                    <div class="select-forma-de-pago">
                        <input type="radio" id="transferencia-bancaria" name="forma-de-pago">
                        <label for="transferencia-bancaria"></label>
                        <p>Transferencia bancaria</p>
                    </div-->
                    <p class="aclaracion-text tarjeta">Los paquetes que compres con tarjeta de crédito, se activarán inmeditamente en tu cuenta y tienen una validez de 30 días para ser utilizados.</p>
                    <!--p class="aclaracion-text transferencia">Al enviar tus datos te llegará un email con la factura y datos para realizar la transferencia bancaria.<br>Envíanos el comprobante de transferencia para poder activar tu compra. Muchos éxitos!</p-->
                    
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
                    
                    
                    
                    <!-- ENVIOS -->
                    <div class="comprar-envios-content">

                        <!--SUSCRIPTOR-->
                        <div class="seleccion-meses solo-suscriptor">
                            <div class="titulo">
                                <p>SELECCIONAR CANTIDAD DE MESES</p>
                            </div>
                            <div class="meses">
                                <div class="select-mes">
                                    <input value="1" data-index="0" checked type="radio"  id="cantidad-meses-1" name="cantidad-meses">
                                    <label for="cantidad-meses-1"></label>
                                    <p for="cantidad-meses">1</p>
                                </div>
                                <div class="select-mes" title="10% Descuento" descripcion="3 meses 10% Descuento">
                                    <input value="3" data-index="1" type="radio"  id="cantidad-meses-3" name="cantidad-meses">
                                    <label for="cantidad-meses-3"></label>
                                    <p for="cantidad-meses">3</p>
                                </div>
                                <div class="select-mes" title="25% Descuento" descripcion="6 meses 25% Descuento">
                                    <input value="6" data-index="2" type="radio" id="cantidad-meses-6" name="cantidad-meses">
                                    <label for="cantidad-meses-6"></label>
                                    <p for="cantidad-meses">6</p>
                                </div>
                                <div class="select-mes" title="35% Descuento" descripcion="12 meses 30% Descuento">
                                    <input value="12" data-index="3" type="radio" id="cantidad-meses-12" name="cantidad-meses">
                                    <label for="cantidad-meses-12"></label>
                                    <p for="cantidad-meses">12</p>
                                </div>
                            </div>
                        </div>

                        <div class="detalle-factura">
                            <div class="content-titulo">
                                <h4>DETALLE FACTURA</h4>
                            </div>
                            <div class="content-descripcion-compra">
                                <div class="fila" style="width: 99% !important;">
                                    <div><p>Paquete</p></div>
                                    <div><p class="plan-name" class="decripcion-plan"></p></div>
                                    <div style="float:right;"><p class="plan-price" style="text-align: right;"></p></div>
                                    <div style="float:right;"><p style="text-align: right;">Subtotal</p></div>
                                </div>
                                <div class="fila discount-row" style="width: 99% !important;">
                                    <div><p>Descuentos</p></div>
                                    <div><p></p></div>
                                    <div style="float:right;"><p class="plan-price-discount" style="text-align: right;"></p></div>
                                    <div style="float:right;"><p style="text-align: right;"></p></div>
                                </div>
                                <!--div class="fila responsable-inscripto">
                                    <div><p>Impuestos</p></div>
                                    <div><p></p></div>
                                    <div style="float:right;"><p class="plan-price-tax" style="text-align: right;"> $125.00</p></div>
                                    <div style="float:right;"><p style="text-align: right;">IVA 21%</p></div>
                                </div-->
                                <div class="fila">
                                    <div><p></p></div>
                                    <div><p></p></div>
                                    <div style="float:right;"><p class="plan-price-total" style="text-align: right;"></p></div>
                                    <div style="float:right;"><p style="text-align: right;"><b>Total:</b></p></div>
                                </div>
                            </div>  
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
        var Plan = function (id, name, value, isSuscription) {
            this.id = id;
            this.name = name;
            this.value = value;
            this.isSuscription = isSuscription;
        };
        <?php
            echo 'var planList = [];';
            foreach ($plans as $plan) {
                $isSuscription = ($plan->isSuscription)?'true':'false';
                echo 'planList.push( new Plan('.$plan->id.',"'.$plan->nombre.'",'.$plan->precio.', '.$isSuscription.'));';
            }
        ?>
    </script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    {{ HTML::script('js/sections/plans.js') }}
</div><!--conteiner-->

@stop

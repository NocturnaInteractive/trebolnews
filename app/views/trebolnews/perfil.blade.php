@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Perfil

@stop

@section('script')

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
                e.stopImmediatePropagation();

                $('#frm_perfil').ajaxSubmit({
                    success: function(data) {
                        if(data.status == 'ok') {
                            noty({
                                type: 'success',
                                text: data.mensaje,
                                layout: 'topCenter',
                                timeout: 1000,
                                callback: {
                                    afterClose: function(){
                                        location.reload();
                                    }
                                }
                            });
                        } else {
                            notys(data.validator);
                        }
                    },
                    complete: function() {
                        $('.btn_guardar').one('click', guardar_perfil_handler);
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

@stop

@section('contenido')

<div id="container">
    <section class="tabs">
        <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
        <label for="tab-1" class="tab-label-1">Perfil</label>
        <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
        <label for="tab-2" class="tab-label-2">Facturación</label>
        <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
        <label for="tab-3" class="tab-label-3">Edici&oacute;n de env&iacute;os </label>
        <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4" />
                <label for="tab-4" class="tab-label-4">Historial de compras </label>
        <div class="clear-shadow"></div>
        <div class="content">
            <form id="frm_perfil" action="{{ action('UsuarioController@editar_perfil') }}" method="post">
                <input type="hidden" name="nombre" value="{{ Auth::user()->nombre }}" />
                <input type="hidden" name="apellido" value="{{ Auth::user()->apellido }}" />
                <input type="hidden" name="telefono" value="{{ Auth::user()->telefono }}" />
                <!-- <input type="hidden" name="empresa" value="{{ Auth::user()->empresa }}" /> -->
                <input type="hidden" name="ciudad" value="{{ Auth::user()->ciudad }}" />
                <input type="hidden" name="pais" value="{{ Auth::user()->pais }}" />
                <input type="hidden" name="empresa_nombre" value="{{ $empresa->nombre or '' }}" />
                <input type="hidden" name="empresa_cuit" value="{{ $empresa->cuit or '' }}" />
                <input type="hidden" name="empresa_factura" value="{{ $empresa->factura or '' }}" />
                <input type="hidden" name="empresa_telefono" value="{{ $empresa->telefono or '' }}" />
                <input type="hidden" name="empresa_direccion" value="{{ $empresa->direccion or '' }}" />
                <input type="hidden" name="empresa_cp" value="{{ $empresa->cp or '' }}" />
                <input type="hidden" name="empresa_ciudad" value="{{ $empresa->ciudad or '' }}" />
                <input type="hidden" name="empresa_responsable" value="{{ $empresa->responsable or '' }}" />
                <input type="hidden" name="empresa_email" value="{{ $empresa->email or '' }}" />
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
                        <!-- <tr>
                            <td class="tipoperfil">Empresa:</td>
                            <td class="datoperfil" editable="empresa">
                            {{ Auth::user()->empresa }}
                            </td>
                        </tr> -->
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
            </div> <!--content-1-->
            <div class="content-2">
                <h2>Edita la informaci&oacute;n de tu empresa</h2>
                <div class="infocont">
                    <table width="100%"  cellpadding="0" cellspacing="0" class="perfiltabla">
                        <tr class="primeraperfil">
                            <th scope="col" width="350px" class="tipoperfil">Nombre de la empresa:</th>
                            <th class="datoperfil" scope="col" width="504px" editable="empresa_nombre">
                            {{ $empresa->nombre or '' }}
                            </th>
                        </tr>
                        <tr>
                            <td class="tipoperfil">CUIT Empresa:</td>
                            <td class="datoperfil" editable="empresa_cuit">
                            {{ $empresa->cuit or '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="tipoperfil">Tipo de factura:</td>
                            <td class="datoperfil" editable="empresa_factura">
                            {{ $empresa->factura or '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="tipoperfil">Tel&eacute;fono:</td>
                            <td class="datoperfil" editable="empresa_telefono">
                            {{ $empresa->telefono or '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="tipoperfil">Direcci&oacute;n de facturaci&oacute;n:</td>
                            <td class="datoperfil" editable="empresa_direccion">
                            {{ $empresa->direccion or '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="tipoperfil">C&oacute;digo postal:</td>
                            <td class="datoperfil" editable="empresa_cp">
                            {{ $empresa->cp or '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="tipoperfil">Ciudad y Pa&iacute;s:</td>
                            <td class="datoperfil" editable="empresa_ciudad">
                            {{ $empresa->ciudad or '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="tipoperfil">Nombre de la persona responsable:</td>
                            <td class="datoperfil" editable="empresa_responsable">
                            {{ $empresa->responsable or '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="tipoperfil">Email del responsable:</td>
                            <td class="datoperfil" editable="empresa_email">
                            {{ $empresa->email or '' }}
                            </td>
                        </tr>
                    </table>
                    <div class="editarperfil">
                        <a href="#" class="btn_editar">EDITAR DATOS</a>
                        <a href="#" class="btn_guardar">GUARDAR DATOS</a>
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
            <div class="content-4">
                <h2>Historial de compras</h2>

                @if (count($payments) > 0)
                    <div class="infocont">
                        <table width="100%"  cellpadding="0" cellspacing="0" class="perfiltabla">
                            <tr class="primeraperfil">
                                <th scope="col" width="150px" class="datoperfil">Env&iacute;os</th>
                                <th scope="col" width="150px" class="datoperfil">Suscriptores</th>
                                <th scope="col" width="200px" class="datoperfil">Cantidades</th>
                                <th scope="col" width="200px" class="datoperfil">Precio (U$S)</th>
                                <th scope="col" width="200px" class="datoperfil">Fecha</th>
                                <th scope="col" width="200px" class="datoperfil">Estado</th>
                                <!--<th scope="col" width="200px" class="datoperfil">Ver detalle recibo</th>-->
                            </tr>
                            @foreach ($payments as $payment)
                            <tr class="primeraperfil">
                                <td class="datoperfil centerTable">
                                    @if (!$payment->isSuscription)
                                        x
                                    @endif
                                </td>
                                <td class="datoperfil centerTable">
                                    @if ($payment->isSuscription)
                                        x
                                    @endif
                                </td>
                                <td class="datoperfil">{{$payment->quantity}}</td>
                                <td class="datoperfil">{{$payment->mount}}</td>
                                <td class="datoperfil">{{$payment->created_at->format('d/m/Y')}}</td>
                                <td class="datoperfil">{{$payment->status}}</td>
                                <!--td class="datoperfil"><a href="#">Ver PDF</a></td-->
                            </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                    <p>Aún no has realizado ninguna compra.</p>
                @endif  
            </div>
        </div>
    </section>
</div>

@stop

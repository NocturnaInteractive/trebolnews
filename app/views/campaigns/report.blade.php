@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Reporte

@stop

@section('script')
	{{ HTML::script('ckeditor/ckeditor.js') }}
	{{ HTML::script('ckeditor/adapters/jquery.js') }}
@stop

@section('contenido')
    <div id="container">
        <div class="content">
            <div>
                <h2>Reporte de Campa&ntilde;as</h2>
                <div class="infocont">
                    <table width="100%"  cellpadding="0" cellspacing="0" class="listacampanias">
                        <tr class="primeralinea">
                            <th scope="col" width="100px" >Tipo</th>
                            <th scope="col" width="350px">Nombre de Campa&ntilde;a</th>
                            <th scope="col" width="305px">Asunto</th>
                            <th scope="col" width="255px">Fecha de Creación</th>
                        </tr>
                        <tr>
                            <td>{{$campaign->tipo}}</td>
                            <td>{{$campaign->nombre}}</td>
                            <td>{{$campaign->asunto}}</td>
                            <td>{{ $campaign->created_at->format('Y-m-d') }}</td>
                        </tr>
                    </table>
                    <table width="100%"  cellpadding="0" cellspacing="0" class="reportecampanias" style="margin-top:50px">
                        <tr class="primeralineareport">
                            <th scope="col" width="233.5px">Emails Enviados</th>
                            <th scope="col" width="233.5px">Emails Entregados</th>
                            <th scope="col" width="233.5px">Emails Abiertos</th>
                            <th scope="col" width="233.5px">Emails Rechazados</th>
                        </tr>
                        <tr class="reporteinfo">
                            <td>{{$report->sent}}</td>
                            <td>{{$report->received}}</td>
                            <td>{{$report->opened}}</td>
                            <td>{{$report->rejected}}</td>
                        </tr>
                    </table>
                    <table width="100%"  cellpadding="0" cellspacing="0" class="reportecampanias" style="margin-top:50px">
                        <tr style="height:20px"></tr>
                        <tr class="primeralineareport">
                            <th scope="col" width="186.8px">Fowards</th>
                            <th scope="col" width="186.8px">Spam</th>
                            <th scope="col" width="186.8px">Pa&iacute;ses</th>
                            <th scope="col" width="186.8px">Ciudades</th>
                            <th scope="col" width="186.8px">Browsers y OS</th>
                        </tr>
                        <tr class="reporteinfo">
                            <td>48</td>
                            <td>2</td>
                            <td>12</td>
                            <td>74</td>
                            <td>4</td>
                        </tr>
                    </table>
                </div><!--infocont-->
            </div><!--content-5-->
            <div class="cleaner"></div>
        </div>
    </div>
@stop

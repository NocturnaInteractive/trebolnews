@extends('admin/master')

@section('titulo')

    Administración TREBOLnews

@stop

@section('contenido')

	<h2>Asignar un Plan a {{$user->nombre}} {{$user->apellido}} < {{$user->email}} ></h2>

	<button id="unpayed-button">IMPAGAS</button>
	<button id="all-button">TODAS</button>

	<div class="unpayed">
		<h3>ORDENES IMPAGAS</h3>
		@if(count($ordersUnpayed) > 0)
		<table>
			<tr>
				<th>ID</th>
				<th>Nombre Plan</th>
				<th>Monto</th>
				<th>Fecha de Creacion</th>
				<th>Acciones</th>
			</tr>
		    @foreach($ordersUnpayed as $order)
			<tr>
				<td>{{$order->orderId}}</td>
				<td>{{$order->nombre}}</td>
				<td>${{$order->monto}}</td>
				<td>{{$order->created_at}}</td>
				<td><a href="#" onclick="createPayment({{$order->orderId}},{{$order->monto}})">Pago Manual</a></td>
			</tr>
		    @endforeach
		</table>	
		@else
			<p>No se encontraron ordenes impagas</p>
		@endif
	</div>
 
	<div class="all">

		<h3>TODAS LAS ORDENES</h3>
		@if(count($orders) > 0)
		<table>
			<tr>
				<th>ID</th>
				<th>Nombre Plan</th>
				<th>Monto</th>
				<th>Fecha de Creacion</th>
			</tr>
		    @foreach($orders as $order)
			<tr>
				<td>{{$order->orderId}}</td>
				<td>{{$order->nombre}}</td>
				<td>${{$order->monto}}</td>
				<td>{{$order->created_at}}</td>
			</tr>
		    @endforeach
		</table>
		@else
			<p>El usuario no ha ordenado productos aun</p>
		@endif	
	</div>


	<script type="text/javascript">
	var username = '{{$user->nombre}} {{$user->apellido}}';
	var useremail = '{{$user->email}}';

	var createPayment = function(orderId,value){
		$('#order-id').val(orderId);
		$('#payment-value').val(value);
		if(confirm('Se creara un pago por $' + value + 
			' para la orden '+ orderId + ' a nombre de ' + username + 
			' <' + useremail + '>' +'\n¿Esta seguro que desea crear el pago manual?')){
			
				$.post('/admin/plan-to-user',{'orderId': orderId})
					.done(function (data){
						window.location.reload();
					});
		}
	}

	$('#unpayed-button').click(function(e){
		$('.unpayed').show();
		$('.all').hide();
	});
	$('#all-button').click(function(e){
		$('.all').show();
		$('.unpayed').hide();
	});
	$('.all').hide();
	</script>

@stop

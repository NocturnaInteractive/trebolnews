<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TrebolNEWS - Mail</title>
</head>
<body>
		
	<h1>TrebolNEWS</h1>
	<h2>Realice el Pago</h2>

	<p>
		Estimado {{$user->nombre}},
	</p>
	<p>
		Se ha creado la orden de pago por {{$order->monto}}<br>
		debido a la compra del siguiente producto:
	</p>
	<p>
		{{$plan->nombre}}
	</p>
	<p>
		Por favor, realice su pago a los siguientes datos:
		<ul>
			<li>TrebolNEWS SA</li>
			<li>CBU 3234234 2342234234</li>
			<li>CUIT 123123123123</li>
		</ul>
	</p>
	<p>
		El producto sera acreditado dentro de las siguientes 72hs habiles.
	</p>
	<p>
		Muchas gracias por tu compra.<br>
		Atentamente,<br><br>
		El equipo de TrebolNEWS
	</p>
	
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TrebolNEWS - Mail</title>
</head>
<body>
		
	<h1>TrebolNEWS</h1>
	<h2>Confirmación de Pago</h2>

	<p>
		Estimado {{$user->nombre}},
	</p>
	<p>
		Se ha creado la orden de pago por {{$order->monto}} debido a la compra del siguiente producto:<br>
		El siguiente producto fue agregado a tu cuenta:
	</p>
	<p>
		{{$plan->nombre}}
	</p>
	
	<p>
		Muchas gracias por tu compra.
		Atentamente,<br><br>
		El equipo de TrebolNEWS
	</p>
	
</body>
</html>
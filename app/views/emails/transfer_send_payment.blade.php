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
	<p>Por favor, realice su pago a los siguientes datos:

		<ul>
			<li>Nocturna Comunicación SRL</li>
			<li>Cuenta Corriente Banco Galicia: 10920-2 019-1</li>
			<li>CBU: 00700191-20000010920217</li>
			<li>CUIT: 30-71304790-9</li>
		</ul>
	</p>
	<p>
		El producto será acreditado una vez que recibamos el comprobante de pago vía mail a: <strong>ventas@trebolnews.com</strong>
	</p>
	<p>
		Muchas gracias por tu compra.
		Atentamente,<br><br>
		El equipo de TrebolNEWS
	</p>
	
</body>
</html>
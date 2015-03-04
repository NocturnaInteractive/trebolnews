<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">		
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>TrebolNEWS</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/estilo.css') }}" />
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css'>
        
        
</head>
<body style="background-color:#17A387; background-image:url(imagenes/confirma_bg.png); background-repeat:no-repeat; background-position: bottom center; background-size:auto; height:auto">
    

<div id="conteinerco">
	<a href="/"><h1>TrebolNEWS</h1></a>
	<h2>Gracias por su compra.</h2>
	<p>Tu &oacute;rden de compra es: <br> 
	<?php 
		if ($months > 1) 
			echo $months . ' meses de ';
	?>
	<strong>{{$plan['title']}} por U$S {{round($finalPrice,2)}}</strong></p> 
	<div id="bothome"><a href="{{$mplink['sandbox_init_point']}}">PAGAR</a></div>
</div>


</body>
</html>

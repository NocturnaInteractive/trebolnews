<!--p>
	Powered by TrebolNEWS
</p-->

<?php
	if (isset($user->empresa)){
		$entity = $user->empresa;
	} else {
		$entity = $user->nombre . ' ' . $user->apellido;
	}
?>


<table height="100%" width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" style=" background-color:#fff; color:#000; font-size:14px; font-family:Helvetica, Arial, sans-serif;">

	<tr><td><table align="center" width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">

		<tr><td><table align="center" width="600px" height="50px" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
			<tr>
				<td width="20px"></td>
				<td width="160px"><a href="#"><img src="{{$host}}/internas/imagenes/logograndeemail.png"></a></td>
				<td width="308px"></td>
				<td width="32px"><a href="https://twitter.com/trebolnews"><img src="{{$host}}/internas/imagenes/campania_facebook.png" width="28" height="28" alt="Facebook"></a></td>
				<td width="32px"><a href="https://twitter.com/trebolnews"><img src="{{$host}}/internas/imagenes/campania_tw.png" width="28" height="28" alt="Twitter"></a></td>
				<td width="28px"><a href="https://twitter.com/trebolnews"><img src="{{$host}}/internas/imagenes/campania_link.png" width="28" height="28" alt="You Tube"></a></td>
				<td width="20px"></td>
			</tr>
		</table></td></tr>


		<tr height="20px"><td><p style="font-size:12px; color:#0d9b8c; text-align:center">{{$entity}} utiliza TrebolNEWS para el envío de sus campañas de email</p></td></tr>


		<tr height="10px"><td style="border-bottom:1px solid #a6a6a6"></td></tr>

		<tr height="15px"><td></td></tr>

	</table></td></tr>

</table>

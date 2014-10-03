<h1>Pagos Recibidos por ti</h1>

<table border="1">
	<tr>
		<th>ID</th>
		<th>Monto</th>
		<th>Status</th>
		<th>ID Orden</th>
		<th>ID Usuario</th>
		<th>Fecha</th>
	</tr>

<?php
		//var_dump($pagos);
	foreach ($pagos as $pago) {
		echo '<tr>
			<td>'.$pago->id.'</td>
			<td>'.$pago->monto.'</td>
			<td>'.$pago->status.'</td>
			<td>'.$pago->id_orden.'</td>
			<td>'.$pago->id_usuario.'</td>
			<td>'.$pago->created_at.'</td>
		</tr>';
	}
?>

</table>
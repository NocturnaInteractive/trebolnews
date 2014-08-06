<html>
	<head>
		{{ HTML::style('css/admin.css') }}
	</head>
	<body>
		<table>
			<tr>
				<th>ID</th>
				<th>Usuario</th>
				<th>Nombre</th>
				<th>Asunto</th>
				<th>Remitente</th>
				<th>Email</th>
				<th>Dir. respuesta</th>
				<th>Listas</th>
				<th>Contenido</th>
				<th>Redes</th>
				<th>Envío</th>
				<th>Status</th>
				<th>Programación</th>
				<th>Creada</th>
				<th>Editada</th>
				<th>Eliminada</th>
			</tr>
			@foreach(Campania::all() as $campania)
			<tr>
				<td>{{ $campania->id }}</td>
				<td>{{ $campania->usuario->email }}</td>
				<td>{{ $campania->nombre }}</td>
				<td>{{ $campania->asunto }}</td>
				<td>{{ $campania->remitente }}</td>
				<td>{{ $campania->email }}</td>
				<td>{{ $campania->respuesta }}</td>
				<td>
					@foreach($campania->listas as $lista)
					{{ $lista->nombre }} <br>
					@endforeach
				</td>
				<td>{{ $campania->contenido }}</td>
				<td>
					@if($campania->redes)
						@foreach(json_decode($campania->redes) as $red)
						{{ $red }} <br>
						@endforeach
					@endif
				</td>
				<td>{{ $campania->envio }}</td>
				<td>{{ $campania->status }}</td>
				<td>{{ $campania->programacion }}</td>
				<td>{{ $campania->created_at }}</td>
				<td>{{ $campania->updated_at }}</td>
				<td>{{ $campania->deleted_at }}</td>
			</tr>
			@endforeach
		</table>
	</body>
</html>
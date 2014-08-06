<html>
	<head>
		{{ HTML::script('js/jquery-1.11.0.min.js') }}
        {{ HTML::script('js/jquery.form.min.js') }}
        {{ HTML::script('js/jquery.noty.packaged.min.js') }}

        {{ HTML::style('css/admin.css') }}
	</head>
	<body>
		<form id="frm_nuevo_template" action="{{ action('TemplateController@guardar') }}" method="post">
			<label for="nombre">
				Nombre:
			</label>
			<input type="text" name="nombre" />

			<label for="categoria">
				Categoría:
			</label>
			<input type="text" name="categoria" />

			<label for="archivo">
				Archivo:
			</label>
			<input type="file" name="archivo" />
		</form>
	</body>
</html>
<html>
    <head>
        {{ HTML::style('css/admin.css') }}
    </head>
    <body>
        <div>
            <ul>
                <li><a href="{{ route('admin/agregar_template') }}">Agregar template</a></li>
            </ul>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Archivo</th>
                <th>Completa</th>
                <th>Creada</th>
                <th>Editada</th>
                <th>Eliminada</th>
            </tr>
            @foreach($templates as $template)
            <tr>
                <td>{{ $template->id }}</td>
                <td>{{ $template->nombre }}</td>
                <td>{{ $template->categoria }}</td>
                <td>{{ $template->archivo }}</td>
                <td>
                    @if(Helpers::template_completa($template))
                    Si
                    @else
                    <a href="{{ route('admin/subir_imagenes', $template->id) }}">No</a>
                    @endif
                </td>
                <td>{{ $template->created_at }}</td>
                <td>{{ $template->updated_at }}</td>
                <td>{{ $template->deleted_at }}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>

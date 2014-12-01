<table width="100%" cellpadding="0" cellspacing="0" class="listadecontactos">
    <tr class="primeralinea">
        <th scope="col" width="40px">
            <div class="checkbox">
                <input type="checkbox" class="todos" />
                <label></label>
            </div>
        </th>
        <th scope="col" width="190px">Nombre y Apellido
            <!-- <a href="#" class="flechatabla"></a> -->
        </th>
        <th scope="col" width="189px">Email</th>
        <th scope="col" width="180px">Puesto / Cargo</th>
        <th scope="col" width="180px">Empresa</th>
        <th scope="col" width="90px">Pa&iacute;s</th>
        <th scope="col" width="65px"></th>
    </tr>
    <tbody id="table-content">
        @foreach($contactos as $contacto)
        <tr>
            <td>
                <div class="checkbox">
                    <input type="checkbox" name="chk_contacto[]" value="{{ $contacto->id }}" />
                    <label></label>
                </div>
            </td>
            <td>{{ $contacto->nombre . ' ' . $contacto->apellido }}</td>
            <td>{{ $contacto->email }}</td>
            <td>{{ $contacto->puesto }}</td>
            <td>{{ $contacto->empresa }}</td>
            <td>{{ $contacto->pais }}</td>
            <td>
                <a class="editarcampam" popup="{{ url('popup/editar_contacto/' . $contacto->id) }}" href="#">
                    <img src="{{ asset('internas/imagenes/editarcamania.png') }}" alt="editar campa&ntilde;a" width="25" height="25">
                </a>
                <a class="borrarcam" popup="{{ url('popup/eliminar_contacto/' . $contacto->id) }}" href="#">
                    <img src="{{ asset('internas/imagenes/borrarcamania.png') }}" alt="borrar campa&ntilde;a" width="25" height="25">
                </a>
                <div class="cleaner"></div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

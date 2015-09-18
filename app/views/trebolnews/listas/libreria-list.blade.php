<table width="100%"  cellpadding="0" cellspacing="0" class="libret">

    <thead>

        <tr class="primeralibre">
            <th scope="col" width="40px">
                <div class="checkbox">
                    <input type="checkbox" class="todos" />
                    <label></label>
                </div>
            </th>
            <th scope="col" width="170px">Visualizaci&oacute;n</th>
            <th scope="col" width="200px">Nombre</th>
            <th scope="col" width="125px">Dimensiones</th>
            <th scope="col" width="99px">Tama&ntilde;o</th>
            <th scope="col" width="100px"></th>
        </tr>

    </thead>

    <tbody>

    @foreach($imagenes as $imagen)

    <tr>
        <td>
            <div class="checkbox">
                <input type="checkbox" name="chk_imagen[]" value="{{ $imagen->id }}" />
                <label></label>
            </div>
        </td>
        <td class="libre_img">
            <a href="{{ asset($imagen->archivo) }}" rel="gallery">
                <label for="checkbox2"><img src="{{ asset($imagen->archivo) }}" height="75" /></label>
            </a>
        </td>
        <td class="nombrelibreria">{{ $imagen->nombre }}</td>
        <?php 
            try {
                $dim = getimagesize($imagen->archivo); 
                $filesize = round(filesize($imagen->archivo) / 1024, 2, PHP_ROUND_HALF_DOWN) . ' Kb';
            } catch (Exception $e) {
                $dim = array(0,0);
                $filesize = '0kb';
            }
        ?>
        <td>{{ $dim[0] . 'px x ' . $dim[1] }}px</td>
        <td>{{ $filesize }}</td>
        <td>
            <a class="ver_libreria" href="#">
                <img src="{{ asset('internas/imagenes/ojoicono.png') }}" width="28" height="25">
            </a>
            <a class="editarcampam" href="#" popup="{{ url('popup/editar_imagen', $imagen->id) }}">
                <img src="{{ asset('internas/imagenes/editarcamania.png') }}" alt="editar campa&ntilde;a" width="25" height="25">
            </a>
            <a class="borrarcam" href="#">
                <img src="{{ asset('internas/imagenes/borrarcamania.png') }}" ajax="{{ action('ImagenController@trash', array('chk_imagen' => $imagen->id)) }}" alt="borrar campa&ntilde;a" width="25" height="25">
            </a>
            <div class="cleaner"></div>
        </td>
    </tr>

    @endforeach

    </tbody>

</table>

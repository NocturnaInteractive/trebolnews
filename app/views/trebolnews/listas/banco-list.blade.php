<table width="100%"  cellpadding="0" cellspacing="0" class="libret">

    <thead>
        <tr class="primeralibre">
            <th scope="col" width="40px">
                <form class="checkbox">
                <input type="checkbox"  id="checkbox1" name="" />
                <label for="checkbox1"></label>
                </form>
            </th>
            <th scope="col" width="254px">Visualizaci&oacute;n</th>
            <th scope="col" width="230px">Nombre</th>
            <th scope="col" width="200px">Dimensiones</th>
            <th scope="col" width="150px">Tama&ntilde;o</th>
            <th scope="col" width="60px"></th>
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
                    <label>
                        <img src="{{ asset($imagen->archivo) }}" width="113" height="75">
                    </label>
                </a>
            </td>
            <td class="nombrebanco">{{ $imagen->nombre }}</td>
            <?php $dim = getimagesize($imagen->archivo); ?>
            <td>{{ $dim[0] . ' x ' . $dim[1] }}</td>
            <td>{{ round(filesize($imagen->archivo) / 1024, 2, PHP_ROUND_HALF_DOWN) . ' Kb' }}</td>
            <td><a class="banco_ver" href="#">ver</a></td>
        </tr>

        @endforeach

    </tbody>

</table>

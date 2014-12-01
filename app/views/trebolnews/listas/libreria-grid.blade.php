<table width="100%"  cellpadding="0" cellspacing="10px" class="tablabanco">

    <tbody>

        <?php $i = 0; ?>

        @foreach($imagenes as $imagen)

            @if($i % 4 == 0)

                <tr>

            @endif

            <td>
                <table cellpadding="0" cellspacing="0">
                    <tr class="banco_opciones" height="20px">
                        <th scope="col"></th>
                        <th scope="col" width="35px">
                            <div class="checkbox">
                                <input type="checkbox" value="valor1" />
                                <label></label>
                            </div>
                        </th>
                        <th scope="col" width="32px"><a class="banco_ver" href="#">ver</a></th>
                        <th scope="col" width="25px"><a class="banco_editar" href="#">editar</a></th>
                        <th scope="col" width="25px"><a class="banco_borar" href="#">borrar</a></th>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <a class="banco_img" href="{{ asset($imagen->archivo) }}" rel="gallery">
                                <label>
                                    <img src="{{ asset($imagen->archivo) }}" width="126" height="75">
                                </label>
                            </a>
                        </td>
                    </tr>
                </table>
            </td>

            @if($i % 4 == 3)

                </tr>

            @endif

        <?php $i++ ?>

        @endforeach

    </tbody>

</table>
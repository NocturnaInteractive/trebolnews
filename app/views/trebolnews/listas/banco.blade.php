<?php $i = 0; ?>
@foreach($imagenes as $imagen)
@if($i % 5 == 0)
<tr>
@endif

<td>
    <table cellpadding="0" cellspacing="0">
        <tr class="banco_opciones" height="20px">
            <th scope="col"></th>
            <th scope="col" width="30px">
                <div class="checkbox">
                    <input type="checkbox" name="chk_imagen[]" value="{{ $imagen->id }}" />
                    <label></label>
                </div>
            </th>
            <th scope="col" width="25px"><a class="banco_ver" href="#">ver</a></th>
        </tr>
        <tr>
            <td colspan="3">
                <a class="banco_img" href="{{ asset($imagen->archivo) }}" rel="gallery">
                    <label for="checkbox1">
                        <img src="{{ asset($imagen->archivo) }}" width="126" height="75">
                    </label>
                </a>
            </td>
        </tr>
    </table>
</td>

@if($i % 5 == 4)
</tr>
@endif
<?php $i++ ?>
@endforeach

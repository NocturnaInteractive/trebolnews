<script>
$(function(){
    $('[pagination]').one('click', pagination_handler);

    function pagination_handler(e) {
        e.preventDefault();

        $(this).on('click', function(e){
            e.preventDefault();
        });

        $.ajax({
            url: $(this).attr('href'),
            success: function(data) {
                $('#table-content').html(data.html);
                $('#paginador').html(data.paginador);
                $('#txt-total').text(data.total);
            }
        });
    }
});
</script>

<?php
    $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
    $ultima = $paginator->getLastPage();
    $actual = $paginator->getCurrentPage();
?>

@if($paginator->count() > 0)
<ul>
    @if($actual != 1)
    <li><a href="{{ $paginator->getUrl(1) }}" pagination >Primera</a></li>
    <li><a href="{{ $paginator->getUrl($actual - 1) }}" class="flechapag" pagination ><img src="{{ asset('internas/imagenes/flechaizq.png') }}" width="12" height="18"></a></li>
    @endif
    @if($actual - 2 > 1)
    <li><a href="#"><strong>...</strong></a></li>
    @endif
    @for($i = $actual - 2; $i <= $actual + 2; $i++)
        @if($i > 0 && $i <= $ultima)
            <li><a href="{{ $paginator->getUrl($i) }}" <?php if($i == $actual) { ?> class="apretado" <?php } ?> pagination >{{ $i }}</a></li>
        @endif
    @endfor
    @if($actual + 2 < $ultima)
    <li><a href="#"><strong>...</strong></a></li>
    @endif
    @if($actual != $ultima)
    <li><a href="{{ $paginator->getUrl($actual + 1) }}" class="flechapag" pagination ><img src="{{ asset('internas/imagenes/flechader.png') }}" width="12" height="18"></a></li>
    <li><a href="{{ $paginator->getUrl($ultima) }}" pagination >&Uacute;ltima</a></li>
    @endif
</ul>
@endif

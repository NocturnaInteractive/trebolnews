<?php
    $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
    $ultima = $paginator->getLastPage();
    $actual = $paginator->getCurrentPage();
?>

<ul>
    <li><a href="#">Primera</a></li>
    <li><a href="#" class="flechapag"><img src="{{ asset('internas/imagenes/flechaizq.png') }}" width="12" height="18"></a></li>
    @if($actual - 2 > 1)
    <li><a href="#"><strong>...</strong></a></li>
    @endif
    @for($i = $actual - 2; $i <= $actual + 2; $i++)
        @if($i > 0 && $i <= $ultima)
            <li><a href="#" <?php if($i == $actual) { ?> class="apretado" <?php } ?>>{{ $i }}</a></li>
        @endif
    @endfor
    @if($actual + 2 < $ultima)
    <li><a href="#"><strong>...</strong></a></li>
    @endif
    <li><a href="#" class="flechapag"><img src="{{ asset('internas/imagenes/flechader.png') }}" width="12" height="18"></a></li>
    <li><a href="#">&Uacute;ltima</a></li>
</ul>
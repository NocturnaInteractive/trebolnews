<script>
$(function() {
	$('#saveForm3').one('click', guardar_lista_handler);

	function guardar_lista_handler(e) {
		e.preventDefault();

		$('#saveForm3').on('click', function(e) {
			e.preventDefault();
		});

		$('#frm_guardar_lista').ajaxSubmit({
			success: function(data) {
				if(data.status == 'ok') {
					location.reload();
				} else {
					console.log(data);
				}
			},
			complete: function() {
				$('#saveForm3').one('click', guardar_lista_handler);
			}
		});
	}

	$('#frm_guardar_lista input').on('keypress', function(e) {
		if(e.which == 13) {
			e.preventDefault();
			$('#saveForm3').trigger('click');
		}
	});
});
</script>

<div id="bg_popup">
<div id="container_popup" class="popup_listasuscriptores">

<div id="encabeezado">
<h3>Editar lista de Suscriptores</h3>
<a href="#" id="cerrar_popup"><img src="{{ asset('internas/imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18"></a>
<div class="cleaner"></div>
</div><!--encabeezado-->

<div id="info_popup">
<form class="formpopup" id="frm_guardar_lista" action="{{ action('ListaController@guardar') }}" method="post">
<input type="hidden" name="id" value="{{ $lista->id }}" />
<input name="nombre" type="text" class="unico" placeholder="Nombre de Lista:" value="{{ $lista->nombre }}" />
<div id="botones_popup">
<input type="button" value="GUARDAR" name="submit" id="saveForm3" />
<input class="btn"  id="borrar3" type="reset" value="BORRAR" name="Enviar2" />
<div class="cleaner"></div>
</div>

</form>
</div><!--info_popup-->

</div><!--container_popup-->
</div><!--bg_popup-->

      <!--explorer placeholder-->

        <script type="text/javascript">
/* <![CDATA[ */
$(function() {
	var input = document.createElement("input");
    if(('placeholder' in input)==false) {
		$('[placeholder]').focus(function() {
			var i = $(this);
			if(i.val() == i.attr('placeholder')) {
				i.val('').removeClass('placeholder');
				if(i.hasClass('password')) {
					i.removeClass('password');
					this.type='password';
				}
			}
		}).blur(function() {
			var i = $(this);
			if(i.val() == '' || i.val() == i.attr('placeholder')) {
				if(this.type=='password') {
					i.addClass('password');
					this.type='text';
				}
				i.addClass('placeholder').val(i.attr('placeholder'));
			}
		}).blur().parents('form').submit(function() {
			$(this).find('[placeholder]').each(function() {
				var i = $(this);
				if(i.val() == i.attr('placeholder'))
					i.val('');
			})
		});
	}
});
/* ]]> */
</script>
<!--explorer placeholder-->
<script>
$(function() {
	$('#saveForm3').one('click', eliminar_contacto_handler);

	function eliminar_contacto_handler(e) {
		e.preventDefault();

		$('#saveForm3').on('click', function(e) {
			e.preventDefault();
		});

		$('#frm_eliminar_contacto').ajaxSubmit({
			success: function(data) {
				location.reload();
			},
			complete: function() {
				$('#saveForm3').one('click', eliminar_contacto_handler);
			}
		});
	}

	$('#borrar3').on('click', function(e) {
		e.preventDefault();

		$('#cerrar_popup').trigger('click');
	});
});
</script>

<div id="bg_popup">
	<div id="container_popup" class="popup_eliminar">
		<div id="encabeezado">
			<h3>Eliminar Suscriptor</h3>
			<a href="#" id="cerrar_popup"><img src="{{ asset('internas/imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18"></a>
			<div class="cleaner"></div>
		</div><!--encabeezado-->

	<div id="info_popup">
		<form id="frm_eliminar_contacto" action="{{ action('ContactoController@eliminar') }}" method="post">
			<input type="hidden" name="id" value="{{ $contacto->id }}" />
			<p id="pregunta_popup">&iquest;Est&aacute; seguro que desea eliminar el suscriptor <strong>"{{ $contacto->nombre . ' ' . $contacto->apellido }}"</strong> de forma permanente?</p>
			<div id="botones_popup">
				<input type="button" value="SI" name="submit" id="saveForm3" />
				<input class="btn"  id="borrar3" type="reset" value="NO" name="Enviar2" />
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
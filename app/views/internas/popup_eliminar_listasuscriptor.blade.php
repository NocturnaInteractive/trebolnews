<script>
$(function() {
	$('#saveForm3').one('click', eliminar_lista_handler);

	function eliminar_lista_handler(e) {
		e.preventDefault();

		$('#saveForm3').on('click', function(e) {
			e.preventDefault();
		});

		$('#frm_eliminar_lista').ajaxSubmit({
			success: function(data) {
				location.reload();
			},
			complete: function() {
				$('#saveForm3').one('click', eliminar_lista_handler);
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
			<h3>Eliminar lista de Suscriptores</h3>
			<a href="#" id="cerrar_popup"><img src="{{ asset('internas/imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18"></a>
			<div class="cleaner"></div>
		</div><!--encabeezado-->

		<div id="info_popup">
			<form id="frm_eliminar_lista" action="{{ action('ListaController@eliminar') }}" method="post">
			<input type="hidden" name="id" value="{{ $lista->id }}" />
			<p id="pregunta_popup">&iquest;Est&aacute; seguro que desea eliminar la lista de suscriptores <strong>"{{ $lista->nombre }}"</strong> de forma permanente?</p>

			<div id="botones_popup">
				<input class="btn-verde" type="button" value="SI" name="submit" id="saveForm3" />
				<input class="btn-rojo" id="borrar3" type="reset" value="NO" name="Enviar2" />
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
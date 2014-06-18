<div id="bg_popup">
<div id="container_popup" class="popup_listasuscriptores">

<div id="encabeezado">
<h3>Subir desde Redes Sociales</h3>
<a href="#" id="cerrar_popup"><img src="{{ asset('internas/imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18"></a>
<div class="cleaner"></div>
</div><!--encabeezado-->

<div id="info_popup">

<a href="#" class="libreria_redes" id="libreria_fc">CONECTAR</a>

<a href="#" class="libreria_redes" id="libreria_tw">CONECTAR</a>

<div class="cleaner"></div>

<a href="#" class="libreria_redes" id="libreria_lk">CONECTAR</a>

<a href="#" class="libreria_redes" id="libreria_g">CONECTAR</a>

<div class="cleaner"></div>

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
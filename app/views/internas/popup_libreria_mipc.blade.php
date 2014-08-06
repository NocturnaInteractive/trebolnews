<script>
$(function(){
	$('#saveForm3').one('click', subir_imagen_handler);

	function subir_imagen_handler(e) {
		e.preventDefault();

		$('#saveForm3').on('click', function(e) {
			e.preventDefault();
		});

		$('#subirdesdepc').ajaxSubmit({
			data: {
				id_carpeta: $('#id_carpeta').val()
			},
			success: function(data) {
				if(data.status == 'ok') {
					location.reload();
				} else {
					notys(data.validator);
				}
			},
			complete: function() {
				$('#saveForm3').one('click', subir_imagen_handler);
			}
		});
	}
});
</script>

<div id="bg_popup">
<div id="container_popup" class="popup_listasuscriptores">

<div id="encabeezado">
<h3>Subir desde Mi PC</h3>
<a href="#" id="cerrar_popup"><img src="{{ asset('internas/imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18"></a>
<div class="cleaner"></div>
</div><!--encabeezado-->

<div id="info_popup">
<form id="subirdesdepc" action="{{ action('ImagenController@guardar') }}" method="post">
<input name="imagen" type="file" id="file" />

<div id="botones_popup">
<input type="button" value="SUBIR" name="submit" id="saveForm3" />
<div class="cleaner"></div>
</div>

</form>
</div><!--info_popup-->

</div><!--container_popup-->
</div><!--bg_popup-->




       <!--input file-->
      <script type="text/javascript">
		;(function( $ ) {

		  // Browser supports HTML5 multiple file?
		  var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
		      isIE = /msie/i.test( navigator.userAgent );

		  $.fn.customFile = function() {

		    return this.each(function() {

		      var $file = $(this).addClass('customfile'), // the original file input
		          $wrap = $('<div class="customfile-wrap">'),
		          $input = $('<input type="text" class="customfile-filename" placeholder="Subir a Librer&iacute;a" />'),
		          // Button that will be used in non-IE browsers
		          $button = $('<button type="button" class="customfile-upload">EXAMINAR</button>'),
		          // Hack for IE
		          $label = $('<label class="customfile-upload" for="'+ $file[0].id +'">EXAMINAR</label>');

		      // Hide by shifting to the left so we
		      // can still trigger events
		      $file.css({
		        position: 'absolute',
		        left: '-9999px'
		      });

		      $wrap.insertAfter( $file )
		        .append( $file, $input, ( isIE ? $label : $button ) );

		      // Prevent focus
		      $file.attr('tabIndex', -1);
		      $button.attr('tabIndex', -1);

		      $button.click(function () {
		        $file.focus().click(); // EXAMINAR dialog
		      });

		      $file.change(function() {

		        var files = [], fileArr, filename;

		        // If multiple is supported then extract
		        // all filenames from the file array
		        if ( multipleSupport ) {
		          fileArr = $file[0].files;
		          for ( var i = 0, len = fileArr.length; i < len; i++ ) {
		            files.push( fileArr[i].name );
		          }
		          filename = files.join(', ');

		        // If not supported then just take the value
		        // and remove the path to just show the filename
		        } else {
		          filename = $file.val().split('\\').pop();
		        }

		        $input.val( filename ) // Set the value
		          .attr('title', filename) // Show filename in title tootlip
		          .focus(); // Regain focus

		      });

		      $input.on({
		        blur: function() { $file.trigger('blur'); },
		        keydown: function( e ) {
		          if ( e.which === 13 ) { // Enter
		            if ( !isIE ) { $file.trigger('click'); }
		          } else if ( e.which === 8 || e.which === 46 ) { // Backspace & Del
		            // On some browsers the value is read-only
		            // with this trick we remove the old input and add
		            // a clean clone with all the original events attached
		            $file.replaceWith( $file = $file.clone( true ) );
		            $file.trigger('change');
		            $input.val('');
		          } else if ( e.which === 9 ){ // TAB
		            return;
		          } else { // All other keys
		            return false;
		          }
		        }
		      });

		    });

		  };

		  // Old browser fallback
		  if ( !multipleSupport ) {
		    $( document ).on('change', 'input.customfile', function() {

		      var $this = $(this),
		          // Create a unique ID so we
		          // can attach the label to the input
		          uniqId = 'customfile_'+ (new Date()).getTime(),
		          $wrap = $this.parent(),

		          // Filter empty input
		          $inputs = $wrap.siblings().find('.customfile-filename')
		            .filter(function(){ return !this.value }),

		          $file = $('<input type="file" id="'+ uniqId +'" name="'+ $this.attr('name') +'"/>');

		      // 1ms timeout so it runs after all other events
		      // that modify the value have triggered
		      setTimeout(function() {
		        // Add a new input
		        if ( $this.val() ) {
		          // Check for empty fields to prevent
		          // creating new inputs when changing files
		          if ( !$inputs.length ) {
		            $wrap.after( $file );
		            $file.customFile();
		          }
		        // Remove and reorganize inputs
		        } else {
		          $inputs.parent().remove();
		          // Move the input so it's always last on the list
		          $wrap.appendTo( $wrap.parent() );
		          $wrap.find('input').focus();
		        }
		      }, 1);

		    });
		  }

		}( jQuery ));

		$('input[type=file]').customFile();
	</script>
       <!--input file-->


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
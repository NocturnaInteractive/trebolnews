<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TrebolNEWS - Mail</title>
</head>
<body>
	<?php

		$campaign = (object) Session::get('campania');
		$suscriptor = new stdClass();
		$suscriptor->name = 'John';
		$suscriptor->last = 'Doe';
		$suscriptor->email = 'johndow@fakemail.com';
		$generated = $campaign->contenido;
		
		if($suscriptor){
			$generated = str_replace("%%suscriptor.name%%",  $suscriptor->name, $generated);
			$generated = str_replace("%%suscriptor.last%%",  $suscriptor->last, $generated);
			$generated = str_replace("%%suscriptor.email%%", $suscriptor->email, $generated);
		}
	?>

	{{$generated}}

	<div class="trebol_footer">
		<?php
			$query = CampaignFooter::where('user_id',Auth::user()->id);
			$footer = $query->first();
		?>
		@if( $footer )
			<?php echo View::make('emails/suscriptor_footer', array( 'footer' =>  $footer)); ?>
		@else
			<?php echo View::make('emails/non_suscriptor_footer'); ?>
		@endif
		<div><a href="#">Unsuscribe</a></div>
	</div>
</body>
</html>
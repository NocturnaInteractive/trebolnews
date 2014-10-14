<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TrebolNEWS - Mail</title>
</head>
<body>
	<?php
		$generated = $campaign->template;
		
		if($campaign->suscriptor){
			$generated = str_replace("%%suscriptor.name%%",  $campaign->suscriptor->name, $generated);
			$generated = str_replace("%%suscriptor.last%%",  $campaign->suscriptor->last, $generated);
			$generated = str_replace("%%suscriptor.email%%", $campaign->suscriptor->email, $generated);
		}
	?>

	{{$generated}}


	@if( $campaign->owner->suscriptionType === 'free' )
	<footer>
		<?php echo View::make('emails/non_suscriptor_footer'); ?>
	</footer>
	@endif
</body>
</html>
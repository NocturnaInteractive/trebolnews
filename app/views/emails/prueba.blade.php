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

	<div class="trebol_footer">
		@if( $campaign->owner->suscriptionType === 'free' )
			<?php echo View::make('emails/non_suscriptor_footer'); ?>
		@endif
		<div><a href="#">Unsuscribe</a></div>
		<img src="http://www.trebolnews.com/campaigns/{{$campaign->id}}/report/pixel.gif">
		<img src="http://upload.wikimedia.org/wikipedia/commons/c/ce/Transparent.gif">
	</div>
</body>
</html>
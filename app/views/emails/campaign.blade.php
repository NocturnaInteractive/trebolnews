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
		<?php
			$query = CampaignFooter::where('user_id',Auth::user()->id);
			$hasFooter = (count($query) > 0 ) ? true : false;
			$footer = $query->first();
		?>
		@if( $hasFooter )
			<?php echo View::make('emails/suscriptor_footer', array( 'footer' =>  $footer)); ?>
		@else
			<?php echo View::make('emails/non_suscriptor_footer'); ?>
		@endif
		<div><a href="#">Unsuscribe</a></div>
		<img src="http://www.trebolnews.com/campaigns/{{$campaign->id}}/report/pixel.gif">
	</div>
</body>
</html>
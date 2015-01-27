<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TrebolNEWS - Mail</title>
</head>
<body>
	<?php
		$host = 'http://www.trebolnews.com';
		$generated = $campaign->template;
		$socialLink = $campaign->socialLinks;
		$query = CampaignFooter::where('user_id',Auth::user()->id);
		$footer = $query->first();
		
		if($campaign->suscriptor){
			$generated = str_replace("%%suscriptor.name%%",  $campaign->suscriptor->name, $generated);
			$generated = str_replace("%%suscriptor.last%%",  $campaign->suscriptor->last, $generated);
			$generated = str_replace("%%suscriptor.email%%", $campaign->suscriptor->email, $generated);
		}
	?>

	{{$generated}}

	<div class="trebol_footer">
		<?php
			if($socialLink){
				echo View::make('emails/social_footer', array( 'socialLink' =>  $socialLink, 'host' => $host));
			}
		?>
		@if(!is_null($footer))
			<?php 
				echo View::make('emails/suscriptor_footer', array( 'footer' =>  $footer)); 
			?>
		@else
			<?php 
				echo View::make('emails/non_suscriptor_footer');
			?>
		@endif

		<div><a href="#">Unsuscribe</a></div>
		<img src="{{$host}}/campaigns/{{$campaign->id}}/report/pixel.gif">
	</div>
</body>
</html>
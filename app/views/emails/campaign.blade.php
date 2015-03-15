<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TrebolNEWS - Mail</title>
</head>
<body>
	<?php
		$host = '//'.Request::server("SERVER_NAME") . ':' . Request::server('SERVER_PORT') . '/';
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
	{{$host}}

	<div class="trebol_footer">
		@if(!is_null($footer))

			<?php 
				echo View::make('emails/suscriptor_footer', array( 'footer' =>  $footer, 'host' => $host)); 
				if($socialLink){
					echo View::make('emails/social_footer', array( 'socialLink' =>  $socialLink, 'host' => $host));
				}
			?>
		@else
			<?php 
				echo View::make('emails/non_suscriptor_footer', array( 'user' =>  Auth::user(), 'host' => $host ) );
			?>
		@endif

		<div><table width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
			<tr>
				<td align="left"><a href="#" style="font-size:12px; margin-left:20px; text-decoration:none; color:#333; font-family:Helvetica, Arial, sans-serif;">Desuscribirse</a></td>
				<td align="right"><a href="#" style="font-size:12px; margin-right:20px; text-decoration:none; color:#333; font-family:Helvetica, Arial, sans-serif;">Enviar a un amigo</a></td>
			</tr>
		</table></div>
		<img src="{{$host}}/campaigns/{{$campaign->id}}/report/pixel.gif">
	</div>
</body>
</html>
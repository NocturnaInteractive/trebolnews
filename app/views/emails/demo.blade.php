<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TrebolNEWS - Mail</title>
</head>
<body>
	<?php
		$host = '';
		$campaign = (object) Session::get('campania');
		$suscriptor = new stdClass();
		$suscriptor->name = 'John';
		$suscriptor->last = 'Doe';
		$suscriptor->email = 'johndoe@sample.com';
		$generated = $campaign->contenido;
		$socialLink = new stdClass();
		$socialLink->facebook	= Session::get('campania.socialLinks_facebook');
		$socialLink->twitter	= Session::get('campania.socialLinks_twitter');
		$socialLink->linkedin	= Session::get('campania.socialLinks_linkedin');
		$socialLink->googleplus	= Session::get('campania.socialLinks_googleplus');
		$socialLink->pinterest	= Session::get('campania.socialLinks_pinterest');
		$socialLink->blogger	= Session::get('campania.socialLinks_blogger');
		$socialLink->meneame	= Session::get('campania.socialLinks_meneame');
		$socialLink->tumblr		= Session::get('campania.socialLinks_tumblr');
		$socialLink->reddit		= Session::get('campania.socialLinks_reddit');
		$socialLink->digg		= Session::get('campania.socialLinks_digg');
		$socialLink->delicious	= Session::get('campania.socialLinks_delicious');
		$query = CampaignFooter::where('user_id',$campaign->id_usuario);
		$footer = $query->first();

		
		if($suscriptor){
			$generated = str_replace("%%suscriptor.name%%",  $suscriptor->name, $generated);
			$generated = str_replace("%%suscriptor.last%%",  $suscriptor->last, $generated);
			$generated = str_replace("%%suscriptor.email%%", $suscriptor->email, $generated);
		}
	?>

	{{$generated}}
	

	<div class="trebol_footer">
		@if( $footer )
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
	</div>
</body>
</html>
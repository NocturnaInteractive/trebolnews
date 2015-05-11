<?php

class TemplateSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		Template::create(array(
			'id' => 1,
			'category' => 'modern',
			'name' => 'Stylus',
			'thumbnail' => '../imagenes/templates/stylus_modern/thumbnail.jpg',
			'content' => '<table height="100%" width="100%" border="0" cellspacing="0" cellpadding="0" style=" background-color:#f0efef; background-image:url(bg.jpg); background-repeat:repeat-x; background-position:top; color:#666666; font-size:14px; font-family:Arial, Helvetica, sans-serif;">
 
 
 <tr style="background-color:#000"><td><table align="center" width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:35px auto 0 auto; border-bottom:1px solid #FFF">
 <tr align="right"><td><p style="color:#FFF; font-size:12px">Lloren Ipsum Dolo</p></td></tr>
 </table></td></tr>
 
 
 <tr style="background-color:#000;"><td style="border-bottom:1px solid #FFF"><table align="center" width="600px" height="90px" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
 <tr>
 <td><a href="#" style="display:block; color:#fff; text-decoration:none"><h1 style="text-align:left; font-size:40px; font-weight:normal; margin:0 0 0 35px">Loren Ipsum</h1></a></td>
 
 <td valign="middle"><table align="right" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;"><tr align="right">
 <td style="background-color:#1f1b62; padding:10px; border:1px solid #FFF"><p style="margin:0; color:#FFF; text-align:center; font-size:10px">Loren ipsum</p></td>
 <td width="8px"></td>
 <td style="background-color:#1f1b62; padding:10px; border:1px solid #FFF"><p style="margin:0; color:#FFF; text-align:center; font-size:10px">5555-5555</p></td>
 <td width="8px"></td>
 <td style="background-color:#1f1b62; padding:10px; border:1px solid #FFF"><p style="margin:0; color:#FFF; text-align:center; font-size:10px">loren@ipsum.com</p></td>
 </tr></table></td>
 
 </tr>
 </table></td></tr>
 
 
 
 <tr><td><table align="center" width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; background-color:#FFF">
 <tr height="280px"><td><img src="header.jpg" width="600" height="280"></td></tr>
 <tr><td><h2 style="font-size:28px; font-weight:normal; text-align:center; margin:20px 0">Lloren Ipsum Dolo</h2></td></tr>
 <tr><td><p style=" text-align:center; margin:0 20px 20px 20px">Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p></td></tr>
 <tr height="30px" align="right"><td><a href="#"><img src="bto_masinfo.png" width="82" height="30" alt="Más Información"></a></td></tr>
 </table></td></tr>
 
 
 
 <tr><td><table align="center" width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:30px auto; background-color:#FFF">
 <tr height="200px">
 <td width="200px" valign="middle" align="center" style="background-color:#00acec"><img src="nota1.png" width="50" height="50"></td>
 
 <td><table align="center" width="200px" border="0" cellspacing="0" cellpadding="0">
 <tr height="170px"><td valign="top"><p style="margin:20px">Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes...</p></td></tr>
 <tr height="30px" align="right"><td><a href="#"><img src="bto_masinfo.png" width="82" height="30" alt="Más Información"></a></td></tr>
 </table></td>
 
 <td width="200px" valign="middle" align="center" style="background-color:#00acec"><img src="nota2.png" width="50" height="50"></td>
 </tr>
 
 
 <tr height="200px">
 <td><table align="center" width="200px" border="0" cellspacing="0" cellpadding="0">
 <tr height="170px"><td valign="top"><p style="margin:20px">Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes...</p></td></tr>
 <tr height="30px" align="right"><td><a href="#"><img src="bto_masinfo.png" width="82" height="30" alt="Más Información"></a></td></tr>
 </table></td>
 
 <td width="200px" valign="middle" align="center" style="background-color:#00acec"><img src="nota3.png" width="50" height="50"></td>
 
 <td><table align="center" width="200px" border="0" cellspacing="0" cellpadding="0">
 <tr height="170px"><td valign="top"><p style="margin:20px">Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes...</p></td></tr>
 <tr height="30px" align="right"><td><a href="#"><img src="bto_masinfo.png" width="82" height="30" alt="Más Información"></a></td></tr>
 </table></td>
 </tr>
 
 </table></td></tr>
 
 
 
 <tr><td><table align="center" width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:20px auto 30px auto;">
 <tr><td><p style="font-size:16px; text-align:center; margin:0 20px 20px 20px; color:#000033">Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p></td></tr>
 
 <tr><td><p style=" text-align:justify; margin:0 20px 20px 20px">Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Cum sociis natoque. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p></td></tr>
 
 <tr height="30px" align="center"><td><a href="#"><img src="bto_masinfo.png" width="82" height="30" alt="Más Información"></a></td></tr>
 </table></td></tr>
 
 
 
 <tr><td><table align="center" width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:20px auto;">
 <tr><td><img src="guarda.png" width="600" height="50"></td></tr>
 </table></td></tr>
 
 
 
 <tr><td><table align="center" width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:30px auto;">
 <tr>
 
 <td><table align="center" width="190px" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; background-color:#FFF">
 <tr><td><img src="nota4.jpg" width="190" height="90"></td></tr>
 <tr><td valign="top"><p style="margin:15px 20px; line-height:18px">Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis...</p></td></tr>
 <tr height="30px" align="right"><td><a href="#"><img src="bto_masinfo.png" width="82" height="30" alt="Más Información"></a></td></tr>
 </table></td>
 
 <td><table align="center" width="190px" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; background-color:#FFF">
 <tr><td><img src="nota5.jpg" width="190" height="90"></td></tr>
 <tr><td valign="top"><p style="margin:15px 20px; line-height:18px">Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis...</p></td></tr>
 <tr height="30px" align="right"><td><a href="#"><img src="bto_masinfo.png" width="82" height="30" alt="Más Información"></a></td></tr>
 </table></td>
 
 <td><table align="center" width="190px" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; background-color:#FFF">
 <tr><td><img src="nota6.jpg" width="190" height="90"></td></tr>
 <tr><td valign="top"><p style="margin:15px 20px; line-height:18px">Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis...</p></td></tr>
 <tr height="30px" align="right"><td><a href="#"><img src="bto_masinfo.png" width="82" height="30" alt="Más Información"></a></td></tr>
 </table></td>
 
 </tr>
 </table></td></tr>
 
 
 
 <tr><td><table align="center" width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:20px auto;">
 <tr><td><img src="guarda.png" width="600" height="50"></td></tr>
 </table></td></tr>
 
 
 
 <tr><td><table align="center" width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:30px auto 0 auto; background-color:#FFF">
 <tr>
 <td rowspan="2" width="300px"><img src="nota7.jpg" width="300" height="138"></td>
 <td height="108" valign="top"><p style="margin:20px 20px 0 20px; line-height:18px">Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis...</p></td>
 </tr>
 <tr height="30px" align="right"><td><a href="#"><img src="bto_masinfo.png" width="82" height="30" alt="Más Información"></a></td></tr>
 </table></td></tr>
 
 
 <tr><td><table align="center" width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:10px auto; background-color:#FFF">
 <tr>
 <td rowspan="2" width="300px"><img src="nota8.jpg" width="300" height="138"></td>
 <td height="108" valign="top"><p style="margin:20px 20px 0 20px; line-height:18px">Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis...</p></td>
 </tr>
 <tr height="30px" align="right"><td><a href="#"><img src="bto_masinfo.png" width="82" height="30" alt="Más Información"></a></td></tr>
 </table></td></tr>
 
 
 <tr><td><table align="center" width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto 50px auto; background-color:#FFF">
 <tr>
 <td rowspan="2" width="300px"><img src="nota9.jpg" width="300" height="138"></td>
 <td height="108" valign="top"><p style="margin:20px 20px 0 20px; line-height:18px">Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis...</p></td>
 </tr>
 <tr height="30px" align="right"><td><a href="#"><img src="bto_masinfo.png" width="82" height="30" alt="Más Información"></a></td></tr>
 </table></td></tr>
 
 
 
 
 <tr style="background-color:#000033"><td><table align="center" width="600px" border="0" cellspacing="10" cellpadding="0" style="margin:0 auto; color:#FFF; padding:20px 0">
 <tr height="25px">
 <td valign="top" style="border-bottom:1px solid #FFF; width:160px"><h5 style="font-size:14px; text-align:left; margin:0">Loren Ipsum Dolo</h5></td>
 <td width="60px"></td>
 <td valign="top" style="border-bottom:1px solid #FFF; width:160px"><h5 style="font-size:14px;text-align:left; margin:0">Loren Ipsum Dolo</h5></td>
 <td width="60px"></td>
 <td valign="top" style="border-bottom:1px solid #FFF; width:160px"><h5 style="font-size:14px;text-align:left; margin:0">Loren Ipsum Dolo</h5></td>
 </tr>
 
 <tr height="18px">
 <td>&#8226;&nbsp;<a href="#" style="color:#FFF; text-decoration:none">Loren Ipsum Dolo</a></td>
 <td></td>
 <td>&#8226;&nbsp;<a href="#" style="color:#FFF; text-decoration:none">Loren Ipsum Dolo</a></td>
 <td></td>
 <td>&#8226;&nbsp;<a href="#" style="color:#FFF; text-decoration:none">Loren Ipsum Dolo</a></td>
 </tr>
 
 <tr height="18px">
 <td>&#8226;&nbsp;<a href="#" style="color:#FFF; text-decoration:none">Loren Ipsum Dolo</a></td>
 <td></td>
 <td>&#8226;&nbsp;<a href="#" style="color:#FFF; text-decoration:none">Loren Ipsum Dolo</a></td>
 <td></td>
 <td>&#8226;&nbsp;<a href="#" style="color:#FFF; text-decoration:none">Loren Ipsum Dolo</a></td>
 </tr>
 
 <tr height="18px">
 <td>&#8226;&nbsp;<a href="#" style="color:#FFF; text-decoration:none">Loren Ipsum Dolo</a></td>
 <td></td>
 <td>&#8226;&nbsp;<a href="#" style="color:#FFF; text-decoration:none">Loren Ipsum Dolo</a></td>
 <td></td>
 <td>&#8226;&nbsp;<a href="#" style="color:#FFF; text-decoration:none">Loren Ipsum Dolo</a></td>
 </tr>
 
 </table></td></tr>
 </table>'));

		
	}

}
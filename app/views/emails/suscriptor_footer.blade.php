<!--p>
	{{$footer->name}} ||
	{{$footer->email}} ||
	{{$footer->address}} ||
	<img style="width:50px; height: 50px;" src="{{URL::to('/').'/'.$footer->imagePath}}" />
</p-->

<table height="100%" width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" style=" background-color:#fff; color:#000; font-size:14px; font-family:Helvetica, Arial, sans-serif;">

	<tr><td><table align="center" width="600px" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">

		<tr height="50px">
			<td width="20px"></td>
			<td width="150px"><img style="width: 150px;" src="{{URL::to('/').'/'.$footer->imagePath}}" /></td>
			<td width="20px"></td>
			<td width="390px" style="color:#000; font-size:12px">{{$footer->name}} | {{$footer->address}}</td>
			<td width="20px"></td>
		</tr>

		<tr height="10px"><td style="border-bottom:1px solid #a6a6a6" colspan="5"></td></tr>
		<tr height="15px"><td colspan="5"></td></tr>


	</table></td></tr>

</table>

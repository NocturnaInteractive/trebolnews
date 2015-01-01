var _profile = {

	showFooterForm: function(e){
		if ($(this).val() == 'free' ){
			$('#paid_footer_wrapper').slideUp(200);
		}else{
			$('#paid_footer_wrapper').slideDown(200);
		}
	}

};

//EVENTS
$('input:radio[name=profilefooter]').click(_profile.showFooterForm);	
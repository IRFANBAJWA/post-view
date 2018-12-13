jQuery(document).ready(function ($) { 
    $('form#visitform').on('submit', function(e){
         $('p.status', this).show().text(ajax_auth_object.loadingmessage);
        username =$('form#visitform #username').val();
        useremail = $('form#visitform #useremail').val();
        term = $('.termc:checked').val();
        action= 'vister_user';

         ctrl = $(this);
         $.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
            data: {
                'action': action,
                'username': username,
                'useremail': useremail,
		        'term': term,
            },
            success: function (data) {                 
                var json = JSON.parse(data)
		$('p.status', ctrl).text(json.message);                 
		if (json.term == 1) {
                 window.location.href = ajax_auth_object.redirecturl;
                }
            },error: function(xhr, status, error) {
                // check status && error
                alert(error);
                 }
        });
    e.preventDefault();
    });

        
});
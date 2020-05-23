jQuery( document ).ready( function($) {
	/*key up event for bind the email and password*/
	$("#emailID").keyup(function(){
        var v = $(this).val();
        $(this).attr('data-val',v);
    });
    $("#password").keyup(function(){
        var v = $(this).val();
        $(this).attr('data-val',v);
    });

	/* check #login-Form-box is availble or not  */
	if ($("#login-Form-box").length > 0) {

		/*get current URL for after login redirect*/
		var urlRedirect = window.location.href;

		/*Jquery Validation*/
        $("#login-Form-box").validate({ 

        	/*submitHandler : this is submit form action */
            submitHandler : function(form) {
               var username = '';
               var password = '';
                username = $("#emailID").attr('data-val');
                password = $("#password").attr('data-val');
                var data = {
                    'action': 'check_login',
                    'username': username,
                    'password': password
                };
                var ajaxurl = screenReaderText.aJaxAdmin;        
                jQuery.post(ajaxurl, data, function(response) {
                    if(response == '0'){
                        $(".auth-content").prepend("<label class='error'>Your email address or password are wrong, please try again.</label>");
                        return false;
                    }else{
                        var data = {
                            'action': 'success_login',
                            'username': username,
                            'password': password
                        };
                        var ajaxurl = screenReaderText.aJaxAdmin;        
                        jQuery.post(ajaxurl, data, function(responseCool) {
                            window.location.href = urlRedirect;
                        });                        
                        return true;
                    }
                });
            },                       
            rules: {
                log: {
                    required: true,
                },
                pwd: {
                    required: true,
                }

            },
            messages: {
                log: {
                    required: "Please enter the email address.",
                },
                pwd: {
                    required: "Please ente the password.",
                }
            }
        });
    }


});
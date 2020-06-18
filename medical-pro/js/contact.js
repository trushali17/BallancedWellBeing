jQuery(document).ready(function(){
    
    (function($) {
        "use strict";

    // validate contactForm form
    $(function() {
        $('#contactForm').validate({
            rules: {
                contact_fname: {
                    required: true,
                    minlength: 2
                },
                contact_lname: {
                    required: true,
                    minlength: 2
                },
                contact_femail: {
                    required: true,
                    email: true
                },
                contact_fmsg: {
                    required: true,
                    minlength: 10
                }
            },
            messages: {
                contact_fname: {
                    required: "come on, you have a name don't you?",
                    minlength: "your name must consist of at least 2 characters"
                },
                contact_lname: {
                    required: "come on, you have a name don't you?",
                    minlength: "your name must consist of at least 2 characters"
                },
                contact_femail: {
                    required: "no email, no message"
                },
                contact_fmsg: {
                    required: "um...yea, you have to write something to send this form.",
                    minlength: "thats all? really?"
                }
            },
            submitHandler: function(form) {
                var submit_btn = $(form).find('input[type=submit]');
                var old_val = submit_btn.val();
                submit_btn.attr('disabled', 'disabled');
                submit_btn.val('Submitting...');

                $(form).ajaxSubmit({
                    type:"POST",
                    dataType:"json",
                    data: $(form).serialize(),
                    url: $(form).attr('action'),
                    success: function(data) {
                        if(data.success)
                        {
                            $('#contactForm :input').attr('disabled', 'disabled');
                            $('#contactForm').fadeTo( "slow", 0.15, function() {
                                $(this).find(':input').attr('disabled', 'disabled');
                                $(this).find('label').css('cursor','default');
                                $('#error').hide();
                                $('#success').fadeIn();
                            })
                            submit_btn.val(old_val);
                        } else if(data.error)
                        {
                            $('#error').html('<span>'+data.error+'</span>').fadeIn();
                        }
                    },
                    error: function() {
                        $('#error').html('<span>Something went wrong, try refreshing and submitting the form again.</span>');
                        $('#contactForm').fadeTo("slow", 0.15, function() {
                            $('#error').fadeIn();
                        })
                        submit_btn.removeAttr('disabled');
                        submit_btn.val(old_val);
                    }
                })
            }
        })
    })
        
 })(jQuery)
});
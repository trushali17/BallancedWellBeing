/*
    Main Jquery File
*/

(function($) {
    "use strict";

    // Custom Select Box
    function customSelect() {
        $(".custom-select select").each(function() {
            $(this).wrap("<span class='select-wrapper'></span>");
            $(this).before("<span class='holder'></span>");
            var selectedOption = $(this).find(":selected").text();
            $(this).prev(".holder").text(selectedOption);
            var selecteclass = $(this).attr('class');
            var selectestyle = $(this).attr('style');
            $(this).parent().addClass(selecteclass);
            $(this).parent().attr('style', selectestyle);
            $(this).change(function() {
                var selectedOption = $(this).find(":selected").text();
                $(this).prev(".holder").text(selectedOption);
                var selecteclass = $(this).attr('class');
                var selectestyle = $(this).attr('style');
                $(this).parent().addClass(selecteclass);
                $(this).parent().attr('style', selectestyle);
            });
        });
    }

    jQuery.fn.shake = function(intShakes, intDistance, intDuration) {
        this.each(function() {
            $(this).css("position","relative");
            for (var x=1; x<=intShakes; x++) {
                $(this).animate({left:(intDistance*-1)}, (((intDuration/intShakes)/4)))
                    .animate({left:intDistance}, ((intDuration/intShakes)/2))
                    .animate({left:0}, (((intDuration/intShakes)/4)));
            }
        });
        return this;
    };

    
    $(document).ready(function(){

        customSelect();

        /*----------------------------------------------------*/
        /*  Slider Preloader
        /*----------------------------------------------------*/
        $(".preloader").delay(700).fadeOut();
        
        /*----------------------------------------------------*/
        /*  Appointment Date
        /*----------------------------------------------------*/
        $('input[name="date"]').datepicker();
    
        /*----------------------------------------------------*/
        /*  Go Top
        /*----------------------------------------------------*/
        $('a[href="#appointment"]').click(function () {
            $('html, body').animate({ scrollTop: 350 }, 800);
            return false
        });  
        
        /*----------------------------------------------------*/
        /*  Appointment Date
        /*----------------------------------------------------*/
        $('.appointment_home_form input').blur(function () {
            if ($(this).val()) {
                $(this).addClass('notEmpty')
            }
            else{
                $(this).removeClass('notEmpty')
            }
        });
        
        /*----------------------------------------------------*/
        /*  Time Table Filter
        /*----------------------------------------------------*/
        var tableCell = $('.cell');
        $('.timeTableFilters li').on('click', function () {
            $('.active').removeClass('active');
            $(this).addClass('active');
            
            var filter_val = $(this).attr('data-filter');
            
            tableCell.addClass('bgf');            
            if(filter_val == 'all'){
                tableCell.removeClass('bgf')
            }
            else{
                tableCell.addClass('bgf');
                $('.timeTable td.'+ filter_val).removeClass('bgf')
            }            
        });
		

	$('#service_tab li').on('click', function () {
            $('#service_tab .active').removeClass('active');
	       var id = $(this).attr('id');	
             $("#"+id+ " a span").addClass('active');
        });

        $('.appointment_form').submit(function(e){
            $('.appointment_form .loading').show();

            $('.appointment_form .error').removeClass('error');
            var submit_btn = $(this).find('input[type=submit]');
            var old_val = submit_btn.val();
            submit_btn.attr('disabled', 'disabled');
            submit_btn.val('Submitting...');
			
			

            e.preventDefault();
            $('.appointment_form .alert').removeClass('alert-danger alert-success').html('').slideUp();
            $.post(MyAjax.ajaxurl, $(this).serialize()+'&action=book_appointment', function(data)
			{
				
                $('.appointment_form .loading').hide();
                submit_btn.removeAttr('disabled');
				
                submit_btn.val(old_val);
                if(data.success)
                {
                    $('.appointment_form .alert').addClass('alert-success').html(data.success).slideDown();
				
					//$( "#appointmefnt_form_pop").modal('toggle');
                } else if(data.error)
                {
                    $('.appointment_form .alert').addClass('alert-danger').html(data.error).slideDown();

                    $.each(data.errors, function(index, value)
					{
						
                        $('.appointment_form').find('label[for='+index+']').addClass('error');
						$('.appointment_form').find('div[for='+index+']').addClass('error');
                    });

                    $( "#appointmefnt_form_pop .modal-dialog" ).shake(3, 20, 300);
                }
            }, 'json');
        });

        $('form[name=newsletterForm]').submit(function(e){
            $('footer .msg').removeClass('error success').html('');
            $('form[name=newsletterForm] input').removeClass('error');
            $('form[name=newsletterForm] .loading').show();
            var submit_btn = $(this).find('input[type=submit]');
            submit_btn.attr('disabled', 'disabled');
            var old_val = submit_btn.val();
            submit_btn.val('Submitting...');

            e.preventDefault();
            $.post($(this).attr('action'), $(this).serialize(), function(data){
                submit_btn.removeAttr('disabled');
                $('form[name=newsletterForm] .loading').hide();
                submit_btn.val(old_val);
                if(data.success)
                {
                    $('footer .msg').addClass('success').html(data.success);
                    $('input[type=text]').val('');
                } else if(data.error)
                {
                    $('footer .msg').addClass('error').html(data.error);
                    $.each(data.errors, function(index, value){
                        $('form[name=newsletterForm]').find('input[name='+index+']').addClass('error');
                    });
                    $('form[name=newsletterForm]').shake(3, 20, 300);
                }
            }, 'json');
        });

        $.each($('.vc_wp_custommenu'), function(){
            if($(this).width() < 400)
            {
                $(this).find('.menu li').css({'width':'49%'});
            }
        })
		
		

        
    });
    
    
        
    /*----------------------------------------------------*/
    /*  Testimonial Slider
    /*----------------------------------------------------*/    
    $('.testimonial_slider').flexslider({
        animation: "fade",
        directionNav: false
    });
        
	$('.gallery-slider').flexslider({
		animation: "slide",
		controlNav: false,
		directionNav: true,
		pauseOnHover: true,
		pauseOnAction: false,
		smoothHeight: true,
		start: function (slider) {
			slider.removeClass('loading');
		}
	});
	
	  if (jQuery().swipebox) {
        // Initialize the Lightbox automatically for any links to images with extensions .jpg, .jpeg, .png or .gif
       // $("a[href$='.jpg'], a[href$='.png'], a[href$='.jpeg'], a[href$='.gif']").swipebox();
	   
	    $(".swipebox").swipebox();
    }
	//$(".swipebox").swipebox();
    /*----------------------------------------------------*/
    /*  Aflix
    /*----------------------------------------------------*/
	/*$(".navbar2,.navbar3").affix({
        offset: {
            top: $('.top_bar').height()
        }
    });*/
	
	$(window).scroll(function () {
		if( $(window).scrollTop() > $('.navbar2,.navbar3').offset().top && !($('.navbar2,.navbar3').hasClass('affix '))){
			$('.navbar2,.navbar3').addClass('affix ');
		} else if ($(window).scrollTop() == 0){
			$('.navbar2,.navbar3').removeClass('affix ');
		}
	});

    /*----------------------------------------------------*/
    /*  Qty spinner start
     /*----------------------------------------------------*/
    $('.btn-number').click(function(e){
        e.preventDefault();

        var fieldName = $(this).attr('data-field');
        var type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {
                var minValue = parseInt(input.attr('min'));
                if(!minValue) minValue = 0;
                if(currentVal > minValue) {
                    input.val(currentVal - 1).change();
                }
                if(parseInt(input.val()) == minValue) {
                    $(this).attr('disabled', true);
                }

            } else if(type == 'plus') {
                var maxValue = parseInt(input.attr('max'));
                if(!maxValue) maxValue = 9999999999999;
                if(currentVal < maxValue) {
                    input.val(currentVal + 1).change();
                }
                if(parseInt(input.val()) == maxValue) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {

        var minValue =  parseInt($(this).attr('min'));
        var maxValue =  parseInt($(this).attr('max'));
        if(!minValue) minValue = 0;
        if(!maxValue) maxValue = 9999999999999;
        var valueCurrent = parseInt($(this).val());

        var name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $('.spinner .btn:first-of-type').on('click', function() {
        var btn = $(this);
        var input = btn.closest('.spinner').find('input');
        if (input.attr('max') == undefined || parseInt(input.val()) < parseInt(input.attr('max'))) {
            input.val(parseInt(input.val(), 10) + 1);
        } else {
            btn.next("disabled", true);
        }
    });
    $('.spinner .btn:last-of-type').on('click', function() {
        var btn = $(this);
        var input = btn.closest('.spinner').find('input');
        if (input.attr('min') == undefined || parseInt(input.val()) > parseInt(input.attr('min'))) {
            input.val(parseInt(input.val(), 10) - 1);
        } else {
            btn.prev("disabled", true);
        }
    });
    /*----------------------------------------------------*/
    /*  Qty spinner  End
     /*----------------------------------------------------*/

    $('.product-slide').each(function(){
        if( $(this).find("div").length > 1 ) $(this).owlCarousel({
            loop:true,
            margin:0,
            nav:false,
            items:1
        })
    });
	
	// Flex Slider for gallery detail page
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            reverse: false,
            slideshow: false,
            itemWidth: 123,
            minItems: 4,
            itemMargin: 10,
            asNavFor: '#slider',
			directionNav:true,
			prevText:'',
			nextText:''
        });

        $('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });

	/*-----------------------------------------------------------------*/
    /* isotopes Effects
    /*-----------------------------------------------------------------*/
    if (jQuery().isotope) {
        // cache container
        var $container = $('#isotope-container');

        // filter items when filter link is clicked
        $('#gallery_filters a').not('.no-isotope').click(function (e) {
            e.preventDefault();
            $(this).parents('li').addClass('active').siblings().removeClass('active');
            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector,
                layoutMode: 'fitRows',
                itemSelector: '.isotope-item',
                animationEngine: 'best-available'
            });
        });

        /* to fix floating bugs due to variation in height */
        setTimeout(function () {
            $container.isotope({
                filter: "*",
                layoutMode: 'fitRows',
                itemSelector: '.isotope-item',
                animationEngine: 'best-available'
            });
        }, 1000);
    }
	

    $('form#commentform').addClass('medical-form');
	


})(jQuery)

 jQuery(function($) {
		  // Bootstrap menu magic
			  $(window).resize(function() {
			if ($(window).width() < 768) 
			{
				$('.dropdown-toggle').each(function () {
					$(".dropdown-toggle").attr('data-toggle', 'dropdown');
				});
			} 
			else 
			{
				$('.dropdown-toggle').each(function () {
					$(".dropdown-toggle").removeAttr('data-toggle dropdown');
				});
			  
			}
		});
		if ($(window).width() < 768) 
		{
			$('.dropdown-toggle').each(function () {
				$(".dropdown-toggle").attr('data-toggle', 'dropdown');
			});
		} 
		else 
		{
			$('.dropdown-toggle').each(function () {
				$(".dropdown-toggle").removeAttr('data-toggle dropdown');
			});
		}
		});




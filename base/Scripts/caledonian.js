// +------------------------------------------------------------------------+
// | Artlantis CMS Solutions                                                |
// +------------------------------------------------------------------------+
// | Caledonian PHP Calendar & Event System                                 |
// | Copyright (c) Artlantis Design Studio 2013. All rights reserved.       |
// | Version       2.1                                                      |
// | Last modified 31.10.13                                                 |
// | Email         developer@artlantis.net                                  |
// | Web           http://www.artlantis.net                                 |
// +------------------------------------------------------------------------+

$(document).ready(function(){
	$(".calendar-day").mouseover(function () {
		$(this).find(".calendar-add").addClass( "glyphicon glyphicon-plus-sign" );
	});
	$(".calendar-day").mouseleave(function () {
		$(this).find(".calendar-add").removeClass("glyphicon glyphicon-plus-sign" );
	});
		
});

$(window).load(function(){
	
	// Run Tooltip
	$('[data-toggle="tooltip"]').tooltip();
		
});


// Button Href
$(document).ready(function(){
    $("button[data-href]").click( function() {
        location.href = $(this).attr("data-href");
    });
});

// Fancybox

$(document).ready(function() {
	
    $(".fancybox").fancybox({
		autoSize : false,
        beforeLoad : function() {
			this.content   = $('#'+this.element.data('fancybox-cnt'));         
            this.width  = parseInt(this.element.data('fancybox-width'));  
            this.height = parseInt(this.element.data('fancybox-height'));
        }
    });
	
    $(".fancybox2").fancybox({
		autoSize : false,
        beforeLoad : function() {
            this.width  = parseInt(this.element.data('fancybox-width'));  
            this.height = parseInt(this.element.data('fancybox-height'));
        }
    });	
	
});

// Mini Calendar Popup

$(document).ready(function() {
	
        $('.calendar-mini-pop').bind('click', function() {
			
			var data_href = $(this).attr('data-fancy-href');

			$(this).fancybox({
				autoSize : false,
				beforeLoad : function() {
					this.type     = 'iframe';
					this.href     = data_href;
					this.width  = 600;  
					this.height = 500;
				}
			});	

        });
	
});

// Toggle Language Box
	$(document).ready(function(e) {
        $('.lang-toggle').click(function(e) {
            $('#lang-box').toggle('fast');
        });
    });

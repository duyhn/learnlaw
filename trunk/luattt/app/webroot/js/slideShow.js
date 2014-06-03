$(function() {
                $(window).scroll(function() {
                    if ($(this).scrollTop() != 0) {
                        $('#bttop').fadeIn();
                    } else {
                        $('#bttop').fadeOut();
                    }
                });
                $('#bttop').click(function() {
                    $('body,html').animate({scrollTop: 0}, 800);
                });
            });

        
            $(document).ready(function() {
                $("#contenttab div").hide(); // Initially hide all content
                $("#tabs li:first").attr("id", "current"); // Activate first
															// tab
                $("#contenttab div:first").fadeIn(); // Show first tab
														// content

                $('#tabs a').click(function(e) {
                    e.preventDefault();
                    if ($(this).closest("li").attr("id") == "current") { // detection
																			// for
																			// current
																			// tab
                        return
                    }
                    else {
                        $("#contenttab div").hide(); // Hide all content
                        $("#tabs li").attr("id", ""); // Reset id's
                        $(this).parent().attr("id", "current"); // Activate this
                        $('#' + $(this).attr('name')).fadeIn(); // Show content
																// for current
																// tab
                    }
                });
            });
        
           
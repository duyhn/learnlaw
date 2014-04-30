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
        
            $(document).ready(function() {
            	showhide('#link11', 1);
            	showhide('#link12', 2);
            	showhide('#link13', 3);
            	showhide('#link14', 4);
                $(".jcarouse").jCarouselLite({// Lấy class của ul và gọi hàm
												// jCarouselLite() trong thư
												// viện
                    vertical: true, // chạy theo chiều dọc
                    hoverPause: true, // Hover vào nó sẽ dừng lại
                    visible: 3, // Số bài viết cần hiện
                    auto: 500, // Tự động scroll
                    speed: 1000					// Tốc độ scroll
                });
            });
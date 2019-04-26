export default class MobileSidebarMenu {

    load()
    {
        window.onload = function(){

            //sidebar mobile
            $('.trigger-sidebar').on('click', function () {
                $('#left_menu').toggleClass('sidebar-show');
                $(this).toggleClass('trigger-open');
                $('body').toggleClass('fixed-body');
            });


            // Show/hide menu depending on scroll direction
            showHideMenu();
            window.onresize = function() {
                showHideMenu();
            }

        };

        // Show/hide menu depending on scroll direction
        function showHideMenu() {
            if(screen.width < 992)
            {
                $('#main_navigation').addClass('scroll-show-hide-enabled');

                var lastScrollTop = 0;
                var scrolledTop = 0;
                $(window).scroll(function()
                {
                    if(screen.width < 992)
                    {
                        var st = $(this).scrollTop();

                        //if less then 100 scroll show menu
                        if(st < 100)
                        {
                            $('#main_navigation').removeClass('scroll-hide');
                            return
                        }

                        //check scroll direction
                        if (st > lastScrollTop)
                        {
                            scrolledTop = 0;
                            $('#main_navigation').addClass('scroll-hide');
                        }
                        else
                        {
                            scrolledTop++;
                            if(scrolledTop > 30)
                            {
                                $('#main_navigation').removeClass('scroll-hide');
                            }
                        }
                        lastScrollTop = st;
                    }
                });
            }
            else
            {
                $('#main_navigation').removeClass('scroll-show-hide-enabled');
            }
        }
    }
}


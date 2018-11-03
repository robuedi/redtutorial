window.onload = function(){

    //Sidebar menu actions
    var sidebar_navigation = {
        init:function () {
            //fetch DOM
            this.initDOM();

            //initial page loading
            this.openParents();

            //open/close action
            this.openCloseAction();

            //show/hide other courses
            this.seeOtherCourses();

        },
        initDOM: function () {
            this.container      = $('.root-list');
            this.listItems      = this.container.find('li');
            this.listItemsSym   = this.listItems.find('.open-symbol');
            this.seeOtherourses = this.container.find('.see-other-courses');
            // this.itemsLabel     = this.container.find('.item-label');
        },
        openParents: function () {
            //get active item
            var activeItem = this.listItems.filter('.active');

            //make parents active
            if(activeItem.length > 0)
            {
                var parents = activeItem.parentsUntil('.root-list', 'li');

                parents.addClass('active');
            }
        },
        openCloseAction: function () {
            this.listItemsSym.on('click', function () {
               var parent = $(this).closest('li');

               //open/close
               if(parent.hasClass('active'))
               {
                   parent.removeClass('active');
               }
               else
               {
                   parent.addClass('active');

                   //close siblings
                   parent.siblings().removeClass('active');
               }
            });
        },
        seeOtherCourses: function () {
            this.seeOtherourses.on('click', function () {
               $(this).toggleClass('active-see');
            });
        }
    };

    sidebar_navigation.init();


    //sidebar mobile
    $('.trigger-sidebar').on('click', function () {
        $('#left_menu').toggleClass('sidebar-show');
        $(this).toggleClass('trigger-open');
        $('body').toggleClass('fixed-body');
    })
}


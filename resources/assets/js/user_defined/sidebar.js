window.onload = function(){

    //Sidebar menu actions
    var sidebar_navigation = {
        init:function () {
            //fetch DOM
            this.initDOM();

            //init actions
            this.activateItem();

            //show active
            this.initialOpenParents('');
        },
        initDOM: function () {
            this.container      = $('[data-sidebar-nav]');
            this.mainListItems  = this.container.find('[data-sidebar-nav] > [data-list-item]');
            this.listItems      = this.container.find('[data-list-item]');
            this.listItemActive = this.listItems.filter('.active').eq(0);
            this.listItemsLabel = this.listItems.find(' > .item-label');
        },
        activateItem: function(){
            var that = this;
            this.listItemsLabel.on('click', function(e){

                //add active
                var parent = $(this).closest('[data-list-item]');

                if($(parent).length > 0)
                {
                    if(parent.hasClass('active'))
                    {
                        //close list item
                        that.closeAction(parent);
                    }
                    else
                    {
                        //open list item
                        that.openAction(parent);
                    }
                }
            });
        },
        openAction: function (parent) {

            //close others
            //get main parent
            if($(parent).is('[data-root-list]'))
            {
                var mainParent = parent;
            }
            else
            {
                var mainParent = parent.closest('[data-root-list]')
            }

            //close other parents and children
            var that = this;
            this.mainListItems.each(function () {
                if(this !== mainParent)
                {
                    $(this).removeClass('active');
                    this.closeChildren(this);
                }
            });

            //open parent
            parent.addClass('active');
        },
        closeAction: function (parent) {

            //close children
            this.closeChildren(parent);

            //close parent
            $(parent).removeClass('active');
        },
        closeChildren: function (parent) {

            //hide all children's lists
            var innerChildren = parent.find('[data-list-item]');
            innerChildren.each(function(){
                $(this).removeClass('active');
            });
        },
        initialOpenParents: function (activeList) {

            //get parent
            if(activeList.length === 0)
            {
                var parent = this.listItemActive.parents('[data-list-item]').eq(0);
            }
            else
            {
                var parent = activeList.parents('[data-list-item]').eq(0);
            }

            //active parent
            if(parent.length > 0)
            {
                parent.addClass('active');
                this.initialOpenParents(parent);
            }
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

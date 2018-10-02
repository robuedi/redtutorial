window.onload = function(){

    //Sidebar menu actions
    var sidebar_navigation = {
        init:function () {
            //fetch DOM
            this.initDOM();

            //init actions
            this.activateItem();
        },
        initDOM: function () {
            this.container      = document.querySelector('[data-sidebar-nav]');
            this.mainListItems      = this.container.querySelectorAll('[data-sidebar-nav] > [data-list-item]');
            this.listItems      = this.container.querySelectorAll('[data-list-item] > .item-label');
            this.test = 0;
            // this.listItemsIcons = this.container.querySelectorAll('[data-list-item] i')
        },
        activateItem: function(){
            var that = this;
            if(typeof this.listItems !== 'undefined')
            {
                //attach action to items
                for (var i = 0; i < this.listItems.length; i++) {
                    this.listItems[i].addEventListener('click', function(e){

                        //add active
                        var target = e.target || e.srcElement;
                        var parent = target.closest('[data-list-item]');

                        if(typeof parent !== 'undefined')
                        {
                            if(parent.classList.contains('active'))
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
                }
            }
        },
        openAction: function (parent) {

            //close others
            //get main parent
            if(parent.hasAttribute('data-root-list'))
            {
                var mainParent = parent;
            }
            else
            {
                var mainParent = parent.closest('[data-root-list]')
            }

            //close other parents and children
            for (var j = 0; j < this.mainListItems.length; j++)
            {
                var currentItem = this.mainListItems[j];
                if(currentItem !== mainParent)
                {
                    this.mainListItems[j].classList.remove('active');
                    this.closeChildren(this.mainListItems[j]);
                }
            }

            //open parent
            parent.classList.add('active');
        },
        closeAction: function (parent) {

            //close children
            this.closeChildren(parent);

            //close parent
            parent.classList.remove('active');
        },
        closeChildren: function (parent) {
            //hide all children's lists
            var innerChildren = parent.querySelectorAll('[data-list-item]');
            for (var j = 0; j < innerChildren.length; j++) {
                innerChildren[j].classList.remove('active');
            }
        }
    };

    sidebar_navigation.init();
}

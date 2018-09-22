window.onload = function(){

    //Sidebar menu actions
    var sidebar_navigation = {
        init:function () {
            //fetch DOM
            this.initDOM();

            //init actions
            this.initItemsAction();

            //init highlight on link click
            this.activateItem();
        },
        initDOM: function () {
            this.container      = document.querySelector('[data-sidebar-nav]');
            this.listItems      = this.container.querySelectorAll('[data-list-item] .item-label a');
            this.listItemsIcons = this.container.querySelectorAll('[data-list-item] i')
        },
        activateItem: function(){
            if(typeof this.listItems !== 'undefined')
            {
                //attach action to items
                for (var i = 0; i < this.listItems.length; i++) {
                    this.listItems[i].addEventListener('click', function(e){

                        //add active
                        var target = e.target || e.srcElement;
                        var parent = target.closest('[data-list-item]');

                        parent.classList.add('active');
                    });
                }
            }
        },
        initItemsAction: function(){

            if(typeof this.listItemsIcons !== 'undefined')
            {
                //attach action to icon items
                var that = this;
                for (var i = 0; i < this.listItemsIcons.length; i++) {
                    this.listItemsIcons[i].addEventListener('click', function(e){
                        that.itemAction(e);
                    });
                }
            }
        },
        itemAction: function (e) {
            e.preventDefault();

            var target = e.target || e.srcElement;
            var parent = target.closest('[data-list-item]');


            if(parent.classList.contains('active'))
            {
                //close list item
                this.closeAction(target, parent);
            }
            else
            {
                //open list item
                this.openAction(target, parent);
            }
        },
        openAction: function (target, parent) {
            //open parent
            parent.classList.add('active');
            target.classList.remove('fa-plus');
            target.classList.add('fa-minus');
        },
        closeAction: function (target, parent) {
            //hide all children's lists
            var innerChildren = parent.querySelectorAll('[data-list-item]');
            for (var j = 0; j < innerChildren.length; j++) {
                innerChildren[j].classList.remove('active');

                //change children's icons
                var openIcons = innerChildren[j].querySelectorAll('.fa-minus');
                for (var l = 0; l < openIcons.length; l++) {
                    openIcons[l].classList.remove('.fa-minus');
                    openIcons[l].classList.add('.fa-plus');
                }
            }

            //close parent
            parent.classList.remove('active');
            target.classList.remove('fa-minus');
            target.classList.add('fa-plus');
        }
    };

    sidebar_navigation.init();
}

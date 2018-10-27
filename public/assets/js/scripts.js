/*!
 * jQuery Cookiebar Plugin
 * https://github.com/carlwoodhouse/jquery.cookieBar
 *
 * Copyright 2012-17, Carl Woodhouse. the cookie function is inspired by https://github.com/carhartl/jquery-cookie
 * Disclaimer: if you still get fined for not complying with the eu cookielaw, it's not our fault.
 * Licence: MIT
 */

(function ($) {
	$.cookie = function (key, value, options) {
		if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
			options = $.extend({}, options);

			if (value === null || value === undefined) {
				options.expires = -1;
			}

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setDate(t.getDate() + days);
			}

			value = String(value);

			return (document.cookie = [
				encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // max-age is not supported by IE
				options.path ? '; path=' + options.path : '',
				options.domain ? '; domain=' + options.domain : '',
				options.secure ? '; secure' : ''
			].join(''));
		}
		options = value || {};
		var decode = options.raw ? function (s) { return s; } : decodeURIComponent;

		var pairs = document.cookie.split('; ');
		for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
			// IE
			if (decode(pair[0]) === key) return decode(pair[1] || '');
		}
		return null;
	};

	$.fn.cookieBar = function (options) {
		var settings = $.extend({
			'closeButton': 'none',
			'hideOnClose': true,
			'secure': false,
			'path': '/',
			'domain': ''
		}, options);

		return this.each(function () {
			var cookiebar = $(this);

			// just in case they didnt hide it by default.
			cookiebar.hide();

			// if close button not defined. define it!
			if (settings.closeButton == 'none') {
				cookiebar.append('<a class="cookiebar-close">Continue</a>');
				$.extend(settings, { 'closeButton': '.cookiebar-close' });
			}

			if ($.cookie('cookiebar') != 'hide') {
				cookiebar.show();
			}

			cookiebar.find(settings.closeButton).click(function () {
				if (settings.hideOnClose) {
					cookiebar.hide();
				}
				$.cookie('cookiebar', 'hide', { path: settings.path, secure: settings.secure, domain: settings.domain, expires: 30 });
				cookiebar.trigger('cookieBar-close');
				return false;
			});
		});
	};

	// self injection init
	$.cookieBar = function (options) {
		$('body').prepend('<div class="ui-widget"><div style="display: none;" class="cookie-message ui-widget-header blue"><p>By using this website you allow us to place cookies on your computer. They are harmless and never personally identify you.</p></div></div>');
		$('.cookie-message').cookieBar(options);
	};
})(jQuery);

$(document).ready(function() {
    $('.cookie-message').cookieBar({
        closeButton : '.close-button'
    });
});

$(function () {
    //close feedback message
    $('.alert .close').on('click', function () {
        $(this).closest('.alert').remove();
    })
})
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

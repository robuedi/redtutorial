/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(49);


/***/ }),

/***/ 49:
/***/ (function(module, exports) {

window.onload = function () {

    //Sidebar menu actions
    var sidebar_navigation = {
        init: function init() {
            //fetch DOM
            this.initDOM();

            //init actions
            this.activateItem();

            //show active
            this.initialOpenParents('');
        },
        initDOM: function initDOM() {
            this.container = $('[data-sidebar-nav]');
            this.mainListItems = this.container.find('[data-sidebar-nav] > [data-list-item]');
            this.listItems = this.container.find('[data-list-item]');
            this.listItemActive = this.listItems.filter('.active').eq(0);
            this.listItemsLabel = this.listItems.find(' > .item-label');
        },
        activateItem: function activateItem() {
            var that = this;
            this.listItemsLabel.on('click', function (e) {

                //add active
                var parent = $(this).closest('[data-list-item]');

                if ($(parent).length > 0) {
                    if (parent.hasClass('active')) {
                        //close list item
                        that.closeAction(parent);
                    } else {
                        //open list item
                        that.openAction(parent);
                    }
                }
            });
        },
        openAction: function openAction(parent) {

            //close others
            //get main parent
            if ($(parent).is('[data-root-list]')) {
                var mainParent = parent;
            } else {
                var mainParent = parent.closest('[data-root-list]');
            }

            //close other parents and children
            var that = this;
            this.mainListItems.each(function () {
                if (this !== mainParent) {
                    $(this).removeClass('active');
                    this.closeChildren(this);
                }
            });

            //open parent
            parent.addClass('active');
        },
        closeAction: function closeAction(parent) {

            //close children
            this.closeChildren(parent);

            //close parent
            $(parent).removeClass('active');
        },
        closeChildren: function closeChildren(parent) {

            //hide all children's lists
            var innerChildren = parent.find('[data-list-item]');
            innerChildren.each(function () {
                $(this).removeClass('active');
            });
        },
        initialOpenParents: function initialOpenParents(activeList) {

            //get parent
            if (activeList.length === 0) {
                var parent = this.listItemActive.parents('[data-list-item]').eq(0);
            } else {
                var parent = activeList.parents('[data-list-item]').eq(0);
            }

            //active parent
            if (parent.length > 0) {
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
    });
};

/***/ })

/******/ });
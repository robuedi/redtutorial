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
/******/ 	return __webpack_require__(__webpack_require__.s = 46);
/******/ })
/************************************************************************/
/******/ ({

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(47);


/***/ }),

/***/ 47:
/***/ (function(module, exports) {

window.onload = function () {

    //Sidebar menu actions
    var sidebar_navigation = {
        init: function init() {
            //fetch DOM
            this.initDOM();

            //init actions
            this.initItemsAction();

            //init highlight on link click
            this.activateItem();
        },
        initDOM: function initDOM() {
            this.container = document.querySelector('[data-sidebar-nav]');
            this.listItems = this.container.querySelectorAll('[data-list-item] .item-label a');
            this.listItemsIcons = this.container.querySelectorAll('[data-list-item] i');
        },
        activateItem: function activateItem() {
            if (typeof this.listItems !== 'undefined') {
                //attach action to items
                for (var i = 0; i < this.listItems.length; i++) {
                    this.listItems[i].addEventListener('click', function (e) {

                        //add active
                        var target = e.target || e.srcElement;
                        var parent = target.closest('[data-list-item]');

                        parent.classList.add('active');
                    });
                }
            }
        },
        initItemsAction: function initItemsAction() {

            if (typeof this.listItemsIcons !== 'undefined') {
                //attach action to icon items
                var that = this;
                for (var i = 0; i < this.listItemsIcons.length; i++) {
                    this.listItemsIcons[i].addEventListener('click', function (e) {
                        that.itemAction(e);
                    });
                }
            }
        },
        itemAction: function itemAction(e) {
            e.preventDefault();

            var target = e.target || e.srcElement;
            var parent = target.closest('[data-list-item]');

            if (parent.classList.contains('active')) {
                //close list item
                this.closeAction(target, parent);
            } else {
                //open list item
                this.openAction(target, parent);
            }
        },
        openAction: function openAction(target, parent) {
            //open parent
            parent.classList.add('active');
            target.classList.remove('fa-plus');
            target.classList.add('fa-minus');
        },
        closeAction: function closeAction(target, parent) {
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
};

/***/ })

/******/ });
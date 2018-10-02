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
            this.activateItem();
        },
        initDOM: function initDOM() {
            this.container = document.querySelector('[data-sidebar-nav]');
            this.mainListItems = this.container.querySelectorAll('[data-sidebar-nav] > [data-list-item]');
            this.listItems = this.container.querySelectorAll('[data-list-item] > .item-label');
            this.test = 0;
            // this.listItemsIcons = this.container.querySelectorAll('[data-list-item] i')
        },
        activateItem: function activateItem() {
            var that = this;
            if (typeof this.listItems !== 'undefined') {
                //attach action to items
                for (var i = 0; i < this.listItems.length; i++) {
                    this.listItems[i].addEventListener('click', function (e) {

                        //add active
                        var target = e.target || e.srcElement;
                        var parent = target.closest('[data-list-item]');

                        if (typeof parent !== 'undefined') {
                            if (parent.classList.contains('active')) {
                                //close list item
                                that.closeAction(parent);
                            } else {
                                //open list item
                                that.openAction(parent);
                            }
                        }
                    });
                }
            }
        },
        openAction: function openAction(parent) {

            //close others
            //get main parent
            if (parent.hasAttribute('data-root-list')) {
                var mainParent = parent;
            } else {
                var mainParent = parent.closest('[data-root-list]');
            }

            //close other parents and children
            for (var j = 0; j < this.mainListItems.length; j++) {
                var currentItem = this.mainListItems[j];
                if (currentItem !== mainParent) {
                    this.mainListItems[j].classList.remove('active');
                    this.closeChildren(this.mainListItems[j]);
                }
            }

            //open parent
            parent.classList.add('active');
        },
        closeAction: function closeAction(parent) {

            //close children
            this.closeChildren(parent);

            //close parent
            parent.classList.remove('active');
        },
        closeChildren: function closeChildren(parent) {
            //hide all children's lists
            var innerChildren = parent.querySelectorAll('[data-list-item]');
            for (var j = 0; j < innerChildren.length; j++) {
                innerChildren[j].classList.remove('active');
            }
        }
    };

    sidebar_navigation.init();
};

/***/ })

/******/ });
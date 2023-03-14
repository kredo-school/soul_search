/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/registration.js":
/*!**************************************!*\
  !*** ./resources/js/registration.js ***!
  \**************************************/
/***/ (() => {

eval("$(function () {\n  var $sections = $('.form-section');\n  function navigateTo(index) {\n    $sections.removeClass('current').eq(index).addClass('current');\n    $('.form-navigation .previous').toggle(index > 0);\n    var atTheEnd = index >= $sections.length - 1;\n    $('.form-navigation .next').toggle(!atTheEnd);\n    $('.form-navigation [type=submit]').toggle(atTheEnd);\n  }\n  function curIndex() {\n    return $sections.index($sections.filter('.current'));\n  }\n  $('.form-navigation .previous').click(function () {\n    navigateTo(curIndex() - 1);\n  });\n  $('.form-navigation .next').click(function () {\n    navigateTo(curIndex() + 1);\n  });\n  navigateTo(0);\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyIkIiwiJHNlY3Rpb25zIiwibmF2aWdhdGVUbyIsImluZGV4IiwicmVtb3ZlQ2xhc3MiLCJlcSIsImFkZENsYXNzIiwidG9nZ2xlIiwiYXRUaGVFbmQiLCJsZW5ndGgiLCJjdXJJbmRleCIsImZpbHRlciIsImNsaWNrIl0sInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9qcy9yZWdpc3RyYXRpb24uanM/ZjE3MyJdLCJzb3VyY2VzQ29udGVudCI6WyIkKGZ1bmN0aW9uKCl7XHJcbiAgICB2YXIgJHNlY3Rpb25zID0gJCgnLmZvcm0tc2VjdGlvbicpO1xyXG5cclxuICAgIGZ1bmN0aW9uIG5hdmlnYXRlVG8oaW5kZXgpe1xyXG4gICAgICAgICRzZWN0aW9ucy5yZW1vdmVDbGFzcygnY3VycmVudCcpLmVxKGluZGV4KS5hZGRDbGFzcygnY3VycmVudCcpO1xyXG4gICAgICAgICQoJy5mb3JtLW5hdmlnYXRpb24gLnByZXZpb3VzJykudG9nZ2xlKGluZGV4PjApO1xyXG4gICAgICAgIHZhciBhdFRoZUVuZCA9IGluZGV4ID49ICRzZWN0aW9ucy5sZW5ndGggLSAxO1xyXG4gICAgICAgICQoJy5mb3JtLW5hdmlnYXRpb24gLm5leHQnKS50b2dnbGUoIWF0VGhlRW5kKTtcclxuICAgICAgICAkKCcuZm9ybS1uYXZpZ2F0aW9uIFt0eXBlPXN1Ym1pdF0nKS50b2dnbGUoYXRUaGVFbmQpO1xyXG4gICAgfVxyXG5cclxuICAgIGZ1bmN0aW9uIGN1ckluZGV4KCl7XHJcbiAgICAgICAgcmV0dXJuICRzZWN0aW9ucy5pbmRleCgkc2VjdGlvbnMuZmlsdGVyKCcuY3VycmVudCcpKTtcclxuICAgIH1cclxuXHJcbiAgICAkKCcuZm9ybS1uYXZpZ2F0aW9uIC5wcmV2aW91cycpLmNsaWNrKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgbmF2aWdhdGVUbyhjdXJJbmRleCgpLTEpO1xyXG4gICAgfSk7XHJcblxyXG4gICAgJCgnLmZvcm0tbmF2aWdhdGlvbiAubmV4dCcpLmNsaWNrKGZ1bmN0aW9uKCl7XHJcblxyXG4gICAgICAgIG5hdmlnYXRlVG8oY3VySW5kZXgoKSsxKTtcclxuICAgIH0pO1xyXG5cclxuICAgIG5hdmlnYXRlVG8oMCk7XHJcbn0pO1xyXG4iXSwibWFwcGluZ3MiOiJBQUFBQSxDQUFDLENBQUMsWUFBVTtFQUNSLElBQUlDLFNBQVMsR0FBR0QsQ0FBQyxDQUFDLGVBQWUsQ0FBQztFQUVsQyxTQUFTRSxVQUFVLENBQUNDLEtBQUssRUFBQztJQUN0QkYsU0FBUyxDQUFDRyxXQUFXLENBQUMsU0FBUyxDQUFDLENBQUNDLEVBQUUsQ0FBQ0YsS0FBSyxDQUFDLENBQUNHLFFBQVEsQ0FBQyxTQUFTLENBQUM7SUFDOUROLENBQUMsQ0FBQyw0QkFBNEIsQ0FBQyxDQUFDTyxNQUFNLENBQUNKLEtBQUssR0FBQyxDQUFDLENBQUM7SUFDL0MsSUFBSUssUUFBUSxHQUFHTCxLQUFLLElBQUlGLFNBQVMsQ0FBQ1EsTUFBTSxHQUFHLENBQUM7SUFDNUNULENBQUMsQ0FBQyx3QkFBd0IsQ0FBQyxDQUFDTyxNQUFNLENBQUMsQ0FBQ0MsUUFBUSxDQUFDO0lBQzdDUixDQUFDLENBQUMsZ0NBQWdDLENBQUMsQ0FBQ08sTUFBTSxDQUFDQyxRQUFRLENBQUM7RUFDeEQ7RUFFQSxTQUFTRSxRQUFRLEdBQUU7SUFDZixPQUFPVCxTQUFTLENBQUNFLEtBQUssQ0FBQ0YsU0FBUyxDQUFDVSxNQUFNLENBQUMsVUFBVSxDQUFDLENBQUM7RUFDeEQ7RUFFQVgsQ0FBQyxDQUFDLDRCQUE0QixDQUFDLENBQUNZLEtBQUssQ0FBQyxZQUFVO0lBQzVDVixVQUFVLENBQUNRLFFBQVEsRUFBRSxHQUFDLENBQUMsQ0FBQztFQUM1QixDQUFDLENBQUM7RUFFRlYsQ0FBQyxDQUFDLHdCQUF3QixDQUFDLENBQUNZLEtBQUssQ0FBQyxZQUFVO0lBRXhDVixVQUFVLENBQUNRLFFBQVEsRUFBRSxHQUFDLENBQUMsQ0FBQztFQUM1QixDQUFDLENBQUM7RUFFRlIsVUFBVSxDQUFDLENBQUMsQ0FBQztBQUNqQixDQUFDLENBQUMiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcmVnaXN0cmF0aW9uLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/registration.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/registration.js"]();
/******/ 	
/******/ })()
;
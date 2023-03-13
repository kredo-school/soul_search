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

eval("$(function () {\n  var $sections = $('.form-section');\n  function navigateTo(index) {\n    $sections.removeClass('current').eq(index).addClass('current');\n    $('.form-navigation .previous').toggle(index > 0);\n    var atTheEnd = index >= $sections.length - 1;\n    $('.form-navigation .next').toggle(!atTheEnd);\n    $('.form-navigation [type=submit]').toggle(atTheEnd);\n  }\n  function curIndex() {\n    return $sections.index($sections.filter('.current'));\n  }\n  $('.form-navigation .previous').click(function () {\n    navigateTo(curIndex() - 1);\n  });\n  $('.form-navigation .next').click(function () {\n    navigateTo(curIndex() + 1);\n  });\n  navigateTo(0);\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyIkIiwiJHNlY3Rpb25zIiwibmF2aWdhdGVUbyIsImluZGV4IiwicmVtb3ZlQ2xhc3MiLCJlcSIsImFkZENsYXNzIiwidG9nZ2xlIiwiYXRUaGVFbmQiLCJsZW5ndGgiLCJjdXJJbmRleCIsImZpbHRlciIsImNsaWNrIl0sInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9qcy9yZWdpc3RyYXRpb24uanM/ZjE3MyJdLCJzb3VyY2VzQ29udGVudCI6WyIkKGZ1bmN0aW9uKCl7XG4gICAgdmFyICRzZWN0aW9ucyA9ICQoJy5mb3JtLXNlY3Rpb24nKTtcblxuICAgIGZ1bmN0aW9uIG5hdmlnYXRlVG8oaW5kZXgpe1xuICAgICAgICAkc2VjdGlvbnMucmVtb3ZlQ2xhc3MoJ2N1cnJlbnQnKS5lcShpbmRleCkuYWRkQ2xhc3MoJ2N1cnJlbnQnKTtcbiAgICAgICAgJCgnLmZvcm0tbmF2aWdhdGlvbiAucHJldmlvdXMnKS50b2dnbGUoaW5kZXg+MCk7XG4gICAgICAgIHZhciBhdFRoZUVuZCA9IGluZGV4ID49ICRzZWN0aW9ucy5sZW5ndGggLSAxO1xuICAgICAgICAkKCcuZm9ybS1uYXZpZ2F0aW9uIC5uZXh0JykudG9nZ2xlKCFhdFRoZUVuZCk7XG4gICAgICAgICQoJy5mb3JtLW5hdmlnYXRpb24gW3R5cGU9c3VibWl0XScpLnRvZ2dsZShhdFRoZUVuZCk7XG4gICAgfVxuXG4gICAgZnVuY3Rpb24gY3VySW5kZXgoKXtcbiAgICAgICAgcmV0dXJuICRzZWN0aW9ucy5pbmRleCgkc2VjdGlvbnMuZmlsdGVyKCcuY3VycmVudCcpKTtcbiAgICB9XG5cbiAgICAkKCcuZm9ybS1uYXZpZ2F0aW9uIC5wcmV2aW91cycpLmNsaWNrKGZ1bmN0aW9uKCl7XG4gICAgICAgIG5hdmlnYXRlVG8oY3VySW5kZXgoKS0xKTtcbiAgICB9KTtcblxuICAgICQoJy5mb3JtLW5hdmlnYXRpb24gLm5leHQnKS5jbGljayhmdW5jdGlvbigpe1xuXG4gICAgICAgIG5hdmlnYXRlVG8oY3VySW5kZXgoKSsxKTtcbiAgICB9KTtcblxuICAgIG5hdmlnYXRlVG8oMCk7XG59KTtcbiJdLCJtYXBwaW5ncyI6IkFBQUFBLENBQUMsQ0FBQyxZQUFVO0VBQ1IsSUFBSUMsU0FBUyxHQUFHRCxDQUFDLENBQUMsZUFBZSxDQUFDO0VBRWxDLFNBQVNFLFVBQVUsQ0FBQ0MsS0FBSyxFQUFDO0lBQ3RCRixTQUFTLENBQUNHLFdBQVcsQ0FBQyxTQUFTLENBQUMsQ0FBQ0MsRUFBRSxDQUFDRixLQUFLLENBQUMsQ0FBQ0csUUFBUSxDQUFDLFNBQVMsQ0FBQztJQUM5RE4sQ0FBQyxDQUFDLDRCQUE0QixDQUFDLENBQUNPLE1BQU0sQ0FBQ0osS0FBSyxHQUFDLENBQUMsQ0FBQztJQUMvQyxJQUFJSyxRQUFRLEdBQUdMLEtBQUssSUFBSUYsU0FBUyxDQUFDUSxNQUFNLEdBQUcsQ0FBQztJQUM1Q1QsQ0FBQyxDQUFDLHdCQUF3QixDQUFDLENBQUNPLE1BQU0sQ0FBQyxDQUFDQyxRQUFRLENBQUM7SUFDN0NSLENBQUMsQ0FBQyxnQ0FBZ0MsQ0FBQyxDQUFDTyxNQUFNLENBQUNDLFFBQVEsQ0FBQztFQUN4RDtFQUVBLFNBQVNFLFFBQVEsR0FBRTtJQUNmLE9BQU9ULFNBQVMsQ0FBQ0UsS0FBSyxDQUFDRixTQUFTLENBQUNVLE1BQU0sQ0FBQyxVQUFVLENBQUMsQ0FBQztFQUN4RDtFQUVBWCxDQUFDLENBQUMsNEJBQTRCLENBQUMsQ0FBQ1ksS0FBSyxDQUFDLFlBQVU7SUFDNUNWLFVBQVUsQ0FBQ1EsUUFBUSxFQUFFLEdBQUMsQ0FBQyxDQUFDO0VBQzVCLENBQUMsQ0FBQztFQUVGVixDQUFDLENBQUMsd0JBQXdCLENBQUMsQ0FBQ1ksS0FBSyxDQUFDLFlBQVU7SUFFeENWLFVBQVUsQ0FBQ1EsUUFBUSxFQUFFLEdBQUMsQ0FBQyxDQUFDO0VBQzVCLENBQUMsQ0FBQztFQUVGUixVQUFVLENBQUMsQ0FBQyxDQUFDO0FBQ2pCLENBQUMsQ0FBQyIsImZpbGUiOiIuL3Jlc291cmNlcy9qcy9yZWdpc3RyYXRpb24uanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/registration.js\n");

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
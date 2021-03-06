/*
 * jQuery dragscrollable Plugin
 * version: 1.1 (31-May-2016)
 * Copyright (c) 2009 Miquel Herrera
 * Modified 2016 by Alexander Steinhöfer
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
!function(e){e.fn.dragscrollable=function(t){var a=e.extend({dragSelector:">:first",acceptPropagatedEvent:!0,preventDefault:!0,allowY:!0},t||{}),o={startDrag:function(e,t,a){e.data.lastCoord={left:t,top:a}},doDrag:function(e,t,o){var n={left:t-e.data.lastCoord.left,top:a.allowY?o-e.data.lastCoord.top:0};e.data.scrollable.scrollLeft(e.data.scrollable.scrollLeft()-n.left),e.data.scrollable.scrollTop(e.data.scrollable.scrollTop()-n.top),e.data.lastCoord={left:t,top:o}},touchStartHandler:function(t){var a=t.originalEvent.touches[0];o.startDrag(t,a.pageX,a.pageY),e.event.add(document,"touchend",o.touchEndHandler,t.data),e.event.add(document,"touchmove",o.touchMoveHandler,t.data)},touchMoveHandler:function(e){var t=e.originalEvent.touches[0];o.doDrag(e,t.pageX,t.pageY)},touchEndHandler:function(){e.event.remove(document,"touchmove",o.mouseMoveHandler),e.event.remove(document,"touchend",o.mouseUpHandler)},mouseDownHandler:function(t){return 1!=t.which||!t.data.acceptPropagatedEvent&&t.target!=this?!1:(o.startDrag(t,t.clientX,t.clientY),e.event.add(document,"mouseup",o.mouseUpHandler,t.data),e.event.add(document,"mousemove",o.mouseMoveHandler,t.data),t.data.preventDefault?(t.preventDefault(),!1):void 0)},mouseMoveHandler:function(e){return o.doDrag(e,e.clientX,e.clientY),e.data.preventDefault?(e.preventDefault(),!1):void 0},mouseUpHandler:function(t){return e.event.remove(document,"mousemove",o.mouseMoveHandler),e.event.remove(document,"mouseup",o.mouseUpHandler),t.data.preventDefault?(t.preventDefault(),!1):void 0}};this.each(function(){var t={scrollable:e(this),acceptPropagatedEvent:a.acceptPropagatedEvent,preventDefault:a.preventDefault};e(this).find(a.dragSelector).bind("mousedown",t,o.mouseDownHandler),e(this).find(a.dragSelector).bind("touchstart",t,o.touchStartHandler)})}}(jQuery);

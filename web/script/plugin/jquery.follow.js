(function($){

	$.fn.followPlugin = function() {

		var $sourceElement = null;
		var $activeElement = null;
		var $destElement = null;
		var dragOffsetX, dragOffsetY;
		var limits;

		var defaultOptions = {
			isActive: true,

			canDrag: function($src, event) {
				return $src;
			},

			didDrop: function($src, $dst) {
				$src.appendTo($dst);
			}
		};

		function cancelDestElement(options) {
			if ($destElement != null) {
				$destElement = null;
			}
		}

		var methods = {
			init: function(options) {
				options = $.extend({}, defaultOptions, options);
				this.data("options", options);
				this.bind("mousedown.dragdrop", methods.onStart);

				return this;
			},
			onStart: function(event) {
				var $me = $(this);
				var options = $me.data("options");

				if (!options.isActive)
					return;

				var $element = options.canDrag($me, event);
				if ($element) {
					$sourceElement = $element;
					var offset = $sourceElement.offset();
					var width = $sourceElement.innerWidth();
					var height = $sourceElement.innerHeight();

					dragOffsetX = event.pageX - offset.left;
					dragOffsetY = event.pageY - offset.top;

					$activeElement = $sourceElement;

					$activeElement.css({
						position: "absolute",
						left: offset.left,
						top: offset.top,
						width: width,
						height: height,
					});

					$(window)
						.bind("mousemove.dragdrop", { source: $me }, methods.onMove)
						.bind("mouseup.dragdrop", { source: $me }, methods.onEnd);

					event.stopPropagation();
					return false;
				}
			},
			onMove: function(event) {
				if (!$activeElement)
					return;

				var $me = event.data.source;
				var options = $me.data("options");
				var posX, posY;

				posX = event.pageX;
				posY = event.pageY;

				$activeElement.css("display", "none");

				var destElement = document.elementFromPoint(
					posX - document.documentElement.scrollLeft - document.body.scrollLeft,
					posY - document.documentElement.scrollTop - document.body.scrollTop
				);


				$activeElement.css("display", "");
				posX -= dragOffsetX;
				posY -= dragOffsetY;
				if (limits) {
					posX = Math.min(Math.max(posX, limits.minX), limits.maxX);
					posY = Math.min(Math.max(posY, limits.minY), limits.maxY);
				}
				$activeElement.css({ left: posX, top: posY });

				if (destElement) {
					if ($destElement == null || $destElement.get(0) != destElement) {
						cancelDestElement(options);
					}
				}
				else if ($destElement!=null) {
					cancelDestElement(options);
				}

				event.stopPropagation();
				return false;
			},
			onEnd: function(event) {
				if (!$activeElement)
					return;

				var $me = event.data.source;
				var options = $me.data("options");
				if ($destElement) {
					options.didDrop($sourceElement, $destElement);
				}
				cancelDestElement(options);


				$activeElement.css("position", "absolute");
				$activeElement.css("width", "");
				$activeElement.css("height", "");

				$(window).unbind("mousemove.dragdrop touchmove.dragdrop");
				$(window).unbind("mouseup.dragdrop touchend.dragdrop");
				$sourceElement = $activeElement = limits = null;
			}
		};

		return methods.init.apply(this, arguments);
	};

})(jQuery);

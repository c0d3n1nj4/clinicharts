(function (root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define([], function () {
      return (root.returnExportsGlobal = factory());
    });
  } else if (typeof exports === 'object') {
    // Node. Does not work with strict CommonJS, but
    // only CommonJS-like enviroments that support module.exports,
    // like Node.
    module.exports = factory();
  } else {
    root['Chartist.plugins.ctPointLabels'] = factory();
  }
}(this, function () {

	function k_formatter(num) {
		return (num > 999) ? (num/1000).toFixed(1)+'K' : num
	}

  /**
   * Chartist.js plugin to display a data label on top of the points in a line chart.
   *
   */
  /* global Chartist */
  (function(window, document, Chartist) {
    'use strict';

    var defaultOptions = {
      labelClass: 'ct-label',
      labelOffset: {
        x: 0,
        y: -10
      },
      textAnchor: 'middle',
      labelInterpolationFnc: Chartist.noop
    };

    Chartist.plugins = Chartist.plugins || {};
    Chartist.plugins.ctPointLabels = function(options) {

      options = Chartist.extend({}, defaultOptions, options);
			
			return function ctPointLabels(chart) {
        if(chart instanceof Chartist.Line) {
          chart.on('draw', function(data) {
            if(data.type === 'point') {
              data.group.elem('text', {
                x: data.x + options.labelOffset.x,
                y: data.y + options.labelOffset.y,
                style: 'text-anchor: ' + options.textAnchor
              }, options.labelClass).text(options.labelInterpolationFnc(data.value.x === undefined ? k_formatter(data.value.y) : k_formatter(data.value.x) + ', ' + k_formatter(data.value.y)));
            }
          });
        }
      };	      		
    };

  }(window, document, Chartist));
  return Chartist.plugins.ctPointLabels;

}));
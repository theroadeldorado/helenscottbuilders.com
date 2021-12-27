/**
 * @type public
 * @name convertSourceToSVG
 * @description
 *
 * Converts a source into an inline SVG
 *
 * @param {Object} target
 * @param {String} url
 * @param {String} color
 * @param {String} classes
 * @param {String} id
 * @return {Void}
 *
 **/
export function convertSourceToSVG(target, url, color, classes) {
  const fileExtension = url.split('.').pop();

  if (fileExtension !== 'svg') return;

  $.get(url, (data) => {
    let $svg = $(data).find('svg');

    // re-appends classes
    if (classes) {
      $svg.attr('class', classes);
    }

    // manually sets viewBox so SVG can be scaled
    if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
      $svg.attr('viewBox', `0 0 ${$svg.attr('height')} ${$svg.attr('width')}`);
    }

    if (color) {
      const svgPathes = $svg.find('g, path');

      svgPathes.each((index, path) => {
        const fill = $(path).attr('fill');
        const stroke = $(path).attr('stroke');

        if (fill !== undefined && fill.indexOf('#') > -1) {
          $(path).attr('fill', color);
        }

        if (stroke !== undefined && stroke.indexOf('#') > -1) {
          $(path).attr('stroke', color);
        }
      });
    }

    target.replaceWith($svg);
  });
}

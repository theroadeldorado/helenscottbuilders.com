/**
 * @type public
 * @name iOSFixDoubleTap
 * @description
 *
 * Fixes double tap issue on iOS devices
 *
 * @param {Array} array
 * @return {Array}
 *
 **/
export function iOSFixDoubleTap() {
  $('button, a').on('touchstart', (event) => {
    const $target = $(event.currentTarget);
    $target.is(':focus') ? $target.blur() : $target.focus();
  });
}

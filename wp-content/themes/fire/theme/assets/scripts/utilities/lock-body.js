/**
 * @type public
 * @name lockBody
 * @requires jQuery
 * @description
 *
 * Locks/unlocks body element where it currently is
 * Allows you to manually pass value or uses scrollTop.
 * Uses animate with step function to handle refresh issues.
 *
 * @param {Boolean} lock
 * @return {Void}
 *
 **/
export function lockBody(lock) {
  const $body = $('body');

  if (lock === true) {
    $body.css({ overflow: 'hidden' });
  } else if (lock === false) {
    $body.removeAttr('style');
  }

  $body.attr('data-fire-lock-body', lock);
}

/**
 * @type public
 * @name lockBodyToggle
 * @requires jQuery
 * @description
 *
 * Toggles the body lock
 *
 * @return {Void}
 *
 **/
export function lockBodyToggle() {
  const status = $('body').attr('data-fire-lock-body');

  if (status === undefined || status === 'false') {
    lockBody(true);
  } else {
    lockBody(false);
  }
}

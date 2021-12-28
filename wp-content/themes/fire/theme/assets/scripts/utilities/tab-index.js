/**
 * @type public
 * @name unsetTabIndex
 * @requires jQuery
 * @description
 *
 * Remove tabindex from element
 *
 * @param {Element}
 * @return {Void}
 *
 **/
export function unsetTabIndex(element) {
  $(element).attr('tabindex', '');
}

/**
 * @type public
 * @name setTabIndex
 * @requires jQuery
 * @description
 *
 * Set tabindex on element
 *
 * @param {Element}
 * @param {Number}
 * @return {Void}
 *
 **/
export function setTabIndex(element, index) {
  $(element).attr('tabindex', index);
}

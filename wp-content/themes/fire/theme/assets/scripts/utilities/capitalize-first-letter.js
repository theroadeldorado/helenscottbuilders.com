/**
 * @type public
 * @name capitalizeFirstLetter
 * @description
 *
 * Captilizes the first letter of a string
 *
 * @param {Boolean}
 * @return {Void}
 *
 **/
export function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

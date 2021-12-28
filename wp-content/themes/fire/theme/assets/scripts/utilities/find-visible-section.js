/**
 * @type public
 * @name findVisibleSection
 * @description
 *
 * @param {Element} element
 * @return {Element}
 *
 **/
export function findVisibleSection(element) {
  return element.is(':hidden') || element.hasClass('gap') ? findVisibleSection(element.next()) : element;
}

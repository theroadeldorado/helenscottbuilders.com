import $ from 'jquery';

/**
 * @type public
 * @name ignoreContext
 * @description
 *
 * Ignores context and stops Drupal behavior triggers
 *
 * @param {Element} context
 * @param {Array} elementsToIgnore
 * @return {Boolean}
 *
 **/
export function ignoreContext(context, elementsToIgnore) {
  let ignore = false;

  elementsToIgnore.forEach((element) => {
    if ($(context).is(element)) {
      ignore = true;
      return false;
    }
  });

  return ignore;
}

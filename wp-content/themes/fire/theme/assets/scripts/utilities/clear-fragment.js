/**
 * @type public
 * @name clearFragment
 * @description
 *
 * Removes everything after and including # from URL
 *
 * @return {Void}
 *
 **/
export function clearFragment() {
  history.pushState('', document.title, window.location.pathname + window.location.search);
}

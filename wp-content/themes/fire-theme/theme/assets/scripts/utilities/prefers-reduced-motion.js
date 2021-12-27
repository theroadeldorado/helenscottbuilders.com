/**
 * @type public
 * @name prefersReducedMotion
 * @description
 *
 * Checks if the user has reduced motion enabled
 *
 * @return {Boolean}
 *
 **/
export function prefersReducedMotion() {
  const QUERY = '(prefers-reduced-motion: no-preference)';
  const mediaQueryList = window.matchMedia(QUERY);
  const prefersReducedMotion = !mediaQueryList.matches;

  return prefersReducedMotion;
}
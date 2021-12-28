import $ from 'jquery';

/**
 * @type public
 * @name screenSizes
 * @description
 *
 * Defines screen sizes
 *
 **/
export const breakpoints = {
  xs: 576,
  sm: 768,
  md: 992,
  lg: 1200,
};

/**
 * @type public
 * @name isDesktop
 * @description
 *
 * Check for desktop breakpoint
 *
 * @return {Boolean}
 *
 **/
export function isDesktop() {
  return window.matchMedia(`(min-width: ${breakpoints.md + 1}px)`).matches;
}

/**
 * @type public
 * @name isTablet
 * @description
 *
 * Check for tablet breakpoint
 *
 * @return {Boolean}
 *
 **/
export function isTablet() {
  return window.matchMedia(`(min-width: ${breakpoints.sm + 1}px)`).matches && window.matchMedia(`(max-width: ${breakpoints.md}px)`).matches;
}

/**
 * @type public
 * @name isMobile
 * @description
 *
 * Check for mobile breakpoint
 *
 * @return {Boolean}
 *
 **/
export function isMobile() {
  return window.matchMedia(`(max-width: ${breakpoints.sm - 1}px)`).matches;
}

/**
 * @type public
 * @name windowMatchesMaxWidthQuery
 * @description
 *
 * Check for specific media query
 *
 * @param {String}
 * @return {Boolean}
 *
 **/
export function windowMatchesMaxWidthQuery(mediaQuery) {
  return window.matchMedia(mediaQuery).matches;
}

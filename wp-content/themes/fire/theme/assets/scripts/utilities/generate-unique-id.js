import { shuffle } from './shuffle';

/**
 * @type public
 * @name generateUniqueId
 * @description
 *
 * Generates a unique string
 *
 * @param {Array} array
 * @return {Array}
 *
 **/
export function generateUniqueId() {
  return shuffle(btoa(Math.random()).toLowerCase().replace(/=/, '').split('')).join('');
}

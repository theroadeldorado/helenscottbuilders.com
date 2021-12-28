/**
 * @type public
 * @name addScript
 * @description
 *
 * Dynamically adds script tag to page
 *
 * @param {Object} attribute
 * @param {String} text
 * @param {Function} callback
 * @return {Void}
 *
 **/
export function addScript(attribute, text, callback) {
  const script = document.createElement('script');
  for (const attr in attribute) {
    script.setAttribute(attr, attribute[attr] ? attribute[attr] : null);
  }
  script.innerHTML = text;
  script.onload = callback;
  document.body.appendChild(script);
}

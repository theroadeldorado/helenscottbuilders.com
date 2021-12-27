import $ from 'jquery';
import throttle from 'lodash/throttle';

/**
 * @type class
 * @name FireDetect
 * @description
 *
 * Useful methods used to detect browser, platform, etc
 *
 **/
export class FireDetect {
  constructor() {
    this.browser = this.detectBrowser();
    this.platform = this.detectPlatform();
    this.touch = this.detectTouch();
  }

  detectBrowser() {
    const browserList = {
      safari: /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor),
      chrome: /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor),
      firefox: navigator.userAgent.toLowerCase().indexOf('firefox') > -1,
      edge: /Edge/.test(navigator.userAgent),
      ie11: /Trident/.test(navigator.userAgent) || /MSIE/.test(navigator.userAgent),
    };
    // return detected browser
    for (let browser in browserList) {
      if (browserList[browser] === true) return browser;
    }
  }

  detectPlatform() {
    const platform = navigator.platform;
    const formattedPlatform = platform.replace(' ', '-'); // replace space with dash if present
    return formattedPlatform;
  }

  detectTouch() {
    return 'ontouchstart' in window || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
  }

  setHtmlClasses() {
    const html = document.documentElement;
    html.classList.add(`is-${this.browser}`, `is-${this.platform}`);
    if (this.touch === true) {
      html.classList.add('has-touch-support');
    }
  }

  detectTrueViewHeight() {
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);

    $(window).on(
      'resize',
      throttle(() => {
        vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
      }, 1000)
    );
  }
}

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import balanceText from 'balance-text';

const callback = function () {
  window.Alpine = Alpine;
  Alpine.plugin(focus);
  Alpine.start();
  balanceText();
};

if (document.readyState === 'complete' || (document.readyState !== 'loading' && !document.documentElement.doScroll)) {
  callback();
} else {
  document.addEventListener('DOMContentLoaded', callback);
}

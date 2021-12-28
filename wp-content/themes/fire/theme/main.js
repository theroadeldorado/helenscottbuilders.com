import $ from 'jquery';
import '@component/polyfills';
import Alpine from 'alpinejs';
import balanceText from 'balance-text';
import { FireDetect, FireComponentRecord } from '@component';
import { moveBootstrapModalsToBody, iOSFixDoubleTap } from '@utility';

const detect = new FireDetect();
const componentRecord = new FireComponentRecord();

/**
 * @type function
 * @name onPageReady
 * @description
 *
 * Initialize scripts when page is ready
 *
 **/
const onPageReady = () => {
  detect.setHtmlClasses();
  detect.detectTrueViewHeight();
  window.Alpine = Alpine;
  Alpine.start();

  window.componentRecord.registerAllComponents();
  moveBootstrapModalsToBody();

  if (detect.touch && (detect.platform === 'iPhone' || detect.platform === 'iPad')) {
    iOSFixDoubleTap();
  }

  balanceText();

  // display page
  $('body').removeClass('opacity-0');
};

// fire all scripts
$(onPageReady);

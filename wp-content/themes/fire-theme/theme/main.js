import './theme.css'

// import '@component/polyfills';
import Alpine from 'alpinejs';
import balanceText from 'balance-text';
import { FireComponentRecord } from '@component';

// const detect = new FireDetect();
const componentRecord = new FireComponentRecord();

// detect.setHtmlClasses();
// detect.detectTrueViewHeight();
window.Alpine = Alpine;
Alpine.start();

window.componentRecord.registerAllComponents();

balanceText();

import $ from 'jquery';
import lozad from 'lozad';

const defaultConfig = {
  rootMargin: '0% 0% 150%',
  loaded(element) {
    if ($(element).attr('data-background-image')) {
      $('<img/>')
        .attr('src', $(element).attr('data-background-image'))
        .on('load', function() {
          $(this).remove();
          $(element).addClass('lozad--loaded');
        });
    } else {
      $(element).on('load', () => {
        $(element).addClass('lozad--loaded');
      });
    }
  },
};

export class FireLazyLoader {
  constructor(config) {
    this.observer = null;
    this.config = config ? config : defaultConfig;
  }

  init() {
    this.observer = lozad('.lozad', this.config);
  }
}

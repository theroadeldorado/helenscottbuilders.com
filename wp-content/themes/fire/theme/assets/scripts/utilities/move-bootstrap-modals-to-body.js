import $ from 'jquery';

/**
 * @type public
 * @name moveBootstrapModalsToBody
 * @description
 *
 * Moves modal to body on open.
 *
 * @return {Void}
 *
 **/
export function moveBootstrapModalsToBody() {
  $('.modal-dialog')
    .parent()
    .on('show.bs.modal', (e) => {
      $(e.relatedTarget.attributes['data-target'].value).appendTo('body');
    });
}

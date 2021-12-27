import $ from 'jquery';
import { generateUniqueId } from '@utility';

/**
 * @type class
 * @name FireComponentRecord
 * @description
 *
 * Component record class
 *
 **/
export class FireComponentRecord {
  // register correct component
  _registerComponent(component, name, id, afterBehaviorHit) {
    // mark as registered
    $(component).attr('data-registered', id);

    // init correct component class
    switch (name) {
      case 'site-header':
        new SiteHeader(id).init();
        break;
      default:
        break;
    }
  }

  registerAllComponents(afterBehaviorHit) {
    // loop through all components on the page
    $('[data-fire-component]').each((index, component) => {
      // get name of component
      let names = $(component).data('fire-component');
      names = names.split(', ');

      // generate a unique ID
      const id = generateUniqueId();

      for (const name of names) {
        this._registerComponent(component, name, id);
      }
    });
  }
}

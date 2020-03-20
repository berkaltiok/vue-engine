'use strict';
Vue.component('Contact', new Promise(function (resolve) {
  resolve({
    template: VUE.ENGINE,
    metaInfo() {
      return {
        "title": "Contact"
      }
    }
  });
}));
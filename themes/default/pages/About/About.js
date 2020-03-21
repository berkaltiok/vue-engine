'use strict';
Vue.component('About', new Promise(function (resolve) {
  resolve({
    template: VUE.ENGINE,
    metaInfo() {
      return {
        "title": "About"
      }
    }
  });
}));
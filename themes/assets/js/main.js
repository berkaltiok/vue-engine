Vue.use(VueMeta);
let app = new Vue({
  el: '#app',
  router,
  store,
  metaInfo() {
    return {
      "title": "Home",
      "titleTemplate": "%s - Vue Engine",
      "meta": [
        {"charset": "utf-8"},
        {"name": "viewport", "content": "width=device-width, initial-scale=1"},
        {"name": "description", "content": "Vue Engine Description"}
      ],
      "style": [],
      "script": []
    }
  }
});
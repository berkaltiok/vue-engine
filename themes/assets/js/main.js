Vue.use(VueMeta);

let app = new Vue({
  el: '#app',
  router: router,
  metaInfo() {
    return {
      "title": "Home",
      "titleTemplate": "%s - Title2",
      "meta": [
        {"charset": "utf-8"},
        {"name": "viewport", "content": "width=device-width, initial-scale=1"},
        {"name": "description", "content": "Pird Tech Web Site"}
      ],
      "style": [],
      "script": []
    }
  }
})
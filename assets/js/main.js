Vue.use(VueMeta);

let app = new Vue({
  el: '#app',
  router: router,
  metaInfo() {
    return {
      "title": "pirdweb",
      "titleTemplate": "%s - Pird",
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
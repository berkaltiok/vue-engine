const router = new VueRouter({
  mode: 'history',
  base: '/vue-engine/',
  routes: [
    {
      path: '/',
      component: function (resolve, reject) {
        loadComponent('Home', '/pages/Home').then(resolve, reject);
      }
    },
    {
      path: '/about',
      name: "About",
      component: function (resolve, reject) {
        loadComponent('About', '/pages/About').then(resolve, reject);
      }
    },
    { path: '/contact', component: {
        template: "<div>Contact Page</div>"
      } }
  ]
});
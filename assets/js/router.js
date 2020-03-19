let Home = {
  template: "<div>Home Page</div>"
};
let About = {
  template: "<div>About Page</div>"
};
let Contact = {
  template: "<div>Contact Page</div>"
};

const router = new VueRouter({
  mode: 'history',
  base: '/vue-engine/',
  routes: [
    { path: '/', component: Home },
    {
      path: '/about',
      name: "About",
      component: function (resolve, reject) {
        loadComponent('About', '/pages/About').then(resolve, reject);
      }
    },
    { path: '/contact', component: Contact }
  ]
});
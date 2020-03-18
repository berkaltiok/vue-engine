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
    { path: '/about', component: About },
    { path: '/contact', component: Contact }
  ]
});
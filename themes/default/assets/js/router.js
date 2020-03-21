const router = new VueRouter({
  mode: 'history',
  base: VUE_DIRECTION+'/',
  routes: [
    {
      path: '/',
      component: (resolve, reject) => loadComponent('Home', '/pages/Home').then(resolve, reject)
    },
    {
      path: '/about',
      component: (resolve, reject) => loadComponent('About', '/pages/About').then(resolve, reject)
    },
    {
      path: '/contact',
      component: (resolve, reject) => loadComponent('Contact', '/pages/Contact').then(resolve, reject)
    }
  ]
});
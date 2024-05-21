import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'


const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'home',
    component: ()=> import('../views/HomePage.vue')
  },  
  {
    path: '/homePage',
    name: 'homePage',
    component: ()=> import('../views/HomePage.vue')
  },
  {
    path: '/detailsPage/:newsId',
    name: 'detailsPage',
    component: ()=>import('../views/DetailsPage.vue')
  },
  {
    path: '/loginPage',
    name: 'loginPage',
    component: ()=>import('../views/LoginPage.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router

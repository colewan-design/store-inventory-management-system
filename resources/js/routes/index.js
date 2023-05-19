import Main from '../Pages/Main.vue'
import Login from '../Pages/Login.vue'
import Superadmin_Dashboard from '../pages/Dashboard.vue'
import SuperAdmin_Profile from '../Pages/Superadmin/Superadmin_Dashboard.vue'
//Navigation
import SuperadminNavigation from '../Pages/Navigation/SuperadminNavigation.vue'


export default {
  mode: 'history',
    routes: [
        {
            path: '/',
            component: Login
        },
        {
            path: '/main',
            name: 'main',
            component: Main,
            meta: { requiresAuth: true }
        },
  
        {
            path: '/login',
            name: 'login',
            component: Login
        },
       
        {
            path: '/Superadmin_Dashboard',
            name: 'Superadmin_Dashboard',
            component: Superadmin_Dashboard,    
            meta: { requiresAuth: true }
        },
      
        {
          path: '/superadmin_profile',
          name: 'superadmin_profile',
          component: SuperAdmin_Profile,
          meta: { requiresAuth: true }
      },
      
       
    ],
    beforeEach: (to, from, next) => {
      if (to.meta.requiresAuth) {
        requireAuth(to, from, next)
      } else if (to.meta.guest) {
        if (localStorage.getItem('token')) {
          next('/dashboard')
        } else {
          next()
        }
      } else {
        next()
      }
    }
}

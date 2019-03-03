import Vue from 'vue'
import Router from 'vue-router'
import Login from './Login.vue'
import HelloWorld from './components/HelloWorld.vue'
import auth from '@/helpers/auth'

// @ - это путь от папки src
// загружается ниже динамически
import Users from '@/components/users/Users.vue'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HelloWorld,
            meta: {
                requireAuth: true
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/users',
            name: 'users',
            // lazy load
            component: () => import('./components/users/Users.vue'),
            meta: {
                requireAuth: true
            }
        }
    ]
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requireAuth)) {
        if (!auth.isAuthorized()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        //всегда так или иначе нужно вызвать next()
        next()
    }
})


export default router
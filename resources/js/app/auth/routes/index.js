import { Login, Register } from '../components'

export default [
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: {
            guest: true,
            needsAuth: false
        }
    },
    {
        name: 'register',
        path: '/register',
        component: Register,
        meta: {
            guest: true,
            needsAuth: false
        }
    }
]

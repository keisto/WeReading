import { Home } from '../components'

export default [
    {
        name: 'home',
        path: '/',
        component: Home,
        meta: {
            guest: true,
            needsAuth: false
        }
    }
]

import {Books, Details, ReadingList} from '../components'

export default [
    {
        name: 'books',
        path: '/books',
        component: Books,
        meta: {
            needsAuth: false
        }
    },
    {
        name: 'book',
        path: '/books/:id',
        component: Details,
        meta: {
            needsAuth: true
        }
    },
    {
        name: 'reading',
        path: '/reading',
        component: ReadingList,
        meta: {
            needsAuth: true
        }
    }
]

import auth from './auth/routes'
import home from './home/routes'
import books from './books/routes'
import errors from './errors/routes'

export default [...home, ...auth, ...books, ...errors]

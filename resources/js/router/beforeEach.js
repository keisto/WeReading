import store from '../vuex'
import localforage from "localforage";

const beforeEach = ((to, from, next) => {
  store.dispatch('auth/checkTokenExists').then(() => {
      if (to.meta.guest) {
          next({ name: 'reading'})
          return
      }

      next()
  }).catch(() => {
      if (to.meta.needsAuth) {
          // When trying to access an auth required page
          // redirect the user back to it after login using intended
          localforage.setItem('intended', to.name)
          next({ name: 'login'})
          return
      }

      next()
  })
})

export default beforeEach

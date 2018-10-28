import Vue from 'vue'
import Vuex from 'vuex'

import projects from './modules/projects'
import auth from './modules/auth'
import users from './modules/users'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    projects,
    auth,
    users,
  },
  strict: debug,
})
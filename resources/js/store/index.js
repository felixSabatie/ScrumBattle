import Vue from 'vue'
import Vuex from 'vuex'

import projects from './modules/projects'
import auth from './modules/auth'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    projects,
    auth,
  },
  strict: debug,
})
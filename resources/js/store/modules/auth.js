
const state = {
    token: '',
    user: {}
  }
  
  // getters
  const getters = {
    
  }
  
  // actions
  const actions = {}
  
  // mutations
  const mutations = {
    setToken(state, token) {
      state.token = token;
    },
    setUser(state, user) {
      state.user = user;
    }
  }
  
  export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
  }
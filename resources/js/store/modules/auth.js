
const state = {
    token: {}
  }
  
  // getters
  const getters = {
    
  }
  
  // actions
  const actions = {}
  
  // mutations
  const mutations = {
    setToken(state, token) {
      state.token = token
    }
  }
  
  export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
  }
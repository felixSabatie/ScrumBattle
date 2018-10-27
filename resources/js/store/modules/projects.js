
const state = {
    project: {}
  }
  
  // getters
  const getters = {
    
  }
  
  // actions
  const actions = {}
  
  // mutations
  const mutations = {
    setProject(state, project) {
      state.project = project
    }
  }
  
  export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
  }
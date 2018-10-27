
const state = {
    currentProject: {}
  }
  
  // getters
  const getters = {
    
  }
  
  // actions
  const actions = {}
  
  // mutations
  const mutations = {
    setProject(state, project) {
      state.currentProject = project
    }
  }
  
  export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
  }
//todo extract card logic to cards.js store

const state = {
    currentProject: {}
};

// getters
const getters = {
  cards(state) {
    let cards = [];
    if(state.currentProject.columns) {
      cards = state.currentProject.columns.flatMap(column => {
        return column.cards;
      }) 
    }

    return cards;
  },
    mob(state) {
        return state.currentProject.mob;
    }
};

// actions
const actions = {};

// mutations
const mutations = {
    setProject(state, project) {
        state.currentProject = project;
        state.currentProject.users.forEach(user => {
          user.done_points = user.pivot.done_points;
          user.total_points = user.pivot.total_points;
        })
    },

    addRemove(state, payload) {
      state.currentProject.total_points += (payload.new - payload.old);

      if(payload.column == 3) {
        state.currentProject.done_points += (payload.new - payload.old);
      }
    },
   
    removeFromTotal(state, amount) {
        state.currentProject.total_points -= amount;
    },

    removeFromDone(state, amount) {
        state.currentProject.done_points -= amount;
    },

    removeFromBoth(state, amount) {
      state.currentProject.total_points -= amount
      state.currentProject.done_points -= amount
    },

    addToTotal(state, amount) {
      state.currentProject.total_points += amount;
    },

    addToDone(state, amount) {
      state.currentProject.done_points += amount;
    },

    addToBoth(state, amount) {
      state.currentProject.done_points += amount;
      state.currentProject.total_points += amount;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};

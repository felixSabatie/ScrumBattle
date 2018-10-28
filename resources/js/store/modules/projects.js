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
  }
};

// actions
const actions = {};

// mutations
const mutations = {
    setProject(state, project) {
        state.currentProject = project;

        //todo tmp until backend is plugged
        project.donePoints = 0;
        project.totalPoints = 0; 
        project.users = project.users.map(user => {
          user.totalPoints = 5;
          user.donePoints = 0;
          return user;
        });
    },

    addRemove(state, payload) {
      state.currentProject.totalPoints += (payload.new - payload.old);

      if(payload.column == 3) {
        state.currentProject.donePoints += (payload.new - payload.old);
      }
    },
   
    removeFromTotal(state, amount) {
        state.currentProject.totalPoints -= amount;
    },

    removeFromDone(state, amount) {
        state.currentProject.donePoints -= amount;
    },

    removeFromBoth(state, amount) {
      state.currentProject.totalPoints -= amount
      state.currentProject.donePoints -= amount
    },

    addToTotal(state, amount) {
      state.currentProject.totalPoints += amount;
    },

    addToDone(state, amount) {
      state.currentProject.donePoints += amount;
    },

    addToBoth(state, amount) {
      state.currentProject.donePoints += amount;
      state.currentProject.totalPoints += amount;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};

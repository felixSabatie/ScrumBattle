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
        project.donePoints = 0;
        project.totalPoints = 0;
    },
    newCard(state, card) {
      
      state.currentProject.columns.filter(column => column.id == card.column_id)
      .forEach(column => {
        column.cards.push(JSON.parse(JSON.stringify(card)));
      })
    },
    newCardPoints(state, card) {
      let sum = 0;
      state.currentProject.columns.flatMap(col => col.cards)
      .forEach(crd => {
        if(crd.id === card.id) {
          crd.points = card.points;
         
        }

        sum += crd.points;
      })

     state.currentProject.totalPoints = sum;
    },

    addUserToCard(state, payload) {
      state.currentProject.columns.flatMap(col => col.cards)
      .forEach(card => {
        if(card.id === payload.card.id) {
          console.log('adding user');
          card.users.push(payload.user);
        }
      })
    },
    removeCard(state, card) {
      
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

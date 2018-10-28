const state = {
    cards: []
  }
  
  // getters
  const getters = {
    
  }
  
  // actions
  const actions = {}
  
  // mutations
  const mutations = {
    setCards(state,cards ){
      state.cards = cards;
    },
    addCard(state, card) {
      state.cards.push(card);
    },
    removeCard(state, card) {
      state.cards = state.cards.filter(crd => crd.id !== card.id);
    },
    addUserToCard(state, payload) {
      state.cards.forEach(card => {
        if(card.id === payload.card.id) {
          card.users.push(payload.user);
        }
      })
      
    }, 
    removeUsertoCard(state, payload) {
      state.cards.forEach(card => {
        if(card.id === payload.card.id) {
          card.users = card.users.filter(user => user.id === payload.user.id);
        }
      })
    },
    setPoints(state, payload) {
      state.cards.forEach(card => {
        if(card.id === payload.card.id) {
          card.points = payload.points;
        }
      })
    },
    changeColumn(state, payload) {
      state.cards.forEach(card => {
        if(card.id === payload.card.id) {
          card.column_id = payload.to;
        }
      })
    }
  }
  
  export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
  }
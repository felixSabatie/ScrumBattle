const state = {
    users: []
};

// getters
const getters = {
    getUsers: (state) => {
       return state.users
    }
};

// actions
const actions = {};

// mutations
const mutations = {
    setUsers(state, users) {
        state.users = users;
    },

    removeFromTotal(state, payload) {
        const user = payload.user;
        const amount = payload.amount;
        
        state.users = state.users.map(usr => {
            if (usr.id == user.id) {
                usr.total_points -= amount;
            }
            return usr; 
        });
    },

    removeFromDone(state, payload) {
        const user = payload.user;
        const amount = payload.amount;
        state.users = state.users.map(usr => {
            if (usr.id == user.id) {
                usr.done_points -= amount;
            }
            return usr;
        });
    },

    removeFromBoth(state, payload) {
        const user = payload.user;
        const amount = payload.amount;
        state.users = state.users.map(usr => {
            if (usr.id == user.id) {
                usr.done_points -= amount;
                usr.total_points -= amount;
            }

            return usr;
        });
    },

    addToTotal(state, payload) {
        const user = payload.user;
        const amount = payload.amount;
        state.users = state.users.map(usr => {
            if (usr.id == user.id) {
                usr.total_points += amount;
            }
            return usr;
        });
    },
    addToDone(state, payload) {
        const user = payload.user;
        const amount = payload.amount;
        state.users = state.users.map(usr => {
            if(usr.id == user.id) {
                usr.done_points += amount;
            }

            return usr;
        })
    },
    addToBoth(state, payload) {
        const user = payload.user;
        const amount = payload.amount;
        state.users = state.users.map(usr => {
            if (usr.id == user.id) {
                usr.done_points += amount;
                usr.total_points += amount;
            }
            return usr;
        }); 
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};

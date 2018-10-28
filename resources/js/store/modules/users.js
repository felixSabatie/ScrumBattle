const state = {
    users: []
};

// getters
const getters = {};

// actions
const actions = {};

// mutations
const mutations = {
    setUsers(state, users) {
        state.users = users;

        //todo temp
        state.users.forEach(user => {
            user.totalPoints = 0;
            user.donePoints = 0;
        })
    },

    removeFromTotal(state, payload) {
        const user = payload.user;
        const amount = payload.amount;

        state.users.forEach(usr => {
            if (usr.id == user.id) {
                usr.totalPoints -= amount;
            }
        });
    },

    removeFromDone(state, payload) {
        const user = payload.user;
        const amount = payload.amount;
        state.users.forEach(usr => {
            if (usr.id == user.id) {
                usr.donePoints -= amount;
            }
        });
    },

    removeFromBoth(state, payload) {
        const user = payload.user;
        const amount = payload.amount;
        state.users.forEach(usr => {
            if (usr.id == user.id) {
                usr.donePoints -= amount;
                usr.totalPoints -= amount;
            }
        });
    },

    addToTotal(state, payload) {
        const user = payload.user;
        const amount = payload.amount;
        state.users.forEach(usr => {
            if (usr.id == user.id) {
                usr.totalPoints += amount;
            }
        });
    },
    addToDone(state, payload) {
        const user = payload.user;
        const amount = payload.amount;
        state.users.map(usr => {
            if (usr.id == user.id) {
                usr.donePoints += amount;
            }
        });
    },
    addToBoth(state, paylaod) {
        const user = payload.user;
        const amount = payload.amount;
        state.users.forEach(usr => {
            if (usr.id == user.id) {
                usr.donePoints += amount;
                usr.totalPoints += amount;
            }
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

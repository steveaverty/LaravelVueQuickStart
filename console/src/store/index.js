import { createStore } from 'vuex'
import user from './modules/user'
import createPersistedState from "vuex-persistedstate";

const store = createStore({
    modules: {
        user: user,
    },
    plugins: [createPersistedState()]
})

export default store;

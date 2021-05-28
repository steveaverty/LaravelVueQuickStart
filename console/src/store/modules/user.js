import config from 'src/config'
import axios from "axios";
import router from "@/router";

const state = () => ({
    id: null,
    email: null,
    name: null,
    token: null
})

// getters
const getters = {
}

// actions
const actions = {
    authenticate({commit, dispatch}, payload){
         axios
            .post(config.API_URL + '/auth/login', payload )
            .then(response => {
                if(response.status === 200){
                    commit('setToken', response.data.token)
                    dispatch('getAuthenticatedUser', payload.redirect)
                }
            });
    },
    getAuthenticatedUser({commit, state}, redirect){
        axios
            .get(config.API_URL + '/users/me',  {
                headers: {
                    'Authorization': 'Bearer ' + state.token
                }
            } )
            .then(response => {
                if(response.status === 200){
                    commit('setUser', response.data)
                    redirect = (redirect === null) ? '/admin/dashboard' : redirect
                    router.push({'path': redirect})
                }
            });
    },
    register({commit, dispatch}, payload){
        axios
            .post(config.API_URL + '/auth/register', payload )
            .then(response => {
                if(response.status === 201){
                    commit('setToken', response.data.token)
                    dispatch('getAuthenticatedUser', payload.redirect)
                }
            });
    }

}

// mutations
const mutations = {
    setToken(state, token) {
        state.token = token
    },
    setUser(state, payload){
        state.id = payload.id
        state.email = payload.email
        state.name = payload.name
    },
    resetManager(state){
        state.id = null
        state.email = null
        state.name = null
        state.token = null
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}

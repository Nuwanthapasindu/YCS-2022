import axios from 'axios'
import router from '@/router';
export default {
    namespaced: true,
    state: {
        user: null,
        token: null,
    },
    getters: {
        GET_USER(state) {
            return state.user;
        },
        GET_TOKEN(state) {
            return state.token;
        },
    },
    mutations: {
        SET_TOKEN(state, token) {
            state.token = token
        },
        SET_AUTH_USER(state, user) {
            state.user = user
        },

    },
    actions: {
        signIn({ dispatch }, data) {
            axios.post('/auth/login', data).then(response => {
                dispatch('attempt', response.data.token);
            }).catch(e => {
                alert(e.response.data.message);
            });


        },
        async attempt({ commit }, token) {
            if (token) {
                commit('SET_TOKEN', token)
                try {

                    const response = await axios.get('/auth/me', token);
                    commit('SET_AUTH_USER', response.data.user);
                    localStorage.setItem('role', response.data.user.role)
                    localStorage.setItem('completed', response.data.user.completed)





                } catch (error) {
                    commit('SET_TOKEN', null)
                    commit('SET_AUTH_USER', null);
                    localStorage.removeItem('token');
                    router.push('/');
                }


            } else {
                router.push('/');
                return;
            }

        },

    },
}
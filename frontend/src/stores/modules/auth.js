const authModule = {
  namespaced: true,
  state: {
    user: ["zhiwar"],
    token: null,
  },
  mutations: {
    setUser(state, payload) {
      state.user = payload;
    },
    setToken(state, payload) {
      state.token = payload;
    },
  },
  actions: {
    setUser(context, payload) {
      context.commit("setUser", payload);
    },
    setToken(context, payload) {
      context.commit("setToken", payload);
    },
  },
};
export default authModule;

export default {
  SET_LOGIN_STATUS(state, status) {
      state.isLoggedIn = status;
  },
  SET_ADMIN_STATUS(state, status) {
      state.isAdmin = status;
  },
};
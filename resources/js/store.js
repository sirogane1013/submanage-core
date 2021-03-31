export default {
    state: {
        isLoggedIn: false,
    },
    login() {
        this.state.isLoggedIn = true;
    },
    logout() {
        this.state.isLoggedIn = false;
    },
}
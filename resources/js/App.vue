<template>
    <div id="app">
        <navbar 
            v-if='! (isLoginPage || isRegisterPage)'
        />
        <router-view />
    </div>
</template>
<style>
    html, body, #app {
        height: 100%;
    }
</style>
<script>
import Navbar from './components/modules/TheNavbar'

export default ({
    name: "App",
    components: {
        Navbar,
    },
    computed: {
        isLoginPage: function () {
            return this.$route.path === "/login";
        },
        isRegisterPage: function () {
            return this.$route.path === "/register";
        },
    },
})
</script>

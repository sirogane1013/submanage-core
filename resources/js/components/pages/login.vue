<template>
    <div class="wrapper">
        <b-card
            title="Login"
            bg-variant="light"
            class="text-center login"
        >
            <form @submit.prevent="login" class="login__form">
                <b-form-input v-model="email" placeholder="Email Address" />
                <b-form-input v-model="password" type="password" placeholder="Password" />
                <b-button type="submit" variant="primary">Login</b-button>
            </form>
            <p>または<router-link to="/register">アカウントを作成</router-link></p>
        </b-card>
    </div>
</template>
<style scoped>
    .wrapper {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .login {
        width: 100%;
        max-width: 330px;
        margin: 0 auto;
    }

    .login__form {
        margin: 0 auto;
    }
</style>
<script>
import store from '../../store'

export default {
    name: 'login',
    data() {
        return {
            email: "",
            password: "",
            errors: []
        };
    },
    methods: {
        login() {
            axios.get("/sanctum/csrf-cookie").then(response => {
                axios
                    .post("/api/user/login", {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        store.login();
                        this.$router.push("/mypage");
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            });
        }
    }
};
</script>

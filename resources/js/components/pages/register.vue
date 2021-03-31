<template>
    <div class="wrapper">
        <b-card
            title="Register"
            bg-variant="light"
            class="text-center register"
        >
            <form @submit.prevent="register" class="register__form">
                <b-form-input v-model="email" placeholder="Email Address" />
                <b-form-input v-model="password" type="password" placeholder="Password" />
                <b-button type="submit" variant="primary">Register</b-button>
            </form>
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

    .register {
        width: 100%;
        max-width: 330px;
        margin: 0 auto;
    }

    .register__form {
        margin: 0 auto;
    }
</style>
<script>
export default {
    name: 'register',
    data() {
        return {
            email: "",
            password: "",
            errors: []
        };
    },
    methods: {
        register() {
            axios.get("/sanctum/csrf-cookie").then(response => {
                axios
                    .post("/api/user/register", {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        this.$router.push("/login");
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    }
                );
            });
        }
    }
};
</script>

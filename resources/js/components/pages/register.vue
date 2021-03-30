<template>
    <div>
        <form @submit.prevent="register">
            <div>
                <label>Email</label>
                <input type="text" v-model="email" />
                <span v-if="errors.email">
                    {{ errors.email[0] }}
                </span>
            </div>
 
            <div>
                <label>Password</label>
                <input type="password" v-model="password" />
                <span v-if="errors.password">
                    {{ errors.password[0] }}
                </span>
            </div>
 
            <button>Register</button>
        </form>
    </div>
</template>
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

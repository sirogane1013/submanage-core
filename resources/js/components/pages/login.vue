<template>
    <div>
        <form @submit.prevent="login">
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
 
            <button>Login</button>
        </form>
    </div>
</template>
<script>
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
                        console.log(response);
                        localStorage.setItem("auth", "ture");
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

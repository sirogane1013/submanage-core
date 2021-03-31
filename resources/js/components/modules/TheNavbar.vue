<template>
    <div id="navbar" class="mb-3">
        <b-navbar toggleable="lg" type="light" variant="light">
            <b-navbar-brand to="/mypage">SubManage</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav>
                <b-nav-item to="/mypage">マイページ</b-nav-item>
                <b-nav-item to="/service">サービス一覧</b-nav-item>
                <b-nav-item to="/information">インフォメーション</b-nav-item>
            </b-navbar-nav>
            <b-button variant="danger" class="float-right" @click="logout">Logout</b-button>
            </b-collapse>
        </b-navbar>
    </div>
</template>
<script>

export default ({
    name: "TheNavbar",
    methods: {
        logout() {
            axios
                .get('/api/user/logout')
                .then(response => {
                    console.log(response);
                    this.$router.push("/login");
                })
        },
    },
})
</script>

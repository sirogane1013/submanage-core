<template>
    <div id="app">
        <navbar />
        <router-view />
    </div>
</template>
<script>
import Navbar from './components/modules/TheNavbar'

export default ({
    name: "App",
    components: {
        Navbar,
    },
    setup() {
        
    },
})
</script>

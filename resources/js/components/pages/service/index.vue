<template>
    <div>
        <ul>
        <li v-for="service in services" :key="service.id">
            <p>{{ service.name }}</p>
            <p>{{ service.price }}</p>
        </li>
    </ul>
    <router-link to="/service/add">add service</router-link>
    </div>
</template>
<script>

export default({
    name: 'service',
    data() {
        return {
            services: [],
        }
    },
    created() {
        axios
        .get('/api/service/list')
        .then(response => {
            this.services = response.data.services;
        })
    },
})
</script>

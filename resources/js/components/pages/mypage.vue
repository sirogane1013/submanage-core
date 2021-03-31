<template>
    <b-container class="wrapper">
        <b-card title="マイページ">
            <p>{{ total_amount }}</p>
            <p v-for="breakdown in breakdowns" :key="breakdown.category_id">
                {{breakdown.category_id}}
                {{breakdown.sum}}
            </p>
        </b-card>
    </b-container>
</template>
<script>

export default({
    name: 'mypage',
    data() {
        return {
            'total_amount': 0,
            'breakdowns': [],
        }
    },
    created() {
        axios
            .get('/api/service/aggregation')
            .then(response => {
                this.total_amount = response.data.total_amount;
                this.breakdowns = response.data.breakdowns;
            })
    },
})
</script>

<style scoped>
    .wrapper {
        max-width: 620px;
        margin: 0 auto;
    }
</style>
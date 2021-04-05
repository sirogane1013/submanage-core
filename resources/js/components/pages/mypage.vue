<template>
    <b-container class="wrapper">
        <b-card title="マイページ">
            <b-card title="今月の使用金額">
                <b-card-body>
                    <h1 class="d-flex justify-content-center">¥ {{ total_amount }}</h1>
                </b-card-body>
            </b-card>
            <b-card title="概観">
                <chart :chartData="chartData" />
            </b-card>
        </b-card>
    </b-container>
</template>
<script>
import Chart from '../modules/Chart'
import store from '../../store'

export default({
    name: 'mypage',
    components: {
        Chart,
    },
    data() {
        return {
            total_amount: 0,
            breakdowns: [],
            categories: store.data.categories
        }
    },
    computed: {
        chartData() {
            const parsed = JSON.parse(JSON.stringify(this.breakdowns));
            return {
                labels: Object.keys(parsed).map(v => this.categories[v].text),
                datasets: [{
                    backgroundColor: "#17A2B880",
                    label: "使用金額",
                    data: Object.values(parsed),
                }],
            }
        }
    },
    async mounted() {
        let { data } = await axios.get('/api/service/aggregation');
        this.total_amount = data.total_amount;
        this.breakdowns = data.breakdowns;
    },
})
</script>

<style scoped>
    .wrapper {
        max-width: 620px;
        margin: 0 auto;
    }
</style>
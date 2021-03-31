<template>
    <b-container class="wrapper">
        <b-card title="マイページ">
            <b-card title="今月の使用金額">
                ¥{{ total_amount }}
            </b-card>
            <b-card title="内訳">
                <chart :chartData="chartData" />
            </b-card>
        </b-card>
    </b-container>
</template>
<script>

import Chart from '../modules/Chart'

export default({
    name: 'mypage',
    components: {
        Chart,
    },
    data() {
        return {
            total_amount: 0,
            breakdowns: [],
            categories: {
                0: "動画",
                1: "食事",
                2: "ショッピング",
            }
        }
    },
    computed: {
        chartData() {
            const parsed = JSON.parse(JSON.stringify(this.breakdowns));
            console.log(parsed);
            console.log(Object.keys(parsed));
            return {
                labels: Object.keys(parsed).map(v => this.categories[v]),
                datasets: [{
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
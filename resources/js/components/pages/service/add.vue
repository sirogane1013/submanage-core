<template>
    <b-container class="wrapper">
        <b-card title="サービスの追加">
            <form @submit.prevent="add">
                <b-form-group
                    id="input-group-1"
                    label="サービス名"
                    label-for="input-1"
                >
                    <b-form-input
                    id="input-1"
                    v-model="name"
                    type="text"
                    placeholder="サービス名"
                    required
                    />
                </b-form-group>
                <b-form-group
                    id="input-group-2"
                    label="カテゴリ"
                    label-for="input-2"
                >
                    <b-form-select
                        id="input-2"
                        v-model="category_id"
                        :options="categories"
                        required
                    />
                </b-form-group>
                <b-form-group
                    id="input-group-3"
                    label="値段"
                    label-for="input-3"
                >
                    <b-input-group prepend="¥">
                        <b-form-input
                            id="input-3"
                            v-model="price"
                            type="number"
                            placeholder="Price"
                            required
                        />
                    </b-input-group>
                </b-form-group>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </b-card>
    </b-container>
</template>
<style scoped>
    .wrapper {
        max-width: 620px;
        margin: 0 auto;
    }
    .services__badge {
        margin-left: auto;
    }
</style>
<script>

export default({
    name: 'serviceAdd',
    data() {
        return {
            name: "",
            price: null,
            category_id: null,
            errors: [],
            categories: [
                { text: 'Select One', value: null }, 
                { text: '動画', value: 0 },
            ],
        };
    },
    methods: {
        add() {
            axios
                .post('/api/service/add', {
                    name: this.name,
                    price: this.price,
                    category_id: this.category_id,
                })
                .then(response => {
                    console.log(response);
                    this.$router.push('/service');
                })
        }
    }
})
</script>

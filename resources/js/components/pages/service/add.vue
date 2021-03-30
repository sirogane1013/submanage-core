<template>
    <form @submit.prevent="add">
            <div>
                <label>サービス名</label>
                <input type="text" v-model="name" />
                <span v-if="errors.name">
                    {{ errors.name[0] }}
                </span>
            </div>
             <div>
                <label>カテゴリ</label>
                <input type="number" v-model="category_id" />
                <span v-if="errors.category_id">
                    {{ errors.category[0] }}
                </span>
            </div>
             <div>
                <label>値段</label>
                <input type="number" v-model="price" />
                <span v-if="errors.price">
                    {{ errors.price[0] }}
                </span>
            </div>
 
            <button>Submit</button>
        </form>
</template>
<script>

export default({
    name: 'serviceAdd',
    data() {
        return {
            name: "",
            price: 0,
            category_id: 0,
            errors: [],
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

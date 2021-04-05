<template>
    <b-container class="wrapper">
        <b-card title="サービス一覧">
            <div>
            <b-card no-body>
                <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-button
                        block
                        class="d-flex justify-content-center align-items-center"
                        variant="info"
                        v-b-toggle="'accordion-add'"
                    >
                        <b-icon-plus-circle />
                    </b-button>
                </b-card-header>
                <b-collapse :id="`accordion-add`" accordion="services" role="tabpanel">
                    <b-card-body>
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
                    </b-card-body>
                    <b-card-footer>
                        <b-button
                            block
                            variant="primary"
                            @click="addService"
                            v-b-toggle="'accordion-add'"
                        >
                            追加
                        </b-button>
                    </b-card-footer>
                </b-collapse>
            </b-card>
            <b-card
                no-body
                v-for="(service, i) in services"
                :key="service.id"
            >
                <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-button
                        block
                        v-b-toggle="'accordion-'+i"
                        class="d-flex justify-content-start align-items-center"
                        variant="outline-info"
                    >
                        <component :is="categories[service.category_id].icon" />
                        <span class="ml-3">
                            {{ service.name }}
                        </span>
                        <b-badge variant="info" pill class="services__badge">
                            ¥{{ service.price }}
                        </b-badge>
                    </b-button>
                </b-card-header>
                <b-collapse :id="`accordion-`+i" accordion="services" role="tabpanel">
                    <b-card-body>
                        <dl>
                            <dt>名前</dt>
                            <dd>{{ service.name }}</dd>
                            <dt>カテゴリ</dt>
                            <dd>{{ categories[service.category_id].text }}</dd>
                            <dt>価格</dt>
                            <dd>¥{{ service.price }}</dd>
                        </dl>
                    </b-card-body>
                    <b-card-footer>
                        <b-button
                            @click="deleteService(service.id)"
                            block
                            variant="danger"
                        >
                            削除
                        </b-button>
                    </b-card-footer>
                </b-collapse>
            </b-card>
        </div>
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
    .bg-white {
        background-color: #fff;
    }
</style>
<script>
import store from '../../../store'

export default({
    name: 'service',
    data() {
        return {
            services: [],
            categories: store.data.categories,
            name: "",
            price: null,
            category_id: null,
        }
    },
    created() {
        axios
            .get('/api/service/list')
            .then(response => {
                this.services = response.data.services.reverse();
            })
    },
    methods: {
        addService() {
            axios
                .post('/api/service/add', {
                    name: this.name,
                    price: this.price,
                    category_id: this.category_id,
                })
                .then(response => {
                    this.name = "";
                    this.price = null;
                    this.category_id
                    axios
                        .get('/api/service/list')
                        .then(response => {
                            this.services = response.data.services.reverse();
                        })
                })
        },
        deleteService(service_id) {
            axios
                .delete('/api/service/delete', {
                    data: {
                        id: service_id,
                    },      
                })
                .then(response => {
                    this.services = this.services.filter(s => s.id != service_id );
                })
        },
    }
})
</script>

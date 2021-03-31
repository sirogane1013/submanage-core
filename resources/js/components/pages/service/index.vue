<template>
    <b-container class="wrapper">
        <b-card title="サービス一覧">
            <div>
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
                        <b-icon-question class="mr-3" />
                        <span>
                            {{ service.name }}
                        </span>
                        <b-badge variant="info" pill class="services__badge">
                            ¥{{ service.price }}
                        </b-badge>
                    </b-button>
                </b-card-header>
                <b-collapse :id="`accordion-`+i" accordion="services" role="tabpanel">
                    <b-button
                        @click="deleteService(service.id)"
                        variant="danger"
                        class="float-right m-2"
                    >
                        削除
                    </b-button>
                </b-collapse>
            </b-card>
            <b-card no-body>
                <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-button
                        block
                        class="d-flex justify-content-center align-items-center"
                        variant="info"
                        to="/service/add"
                    >
                        <b-icon-plus-circle />
                    </b-button>
                </b-card-header>
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
</style>
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
    methods: {
        deleteService(service_id) {
            axios
                .delete('/api/service/delete', {
                    data: {
                        id: service_id,
                    },      
                })
                .then(response => {
                })
        },
    }
})
</script>

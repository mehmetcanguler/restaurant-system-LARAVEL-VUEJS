<template>
    <div class="row m-0 p-0">
        <div class="col-4 p-0 products">
            <template v-for="category in categories" :key="category.title">
                <div class="d-block py-2 text-center p-0 my-0 text-uppercase category"
                    @click="productsFor(category.products)">
                    {{ category.title }}
                </div>

            </template>
        </div>
        <div class="col-8 p-0 products">
            <div class="row p-0 m-0">
                <template v-for="product in products" :key="product.title">
                    <div class=" p-0 col-sm-4 border rounded text-center h4 bg-danger m-0 overflow-hidden align-items-center justify-content-center product"
                        :style="{ 'background-image': 'url(' + product.image + ')' }"
                        @click="sendProductId(product.id)">
                        {{ product.title }}
                        <br>
                        {{ product.price }} TL

                    </div>
                </template>
            </div>
        </div>
    </div>
    <div style="height: 10vh;" class="d-flex bg-light">
        <div class="col-6 bg-danger">
            <textarea type="text" placeholder="Not giriniz" style="height:100%;border-radius: 0;resize: none;"
                class="form-control" v-model="request.title">
                </textarea>

        </div>
        <div class="col-3 d-flex align-items-center justify-content-start">

            <span class="h5">{{ qty }} adet ürün ekle</span>
        </div>
        <div class="col-3 d-flex align-items-center justify-content-end">
            <template v-if="qty < 1">
                {{ qty = 1 }}
            </template>
            <div v-if="qty != 1" class="btn btn-danger me-2" @click="qty = qty - 10;">-10</div>
            <div v-if="qty != 1" class="btn btn-danger me-2" @click="qty--;">-</div>

            <div class="btn btn-success ms-2" @click="qty++;">+</div>
            <div class="btn btn-success ms-2" @click="qty = qty + 10;">+10</div>

        </div>
    </div>
</template>

<script>
// import EventBus from './EventBus';
export default {
    data() {
        return {
            products: null,
            product_id: "",
            request: {},
            errors: {},
            qty: 1,
            title: "",
        }
    },
    props: {
        categories: {},
        table_id: "",
    },
    emits: {
        new_order: {},
        new_tables: {}
    },
    methods: {
        productsFor(products) {
            this.products = products;
        },
        sendProductId(product_id) {
            this.request.table_id = this.table_id;
            this.request.product_id = product_id;
            this.request.qty = this.qty;
            this.errors = {}
            axios
                .post("/add-order-detail", this.request)
                .then((data) => {
                    this.$emit('new_order', data.data.order);
                    if (data.data.tables) {
                        this.$emit('new_tables', data.data.tables);
                    }
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        console.log(this.errors = error.response.data.errors) || {};
                    }
                });
            this.qty = 1;
            this.request={};
        }
    },

}
</script>

<style>
.products {
    background-color: #fff;
    border: 1px solid black;
    height: 80vh;
    overflow-y: scroll;
}

.products::-webkit-scrollbar {
    width: 0;
}

.category {
    background-color: darkgoldenrod;
    border: 1px solid black;
    height: 70px;
}

.category:hover {
    cursor: pointer;
    background-color: darksalmon;
    border: 2px solid #d0d0d0;
}

.product {
    height: 70px;

}
</style>
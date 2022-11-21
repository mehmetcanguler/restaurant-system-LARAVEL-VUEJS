<template>
    <div class="order" style="border: 1px solid black;">
        <div class="d-flex border-bottom border-bottom-1 border-dark" style="height:7%; background-color: #ddd; ">
            <div class=" w-100  p-2 border d-flex align-items-center ">
                <span class="col-3 ">Ürün Adı</span>
                <span class="col-2 text-start">Fiyat</span>
                <span class="col-1 text-center">Adet</span>
                <span class="col-2 text-end">Tutar</span>
                <span class="col-4 text-end">Islemler</span>

            </div>
        </div>
        <div class="d-flex flex-column shopping-cart" style="height:73%; background-color: #eee; ">
            <template v-if="order">
                <div class="card-item my-1 p-2 border shadow d-flex align-items-start"
                    v-for="value in order.order_detail" :key="value">

                    <span class="col-3 ">{{ value.product.title }}</span>
                    <span class="col-2 text-start">{{ value.product.price }}</span>
                    <span class="col-1 text-center">{{ value.qty }}</span>
                    <span class="col-2 text-end">{{ value.product.price * value.qty }}.00</span>
                    <div class="d-none">
                        {{ total = total + value.product.price * value.qty }}
                    </div>
                    <span class="col-4 text-end">
                        <div class="btn btn-sm btn-primary " @click="plus(value.id, value.qty)"><i
                                class="fa fa-plus"></i></div>
                        <div class="btn btn-sm btn-warning " @click="minus(value.id, value.qty)"><i
                                class="fa fa-minus"></i></div>
                        <div class="btn btn-sm btn-danger " @click="destroy(value.id)"><i class="fa fa-trash"></i></div>
                    </span>

                </div>
            </template>
        </div>

        <div style="height:20%" class="d-flex flex-column justify-content-between py-1">
            <template v-if="success == false">
                <div class="order-note h-50 bg-light">
                    <p class="order-note-content">
                        <template v-if="order">
                            <template :key="value" v-for="value in order.order_detail">
                                {{ value.product.title }} -- {{ value.title }}
                                <br>
                            </template>
                        </template>
                    </p>
                </div>
                <div class="pay-system d-flex align-items-end justify-content-between">
                    <div class="">
                        <span class="h5">Toplam :</span>
                        <span class="h5">{{ total }}.00 TL</span>
                    </div>
                    <div class="payment">
                        <div class="btn btn-danger me-2" @click="deleteOrder">
                            Masayı iptal et
                        </div>
                        <div class="btn btn-success me-2" @click="sendOrder(0)">
                            Nakit Öde
                        </div>
                        <div class="btn btn-success me-2" @click="sendOrder(1)">
                            Kredi Karti ile Öde
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="alert alert-success h1">Masa Hesabı Başarıyla Ödendi</div>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            total: 0,
            field: {},
            errors: {},
            success: false
        }
    },
    props: {
        product_id: "",
        order: null
    },
    emits: {
        new_order: {},
        new_tables: {}
    },
    methods: {
        plus(id, qty) {
            qty++;
            this.field.qty = qty;
            axios
                .put('edit-order-detail-qty/' + id, this.field)
                .then((data) => {
                    this.$emit('new_order', data.data);
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                        console.log(this.errors)
                    }
                });
            this.field = {}
        },
        minus(id, qty) {

            if (qty != 1) {
                qty--;
                this.field.qty = qty;
                axios
                    .put('edit-order-detail-qty/' + id, this.field)
                    .then((data) => {
                        this.$emit('new_order', data.data);
                    })
                    .catch((error) => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                            console.log(this.errors)
                        }
                    });
            }
            this.field = {}
        },
        destroy(id) {
            axios
                .delete('delete-order-detail/' + id)
                .then((data) => {
                    this.$emit('new_order', data.data);
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
        },
        deleteOrder() {
            if (this.order) {
                axios
                    .delete('delete-order/' + this.order.id)
                    .then((data) => {
                        this.$emit('new_order', data.data.order);
                        if (data.data.tables) {
                            this.$emit('new_tables', data.data.tables);
                        }
                    })
                    .catch((error) => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        }
                    });
            }
        },
        sendOrder(payment_type) {
            this.field.payment_type = payment_type;
            this.field.order_id = this.order.id
            axios.post('complete-order', this.field)
                .then((data) => {
                    this.$emit('new_order', null);
                    this.$emit('new_tables', data.data);
                    this.success = true

                    setTimeout(() => {
                        this.success = false
                    }, 2000)
                })
                .catch((error) => {
                    console.log(error)
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {}
                    }
                });
        }

    },
    beforeUpdate() {
        this.total = 0
    },
}
</script>

<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css');

.order {
    background-color: grey;
    height: 100vh;
}

.card-item {
    width: 100%;
    height: 50px;

}

.shopping-cart {
    overflow-y: scroll;
}

.shopping-cart::-webkit-scrollbar {
    width: 0;
}

.order-note-content {
    height: 100%;
    width: 100%;
    overflow-y: scroll;
}
</style>
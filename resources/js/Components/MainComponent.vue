,
<template>
    <div class="container-fluid "> 
        <div class="row">
            
        <template v-if="table_id == null" :key="table.title" v-for="table in tables">
                <template :key="value" v-for="value in table.table">

                    <template v-if="value.status == 1">
                        <div class="col-sm-2 border rounded p-0 m-0 full-table text-center h2 "
                            @click="sendTableId(table.title, value)">
                            <p>{{ table.title }}</p>
                            <p>{{ value.table_no }}</p>
                            <template  v-for="order in value.order">
                             <template v-if="order.status == 1"  v-for="order_detail in order.order_detail" >
                                  <div class="d-none">
                                    {{total = total + order_detail.product.price * order_detail.qty }}
                                  </div>         
                            </template>    
                            </template>
                            <p>{{total}}.00 TL</p>
                           <div class="d-none">
                            {{total=0}}
                           </div>
                        </div>
                    </template>

                    <template v-else>
                        <div class="col-sm-2 border rounded p-0 m-0 empty-table text-center h2 "
                        @click="sendTableId(table.title, value)">
                            <p>{{ table.title }}</p>
                            <p>{{ value.table_no }}</p>
                            <template  v-for="order in value.order">
                             <template v-if="order.status == 1"  v-for="order_detail in order.order_detail" >
                                  <div class="d-none">
                                    {{total = total + order_detail.product.price * order_detail.qty }}
                                  </div>         
                            </template>    
                            </template>
                            <p>{{total}}.00 TL</p>
                           <div class="d-none">
                            {{total=0}}
                           </div>
                        </div>
                    </template>

                </template>
          
        </template>
    </div>

        <template v-if="table_id != null">
            <div class="row">
                <div class="col-5 p-0">
                    <order-component :order="order" @new_order="new_order" @new_tables="new_tables"></order-component>
                </div>
                <div class="col-7 p-0" style="height:100vh;">
                    <div style="height:90vh;">
                        <product-component :categories="categories" :table_id="table_id" @new_order="new_order"
                            @new_tables="new_tables"></product-component>
                    </div>
                    <div style="height: 10vh;" class="d-flex justify-content-end">


                        <span class="h3 align-self-end text-white pe-2">
                            {{ table_name }}
                        </span>
                        <button class="btn btn-danger align-self-end m-1" @click="go_table()">Diğer Masalara
                            Dön</button>
                    </div>
                </div>
            </div>
        </template>

    </div>
</template>

<script>
// import TableComponent from "./TableComponent.vue";
import ProductComponent from "./ProductComponent.vue";
import OrderComponent from "./OrderComponent.vue";

export default {
    data() {
        return {
            table_id: null,
            errors: {},
            order: {},
            categories: {},
            table_name: null,
            tables: {},
            total:0,
        };
    },
    props: {
        tables_prop: {},
    },
    components: {
        // TableComponent,
        ProductComponent,
        OrderComponent,
    },
    methods: {
        sendTableId(table_name, value) {
            this.table_name = table_name + " " + value.table_no;
            this.table_id = value.id;
            axios
                .get("/order/" + value.id)
                .then((data) => {  
                    this.categories = data.data.categories;
                    this.order = data.data.order
                })
                .catch((error) => {
                    console.log(error)
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {}
                    }
                });
        },
        new_order(value) {
            console.log('sipariş güncellendi')
            this.order = value;
        },
        go_table() {
            this.table_id = null;
        },
        new_tables(value) {
            console.log('masalar güncellendi')
            this.tables = value
        }
    },
    created() {
        this.tables = this.tables_prop
    },
};
</script>

<style>
* {
    margin: 0;
    padding: 0;
}

body {
    margin: 0;
    padding: 0;
    background-color: #000;
}

.full-table {
    height: 180px;
    width: 16,66666666666667%;
    background-color: green;
    overflow: hidden;
    text-overflow: ellipsis;
}

.empty-table {
    height: 180px;
    width: 16,66666666666667%;
    background-color: grey;
    overflow: hidden;
    text-overflow: ellipsis;
}

.full-table:hover {
    height: 180px;
    width: 16,66666666666667%;
    background-color: greenyellow;
    border: 1px solid transparent;
    cursor: pointer;
}

.empty-table:hover {
    height: 180px;
    width: 16,66666666666667%;
    background-color: gainsboro;
    border: 1px solid transparent;
    cursor: pointer;
}
</style>

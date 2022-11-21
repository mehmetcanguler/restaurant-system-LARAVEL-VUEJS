<!-- <template>
    <div class="container">
        <template
            v-if="category == null"
            :key="index"
            v-for="(value, index) in categories"
        >
            <button class="btn btn-primary" @click="getProduct(value)">
                {{ value.title }}
            </button>
        </template>
        <template v-else>
            <button class="btn btn-primary" @click="back()">kategoriler</button>
            <div class="mt-5">
                <ProductComponent :category_props="category"></ProductComponent>
            </div>
        </template>
    </div>
</template>

<script>
import ProductComponent from "./ProductComponent.vue";

export default {
    data: function () {
        return {
            category : null
        };
    },
    components: {
        ProductComponent,
    },
    props: {
        table_id: {},
        categories: {},
        orders: {},
    },
    beforeMount()
    {

    },
    methods: {
        getProduct(category) {
            this.category = category;
        },
        back() {
            this.category = null;
        },
    },
};
</script> -->

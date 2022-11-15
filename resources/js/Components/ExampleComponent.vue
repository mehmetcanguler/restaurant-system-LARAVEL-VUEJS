<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <!-- validate alert -->
                        <template v-if="validate != null">
                            <div class="alert alert-danger" v-for="(value,index) in validate.title" :key="index">
                                {{ value }}
                            </div>
                            <!--  -->
                        </template>
                        <!-- succes alert -->
                        <template v-if="success != null">
                            <div class="alert alert-success">
                                Kategori Başarıyla Oluşturuldu
                            </div>
                        </template>
                        <!--  -->

                        <form @submit.prevent="submit">
                            <div class="form-group">
                                <label for="">Kategori Adı</label>
                                <input
                                    class="form-control"
                                    v-model="fields.title"
                                    type="text"
                                    name="title"
                                />
                            </div>
                            <button class="btn btn-primary">
                                Kategori Oluştur
                            </button>
                        </form>
                    </div>
                    <div class="card-content">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Kategori Adı</th>
                                    <th>Oluşturulma tarihi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    :key="index"
                                    v-for="(value, index) in newCategories"
                                >
                                    <td>{{ value.id }}</td>
                                    <td>{{ value.title }}</td>
                                    <td>{{ value.created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FormComponent from "./FormComponent.vue";

export default {
    data: function () {
        return {
            newCategories: "boş",
            fields: {},
            errors: {},
            validate: null,
            success: null,
        };
    },
    components: {
        FormComponent,
    },
    props: {
        categories: "",
    },
    beforeMount() {
        this.newCategories = this.categories;
    },
    methods: {
        submit() {
            this.errors = {};
            axios
                .post("/category", this.fields)
                .then((categories) => {
                    this.fields = {};
                    this.validate = null;
                    this.success = true;
                    this.newCategories = categories.data;
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.success = null;
                        this.validate = error.response.data.errors;
                        this.errors = error.response.data.errors || {};
                    }
                });
        },
    },
};
</script>

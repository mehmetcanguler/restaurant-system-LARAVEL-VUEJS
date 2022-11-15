<template>
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
        <button class="btn btn-primary">Kategori Oluştur</button>
    </form>
</template>

<script>
export default {
    name: "FormComponent",
    props: {},
    data() {
        return {
            fields: {},
            errors: {},
        };
    },
    methods: {
        submit() {
            this.errors = {};
            axios
                .post("/category", this.fields)
                .then((categories) => {
                    console.log(categories);
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        console.log(error);
                        this.errors = error.response.data.errors || {};
                    }
                });
        },
    },
};
</script>

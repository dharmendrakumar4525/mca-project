<template>
    <div class="card text-center">
        <div class="card-header header-primary">Add A New Category</div>
        <br />
        <form id="app" @submit.prevent="submitForm" method="post" class="form">
            Category
            <select v-model="categoryId" class="form-group">
                <option :value="0">Please select one</option>
                <option
                    v-for="category in updatecategories"
                    :value="category.id"
                    :key="category.id"
                >
                    {{ category.name }}
                </option>
            </select>

            <p>
                <label for="name"
                    >{{
                        categoryId == 0 ? "Category Name" : " Sub Category Name"
                    }}
                    <input
                        type="text"
                        name="name"
                        id="name"
                        v-model="name"
                        class="form-group"
                    /><br />
                    <span class="alert-danger" v-text="error[0]"></span>
                </label>
            </p>
            <p>
                <input type="submit" class="btn btn-primary" value="Submit" />
            </p>
        </form>
    </div>
</template>
<script>
export default {
    name: "CategoryCreate",
    props: {
        categories: Array
    },
    data() {
        return {
            updatecategories: this.categories,
            error: "",
            name: null,
            categoryId: ""
        };
    },
    methods: {
        submitForm: function(e) {
            let Event = this;
            console.log(this.name);
            axios
                .post("/category", {
                    categoryId: this.categoryId,
                    name: this.name
                })
                .then(response => {
                    Event.error = "";
                    if (response.status === 200) {
                        this.name = "";
                        console.log(response);
                        this.updatecategories = response.data.categories;
                        window.location.href = "/category/";
                    }
                })
                .catch(error => {
                    alert("Category name is  unique");
                    this.error = error.response.data.errors.name;
                    console.log(this.error);
                });
            e.preventDefault();
        }
    }
};
</script>

<template>
    <div class="card text-center">
        <div class="card-header header-primary">Add A New Category</div>
        <br />
        <form id="app" @submit.prevent="submitForm" method="post" class="form">
            <p>
                <label for="name">
                    Category Name

                    <input
                        type="text"
                        name="name"
                        v-model="category.name"
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
      name: "CategoryEdit",
    props: {
        category: Object
    },
    data() {
        return {
            error: "",
            name: null
        };
    },
    methods: {
        submitForm: function(e) {
            console.log(this.category.id);
            axios
                .patch("/category/" + this.category.id, {
                    id: this.category.id,
                    name: this.category.name
                })
                .then(response => {
                    Event.error = "";
                    if (response.status === 200) {
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

<template>
    <div class="card text-center">
        <div class="card-header header-primary">Add A New Category</div>
        <br />
        <form id="app" @submit.prevent="submitForm" method="post" class="form">
            Category
            <select v-model="categoryId"
             class="form-group">
           
                <option 
                    v-for="category in categories"
                   v-bind:value="category.id"
                   >
                    
                    {{ category.name }}
                </option>
            </select>

            <p>
                <label for="name">
                    Sub Category Name
                    <input
                        type="text"
                        name="name"
                        id="name"
                        v-model="subcategory.name"
                        
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
    name: "SubcategoryEdit",
    props: {
        categories: Array,
        subcategory: Object
    },
    data() {
        return {
            error: "",
            categoryId:this.subcategory.category_id
        };
    },
    methods: {
        submitForm: function(e) {
            console.log(this.categoryId);
            console.log(this.subcategory.name);

            axios
                .patch(
                    "/category/" +
                        this.categoryId +
                        "/subcategory/" +
                        this.subcategory.id,
                    {
                        category_id: this.categoryId,
                        name: this.subcategory.name,
                        id: this.subcategory.id
                    }
                )
                .then(response => {
                    Event.error = "";
                    if (response.status === 200) {
                        window.location.href =
                            "/category/" + this.categoryId + "/subcategory";
                    }
                })
                .catch(error => {
                    alert("Plz select a the one  category");
                    this.error = error.response.data.errors.name;
                    console.log(this.error);
                });
            e.preventDefault();
        }
    }
};
</script>

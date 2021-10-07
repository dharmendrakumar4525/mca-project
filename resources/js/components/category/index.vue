<template>
    <div>
        <table class="table table-sm table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Category Id</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Sub Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody v-for="category in updateCategories">
                <td v-text="category.id"></td>
                <td v-text="category.name"></td>
                <td>
                    {{ category.sub_categories_count }}
                </td>
                <td>
                    <button class="btn btn-info btn-sm float-right">
                        <i @click="edit(category.id)" class="far fa-edit"></i>
                    </button>
                    <button
                        type="submit"
                        class="btn btn-danger btn-sm mr-2 float-right"
                    >
                        <i
                            @click="deleted(category.id)"
                            class="fas danger fa-trash"
                        ></i>
                    </button>
                    <button
                        type="submit"
                        class="btn btn-primary btn-sm mr-2 float-right"
                    >
                        <i
                            @click="subCategory(category.id)"
                            class="fas fa-angle-down"
                        ></i>
                    </button>
                </td>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    name: "CategoryIndex",
    props: {
        categories: Array
    },
    data() {
        return {
            subCategoryEnabled: false,
            updateCategories: this.categories
        };
    },
    methods: {
        showCategory() {
            this.subCategoryEnabled = true;
        },
        deleted(id) {
            axios
                .delete("/category/" + id)
                .then(response => {
                    console.log(response.data.categories);
                    this.updateCategories = response.data.categories;
                })
                .catch(error => {});
        },
        edit(id) {
            console.log(id);
            window.location.href = "/category/" + id + "/edit";
        },
        getCategories() {
            axios.get("/category/").then(response => {
                this.updateCategories = response.data.categories;
            });
        },
        subCategory(id) {
            console.log(id);
            window.location.href = "/category/" + id + "/subcategory";
        }
    }
};
</script>

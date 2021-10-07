<template>
    <div>
        <table class="table table-sm table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">SubCategory Id</th>
                    <th scope="col">sub Category Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody v-for="subcategory in updateSubCategories">
                <td v-text="subcategory.id"></td>
                <td v-text="subcategory.name"></td>
                <td>
                    <button class="btn btn-info btn-sm float-right">
                        <i
                            @click="edit(subcategory.id)"
                            class="far fa-edit"
                        ></i>
                    </button>
                    <button
                        type="submit"
                        class="btn btn-danger btn-sm mr-2 float-right"
                    >
                        <i
                            @click="deleted(subcategory.id)"
                            class="fas danger fa-trash"
                        ></i>
                    </button>
                </td>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    name: "SubcategoryIndex",
    props: {
        subcategories: Array,
        category: Object
    },
    data() {
        return {
            updateSubCategories: this.subcategories
        };
    },
    methods: {
        deleted(id) {
            axios
                .delete(
                    "/category/" + this.category.id + "/subcategory/" + id + "/"
                )
                .then(response => {
                    window.location.href =
                        "/category/" + this.category.id + "/subcategory";
                })
                .catch(error => {});
        },
        edit(id) {
            console.log(id);
            window.location.href =
                "/category/" +
                this.category.id +
                "/subcategory/" +
                id +
                "/edit";
        }
    }
};
</script>

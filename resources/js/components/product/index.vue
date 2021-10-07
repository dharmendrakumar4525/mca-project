<template>
    <div>
        <div class="table-responsive">
            <table-component
                v-if="fetchData.length > 0"
                ref="tableCategories"
                :data="fetchData"
                :table-class="'table table-striped table-sm bg-white'"
                :show-filter="false"
                :show-caption="false"
                :cache-lifetime="0"
            >
                <table-column show="id" label="id"></table-column
                ><small> </small>
                <table-column show="name" label="Name"> </table-column>
                <table-column label="image"><template slot-scope="row">
                       <div v-show="false">
                    {{ (image = "/storage/" + row.image) }}
                </div>
            <img :src= image  width="100" height="100">  
         </template></table-column>
                <table-column show="price" label="Price"> </table-column>
                <table-column show="description" label="description">
                </table-column>
                <table-column show="unit_in_stock" label="Stock">
                </table-column>
                 <table-column  label="Action">
                      <template slot-scope="row">
                       <button  type="submit" class="btn mb-2 btn-info btn-sm">
                        <i @click="edit(row.id)" class="far fa-edit"></i>
                    </button>
                  
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i @click="deleted(row.id)"  class="fas danger fa-trash"></i>
                    </button>
                       </template slot-scope="row">
                </table-column>
            </table-component>
        </div>
    </div>
</template>
<script>
// import {TableComponent, TableColumn} from '@aayushdrolia111/vue-table-component';
import { TableComponent, TableColumn } from "vue-table-component";

export default {
    name: "ProductIndex",
    props: {
        products: Object
    },

    components: {
        TableColumn,
        TableComponent
    },
    methods: {
        async fetchData({ page, filter, sort }) {
            const response = await axios.get("/product",{
                  params: {
                    page: page,
                 }
            })
            console.log(response.data);
            return response.data;
        },
            edit(id) {
                console.log("fjhafhd");
            window.location.href = "/product/" + id + "/edit";
        },
        deleted(id) {
            axios
                .delete("/product/" + id + "/")
                .then(response => {
                    window.location.href = "/product";
                })
                .catch(error => {});
        }
    }
};
</script>

<template>
    <div>
        <div class="table-responsive">
            <table-component
                :data="fetchData"
                ref="products"
                :table-class="'table table-striped table-sm bg-white'"
                :cache-lifetime="0"
            >
                <table-column show="id" label="id"> </table-column>
                <table-column show="name" label="Name"> </table-column>
                <table-column show="image" label="image"> </table-column>
                <table-column show="price" label="description"> </table-column>
                <table-column show="description" label="description">
                </table-column>
                <table-column show="unit_in_stock" label="Unit in Stock">
                </table-column>
            </table-component>
            <template slot-scope="row">
                <span class="d-block">{{ products }}</span>
            </template>
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
            const response = await axios.get("/product", { page });

            // An object that has a `data` and an optional `pagination` property
            return response;
        }
    }
};
</script>

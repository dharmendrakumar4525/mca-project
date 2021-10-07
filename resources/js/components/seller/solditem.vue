<template>
    <div>
        <div class="col-auto">
            <select
                class="form-control"
                @change="productFilter()"
                v-model="productId"
            >
                <option selected>Filter By Product</option>
                <option v-for="(name, id) in products" :value="id">{{
                    name
                }}</option>
            </select>
            <select
                class="form-control"
                @change="customerFilter()"
                v-model="customerId"
            >
                <option selected>Filter By Product</option>
                <option v-for="(name, id) in customers" :value="id">{{
                    name
                }}</option>
            </select>
        </div>
        <table class="table table-bordered table-sm table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">Order id</th>
                    <th scope="col">Product image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Quantiy</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(order, index) in data">
                    <td class="v-align-middle" width="400px">
                        {{ index }}
                    </td>
                    <td class="v-align-middle" width="70px">
                        <img
                            class="img-thumbnail"
                            :src="/storage/ + order.product.image"
                        />
                    </td>

                    <td class="v-align-middle" width="400px">
                        {{ order.product.name }}
                    </td>
                    <td class="v-align-middle" width="200px">
                        {{ order.customer.name }}
                    </td>
                    <td class="v-align-middle" width="400px">
                        {{ order.quantity }}
                    </td>
                    <td class="v-align-middle" width="400px">
                        {{ order.amount }}
                    </td>

                    <td class="v-align-middle" width="400px">
                        <button
                            class="btn btn-success"
                            @click="approval(order.id, index)"
                            v-model="order.status"
                            :disabled="order.status ? true : false"
                        >
                            Approve
                        </button>
                    </td>
                </tr>
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</template>
<script>
import axios from "axios";
export default {
    name: "Seller-Solditem",
    props: {
        orders: Array,
        customers: Array,
        products: Array
    },
    data() {
        return {
            data: this.orders,
            productId: "",
            customerId: ""
        };
    },
    methods: {
        approval(id, index) {
            console.log(index);
            axios.patch("/sold/" + id).then(response => {
                this.data[index].status = 1;
            });
        },

        productFilter() {
            console.log(this.productId);

            axios
                .get("/sold", {
                    params: {
                        product_id: this.productId
                    }
                })
                .then(response => {
                    if (response.status === 200) {
                        this.data = response.data.data;
                    }
                });
        },
        customerFilter() {
            axios
                .get("/sold", {
                    params: {
                        customer_id: this.customerId
                    }
                })
                .then(response => {
                    if (response.status === 200) {
                        this.data = response.data.data;
                    }
                });
        }
    },
    mounted() {}
};
</script>

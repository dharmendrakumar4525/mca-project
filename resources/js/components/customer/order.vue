<template>
    <div>
        <table class="table table-bordered table-sm table-striped text-center">
            <thead>
                <tr>
                    <!-- <th scope="col "></th> -->
                    <th scope="col">image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantiy</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            
            <tbody>
                <tr v-for="product in orders">
                    <!-- {{product.order_products}} -->
                    <td class="v-align-middle" width="70px">
                        <img
                            class="img-thumbnail"
                            :src="/storage/ + product.order_products[0].image"
                        />
                    </td>

                    <td class="v-align-middle" width="400px">
                        {{ product.order_products[0].name }}
                    </td>
                    <td class="v-align-middle" width="200px">
                        {{ product.quantity }}
                    </td>
                    <td class="v-align-middle" width="400px">
                        {{ product.amount }}
                    </td>
                    <td class="v-align-middle" width="400px">
                        {{ product.status }}
                    </td>
                </tr>
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</template>
<script>
export default {
    name: "Customer-Order",
    props: {
        orders: Array
    }
};
</script>

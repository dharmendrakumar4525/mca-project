<template>
    <div>
        <table class="table table-bordered table-sm table-striped text-center">
            <thead>
                <tr>
                    <th scope="col "></th>
                    <th scope="col">image</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="cartItem in cart">
                    <td class="v-align-middle" width="50px">
                        <a
                            class="p-0"
                            href="#"
                            data-toggle="modal"
                            @click="deleted(cartItem.id)"
                            data-backdrop="static"
                            data-target="#modal-delete-cart-item"
                        >
                            <i class="fas fa-times text-danger"></i
                        ></a>
                    </td>
                    <td class="v-align-middle" width="70px">
                        <img
                            class="img-thumbnail"
                            :src="/storage/ + cartItem.product.image"
                            v-if="cartItem.product.image"
                        />
                        <img
                            v-else
                            src="/images/no_image_found.jpg"
                            class="img-thumbnail"
                        />
                    </td>
                    <td class="v-align-middle" width="400px">
                        {{ cartItem.product.name }}
                    </td>
                    <td class="v-align-middle" width="200px">
                        ${{ cartItem.product.price }}
                    </td>
                    <td class="p-0 v-align-middle" width="200px">
                        <input
                            type="number"
                            min="1"
                            class="text-center"
                            style="max-width: 5rem; min-width: 80px;"
                            width="100%"
                            v-model="cartItem.quantity"
                        />
                    </td>
                    <td class="v-align-middle" width="200px">
                        ${{ cartItem.quantity * cartItem.product.price }}
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <button
                            type="button"
                            class="btn btn-primary btn-sm float-right mt-1"
                            @click.prevent="updateCart(1)"
                        >
                            <i class="fas fa-save"></i> Update Cart
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary btn-sm float-right mt-1"
                            @click.prevent="addItem()"
                        >
                            <i class="fas fa-save"></i> Add item
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div v-if="1" class="row">
            <div class="col-lg-6 col-md-12 offset-lg-6 text-center">
                <div class="card">
                    <div class="card-header pb-0"><h4>Cart Totals</h4></div>
                    <div>
                        <ul
                            class="list-group list-group-flush table-striped"
                            style="overflow: auto; max-height: 25rem;"
                        >
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>Shipping</strong>
                                    </div>
                                    <div class="col">Free Shipping</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <strong>Total</strong>
                                    </div>
                                    <div class="col notranslate">
                                        ${{ total }}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button
                            type="button"
                            class="btn btn-primary btn-sm float-right ml-1 mb-1"
                            @click="checkout()"
                        >
                            <i class="fa fa-paper-plane"></i>
                            Proceed To Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    name: "CustomerCart",
    props: {
        cartitems: Array,
        total: Number
    },
    data() {
        return {
            cart: this.cartitems,
            order: [[]]
        };
    },
    methods: {
        updateCart(id) {
            console.log(this.cart);
            axios
                .patch("/addtocart/" + id, {
                    data: this.cart
                })
                .then(response => {
                    if (response.data === 0) {
                        window.location.href = "/login";
                    } else {
                        window.location.href = "/addtocart";
                    }
                })
                .catch(error => {});
        },
        deleted(id) {
            axios.delete("/addtocart/" + id).then(responce => {
                window.location.href = "/addtocart";
            });
        },
        addItem() {
            window.location.href = "/customer";
        },
        checkout() {
            let order = [];
            for (var i = 0; i < this.cart.length; i++) {
                order.push({
                    product_id: this.cart[i]["product_id"],
                    quantity: this.cart[i]["quantity"],
                    amount:
                        this.cart[i]["product"]["price"] *
                        this.cart[i]["quantity"]
                });
            }

            console.log(order);
            axios.post("/order", order);
        }
    }
};
</script>

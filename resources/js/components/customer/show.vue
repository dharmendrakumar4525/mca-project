<template>
    <div>
        <section class="mb-5">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div id="mdb-lightbox-ui"></div>
                    <div class="mdb-lightbox">
                        <div class="row product-gallery mx-1">
                            <i
                                @mouseover="isHovering = true"
                                @mouseout="isHovering = false"
                                class="fa fa-heart"
                                :class="{ hovering: isHovering }"
                                v-show="!status"
                                @click="addWishlist(product.id)"
                                >{{ isHovering ? "add to wishlist" : "" }}</i
                            >
                            <i
                                class="fa fa-heart red-color"
                                v-show="status"
                                @click="deleteWishlist(product.id)"
                            ></i>
                            <div class="col-12 mb-0">
                                <figure
                                    class="view overlay rounded z-depth-1 main-img"
                                >
                                    <a :scr="image" data-size="710x823">
                                        <img
                                            :src="image"
                                            class="img-fluid z-depth-1"
                                        />
                                    </a>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5>{{ product.name }}</h5>
                    <p>
                        <span class="mr-1"
                            ><strong>${{ product.price }}</strong></span
                        >
                    </p>
                    <p class="pt-1">{{ product.description }}</p>

                    <hr />
                    <div class="table-responsive mb-2">
                        <table class="table table-sm table-borderless">
                            <tbody>
                                <tr>
                                    <td class="pl-0">
                                        <div
                                            class="def-number-input number-input safari_only mb-0"
                                        >
                                            <label for="quantity"
                                                >Quantity:</label
                                            >
                                            <input
                                                type="number"
                                                id="quantity"
                                                name="quantity"
                                                v-model="quantity"
                                                min="1"
                                            />
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button
                        type="button"
                        class="btn btn-primary btn-md mr-1 mb-2"
                        @click="buy()"
                    >
                        Buy now
                    </button>
                    <button
                        type="button"
                        @click="addCart(product.id, quantity)"
                        class="btn btn-success btn-md mr-1 mb-2"
                    >
                        <i class=""></i>Add to cart
                    </button>
                     <button
                        type="button"
                        @click="chat(product.supplier_id)"
                        class="fas fa-comment btn btn-warning btn-md mr-1 mb-2"
                    >
                        <i class=""></i>Chat With Seller
                    </button>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    name: "CostomerShow",
    props: {
        product: Object
    },
    data() {
        return {
            image: "/storage/" + this.product.image,
            quantity: 1,
            product_id: this.product.id,
            status: false,
            isHovering: false
        };
    },
    beforeMount(product_id) {
        axios.get("/wishlist/" + this.product_id).then(response => {
            console.log(response.data.status);
            this.status = response.data.status;
        });
    },
    methods: {
        addWishlist(id) {
            axios
                .post("/wishlist", {
                    product_id: id,
                    status: true
                })
                .then(response => {
                    Event.error = "";
                    if (response.data === 0) {
                        window.location.href = "/login";
                    }
                    console.log(response);
                    if (response.data === 1) {
                        this.status = true;
                    }
                });
        },
        deleteWishlist(id) {
            axios
                .delete("/wishlist/" + id, {
                    product_id: id,
                    status: true
                })
                .then(response => {
                    Event.error = "";
                    if (response.data === 0) {
                        window.location.href = "/login";
                    }
                    console.log(response);
                    if (response.data === 1) {
                        this.status = false;
                    }
                });
        },
        addCart(id, quantity) {
            axios
                .post("/addtocart", {
                    product_id: id,
                    quantity: quantity
                })
                .then(response => {})
                .catch(error => {
                    this.subCategories = "";
                });
        },
        buy() {
            console.log(this.product.price);
            console.log(this.quantity);
            axios
                .post("/order", {
                    product_id: this.product.id,
                    quantity: this.quantity,
                    amount: this.quantity * this.product.price,
                    payment_id: null
                })
                .then(response => {})
                .catch(error => {
                    this.subCategories = "";
                });
        },
        chat(id){
            console.log(id);
             window.location.href = "/chat/"+id;
        }
    }
};
</script>
<<style>
.red-color {
    color: red;
}

.hovering {
    color: green;
}
</style>

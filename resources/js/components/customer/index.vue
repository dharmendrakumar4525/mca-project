<template>
    <div>
        <div>
            <div class="form-row">
                Filter
                <div class="col-auto">
                    <select
                        class="form-control"
                        @change="categoryFilter()"
                        v-model="categoryId"
                    >
                        <option selected>Select One category</option>
                        <option
                            v-for="category in categories"
                            :value="category.id"
                            >{{ category.name }}</option
                        >
                    </select>
                </div>

                <div
                    class="col-sm-auto"
                    @change="subCategoryFilter()"
                    v-show="subCategories"
                >
                    <select class="form-control" v-model="subCategoryId">
                        <option value="0">Select One Subcategory</option>
                        <option
                            v-for="sub_category in subCategories"
                            :value="sub_category.id"
                            >{{ sub_category.name }}</option
                        >
                    </select>
                </div>
            </div>
            <!-- <div class="text-center" :class="value"><img src="image/ajax-loader.gif" /></div> -->
            <div class="products_box" v-for="(product, index) of updateProduts">
                <div class="product_item">
                    <div class="row">
                        <div class="col-4">
                            <a :href="/customer/ + product.id">
                                <img
                                    class="img-fluid"
                                    v-bind:src="/storage/ + product.image"
                                    alt="product-image"
                                />
                            </a>
                        </div>

                        <div class="col-8">
                            <h2 class="product_name">
                                <a :href="/customer/ + product.id">{{
                                    product.name
                                }}</a>
                            </h2>
                            <h6 class="product_description">
                                {{ product.description }}
                            </h6>
                            <h3 class="product_price">
                                <span>$</span>{{ product.price }}
                            </h3>
                            <button class="btn btn-primary  mr-2 float">
                                <i
                                    @click="info(product.id)"
                                    class="fas fa-info-circle"
                                >
                                </i>
                            </button>
                        </div>
                    </div>
                </div>
                <br />
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    name: "Home",
    props: {
        products: Array,
        categories: Array
    },
    mounted() {
        this.$emit("mounted");
    },
    data() {
        return {
            categoryId: "",
            subCategories: [],
            subCategoryId: [],
            updateProduts: this.products
        };
    },
    methods: {
        info(id) {
            console.log(id);
            window.location.href = "/customer/" + id;
        },
        categoryFilter() {
            console.log(this.categoryId);
            axios
                .get("/category/" + this.categoryId)
                .then(response => {
                    Event.error = "";
                    if (response.status === 200) {
                        this.subCategories = response.data.categories;
                        console.log(response.data.products);
                        this.updateProduts = response.data.products;
                    }
                })
                .catch(error => {
                    this.subCategories = "";
                });
        },

        subCategoryFilter() {
            console.log(this.subCategoryId, "iiasdhkjashdjksahd");
            axios
                .get(
                    "category/" +
                        this.categoryId +
                        "/subcategory/" +
                        this.subCategoryId
                )
               
                .catch(error => {
                    this.subCategories = "";
                });
        }
    }
};
</script>

<template>
    <div> 
     <table class="table table-bordered table-sm table-striped text-center">
        <thead>
            <tr>
            <th scope="col "></th>
            <th scope="col">image</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
            </tr>
        </thead>


        <tbody>
                <tr v-for="(product) in wishlist">
                <td class="v-align-middle" width="50px">
                    <a class="p-0" href="#"   @click="deleted(product.id)" data-toggle="modal" :data-index="product.id"
                    data-backdrop="static" data-target="#modal-delete-cart-item">
                    <i class="fas fa-times text-danger"></i></a>
                </td>
                <td class="v-align-middle" width="70px">
                    <img class="img-thumbnail" :src="/storage/ + product.image" v-if="(product.image)">
                    <img v-else src="/images/no_image_found.jpg" class="img-thumbnail">
                </td>
                <td class="v-align-middle" width="400px">{{product.name}}</td>
                <td class="v-align-middle" width="200px">${{product.price}}</td>
             <td><button class="btn btn-primary" @click="addtoCart(product.id)"> <i class="fas fa-cart-plus"></i></button></td>
                </tr>
        </tbody>
         <tfoot>
        </tfoot>
     </table>
  
    </div>
 </div>
</template>
<script>
import axios from 'axios';
export default {
    name:"Customer-Wishlist",
     props: {
        wishlist: Array,
    },
    methods: {
        addtoCart(id) {
            axios
                .post("/addtocart", {
                    product_id: id,
                    quantity: 1
                })
               
                .then(response => {})
                .catch(error => {
                    this.subCategories = "";
                });
                 
            axios
                .delete("/wishlist/" + id, {
                    product_id: id,
                    status: true
                })
                .then(response => {
                window.location.href = "/wishlist";
                });
    
        },
         deleted(id) {
            console.log(id);
            axios.delete("/wishlist/" + id).then(responce => {
                window.location.href = "/wishlist";
            });
         }
             

    },

}
</script>
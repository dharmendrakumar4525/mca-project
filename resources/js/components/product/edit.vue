<template>
    <div>
          <form @submit.prevent="submitForm"  class="form">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter name" required v-model="product.name">
                  <div class="alert-danger" v-if="errors['name']" v-text="errors['name'][0]"></div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" placeholder="Enter description" required v-model="product.description">
                  <div class="alert-danger" v-if="errors['description']" v-text="errors['description'][0]"></div>
            </div>
            <div class="form-group">
                <label>Unit iN Stock</label>
                <input type="text" class="form-control" placeholder="Unit in Stock" required v-model="product.unit_in_stock">
                  <div class="alert-danger" v-if="errors['unit_in_stock']" v-text="errors['unit_in_stock'][0]"></div>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" class="form-control" placeholder="Enter price" required v-model="product.price">
                  <div class="alert-danger" v-if="errors['price']" v-text="errors['price'][0]"></div>
            </div>
             <div class="form-group">
                 <label>Select Category</label>
                <select  class="form-control"  @change="getSubcategories()" v-model="categoryId" >
                            <option value="0">Select One category</option>
                            <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                </select>
             </div>
             <div class="alert-danger" v-if="errors['category_id']" v-text="errors['category_id'][0]"></div>
                <div class="form-group"  v-show="subCategories.length>1">
                 <label>Select  Sub Category</label>
                <select  class="form-control"  v-model="SubCategoryId" >
                            <option value="0">Select One Subcategory</option>
                             <option v-for="sub_category in subCategories" :value="sub_category.id">{{sub_category.name}}</option>
                </select>
             </div>
              <div class="form-group">
                    <label>Image</label>
                         <input type="file" name="image" class="form-control" v-on:change="onImageChange">
                           <div class="alert-danger" v-if="errors['image']" v-text="errors['image'][0]"></div>
             </div>
            <div class="col-4">
              <img  class="img" v-bind:src="url" border="7" height="100" width="100" alt="product-image"/>
             </div><br>
            <button  type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>
<script>
export default {
    name: "ProductEdit",
    data(){
        return{
              categoryId:"", 
              SubCategoryId:'', 
              subCategories:'',
              image: null,
              url : "/storage/" + this.product.image,
              errors:[]
        }
    },
     props:{
        product:Object,
        categories:Array
     },
     methods: {
         onImageChange(e){
                this.product.image = e.target.files[0];
            },
              submitForm:function(e) {
                
                    e.preventDefault();
                    let formData = new FormData();
                    console.log( this.image);
                console.log("dharmendra");
                    formData.append('image', this.product.image);
                    formData.append('name', this.product.name);
                    formData.append('category_id', this.categoryId);
                    formData.append('subcategory_id', this.SubCategoryId);
                    formData.append('price', this.product.price);
                    formData.append('description', this.product.description);
                    formData.append('unit_in_stock', this.product.unit_in_stock);
                    formData.append('_method', 'PUT');
                    console.log(formData);
                    axios.post('/product/'+this.product.id, formData,
                    {headers: {"Content-Type": "multipart/form-data"}})
                    
                  .then(response => {
                   
                      console.log("hkjashdj");
                      window.location.href = "/product";
                      
                    Event.errors = "";
                    if (response.status === 200) {
                         

                    }
                     })
                .catch(error => {
                     console.log(error.response.data.errors);
                        this.errors=  error.response.data.errors;
                 });
            },
           getSubcategories(){
                console.log(this.categoryId);
                axios
                .get("/category/"+this.categoryId)
                .then(response => {
                    Event.error = "";
                    if (response.status === 200) {
                        this.subCategories=response.data.categories;
                        console.log(response.data.categories)
                    }
                })
                .catch(error => {
                     this.subCategories="";
                      this.errors=  error.response.data.errors;
                 });
            },
     },
};
</script>

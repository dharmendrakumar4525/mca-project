<template>
    <div>
        <div class="card text-center"></br>
         <form id="app" @submit.prevent="submitForm" method="post" class="form">
                <div class="input-group mt-2">
                    <span class="input-group-text">Product Name</span>
                    <input type="text"  v-model="name"  class="form-control"    name="name" placeholder="Enter The Name of Product"/> 
                </div>
                <div class="alert-danger" v-if="errors['name']" v-text="errors['name'][0]"></div>

                <div class="input-group mt-2">
                    <span class="input-group-text ">Price</span>
                    <input type="text" v-model="price" class="form-control"  name="price" placeholder="Enter the Price"/>
                </div>
                <div class="alert-danger" v-if="errors['price']" v-text="errors['price'][0]"></div>

                <div class="input-group mt-2">
                    <div class="input-group-text">Descriptions</div>
                    <input type="text" v-model="descriptions" class="form-control" name="descriptions" placeholder="Enter the Descriptions"/>
                </div>
                <div class="alert-danger" v-if="errors['description']" v-text="errors['description'][0]"></div>

                <div class="input-group mt-2">
                    <span class="input-group-text " id="basic-addon1">Category Name</span>
                    <select  class="form-control"  @change="getSubcategories()" v-model="categoryId" >
                         <option selected >Select One category</option>
                         <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                    </select>
                </div>
                 <div class="alert-danger" v-if="errors['category_id']" v-text="errors['category_id'][0]"></div>

                  <div class="input-group mt-2 " v-show="subCategories.length>1">
                        <span class="input-group-text " id="basic-addon1">Sub Category Name</span>
                        <select  class="form-control" v-model="subCategoryId" >
                            <option value=0>Select One Subcategory</option>
                            <option v-for="sub_category in subCategories" :value="sub_category.id">{{sub_category.name}}</option>
                        </select>
                  </div>
                  <div class="input-group mt-2">
                        <span class="input-group-text " id="basic-addon1">Image</span>
                         <input type="file" name="image" class="form-control" v-on:change="onImageChange">
                 </div>
                  <div class="alert-danger" v-if="errors['image']" v-text="errors['image'][0]"></div>

                  <div class="input-group mt-2">
                    <span class="input-group-text " id="basic-addon1">Unit In Stock</span>
                    <input type="text" v-model="unitInStock" class="form-control" name="name" placeholder="Stock"/>
                  </div>
                   <div class="alert-danger" v-if="errors['unit_in_stock']" v-text="errors['unit_in_stock'][0]"></div><br>
                  <div class="center">
                     <input type="submit" class="btn btn-primary" value="Submit" />
                 </div><br>
         </form>
        </div>
    </div>
</template>
<script>
export default {
    name: "ProductCreate",
     props: {
        categories: Array
    },
    data(){
        return{
            name:'',
            price:'',
            descriptions:'',
            categoryId:'',
            subCategories:[],
            unitInStock:'',
            subCategoryId:'',
            errors:[],
            selected:''
        }
    },
      methods:{
             onImageChange(e){
                this.image = e.target.files[0];
            },
            submitForm:function(e) {
               console.log("gagsd");
                       e.preventDefault();
                    let formData = new FormData();
                    formData.append('image', this.image);
                    formData.append('name', this.name);
                    formData.append('category_id', this.categoryId);
                    formData.append('subcategory_id', this.subCategoryId);
                    formData.append('price', this.price);
                    formData.append('description', this.descriptions);
                    formData.append('unit_in_stock', this.unitInStock);
                    axios.post('/product', formData)
                  .then(response => {
                    Event.error = "";
                    if (response.status === 200) {
                        this.subCategories=response.data.categories;
                             window.location.href = "/product/";
                    }
                })
                 .catch(error => {
                     console.log(error.response.data.errors);
                        this.errors=  error.response.data.errors;
                 });
            },
           getSubcategories(){
                axios
                .get("/category/"+this.categoryId)
                .then(response => {
                    Event.error = "";
                    if (response.status === 200) {
                        this.subCategories=response.data.categories;
                    }
                })
                .catch(error => {
                     this.subCategories="";
                 });
            },
      }  
  }
</script>

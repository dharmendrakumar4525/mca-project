<template>
    <div class="card justify-content-center">
        <div class="text-center form card  col">
            <div>
                <label for="street">Address Line 1</label><br />
                <input  class="form-control" type="text"  v-model="form.address_line1" :class="{ 'is-invalid': form.errors.has('address_line1') }"  />
                <span  class="help-block invalid-feedback" v-show="form.errors.has('address_line1')" v-text="form.errors.first('address_line1')"
                ></span>
            </div>
            <div>
                <label for="street">Street</label><br />
                <input class="form-control" type="text" v-model="form.street" :class="{ 'is-invalid': form.errors.has('street') }" />
                <span class="help-block invalid-feedback" v-show="form.errors.has('street')" v-text="form.errors.first('street')"></span>
            </div>
            <div>
                <label for="city">City</label><br />
                 <input class="form-control" type="text" v-model="form.city" :class="{ 'is-invalid': form.errors.has('city') }" />
                <span class="help-block invalid-feedback" v-show="form.errors.has('city') "
                      v-text="form.errors.first('city')"></span>
            </div>
             <div>
                <label for="state">State</label><br />
                <input class="form-control" type="text" v-model="form.state" :class="{ 'is-invalid': form.errors.has('state') }" />
                <span class="help-block invalid-feedback" v-show="form.errors.has('state') "
                      v-text="form.errors.first('state')"></span>
            </div>
            <div>
                <label for="postcode">Zip Code</label><br />
                <input class="form-control" type="text" v-model="form.zip" :class="{ 'is-invalid': form.errors.has('zip') }" />
                <span class="help-block invalid-feedback" v-show="form.errors.has('zip')"
                      v-text="form.errors.first('zip')"></span>
            </div>
            <div>
                <label for="country">Country</label><br />
                <input class="form-control" type="text" v-model="form.country"  :class="{ 'is-invalid': form.errors.has('country') }"/>
                <span class="help-block invalid-feedback" v-show="form.errors.has('country') " 
                      v-text="form.errors.first('country')"></span>
            </div> 
              <div>
                <label for="country">PostCode</label><br />
                <input class="form-control" type="text" v-model="form.postcode"  :class="{ 'is-invalid': form.errors.has('postcode') }"/>
                <span class="help-block invalid-feedback" v-show="form.errors.has('postcode') " 
                      v-text="form.errors.first('postcode')"></span>
            </div> 
            <br />
            <div>
                <input
                    type="button"
                    class="form-control btn btn-primary"
                    @click="addAdderss()"
                    value="Add Address"
                />
            </div>
            <br />
        </div>
    </div>
</template>

<script>
import Form from "form-backend-validation";
export default {
    data() {
        return {
            form: new Form(["address_line1",'state', "zip",'street','city','postcode','country']),
        };
    },
    components: { Form },
    methods: {
        addAdderss() {
                this.form.post("/user-address", this.form)
                .then(response => {
                    
                })
                .catch(error => {});
        }
    }
};
</script>

<style scoped>
.information {
    width: 50%;
    margin: 15px 0px;
}
.information input {
    width: 100%;
    padding: 5px;
    margin: 5px 0px;
}
</style>

<template>
    <div>
        <div class="card mb-3 mt-3">
            <div class="card-header"><strong>Mailing Addresses</strong></div>
            <div class="card-body">
                <div class="row">
                    <div
                        class="col-lg-4 col-md-6 col-sm-12 mb-3"
                        v-for="(address, index) in addresses"
                    >
                        <div class="card shadow">
                            <div class="card-body notranslate">
                                <input type="radio"  @click= selectAddress(address.id) :value="address.id" v-model="picked" />
                                {{ address.address_line1 }} {{ address.zip
                                }}<br />
                                {{ address.city }}, {{ address.state }} <br />
                                <span> country : {{ address.country }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row"></div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        addresses: Array
    },
    data() {
        return {
          picked: ''
        };
    },
    methods: {
      selectAddress(id){
          axios 
          .get('/user-address/'+ id)
          .then(function(response) {
                   if(response.status ===200){
                     alert("address is selected");
                   }
                   
                })
      }
    },
};
</script>

<template>
  <div class="card justify-content-center" style="width: 70rem">
    <h5 class="card-title offset-6">Profile</h5>
    <ul class="list-group list-group-flush">
      <li />
      <li class="list-group-item">
        <div v-show="isEditable['name'] === false">
          Name:
          <label @click="enableEdit('name')" v-text="name" /><i
            class="fas fa-pen"
            @click="enableEdit('name')"
          />
        </div>
        <input
          type="text"
          v-model="name"
          @blur="saveValue('name', name)"
          value="name"
          v-show="isEditable['name'] === true"
        >
      </li>
      <li class="list-group-item">
        <div v-show="isEditable['email'] === false">
          email:
          <label @click="enableEdit('email')" v-text="email" />
          <i class="fas fa-pen" @click="enableEdit('email')" />
        </div>
        <input
          type="text"
          v-model="email"
          @blur="saveValue('email', email)"
          value="email"
          v-show="isEditable['email'] === true"
        >
      </li>
      <li class="list-group-item">
        <div v-show="isEditable['address'] === false">
          address:
          <label @dblclick="enableEdit('address')" v-text="address" />
          <i class="fas fa-pen" @click="enableEdit('address')" />
        </div>
        <input
          type="text"
          v-model="address"
          @blur="saveValue('address', address)"
          value="address"
          placeholder="address"
          v-show="isEditable['address'] === true"
        >
      </li>
      <li class="list-group-item">
        <div v-show="isEditable['phone'] === false">
          Phone Number:
          <label @dblclick="enableEdit('phone')" v-text="phone" />
          <i class="fas fa-pen" @click="enableEdit('phone')" />
        </div>
        <input
          type="text"
          v-model="phone"
          @blur="saveValue('phone', phone)"
          value="phone"
          v-show="isEditable['phone'] === true"
        >
      </li>
    </ul>
  </div>
</template>
<script>
import axios from 'axios';

export default {
    props: {
        user: Object
    },

    data() {
        return {
            name: this.user['name'],
            phone: this.user['phone'],
            email: this.user['email'],
            address: this.user['address'],
            userid: this.user['id'],
            image: '/storage/' + this.user['image'],

            isEditable: {
                name: false,
                email: false,
                address: false,
                phone: false,
                Responce: ''
            },
            field: ''
        };
    },
    methods: {
        enableEdit(field) {
            this.isEditable[field] = true;
        },
        saveValue(field, value) {
            this.isEditable[field] = false;
            let event = this;
            if (this.vaule == '') {
                console.log('emoty');
            } else {
                axios.post('/profile', {
                        data: { value: value, field: field }
                    })
                    .then(function(response) {
                        console.log('fine', response.data);
                        alert(response.data.message);
                        })  .catch(function() {
                    console.log('FAILURE!!')});
            }
        },
        PostImage() {
            let self = this;
            var formData = new FormData();
            let event = this;
            var file = document.getElementById('file-upload').files[0];
            formData.append('file', file);
            axios
                .post('/profile', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    console.log('fine', response.data.data.image);
                    event.image = '/storage/' + response.data.data.image;
                })
                .catch(function() {
                                });
        }
    }
};
</script>

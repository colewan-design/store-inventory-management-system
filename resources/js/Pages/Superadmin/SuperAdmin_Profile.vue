<template>
  <v-card height="100vh">
    <v-layout>
      <superadmin-navigation></superadmin-navigation>

      <v-main>
        <v-toolbar color="primary" dark>
        <v-toolbar-title>Super Admin's Profile</v-toolbar-title>
      </v-toolbar>
        <v-container fluid>
    <v-card class="mt-5">
     
      <v-card-text>
        <v-row>
          <v-col cols="12" sm="6">
            <v-card class="pa-5">
              <v-card-title class="pb-4">Personal Information</v-card-title>
              <v-list>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title class="font-weight-bold">Complete Name:</v-list-item-title>
                    <v-list-item-subtitle>{{ userName }}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title class="font-weight-bold">Email:</v-list-item-title>
                    <v-list-item-subtitle>{{ email }}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item v-if="contactNumber">
                  <v-list-item-content>
                    <v-list-item-title class="font-weight-bold">Contact Number:</v-list-item-title>
                    <v-list-item-subtitle>{{ contactNumber }}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
            </v-card>
          </v-col>
          <v-col cols="12" sm="6">
            <v-card class="pa-5">
              <v-card-title class="pb-4">Contact Information</v-card-title>
              <v-form>
                <v-text-field
                  label="Contact Number"
                  required
                  v-model="contactNumber"
                  outlined
                ></v-text-field>
                <v-btn color="primary" class="mt-5" @click="saveContactNumber">Save</v-btn>
              </v-form>
            </v-card>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-container>

      </v-main>
    </v-layout>
  </v-card>
</template>

    
    <script>
import SuperadminNavigation from "../Navigation/SuperadminNavigation.vue";
export default {
  components:{
    SuperadminNavigation: SuperadminNavigation,
  },
};
</script>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      userName: '',
      email: '',
      dialog: false,
    };
  },
  mounted() {
    const authToken = localStorage.getItem('auth_token');

    axios.get('/user', {
        headers: {
            'Authorization': `Bearer ${authToken}`
        }
    })
    .then(response => {
        this.userName = response.data.name;
        this.email = response.data.email;
    })
    .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
            window.location.href = '/'; // Redirect to login page
        }
    });
},
};
</script>
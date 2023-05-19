<template>
  <main>
    <v-card height="100vh">
      <v-layout>
        <v-navigation-drawer clipped permanent>
          <v-toolbar color="primary" dark>
            <v-toolbar-title class="text-h6">Student Management Suite</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon @click="showLogoutModal = true">
              <v-icon>mdi-logout</v-icon>
            </v-btn>
            <!-- Logout Modal -->
            <v-dialog v-model="showLogoutModal" max-width="400">
              <v-card>
                <v-card-title>Logout Confirmation</v-card-title>
                <v-card-text>Are you sure you want to logout?</v-card-text>
                <v-card-actions>
                  <v-btn color="primary" text @click="logout">Confirm</v-btn>
                  <v-btn color="grey" text @click="showLogoutModal = false">Cancel</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
          <v-list-item class="px-2">
            <v-list-item>
              <v-list-item-avatar style="height: 100px; margin: 20px auto; width: 100px; display: block;">
                <img src="./img/superadmin.png">
              </v-list-item-avatar>
            </v-list-item>
          </v-list-item>
          <v-list-item to="./superadmin_profile" style="text-align: center; font-size: larger;">
            <v-list-item-content>
              <v-list-item-title class="text-h6">{{ userName }}</v-list-item-title>
              <v-list-item-subtitle>{{ email }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-divider></v-divider>
  
          <v-list dense>
      <!-- Super Admin Dashboard -->
      <v-list-item to="/Superadmin_Dashboard">
        <v-list-item-icon>
          <v-icon color="primary">mdi-view-dashboard</v-icon>
        </v-list-item-icon>
        <v-list-item-title class="text-uppercase">Dashboard</v-list-item-title>
      </v-list-item>

      <!-- Teachers Information -->
      <v-list-item to="/teacher_information">
        <v-list-item-icon>
          <v-icon color="success">mdi-account-group</v-icon>
        </v-list-item-icon>
        <v-list-item-title class="text-uppercase">Teachers Information</v-list-item-title>
      </v-list-item>

      <!-- Students Information -->
      <v-list-item to="/student_information">
        <v-list-item-icon>
          <v-icon color="warning">mdi-account-multiple</v-icon>
        </v-list-item-icon>
        <v-list-item-title class="text-uppercase">Students Information</v-list-item-title>
      </v-list-item>

      <!-- Parents Information -->
      <v-list-item to="/parent_information">
        <v-list-item-icon>
          <v-icon color="error">mdi-account-heart</v-icon>
        </v-list-item-icon>
        <v-list-item-title class="text-uppercase">Parents Information</v-list-item-title>
      </v-list-item>

      <!-- Staff Information -->
      <v-list-item to="/staff_information">
        <v-list-item-icon>
          <v-icon color="info">mdi-account-tie</v-icon>
        </v-list-item-icon>
        <v-list-item-title class="text-uppercase">Staff Information</v-list-item-title>
      </v-list-item>

    </v-list>
          </v-navigation-drawer>
        </v-layout>
      </v-card>
      </main>
    </template>

<script>
export default {
  data() {
    return {
      showLogoutModal: false,
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
  name: 'SuperadminNavigation',
  components: {},
  methods: {
    logout() {
        const authToken = localStorage.getItem('auth_token');
        axios.post('/logout', null, {
            headers: {
                'Authorization': `Bearer ${authToken}`
            },
            withCredentials: true
        })
        .then(response => {
            // handle successful logout
            window.location.href = '/';
        })
        .catch(error => {
            // handle logout error
        });
        // Hide the modal
    this.showLogoutModal = false;
    },
},
};
</script>


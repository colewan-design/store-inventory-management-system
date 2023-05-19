<template>
  <v-app id="inspire">
      <v-main>
          <v-container fluid fill-height>
              <v-layout align-center justify-center>
                  <v-flex xs12 sm8 md4>
                      <v-card class="elevation-12">
                        <v-card-title>
              <v-layout align-center justify-space-between>
                <h3 class="headline">
                 Store Management System
                </h3>
              </v-layout>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <p>Sign in with your Email and Password:</p>
              <v-form @submit.prevent="login">
                <v-text-field
                    outline
                    label="Email"
                    type="email"
					name="email"
                    v-model="email"></v-text-field>
                <v-text-field
                    outline
                    hide-details
					name="password"
                    label="Password"
                    type="password"
                    v-model="password"></v-text-field>
                    <v-card-actions :class="{ 'pa-3': $vuetify.breakpoint.smAndUp }">
              <v-spacer></v-spacer>
              <v-btn color="info" type="submit">
                Login
              </v-btn>
            </v-card-actions>
		  <v-alert v-if="errorMessage" type="error">{{ errorMessage }}</v-alert>
            
              </v-form>
            </v-card-text>
                  </v-card>
              </v-flex>
          </v-layout>
      </v-container>
  </v-main>
</v-app>
</template>
<script>
  export default {
      data() {
          return {
              email: '',
              password: '',
              errorMessage: '',
          };
      },
      methods: {
          async login() {
              axios.post('/login', {
                  email: this.email,
                  password: this.password,
              })
              .then(response => {
                  // handle successful login
                  if (response.data.token) {
                    localStorage.setItem('auth_token', response.data.token);
                      const userRole = response.data.user.role; // assuming the API returns the user's role
                      let targetRoute = '';
                      switch (userRole.toLowerCase()) {
                        case 'superadmin':
                            targetRoute = '/Superadmin_Dashboard';
                            break;
                          default:
                              // handle unknown role
                              break;
                      }
                      if (this.$route.path !== targetRoute) {
                          this.$router.push(targetRoute);
                      }
                  }
              })
              .catch(error => {
                  // handle login error
                  if (error.response && error.response.status === 401) {
                      // incorrect email or password
                      this.errorMessage = "Incorrect email or password";
                  } else {
                      // other login error
                      this.errorMessage = "Error logging in. Please try again later.";
                  }
              });
          },
      },
  };
</script>
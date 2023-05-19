<template>
    <v-card>
        <v-card-title>
          School Fees and Miscellaneous Charges
          <v-spacer></v-spacer>
          
        </v-card-title>
        <v-card-text>
          <v-list>
            <v-list-item>
              <v-list-item-title>Tuition Fee:</v-list-item-title>
              <v-list-item-subtitle>Php 1000.00</v-list-item-subtitle>
            </v-list-item>
            <v-list-item>
              <v-list-item-title>Library Fee:</v-list-item-title>
              <v-list-item-subtitle>Php 100.00</v-list-item-subtitle>
            </v-list-item>
            <v-list-item>
              <v-list-item-title>Computer Fee:</v-list-item-title>
              <v-list-item-subtitle>Php 150.00</v-list-item-subtitle>
            </v-list-item>
            <v-list-item>
              <v-list-item-title>Miscellaneous Charges:</v-list-item-title>
              <v-list-item-subtitle>Php 50.00</v-list-item-subtitle>
            </v-list-item>
          </v-list>
        </v-card-text>
      </v-card>
</template>

<script>
export default {
  data() {
    return {
      showDialog5: false,
    };
  },
};
</script>
<template>
    <v-card>
      <v-card-title>Child Grades</v-card-title>
      <v-card-text>
        <p>Name: {{ childName }}</p>
        <p>Age: {{ childAge }}</p>
        <p>Grade: {{ childGrade }}</p>
        <p>{{ message }}</p>
      </v-card-text>
    </v-card>
  </template>
  
  <script>
  export default {
    props: {
      childName: {
        type: String,
        required: true,
      },
      childAge: {
        type: Number,
        required: true,
      },
      childGrade: {
        type: String,
        required: true,
      },
      message: {
        type: String,
        required: true,
      },
    },
  };
  </script>
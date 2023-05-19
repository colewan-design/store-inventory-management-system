<template>
  <v-card>
    <v-card-title>Student's Clubs and Competitions</v-card-title>
    <v-card-text>
      <p>Name: {{ childName }}</p>
      <p>Age: {{ childAge }}</p>
      <p>Grade: {{ childGrade }}</p>

      <v-expansion-panels>

          <v-expansion-panel style="margin-bottom: 20px; background-color: blueviolet; color: white; font-weight: bolder;">

            <v-expansion-panel-header>
              STUDENT'S CLUBS
            </v-expansion-panel-header>

            <v-expansion-panel-content>
              <ul>
                <li>Club 1</li>
                <li>Club 2</li>
                <li>Club 3</li>
              </ul>
            </v-expansion-panel-content>

      </v-expansion-panel>

<v-expansion-panel style="margin-bottom: 20px; background-color: coral; color: white; font-weight: bolder;">

  <v-expansion-panel-header>
    STUDENT'S COMPETITIONS' CERTIFICATES
  </v-expansion-panel-header>

  <v-expansion-panel-content>
    <ul>
      <li>Certificate 1</li>
      <li>Certificate 2</li>
      <li>Certificate 3</li>
    </ul>
  </v-expansion-panel-content>

</v-expansion-panel>

</v-expansion-panels>


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

  
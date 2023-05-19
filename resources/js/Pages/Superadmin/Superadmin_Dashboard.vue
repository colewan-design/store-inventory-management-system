<template>
  <v-card height="100%">
    <v-layout>
      <superadmin-navigation></superadmin-navigation>

  <v-main>
  <v-toolbar color="primary" dark>
    <v-toolbar-title>Superadmin</v-toolbar-title>
  </v-toolbar>

  <v-card style="margin: 5px;">
    <v-card-title style="font-weight: bolder; font-size: x-large;">Dashboard</v-card-title>

    <v-row style="margin: 5px;">
      <v-col cols="12" md="6" lg="4">
        <v-card style="outline: auto;">
          <v-card-title>Users</v-card-title>
          <v-card-text>
            <v-list>
              <v-list-item to="/accounts">
                <v-list-item-icon>
                  <v-icon>mdi-account-box-multiple</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>View All Users</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-list-item>
                <v-list-item-icon>
                  <v-icon>mdi-account-plus</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>Add New User</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="12" md="6" lg="4">
        <v-card style="outline: auto;">
          <v-card-title>Clasess</v-card-title>
          <v-card-text>
            <v-list>
              <v-list-item>
                <v-list-item-icon>
                  <v-icon>mdi-school</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>View All Clasess</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-list-item>
                <v-list-item-icon>
                  <v-icon>mdi-plus</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>Add New Class</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="12" md="6" lg="4">
        <v-card style="outline: auto;">
          <v-card-title>Reports</v-card-title>
          <v-card-text>
            <v-list>
              <v-list-item>
                <v-list-item-icon>
                  <v-icon>mdi-file-document-outline</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>Attendance Report</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-list-item>
                <v-list-item-icon>
                  <v-icon>mdi-file-chart-outline</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>Performance Report</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-row style="margin: 5px;">
      <v-col cols="12" md="6" lg="4">
        <v-card style="outline: auto;">
          <v-card-title>Staff Present Today</v-card-title>
          <v-card-text>
            <!-- Add your staff present today data here -->
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="12" md="6" lg="4">
        <v-card style="outline: auto;">
          <v-card-title>Students Present Today</v-card-title>
          <v-card-text>
            <!-- Add your student present today data here -->
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="12" md="6" lg="4">
        <v-card style="outline: auto;">
          <v-card-title>Fees Awaiting Payment</v-card-title>
          <v-card-text>
            <!-- Add your fees awaiting payment data here -->
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row style="margin: 5px;">
      <v-col cols="12">
        <v-card style="outline: auto;">
          <v-card-title>Recent Activities</v-card-title>
          <v-card-text>
            <!-- Add your recent activities data here -->
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-row style="margin: 5px;">
      <v-col cols="12">
        <v-card style="outline: auto;">
          <v-card-title>Charts</v-card-title>
                <!-- <Bar
          id="my-chart-id"
          :options="chartOptions"
          :data="chartData"
        /> -->
        </v-card>
      </v-col>
    </v-row>

  </v-card>
  
</v-main>

    </v-layout>
  </v-card>
  
</template>

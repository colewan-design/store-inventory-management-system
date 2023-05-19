<template>
  <v-card>
    <v-card-title>Child Profile</v-card-title>
    <v-card-text class="pdf-content">
      <p>Name: {{ childName }}</p>
      <p>Age: {{ childAge }}</p>
      <p>Grade: {{ childGrade }}</p>
      <p>LRN: {{ childLRN }}</p>
      <p>Interests: {{ interests }}</p>
      <p>Address: {{ childAdd }}</p>
      <p>Birth Date: {{ childBDay }}</p>
    </v-card-text>
    <v-card-actions>
      <v-btn @click="downloadPDF" color="primary">Download PDF</v-btn>
      <v-btn @click="downloadExcel" color="success">Download Excel</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import * as XLSX from 'xlsx';

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
    childLRN: {
      type: String,
      required: true,
    },
    interests: {
      type: String,
      required: true,
    },
    childAdd: {
      type: String,
      required: true,
    },
    childBDay: {
      type: String,
      required: true,
    },
  },
  methods: {
    downloadPDF() {
      const authToken = localStorage.getItem('auth_token');
      const account_id = this.account_id ?? '';
      const queryParams = `?account_id=${account_id}`; // Add this to the URL
      axios.get(`/students/profilepdf${queryParams}`, {
      headers: {
        'Authorization': `Bearer ${authToken}`
      },
      responseType: 'blob'
      })

      .then(response => {
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'students.pdf');
        document.body.appendChild(link);
        link.click();
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
    downloadExcel() {
      /* generate worksheet */
      const ws = XLSX.utils.json_to_sheet([{
        "Name": this.childName,
        "Age": this.childAge,
        "Grade": this.childGrade,
        "LRN": this.childLRN,
        "Interests": this.interests,
        "Address": this.childAdd,
        "Birth Date": this.childBDay,
      }]);

      /* generate workbook and add the worksheet */
      const wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, "Child Profile");

      /* save to file */
      XLSX.writeFile(wb, 'child-profile.xlsx');
    }
  }
};
</script>

<template>
    <div>
        <h3>Sales Yearly Report</h3>
        
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'reports'}" class="btn btn-warning">Print</router-link>
          </div>
        </div><br />
          <table class="table table-hover table-striped table-responsive">
           <tr v-for="sale in sales">
           <th>{{sale.year}}</th><td>{{sale.sales}}</td>
           </tr>
        </table>
    </div>
</template>


<script>

    export default {
       
        data(){
            return{
               
        sales:[]
               
         }
        },

        created: function()
        {
            this.fetchInventoryReports();
        },

        methods: {
            fetchInventoryReports()
            {
              let uri = 'http://localhost/ims/public/api/reports/${id}';
              this.axios.get(uri).then((response) => {
                  this.sales = response.data;
                  console.log(this.sales)
              });
            }
            
        }
    }
</script>
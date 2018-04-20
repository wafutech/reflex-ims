<template>
    <div>
        <h3>Purchase Order Yearly Report</h3>
        
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'reports'}" class="btn btn-warning">Print</router-link>
          </div>
        </div><br />
          <table class="table table-hover table-striped table-responsive">
           <tr v-for="order in orders">
           <th>{{purchase.year}}</th><td>{{purchase.purchaseAmount}}</td>
           </tr>
        </table>
    </div>
</template>


<script>

    export default {
       
        data(){
            return{
               
        purchases:[]
               
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
                  this.purchases = response.data;
                  console.log(this.purchases)
              });
            }
            
        }
    }
</script>
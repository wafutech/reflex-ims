<template>
    <div>
        <h3>Sales By Product</h3>
        
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'reports'}" class="btn btn-warning">Print</router-link>
          </div>
        </div><br />
          <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <td>Employee</td>
                <td>Sales</td>
                
                                
            </tr>
            </thead>

            <tbody>
                <tr  v-for="sale in sales"
            :key="sale.user_id">
                    <td>{{ sale.name}}</td>
                    <td>{{ sale.sales }}</td>
                                       
                </tr>
            </tbody>
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
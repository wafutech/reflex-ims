<template>
    <div>
        <h3>Transaction Log</h3>
        
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'reports'}" class="btn btn-warning">Print</router-link>
          </div>
        </div><br />
          <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <td>Date</td>
                <td>Transaction Code</td>
                <td>Transaction Details</td>
                <td>URL</td>
                <td>User</td>                
                                
            </tr>
            </thead>

            <tbody>
                <tr  v-for="tran in transaction">
                    <td>{{ tran.created_at }}</td>
                    <td>{{ tran.transaction_code }}</td>
                    <td>{{tran.details}}</td>
                    <td>{{tran.url}}</td>
                    <td>{{tran.name}}</td>
                                       
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>

    export default {
       
        data(){
            return{
               
        transaction:[]
               
         }
        },

        created: function()
        {
            this.fetchInventoryReports();
        },

        methods: {
            fetchInventoryReports()
            {
              let uri = 'http://localhost/ims/public/api/reports/transactions';
              this.axios.get(uri).then((response) => {
                  this.transaction = response.data;
                  console.log(this.transaction)
              });
            }
            
        }
    }
</script>
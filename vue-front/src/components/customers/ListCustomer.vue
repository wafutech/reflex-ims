<template>
    <div>
  <h3 class="title">Customers <span class="pull-right"><router-link :to="{ name: 'create-customer'}" class="btn btn-success">New Customer</router-link></span></h3>

    
  <div class="panel panel-default">
  <div class="panel-heading">
  <div class="panel-title">
  <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Customer Name</th>
                <th>Cell Phone</td>
                <th>Work Phone</th>
                <th>&nbsp;</th>
                
                
            </tr>
            </thead>
            </table>
            
  </div>
  </div>
  <div class="panel-body">
  <table class="table table-striped table-hover">
  <tr  v-for="customer in customers"
            :key="customer.id">
    <td>{{ customer.customer_name }}</td>
    <td>+{{customer.phone_code}}{{ customer.mobile_number }}</td>
    <td>+{{customer.phone_code}}{{ customer.work_phone }}</td>
    <td><a href="">View All</a></td>
    </tr>
  </table>
  </div>
  </div>
          
    </div>
</template>


<script>

    export default {
       
        data(){
            return{
               
        customers:[]
               
         }
        },

        created: function()
        {
            this.fetchCustomers();
        },

        methods: {
            fetchCustomers()
            {
              let uri = 'http://127.0.0.1:8000/api/customers';
              this.axios.get(uri).then((response) => {
                  this.customers = response.data;
                  console.log(this.customers)
              });
            },
            deleteCustomer(id)
            {
              let uri = `http://127.0.0.1:8000/api/customers/${id}`;
              this.customers.splice(id, 1);
              this.axios.delete(uri);
            }
        }
    }
</script>
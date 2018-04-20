<template>
    <div>
        <h3>Customers</h3>
        
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create-customer'}" class="btn btn-primary">Add Customer</router-link>
          </div>
        </div><br />
          <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Phone</td>
                <td>Fax</td>
                <td>Work Phone</td>
                <td>Phone Code</td>
                <td>E-Mail</td>
                <td>Postal Address</td>
                <td>Town/City</td>
                <td>Postal Code</td>
                <td>Phisical Address</td>
                <td>Company</td>
                
            </tr>
            </thead>

            <tbody>
                <tr  v-for="customer in customers"
            :key="customer.id">
                    <td>{{ customer.first_name }}</td>
                    <td>{{ customer.last_name }}</td>
                    <td>{{ customer.mobile_number }}</td>
                    <td>{{ customer.fax }}</td>
                    <td>{{ customer.work_phone }}</td>
                    <td>{{ customer.phone_code}}</td>
                    <td>{{ customer.email }}</td>
                    <td>{{ customer.postal_address }}</td>
                    <td>{{ customer.town }}</td>
                    <td>{{ customer.zip }}</td>
                    
                   
                    <td>{{ customer.phisical_address }}</td>
                     <td>{{ customer.company }}</td>
                    <td><router-link :to="{name: 'edit-customer', params: { id: customer.id }}" class="btn btn-primary">Edit</router-link></td>
                    
                    <td><button class="btn btn-danger" v-on:click="deleteCustomer(customer.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
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
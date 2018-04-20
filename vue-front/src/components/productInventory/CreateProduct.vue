<template>
  <div>
    <h3 class="title">Add  Product</h3>
      <div class="alert alert-success" v-if="submitted">
                {{message}}
            </div>
        
    <form v-on:submit.prevent="addProduct">
      <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Product Name:</label>
            <input type="text" class="form-control" v-model="product.product_name">
          </div>
        </div>
        </div>

         <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Description:</label>
              <input type="text" class="form-control" v-model="product.product_description" />
            </div>
          </div>
        </div>
          
         <div v-cloak>
        <div class="row">
          <div class="col-md-10">
          <div class="form-group">
            <label>Category:</label>
            <select v-model="product.category_id" class="form-control" style="height:40px;">
            <option value="null" selected>Select Category</option>
            <option v-for="c in categories" v-bind:value="c.id">{{c.category_name}}</option> 
          </select> 

          </div>
          </div>
          </div>
        </div>


         <div v-cloak>
        <div class="row">
          <div class="col-md-10">
          <div class="form-group">
            <label>Unit Measure:</label>
            <select v-model="product.unit_id" class="form-control" style="height:40px;">
            <option value="" >Select Measure</option>
            <option v-for="u in units" v-bind:value="u.id">{{u.unit_description}}</option> 
          </select> 

          </div>
          </div>
          </div>
        </div>

        

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Unit Cost:</label>
              <input type="number" class="form-control" v-model="product.unit_cost" />
            </div>
          </div>
        </div>


           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Selling Price:</label>
              <input type="number" class="form-control" v-model="product.list_price" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Min-Order:</label>
              <input type="text" class="form-control" v-model="product.min_order" />
            </div>
          </div>
        </div>

          

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Supply Capacity:</label>
              <input type="text" class="form-control" v-model="product.supply_capacity" />
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Quantity in Stock:</label>
              <input type="number" class="form-control" v-model="product.quantity_in_stock" />
            </div>
          </div>
        </div>


           

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Re-Order Level:</label>
              <input type="text" class="form-control" v-model="product.reorder_level" />
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Re-Order Quantity:</label>
              <input type="text" class="form-control" v-model="product.reorder_quantity" />
            </div>
          </div>
        </div>


                   <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Quantity/Unit:</label>
              <input type="text" class="form-control" v-model="product.quantity_per_unit" />
            </div>
          </div>
        </div>

          <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Discountinued:</label>
              <input type="radio" value="1" class="radio" v-model="product.discontinued" />Yes</br>
              <input type="radio" value="0" checked="yes" class="radio" v-model="product.discontinued" />No
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <button class="btn btn-info pull-right">Save</button>
            </div>
          </div>
        </div>

           

        
    </form>
  </div>
</template>
<script>
  export default {
    data(){
        return{
          product:{},
          selected: 'Select Category',
          categories:[],
          submitted:false,
           message:'',
           units:[]
        }
       
    },

     created: function()
        {
            this.fetchCategories();
            this.fetchUnitofMesuares()
           
        },
    
    methods: {
      addProduct(){
        let uri = 'http://127.0.0.1:8000/api/products';
        this.axios.post(uri, this.product).then((response) => {
        this.message=response.data;
        this.submitted = true;
          //this.$router.push({name: 'list-products'})
        })
    },
    fetchCategories()
            {
              let uri = 'http://127.0.0.1:8000/api/product/categories';
              this.axios.get(uri).then((response) => {
                  this.categories = response.data;
              });
            },

          fetchUnitofMesuares()
            {
              let uri = 'http://127.0.0.1:8000/api/lists/unit-of-measures';
              this.axios.get(uri).then((response) => {
                  this.units = response.data;
                  console.log(this.units);
              });
            },
  }
}
</script>
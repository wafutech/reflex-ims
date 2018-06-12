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
            <input type="text" name="product_name" v-validate="'required|string'" class="form-control" v-model="product.product_name" autofocus>
          </div>
          <div class="help-block alert alert-danger" v-show="errors.has('product_name')">
          {{errors.first('product_name')}}
          </div>
        </div>
        </div>

         <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Description:</label>
              <input type="text" name="description" v-validate="'required|string'" class="form-control" v-model="product.product_description" />
            </div>
            <div class="help-block alert alert-danger" v-show="errors.has('description')">
          {{errors.first('description')}}
          </div>
          </div>
        </div>
          
         <div v-cloak>
        <div class="row">
          <div class="col-md-10">
          <div class="form-group">
            <label>Category:</label>
            <select v-model="product.category_id" name="category_id" v-validate="'required'" class="form-control" style="height:40px;">
            <option disabled value=''>Select Category</option>
            <option v-for="c in categories" v-bind:value="c.id">{{c.category_name}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('category_id')">
          {{errors.first('category_id')}}
          </div>

          </div>
          </div>
          </div>
        </div>


         <div v-cloak>
        <div class="row">
          <div class="col-md-10">
          <div class="form-group">
            <label>Unit Measure:</label>
            <select v-model="product.unit_id" name="unit_id" v-validate="unit_id" class="form-control" style="height:40px;">
            <option value="" >Select Measure</option>
            <option v-for="u in units" v-bind:value="u.id">{{u.unit_description}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('unit_id')">
          {{errors.first('unit_id')}}
          </div>

          </div>
          </div>
          </div>
        </div>

        

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Unit Cost:</label>
              <input type="number" name="unit_cost" v-validate="'required'" class="form-control" v-model="product.unit_cost" />
              <div class="help-block alert alert-danger" v-show="errors.has('unit_cost')">
          {{errors.first('unit_cost')}}
          </div>
            </div>
          </div>
        </div>


           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Selling Price:</label>
              <input type="number" name="list_price" v-validate="'required'" class="form-control" v-model="product.list_price" />
              <div class="help-block alert alert-danger" v-show="errors.has('list_price')">
          {{errors.first('list_price')}}
          </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Min-Order:</label>
              <input type="text" name="min_order" v-validate="'required'" class="form-control" v-model="product.min_order" />
              <div class="help-block alert alert-danger" v-show="errors.has('min_order')">
          {{errors.first('min_order')}}
          </div>
            </div>
          </div>
        </div>

          

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Supply Capacity:</label>
              <input type="text" class="form-control" v-model="product.supply_capacity" name="supply_capacity" v-validate="'required'" />

              <div class="help-block alert alert-danger" v-show="errors.has('supply_capacity')">
          {{errors.first('supply_capacity')}}
          </div>
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Quantity in Stock:</label>
              <input type="number" class="form-control" v-model="product.quantity_in_stock" name="quantity_in_stock" v-validate="'required'" />
              <div class="help-block alert alert-danger" v-show="errors.has('quantity_in_stock')">
          {{errors.first('quantity_in_stock')}}
          </div>
            </div>
          </div>
        </div>


           

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Re-Order Level:</label>
              <input type="text" class="form-control" v-model="product.reorder_level" name="reorder_level" v-validate="'required'" />
              <div class="help-block alert alert-danger" v-show="errors.has('reorder_level')">
          {{errors.first('reorder_level')}}
          </div>
            </div>
          </div>
        </div>

           <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Re-Order Quantity:</label>
              <input type="text" class="form-control" v-model="product.reorder_quantity" name="reorder_quantity" v-validate="'reorder_quantity'"/>
              <div class="help-block alert alert-danger" v-show="errors.has('reorder_quantity')">
          {{errors.first('reorder_quantity')}}
          </div>
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

     mounted: function()
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
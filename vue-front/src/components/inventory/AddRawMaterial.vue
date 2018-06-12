<template>
  <div>
   <h3 class="title">Add  Raw Material Item</h3>
      <div class="alert alert-success" v-if="submitted">
                {{message}}
            </div>
        <form v-on:submit.prevent="addRawMaterialIventory">

        <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Raw Material Name:</label>
            <input type="text" name="raw_material_name" v-validate="'required'" class="form-control" v-model="raw_material.raw_material_name" autofocus>
          </div>
          <div class="help-block alert alert-danger" v-show="errors.has('raw_material_name')">
          {{errors.first('raw_material_name')}}
          </div>
        </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Description:</label>
              <input type="text" name="description" v-validate="''" class="form-control" v-model="raw_material.raw_material_desc" />
            </div>
            <div class="help-block alert alert-danger" v-show="errors.has('raw_material_desc')">
          {{errors.first('raw_material_desc')}}
          </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Quantity in Hand:</label>
              <input type="number" name="unit_cost" v-validate="'required|numeric'" class="form-control" v-model="raw_material.quantity_in_hand" />
              <div class="help-block alert alert-danger" v-show="errors.has('quantity_in_hand')">
          {{errors.first('quantity_in_hand')}}
          </div>
            </div>
          </div>
        </div>

        <!--Unit of Measure-->
          <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Unit of Measure</label>
              <select name="unit_of_measure" v-model="raw_material.unit_of_measure" class="form-control" style="height:40px;" v-validate=" 'required'"  >
             <option v-for="unit in units" v-bind:value="unit.id">{{unit.unit_description}}</option> 
          </select> 
              <div v-show="errors.has('unit_of_measure')" class="help-block alert alert-danger">
              {{errors.first('unit_of_measure')}}
              </div>
            </div>
          </div>
        </div>



        <div class="row">
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-6">
           <div v-cloak>        
          <div class="form-group">
            <label>Prefered Supplier:</label>
            <select v-model="raw_material.prefered_supplier" name="prefered_supplier" v-validate="'required'" class="form-control" style="height:40px;">            
            <option v-for="c in suppliers" v-bind:value="c.id">{{c.company}}</option> 
          </select> 
          <div class="help-block alert alert-danger" v-show="errors.has('prefered_supplier')">
          {{errors.first('prefered_supplier')}}
          </div>
          </div>
        </div> 
        </div>
        </div>
        </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Value (The monitory value of the Qty in Hand Inventory):</label>
              <input type="number" name="starting_value" v-validate="'required'" class="form-control" v-model="raw_material.starting_value" />
              <div class="help-block alert alert-danger" v-show="errors.has('starting_value')">
          {{errors.first('starting_value')}}
          </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Re-Order Level:</label>
              <input type="text" name="min_order" v-validate="'required|numeric'" class="form-control" v-model="raw_material.reorder_level" />
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
              <input type="text" class="form-control" v-model="raw_material.reorder_quantity" name="reorder_quantity" v-validate="'required'" />

              <div class="help-block alert alert-danger" v-show="errors.has('reorder_quantity')">
          {{errors.first('reorder_quantity')}}
          </div>
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
  name:'AddRawMaterial',
    data(){
        return{
          raw_material:{},
          suppliers:{},
          submitted:false,
           message:'',
           units:{},
           message:'Saved! Add More...'
        }
       
    },

     mounted: function()
        {
            this.getSuppliers();
            this.fetchUnitofMesuares();
           
        },
    
    methods: {
      addRawMaterialIventory(){
        let uri = 'http://127.0.0.1:8000/api/raw-materials';
        this.axios.post(uri, this.raw_material).then((response) => {
        console.log(response.data);
        this.raw_material ='';
        this.submitted = true;
         
        })
    },
    getSuppliers(){
        let uri = 'http://127.0.0.1:8000/api/suppliers';
              this.axios.get(uri).then((response) => {
                  this.suppliers = response.data;
              });
    },

          fetchUnitofMesuares()
            {
              let uri = 'http://127.0.0.1:8000/api/lists/unit-of-measures';
              this.axios.get(uri).then((response) => {
                  this.units = response.data;
              });
            }
  }
}
</script>
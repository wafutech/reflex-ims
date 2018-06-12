<template>
  <div>
    <h3 class="title">Add  Ware-House</h3>
      <div class="alert alert-success" v-if="submitted">
                {{message}}
            </div>
         
        
    <form v-on:submit.prevent="addWarehouse">
      <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Ware House Name:</label>
            <input type="text" name="warehouse_name" v-validate="'required'" class="form-control" v-model="warehouse.warehouse_name" autofocus>
          </div>
          <div class="help-block alert alert-danger" v-show="errors.has('warehouse_name')">
          {{errors.first('warehouse_name')}}
          </div>
          <span class="help-block alert alert-danger" v-text="errors.get('warehouse_name')"
        </div>
        </div>

         <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Warehouse Code (Optional):</label>
              <input type="text" name="warehouse_code" v-validate="''" class="form-control" v-model="warehouse.warehouse_code" />
            </div>
            <div class="help-block alert alert-danger" v-show="errors.has('warehouse_code')">
          {{errors.first('warehouse_code')}}
          </div>
          </div>
        </div>
          
         

        

        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Location (place/town/country/region):</label>
              <input type="text" name="location" v-validate="'required'" class="form-control" v-model="warehouse.location" />
              <div class="help-block alert alert-danger" v-show="errors.has('location')">
          {{errors.first('location')}}
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
class Errors
  {
constructor()
{
  this.errors = {};
}
get(field)
{
  if(this.errors[field])
  {
    return this.errors[field][0];
  }
}

record(errors)
{
  this.errors = errors;
}
  }
  export default {
  
    data(){
        return{
          warehouse:{},
          submitted:false,
           message:'Warehouse Saved!',
           errors:new Errors()
        }
       
    },

     mounted: function()
        {
            
            this.addWarehouse();
           
        },
    
    methods: {
      addWarehouse(){
        let uri = 'http://127.0.0.1:8000/api/ware-houses';
        this.axios.post(uri, this.warehouse).then((response) => {
        this.submitted = true;
         
        })
        .catch(error=>     
        this.errors.record(error.response.data)
        );
    }
    
  }
}
</script>
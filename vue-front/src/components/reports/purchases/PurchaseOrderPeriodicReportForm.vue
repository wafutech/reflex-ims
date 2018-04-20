<template>
  <div>
    <h3>Select Date Interval</h3>
    <form v-on:submit.prevent="addCategory">
             
                    

           <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Start Date:</label>
              <input v-validate="'required'" type="date" class="form-control col-md-6 date-picker" v-model="report.start_date" />
              <span v-show="errors.has('required')">{{ errors.first('required') }}</span>
            </div>
          </div>
        </div>

            <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>End Date:</label>
              <input type="date" class="form-control col-md-6 date-picker" v-model="report.end_date" />
            </div>
          </div>
        </div>

           <br />

        <div class="form-group">
          <button class="btn btn-primary">Continue</button>
        </div>
    </form>
  </div>
</template>
<script>
  export default {
    data(){
        return{
          report:{}
        }
    },
    methods: {
      addCategory(){
        let uri = 'http://localhost/dms/public/api/reports/${id}';
        this.axios.post(uri, this.report).then((response) => {
          this.$router.push({name: 'purchase-orders-report'})
        })
    }
  }
}
</script>
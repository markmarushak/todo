<template>

    <div class="col-sm-12">

          <div class="row point" v-for="(input, index) in inputs">

           <!--  <div class="col-md-1 number-point">
                <span class="badge badge-white">
                    {{index+1}}
                </span>
            </div> -->

            <div class="col-md-10">
                <div class="form-group">
                    <div class="input-group input-group-alternative mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text">{{index+1}}</span>
                      </div>
                      <input type="text" name="point[]" class="form-control form-control-alternative" v-model="form.points" required>
                    </div>

                    

                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-icon btn-2 btn-danger" type="button" v-on:click="removePoint(index)">
                    <span class="btn-inner--icon btn-2 "><i class="ni ni-fat-remove"></i></span>
                </button>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-icon btn-2 btn-danger" type="button" v-on:click="addPoint(index)">
                    <span class="btn-inner--icon btn-2 "><i class="ni ni-fat-add"></i></span>
                    <span class="text-inner">add row</span>
                </button>
            </div>
        </div>
    </div>

</template>

<script>

    export default {
        data: function(){
            return {
                inputs:[],
                form: {
                    points: []
                }
            }
        },
        methods: {
            addPoint: function(){
                this.inputs.push({
                    one: '',
                    two: ''
                })
            },
            removePoint: function(index){
                this.inputs.splice(index,1)
            }
        }
    }

</script>


<template>

    <div class="row">
        <form id="task-form" @submit.prevent="submit" action="#">
            <div class="row">

                <div class="col-sm-12">

                    <div class="form-group">
                        <h5>Новая категория или выбрать существующею</h5>
                        <label class="custom-toggle">
                          <input type="checkbox" name="choose-category" v-model="form.category_type">
                          <span class="custom-toggle-slider rounded-circle"></span>
                      </label>

                  </div>
                  <div class="form-group" v-if="form.category_type == false">
                    <input type="text" name="category" class="form-control form-control-alternative" required="required" placeholder="Назовите категорию" v-model="form.category">
                </div>

                <div class="form-group" v-else>
                    <select name="category" class="form-control form-control-alternative" required="required" v-model="form.category">
                        <option value="">Выберите категорию</option>
                        <option  v-bind:value="c.id" v-for="c in categories">{{c.category}}</option>
                    </select>
                </div>

            </div>

        </div>

        <transition name="fade">
            <div class="row" v-if="form.category != ''">

                <div class="col-md-4">

                    <div class="form-group">

                        <input type="text" name="task" class="form-control form-control-alternative" placeholder="Укажите цель" required v-model="form.task">

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <input type="text" name="trophy" class="form-control form-control-alternative" placeholder="Выберите награду" required v-model="form.trophy">

                    </div>

                </div>

                <div class="col-md-4">
                    <datepicker name="dedline" readonly="false" input-class="form-control form-control-alternative" placeholder="Укажите дедлайн" required v-model="form.dedline"></datepicker>

                </div>

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
                        <input type="text" name="point[]" class="form-control form-control-alternative" v-model="form.points[index]" required>
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

    <div class="col">
        <br>
        <h5 class="card-title text-uppercase text-muted mb-0">Сделать публичным</h5>
        <label class="custom-toggle">
          <input type="checkbox" name="publish" v-model="form.public">
          <span class="custom-toggle-slider rounded-circle"></span>
      </label>
  </div>

  <div class="col">
    <button class="btn btn-icon btn-3 btn-primary" type="submit">
        <span class="btn-inner--icon"><i class="ni ni-calendar-grid-58"></i></span>

        <span class="btn-inner--text">Создать План</span>

    </button>

</div>

</div>

</transition>
</form>



</div>

</template>

<script>

    import Point from './partials/example_point.vue';
    import Datepicker from 'vuejs-datepicker';
    import axios from 'axios';
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    import todoList from './TableTodo.vue';

    export default {
        mounted(){

        },
        data: function(){
            return {
                form: {
                    category_type: false,
                    category:'',
                    task: '',
                    trophy: '',
                    dedline: '',
                    public: false,
                    points: []
                },
                inputs:[],
                categories: ''
            }
        },
        methods: {
            submit: function(event){
                event.preventDefault();
                console.log(this.form);
                axios.post('/task', {_token: CSRF_TOKEN, main: this.form})
                .then(response => {
                    console.log(response.data);
                    this.form.category_type = false;
                    this.form.category = '';
                    this.form.task = '';
                    this.form.trophy = '';
                    this.form.dedline = '';
                    this.form.public = false;
                    this.form.points = [];
                    this.inputs = [];
                });
            },
            addPoint: function(){
                this.inputs.push({
                    one: '',
                    two: ''
                })
            },
            removePoint: function(index){
                this.inputs.splice(index,1)
            }
        },
        created(){
           axios.get('/categories', {data: {_token: CSRF_TOKEN}})
           .then(response => {
            this.categories = response.data;
            console.log(this.categories);
        });
       },
       components: {
        Datepicker,
        Point
    }
}
</script>


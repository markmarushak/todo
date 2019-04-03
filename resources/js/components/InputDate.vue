<template>

    <div class="row">
        <div class="col-sm-12">
            <form id="task-form" @submit.prevent="submit" action="#">
                <div class="row">

                    <category-show></category-show>

                </div>

                <div class="row">

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
                        <datepicker name="dedline" readonly="false" input-class="form-control form-control-alternative" placeholder="Укажите дедлайн" required format="dd-MM-yyyy" v-model="form.dedline"></datepicker>

                    </div>

                    <div class="col-sm-12">

                      <div class="row point" v-for="(input, index) in inputs">

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
            </div>

            <div class="col-sm-12">
                <button class="btn btn-icon btn-2 btn-danger" type="button" v-on:click="addPoint(index)">
                    <span class="btn-inner--icon btn-2 "><i class="ni ni-fat-add"></i></span>
                    <span class="text-inner">add row</span>
                </button>
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


</form>
</div>

<table-todo :newtask="newtasks"></table-todo>

</div>

</template>

<script>

    import Point from './partials/example_point.vue';
    import Datepicker from 'vuejs-datepicker';
    import axios from 'axios';
    import tableTodo from './TableTodo.vue';
    import categoryShow from './partials/Category.vue';

    export default {
        mounted(){

        },
        data: function(){
            return {
                form: {
                    category: [],
                    task: '',
                    trophy: '',
                    dedline: '',
                    public: false,
                    points: [],
                    status: 'pending'
                },
                inputs:[],
                newtasks: []
            }
        },
        methods: {
            submit: function(event){
                this.newtasks.push(_.clone(this.form));
                
                axios.post('/task', {_token: CSRF_TOKEN, main: this.form})
                .then(response => {

                    console.log(this.newtasks);
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
            },
        },
        created(){
           axios.get('/categories')
           .then(response => {
            this.categories = response.data;
            console.log(this.categories);
        });
       },
       components: {
        Datepicker,
        Point,
        tableTodo,
        categoryShow
    }
}
</script>


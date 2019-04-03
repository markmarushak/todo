<template>
<div class="col-sm-12">

                        <div class="row">
                            
                            <!-- <div class="col-sm-12">
                                <div class="form-group">
                                    <h5>Новая категория или выбрать существующею</h5>
                                    <label class="custom-toggle">
                                      <input type="checkbox" name="choose-category" v-model="form.category_type">
                                      <span class="custom-toggle-slider rounded-circle"></span>
                                  </label>

                                </div>
                            </div> -->

                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="category" class="form-control form-control-alternative" required="required" placeholder="Назовите категорию" v-model="category">
                                </div>
                            </div>

                            <div class="col-sm-6" v-if="categories != ''">
                                <div class="form-group">
                                    <select name="category" class="form-control form-control-alternative" v-model="category_select">
                                        <option value="">Выберите категорию</option>
                                        <option  v-bind:value="c.id" v-for="c in categories">{{c.category}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
					            <button class="btn btn-icon btn-3 btn-success" type="submit">
					                <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>

					                <span class="btn-inner--text">Новая категория</span>

					            </button>

					        </div>

                        </div>

                </div>
</template>

<script>
	
	export default {
		mounted(){
			console.log('categoru load')
		},
		data: function(){
			return {
				category: '',
				category_select: {},
				categories: ''
			}
		},
		methods: {
			create: function(event)
			{
				axios.post('/categories', {name:event.target.value}).then(response => {
					console.log(response.data);
				});
			},
			update: function()
			{
				axios.put('/categories',data).then(response => {
					console.log(response.data);
				});
			},
			delete: function(id)
			{
				axios.delete('/categories',{id:id}).then(response => {
					console.log(response.data);
				});
			},
			view: function()
			{
				return 0;
			}
		}
	}

</script>
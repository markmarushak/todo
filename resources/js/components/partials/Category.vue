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

                            <div class="col-sm-3">
                            	<div class="form-group">
                            		<input type="text" name="category" class="form-control form-control-alternative" required="required" placeholder="Назовите категорию" v-model="category">
                            	</div>
                            </div>

                            <div class="col-sm-6" v-if="categories != ''">
                            	<div class="form-group">
                            		<select name="category" class="form-control form-control-alternative" v-model="parent_id">
                            			<option value="">Выберите категорию</option>
                            			<option  v-bind:value="c.id" v-for="c in categories">{{c.category}}</option>
                            		</select>
                            	</div>
                            </div>

                            <div class="col">
                            	<button class="btn btn-icon btn-3 btn-success" type="submit" @click="create">
                            		<span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>

                            		<span class="btn-inner--text">Новая категория</span>

                            	</button>

                            </div>

                            <div class="col-sm-12">

                            	<ul v-for="i in treeData">
                            		<parent-list
                            		class="item"
                            		:item="i"
                            		@make-folder="makeFolder"
                            		@add-item="addItem"
                            		></parent-list>
                            	</ul>

                            </div>

                        </div>

                    </div>
                </template>

                <script>

                	import ParentList from './CategoryParent.vue';

                	export default {
                		mounted(){
                			console.log('categoru load')
                			axios.get('/categories').then(response => {
                				// this.categories = response.data
                				this.treeData = response.data
                				console.log(this.treeData);
                			});
                		},
                		data: function(){
                			return {
                				category: '',
                				parent_id: 0,
                				category_select: {},
                				categories: [],
                				treeData: ''
                			}
                		},
                		methods: {
                			create: function(event)
                			{
                				var data = {
                					parent_id: this.parent_id,
                					category: this.category
                				}
                				axios.post('/categories', data).then(response => {
                					data.id = response.data;
                					this.categories.push(data);
                					this.treeData.push(data);

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
                			},
                			parent: function(parent_id)
                			{

                			},
                			makeFolder: function (item) {
                				Vue.set(item, 'children', [])
                				this.addItem(item)
                			},
                			addItem: function (item) {
                				item.children.push({
                					name: 'new stuff'
                				})
                			}
                		},
                		components: {
                			ParentList
                		},
                	}

                </script>
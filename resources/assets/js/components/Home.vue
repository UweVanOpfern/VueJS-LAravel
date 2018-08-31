<template>
	
	<div>
		<nav class="panel column is-offset-2 is-8">
		    <p class="panel-heading">
		   	 My phonebook list
		   	<button class="button is-primary is-outlined" @click="openAdd">
			      Add new Phonebook
			</button>

		    </p>
			<div class="panel-block">
			    <p class="control has-icons-left">
			      <input class="input is-small" type="text" placeholder="search" v-model="searchQuery">
			      <span class="icon is-small is-left">
			        <i class="fas fa-search" aria-hidden="true"></i>
			      </span>
			    </p>
			</div>

			<a class="panel-block" v-for="item,key in temp">
				<span class="column is-9">
					{{ item.name }}
				</span>
				
				<span class="panel-icon column is-1">
					<i class="has-text-danger fa fa-trash" aria-hidden="true" @click="del(key,item.id)"></i>
				</span>

				<span class="panel-icon column is-1">
					<i class="has-text-primary fa fa-eye" aria-hidden="true" @click="openShow(key)"></i>
				</span>
			</a>
		</nav>

		<Add :openmodal='addActive' @closeRequest='close'></Add>
		<Show :openmodal='showActive' @closeRequest='close'></Show>

	</div>
</template>

<script>

	let Add =  require('./Add.vue');
	let Show =  require('./Show.vue');

	
	export default{
		components:{Add,Show},

		data(){

			return{

				addActive : '',
				showActive : '',
				lists:{},
				errors:{},
				searchQuery: '',
				temp : ''
			}
		},

		watch:{

			searchQuery(){

				if (this.searchQuery.length > 0) {

					this.temp = this.lists.filter((item) => {
						
						return item.name.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
					});
				}else{

					this.temp = this.lists
				}
			}
		},

		mounted(){
			axios.post('/getData').
				then((response)=>this.lists = this.temp = response.data)
			  	.catch((error)=> this.errors = error.response.data.errors)
		},

		methods:{
			openAdd(){
				this.addActive = 'is-active';
			},

			openShow(key){
				this.$children[1].list = this.lists[key]
				this.showActive = 'is-active';
			},

			del(key,id){

				if (confirm("Are sure you want to delete this phonebook")) {

					axios.delete(`/phonebook/${id}`).
					then((response)=> this.lists.splice(key,1))
				  	.catch((error)=> this.errors = error.response.data.errors)
				}
			},

			close(){
				this.addActive = ''
				this.showActive = ''
			}
		}
	}
</script>
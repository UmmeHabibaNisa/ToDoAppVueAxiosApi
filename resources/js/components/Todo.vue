<template>
    <section>
        <div class="container">
            <form>
                <div class="form-group">
                    <label class="input-group-text" for="exampleInputPassword1">Make your list</label>
                    <input style="margin-top:5px" type="text" name="title" class="form-control"
                           id="exampleInputPassword1" placeholder="what do u want to do today?"
                           v-model="title">
                    <button v-show="!edit" style="margin-top:10px" type="button" class="btn btn-primary"
                            v-on:click="insertTodo">Submit
                    </button>
                    <button v-show="edit" style="margin-top:10px" type="button" class="btn btn-primary" @click="updateTodo(title)">Update</button>
                </div>
                <ul class="list-group list-group-flush">
                    <div  v-for="(todo,id) in list" class="form-check">
                        <!--
                                                <input  type="checkbox" class="form-check-input"  id="checkbox"  @click="checkboxTodo"> &lt;!&ndash;v-model="todo.complete" :id="id"&ndash;&gt;
                        -->
                        <li style="margin-top:10px" >

                           <span><input  type="checkbox" class="form-check-input" v-model="todo.checkbox" id="id"  @change="checkboxTodo(todo)">
                              <div style=" margin-right: 80px;">{{todo.title}}</div>
                           </span>
                            <!--
                                                        <span style=" margin-right: 80px;">{{todo.title}}</span>
                            -->
                            <!-- <div v-for=" todo in something">
                                 <span v-show="!todo.edit">{{listdata.message}}</span>
                                 <input type="text" v-model="listdata.message" v-show="listdata.message">
                             </div>-->

                            <button v-show="!todo.edit" style="margin:5px;" type="button"
                                    class="btn btn-secondary" v-on:click="editTodo(todo)">Edit
                            </button>

                            <button type="button" class="btn btn-info"
                                    v-on:click="deleteTodo(todo.id)">Delete
                            </button>

                        </li>

                    </div>
                </ul>

            </form>

        </div>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
              integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
              crossorigin="anonymous">

    </section>
</template>

<script>

    export default {
        name: 'App',
        data() {
            return {
                id:'',
                title: '',
                title2: 'demo test',
                edit: false,
                checked: '' ,
                // listdata : [
                //     {
                //         title: '',
                //         complete: ''
                //     }
                // ]
                list: {},
            }

        },
        mounted() {
            this.getTodoData();
        },
        methods: {
            /*        saveTodo(index, todo) {
                if (this.edit) {
                    this.listdata.splice(this.listdata.indexOf(todo), 1);
                    this.listdata.push({
                        message: this.message,
                        complete: false,
                        //console.log(this.message);
                    });
                    this.edit = false;
                } else {
                    this.listdata.push({
                        message: this.message,
                        complete: false,
                    });
                }

                this.message = '';
            },*/
            insertTodo() {
                axios.post("/api/todo", {title: this.title}).then(response => {
                    this.getTodoData();
                    this.title = '';
                }).catch(err => {
                    console.log(err);
                })
            },
            getTodoData() {
                axios.get("/api/todo").then(response => {
                    this.list = response.data;
                }).catch(err => {
                    console.log(err);
                })
            },
            updateTodo(){
                axios.put("/api/todo/"  + this.id, {title: this.title}).then(response => {
                    this.getTodoData();
                    this.title = '';
                    this.edit= false;
                }).catch(err => {
                    console.log(err);
                })

            },
            editTodo(todo) {
                this.id=todo.id;
                this.edit = true;
                this.title = todo.title
            },
            // deleteTodo(id) {
            //     console.log('sdfgfg',id)
            //     axios
            //         .delete("/api/todo/" + id)
            //         .then(response =>{
            //             console.log('res',response)
            //             }
            //         )
            //         .catch(err => {
            //             console.log(err);
            //         })
            //         //.finally(this.getTodoData());
            // },
            /*  deleteTodo(index) {
                this.listdata.splice(index, 1);
            },*/

            deleteTodo(id) {
                axios.delete('api/todo/' + id)
                    .then(response => {
                        this.getTodoData();
                    });
                //console.log('res', response);

            },
            // console.log('id', id)
            checkboxTodo(todo){
                console.log(todo);

                axios.post('/api/checkbox/' + todo.id, todo )
                    .then(response => {
                        console.log( response);
                        //this.getTodoData();

                    })
            },
        }

    }

</script>

<style lang="scss">

</style>


<html>
<head>
    <title>laravel vue</title>
    <link href="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <tasks-app></tasks-app>
    </div>
    <template id="tasks-template">
        <h1>My Tasks</h1>
        <form class="form-group" @submit='createTask'>
            <input type="text" v-model="notes" class="form-control"><br>
            <input type="submit" class="btn btn-success btn-block" value="提交">
        </form>
        <ul class="list-group">
            <li class="list-group-item" v-for="task in list  | orderBy 'id' -1">
                @{{ task.body }}
                <button class="btn btn-danger" @click='deleteTask(task)'>delete</button>
                <button class="btn btn-info" @click='toDetail(task.id)'>detail</button>
            </li>
        </ul>
    </template>
    <script src="https://cdn.bootcss.com/vue/1.0.14/vue.min.js"></script>
    <script src="https://cdn.bootcss.com/vue-resource/1.0.3/vue-resource.min.js"></script>
    {{--<script src="https://cdn.bootcss.com/vue-router/2.1.1/vue-router.min.js"></script>--}}
    <script>
        var resource = Vue.resource('task/{id}');
        Vue.component('tasks-app',{
            template:'#tasks-template',
            data:function () {
              return {
                  notes:[],
                  list:[]
              }
            },
            created:function(){
                var vm = this;

                this.$http.get('api/tasks').then((response) => {
                        vm.list = response.data;
                    },(response) => {
                        alert('error!');
                    }
                );
            },

            methods:{

                deleteTask:function (task) {
//                    console.log(task.id);
                    resource.delete({id:task.id}).then((response) => {
                        this.list.$remove(task);
                    },(response) => {
                            alert('error!');
                        }
                    );
                },
                createTask:function(e){
                    e.preventDefault();
                    this.$http.post('task', {body: this.notes}).then((response) => {
                        console.log(response);
                        this.list.push(response.data.task);
                        this.notes = '';
                }, (response) => {
                        // error callback
                    });
                },
                toDetail:function(id){
//                    alert(id)
                    window.location.href='/task/'+id;
                }
            }
        });
        new Vue({
            el:'body',
        })
    </script>
</body>
</html>
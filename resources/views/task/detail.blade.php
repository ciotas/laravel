<html>
<head>
    <title>detail</title>
    <link href="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="row">
        <p id="detail">@{{ onedetail.body }}</p>
    </div>
</div>
<script src="https://cdn.bootcss.com/vue/1.0.14/vue.min.js"></script>
<script src="https://cdn.bootcss.com/vue-resource/1.0.3/vue-resource.min.js"></script>
<script src="https://cdn.bootcss.com/vue-router/2.1.1/vue-router.min.js"></script>

<script>
    var resource = Vue.resource('task/{id}');
    new Vue({
        el:'#detail',
        data:{
            onedetail:'',
        },
        methods:{

        },
        created:function(){
            var vm = this;


        },
    });
</script>

</body>
</html>
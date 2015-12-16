<template>
    <div>
        <div class="well">
            <h3>Search User</h3>

            <form action="" method="POST" @submit.prevent="searchUser">
                <div class="input-group">
                    <input type="number" v-model="cNumber" id="searchCNumber" class="form-control" placeholder="Search C Number" autofocus>
                  <span class="input-group-btn">
                    <button class="btn" type="button" @click.prevent="searchUser">Go!</button>
                  </span>
                </div>
            </form>
        </div>

        <form class="form-horizontal" v-show="user">
            <div class="form-group">
                <label for="cNumber" class="col-sm-2 control-label">C Number</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="cNumber" v-model="inputs.cNumber" placeholder="C Number" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="login" class="col-sm-2 control-label">Login Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="login" v-model="inputs.login" name="login" placeholder="Login Name">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="password"  v-model="inputs.password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email"  v-model="inputs.email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="row button-group pull-right clearfix">
                <button class="btn btn-purple" @click.prevent="update">更新</button>
                <button class="btn btn-purple" @click.prevent="reset">重設</button>
            </div>
        </form>
        <div v-show="user">
            <button class="btn btn-default">Show User Documents</button>
            <table class="table" v-show="hasDocuments">
                <thead>
                    <th>Upload Date</th>
                    <th>Document Type</th>
                    <th>Document Name</th>
                    <th></th>
                </thead>
                <tbody>
                <td>today</td>
                <td>BR</td>
                <td>The document</td>
                <td>
                    <button class="btn btn-danger btn-sm">Remove</button>
                </td>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default{
        data: function(){
            return {
                cNumber:"",
                user:"",
                inputs:{},
                Documents:[]
            }
        },
        computed:{
            hasDocuments: function(){
                return !!this.Documents.length
            }
        },
        methods:{
            toggleTooltip: function(e){
                $('#searchCNumber').tooltip({
                    trigger:'manual',
                    title:"number only"
                });
                if((e.keyCode <48 || e.keyCode > 57) &&  e.keyCode!== 13){
                    $('#searchCNumber').tooltip('show')
                }else{
                    $('#searchCNumber').tooltip('hide')
                }
            },
            searchUser: function(){
                console.log('get request to server to find the user')
                if(this.cNumber){
                    var url = "/searchcustomer/"+this.cNumber;
                    this.$http.get(url, function(response){
                        console.log(response)
                        if(response){
                            this.$set('user', response);
                            this.$set('inputs', response);
                        }else{
                            alert('no one match the c number! Please verify.')
                        }
                    })
                }else{
                    alert('You have to input the C Number!');
                }
            },
            reset: function(){
                for(var key in this.inputs){
                    if(key !== 'cNumber') this.inputs[key] = "";
                }
            },
            update: function(){
                console.log('print something');
            }
        },
        ready: function(){
            document.getElementById("searchCNumber").addEventListener("keypress", this.toggleTooltip);
        }
    }
</script>
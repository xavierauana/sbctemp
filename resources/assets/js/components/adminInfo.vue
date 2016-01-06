<template>
    <div>
        <div class="panel panel-default">
            <user-table :users="users" :profiles="profiles" :selected-user.sync="user"></user-table>
        </div>
        <form class="form-horizontal">
            <div class="form-group">
                <label for="loginName" class="col-sm-3 control-label">管理人員登入名稱</label>
                <div class="col-sm-9">
                    <input type="text" v-model="inputs.loginName" :value="user.loginName" class="form-control" id="loginName" placeholder="Administrator Login Name" >
                </div>
            </div>
            <div class="form-group">
                <label for="profile" class="col-sm-3 control-label">管理人員權限類別</label>
                <div class="col-sm-9">
                    <select name="profile" id="profile" class="form-control" v-model="inputs.profile" >
                        <option  value="" >-- Can Select A Existing Profile --</option>
                        <option v-for="profile in profiles" :value="profile" > {{profile.label}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-3 control-label">登入密碼</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="password" v-model="inputs.password" :value="user.password" placeholder="Administrator Password" >
                </div>
            </div>

            <h5><strong>設定權限 Permissions Setting</strong></h5>
            <permissions :profile="inputs.profile"></permissions>
            <div class="form-group">
                <div class="col-xs-12 col-sm-4 pull-right">
                    <button class="btn btn-block btn-purple" @click.prevent="deleteAdmin">刪除 Delete</button>
                </div>
                <div class="col-xs-12 col-sm-4 pull-right">
                    <button class="btn btn-block btn-purple" @click.prevent="reset">重設 Reset</button>
                </div>
                <div class="col-xs-12 col-sm-4 pull-right">
                    <button class="btn btn-block btn-purple" @click.prevent="updateUser">更新 Update</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

    import Permissions from './permissions.vue'
    import UserTable from './userTable.vue'
    import SideBarMenu from './sideBarMenu.vue'

    export default {
        components:{
            Permissions,
            UserTable,
            SideBarMenu
        },
        data:function(){
            return {
                inputs:{
                    profile:"",
                    password:"",
                    loginName:""
                },
                users:[],
                user:"",
                profiles:[]
            }
        },
        watch:{
            user: function(){
                if(this.user){
                    this.inputs.profile = this.profiles.filter(function(profile){
                        return profile.id == this.user.profile_id
                    }.bind(this))[0]

                }
            }
        },
        created: function(){
            this.$http.get('/getadminusers', function(response){
                this.$set('users', response);
            });
            this.$http.get('/getpermissionprofiles', function(response){
                this.$set('profiles', response);
            })
        },
        methods:{
            reset: function(){
                if(this.user){
                    this.inputs.loginName = this.user.loginName;
                    this.inputs.profile = "";
                    this.inputs.password = "";
                }
            },
            updateUser: function(){
                console.log('update user')
            },
            deleteAdmin: function(){
                if(confirm('Are you sure you will delete the admin user, '+this.user.loginName+'? '+'你確定要刪除管理人員, '+this.user.loginName+'？' )){
                    console.log('post delete admin');
                    this.inputs.profile = "";
                    this.inputs.password = "";
                    this.inputs.loginName = "";
                    this.users.$remove(this.user);
                }
            }
        }
    }
</script>
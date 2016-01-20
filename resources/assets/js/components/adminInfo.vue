<template>
    <div>
        <h3>管理人員資料 Administrator Info</h3>
        <div class="panel panel-default">
            <user-table :users="users" :profiles="profiles" :selected-user.sync="user"></user-table>
        </div>
        <form class="form-horizontal">
            <div class="form-group">
                <label for="loginName" class="col-sm-3 control-label">管理人員登入名稱</label>
                <div class="col-sm-9">
                    <input type="text" v-model="inputs.loginName" :value="user.loginName" class="form-control" id="loginName" placeholder="Administrator Login Name" :disabled="!user">
                </div>
            </div>
            <div class="form-group">
                <label for="profile" class="col-sm-3 control-label">管理人員權限類別</label>
                <div class="col-sm-9">
                    <select name="profile" id="profile" class="form-control" v-model="inputs.profile" :disabled="!user">
                        <option  value="" >-- Administrator Permission Type --</option>
                        <option v-for="profile in profiles" :value="profile" > {{profile.label}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-3 control-label">登入密碼</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="password" v-model="inputs.password" :value="user.password" placeholder="Administrator Password" :disabled="!user">
                </div>
            </div>

            <h5><strong>現有權限 Existing Permission</strong></h5>
            <permissions :profile="inputs.profile"></permissions>
            <div class="row">
                <div class="col-xs-12 col-sm-4 pull-right">
                    <button class="btn btn-block btn-purple" :class="{'btn-purple':isButtonActive}" :disabled="!isButtonActive" @click.prevent="reset">重設 Reset</button>
                </div>
                <div class="col-xs-12 col-sm-4 pull-right">
                    <button class="btn btn-block btn-purple" :class="{'btn-purple':isButtonActive}" :disabled="!isButtonActive" @click.prevent="updateUser">更新 Update</button>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-4 pull-right">
                    <button class="btn btn-block" :class="{'btn-purple':isButtonActive}" :disabled="!isButtonActive" @click.prevent="revert">返回原本設定 Revert to default</button>
                </div>
                <div class="col-xs-12 col-sm-4 pull-right">
                    <button class="btn btn-block btn-purple" :class="{'btn-purple':!!user}" :disabled="!user" @click.prevent="deleteAdmin">刪除 Delete</button>
                </div>
            </div>
        </form>
        <pre>
            {{$data|json}}
        </pre>
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
                profiles:[],
                isButtonActive: false
            }
        },
        watch:{
            user: function(){
                    if(this.user){
                        this.inputs.profile = this.profiles.filter(function(profile){
                            return profile.id == this.user.profile_id
                        }.bind(this))[0]
                    }
                },
            inputs:{
                handler: function(){
                    var check = false;
                    if(this.inputs.password !== this.user.password) check = true;
                    if(this.inputs.loginName !== this.user.loginName) check = true;
                    if(this.inputs.profile.id !== this.user.profile_id) check = true;
                    this.isButtonActive = check;
                },
                deep: true
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
            revert: function(){
                this.inputs.profile = this.profiles.filter(function(profile){
                    return profile.id == this.user.profile_id
                }.bind(this))[0]
                this.inputs.password = this.user.password;
                this.inputs.loginName = this.user.loginName;
            },
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
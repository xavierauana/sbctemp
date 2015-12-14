@extends('partials.adminLayout')

@section('content')
    <div id="editAdminInfo">
        <div class="panel panel-default">
            <userstable :users="users" :profiles="profiles" :selected-user.sync="user"></userstable>
        </div>
        <form class="form-horizontal">
            <div class="form-group">
                <label for="loginName" class="col-sm-3 control-label">管理人員登入名稱</label>
                <div class="col-sm-9">
                    <input type="text" v-model="inputs.loginName" :value="user.loginName" class="form-control" id="loginName" placeholder="" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="profile" class="col-sm-3 control-label">管理人員權限類別</label>
                <div class="col-sm-9">
                    <select name="profile" id="profile" class="form-control" v-model="inputs.profile_id" :value="user.profile_id" v-model="existingProfile" disabled>
                        <option  value="" > Can Select A Existing Profile </option>
                        <option v-for="profile in profiles" :value="profile.id" > @{{profile.name}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-3 control-label">登入密碼</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="password" v-model="inputs.password" :value="user.password" placeholder="" disabled>
                </div>
            </div>

            <h5><strong>設定權限</strong></h5>
            <permission :my-permissions.once="permissions" :profile="inputs.profile_id" :profiles="profiles"></permission>
            <div class="form-group">
                <div class="col-xs-12 col-sm-4 pull-right">
                    <button type="submit" class="btn btn-block" @click.prevent="revertToDefault">Reset</button>
                </div>
                <div class="col-xs-12 col-sm-4 pull-right">
                    <button type="submit" class="btn btn-block" @click.prevent="updateUser">Update</button>
                </div>
            </div>
        </form>
    </div>
@stop
@section('scripts')
    <template id="template-users-table">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>登入名稱</th>
                <th>權限類別</th>
            </tr>
            </thead>
            <tbody>
                <tr @click="selectUser(user)" v-for="user in users">
                    <td>@{{ user.loginName }}</td>
                    <td>@{{ user.profile_id }}</td>
                </tr>
            </tbody>
        </table>
    </template>
    <script>
//        Vue.component('userstable', {
//            template: "#template-users-table",
//            props: {
//                profiles: null,
//                users: null,
//                selectedUser:{
//                    twoWay: true
//                }
//            },
//            methods:{
//                selectUser: function(user){
//                    console.log(user);
//                    this.selectedUser = user;
//                },
//                getProfileLabel:function(){
//                    return "Yes"
//                }
//            }
//        });
//        Vue.component('permission', {
//            template: "#template-permission-table",
//            props: {
//                myPermissions: null,
//                profile: null,
//                profiles: null,
//            },
//            data:function(){
//                return {
//                    selectedPermissions:[]
//                }
//            },
//            watch: {
//                profile: function(value){
//                    console.log(this.profile);
//                    var self = this;
//                    if(this.profile == ""){
//                        this.selectedPermissions =[];
//                    }else{
//                        this.profiles.map(function(profile){
//                            if(profile.id == self.profile){
//                                self.selectedPermissions = profile.permissions;
//                            }
//                        })
//                    }
//                }
//            }
//        });

    </script>
@stop
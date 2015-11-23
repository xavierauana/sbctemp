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
                    <button type="submit" class="btn btn-block" @click.prevent="revertToDefault">Revert To Default</button>
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
    <template id="template-permission-table">
        <div class="row permissions" >
            <div class="col-md-4 col-xs-6" v-for="permission in myPermissions">
                <label>
                    <input type="checkbox" disabled v-model="selectedPermissions" :value="permission.code"> @{{ permission.label }}
                </label>
            </div>
        </div>
    </template>
    <script>
        Vue.component('userstable', {
            template: "#template-users-table",
            props: {
                profiles: null,
                users: null,
                selectedUser:{
                    twoWay: true
                }
            },
            methods:{
                selectUser: function(user){
                    console.log(user);
                    this.selectedUser = user;
                },
                getProfileLabel:function(){
                    return "Yes"
                }
            }
        });
        Vue.component('permission', {
            template: "#template-permission-table",
            props: {
                myPermissions: null,
                profile: null,
                profiles: null,
            },
            data:function(){
                return {
                    selectedPermissions:[]
                }
            },
            watch: {
                profile: function(value){
                    console.log(this.profile);
                    var self = this;
                    if(this.profile == ""){
                        this.selectedPermissions =[];
                    }else{
                        this.profiles.map(function(profile){
                            if(profile.id == self.profile){
                                self.selectedPermissions = profile.permissions;
                            }
                        })
                    }
                }
            }
        });
        new Vue({
            el: "#editAdminInfo",
            data:{
                user:"",
                inputs:{
                    loginName:"",
                    profile_id:"",
                    password:"",
                },
                users:[
                    {id:1, loginName:"Admin-Rainbow", profile_id:3, password: "123456"},
                    {id:2, loginName:"Admin-RJ", profile_id:1, password: "abcdefg"}
                ],
                existingProfile:"",
                profiles:[
                    {id:1, name:"1", permissions:[
                        'readcustomerinfo',
                        'readadmininfo',
                        'editCustomerInfo',
                        'deleteCustomer',
                        'editCustomerLogin'
                    ]},
                    {id:2, name:"This is the second one", permissions:[
                        'editAdminLogin',
                        'createNewCustomer',
                        'editCustomerInfo',
                        'editCustomerLogin'
                    ]},
                    {id:3, name:"自定", permissions:[
                        'editDocumentType',
                        'uploadfile',
                        'editCustomerInfo',
                        'deleteAdmin',
                        'editCustomerLogin'
                    ]}
                ],
                permissions:[
                    {id:1, code:"readcustomerinfo", label:"讀取客戶資料"},
                    {id:2, code:"readadmininfo", label:"讀取管理人員資料"},
                    {id:3, code:"uploadfile", label:"上載文件"},
                    {id:4, code:"createNewCustomer", label:"新增客戶"},
                    {id:5, code:"createNewAdmin", label:"新增管理人員"},
                    {id:6, code:"deleteDocument", label:"刪除文件"},
                    {id:7, code:"editCustomerInfo", label:"更改客戶資料"},
                    {id:8, code:"editAdminInfo", label:"更改管理人員資料"},
                    {id:9, code:"editDocumentType", label:"更改文件類別資料"},
                    {id:10, code:"deleteCustomer", label:"刪除客戶"},
                    {id:11, code:"deleteAdmin", label:"更改及刪除管理人員"},
                    {id:11, code:"editCustomerLogin", label:"讀取 / 更改客戶登入名稱及密碼"},
                    {id:11, code:"editAdminLogin", label:"讀取 / 更改管理人員登入名稱及密碼"}
                ]
            },
            methods:{
                revertToDefault: function(){
                    this.inputs.loginName = this.user.loginName;
                    this.inputs.profile_id = this.user.profile_id;
                    this.inputs.password = this.user.password;
                },
                updateUser:function(){
                    console.log('Put to server and update user');
                    this.user.loginName = this.inputs.loginName;
                    this.user.profile_id = this.inputs.profile_id;
                    this.user.password = this.inputs.password;
                }
            },
            watch:{
              user: function(){
                  var inputs = document.getElementsByTagName('form')[0].elements;
                  for(var i = 0; i < Object.keys(inputs).length; i++){
                      if( typeof inputs[i] !== 'undefined'){
                          if(inputs[i].type == "text"  || inputs[i].type == "select-one"){
                              inputs[i].removeAttribute('disabled');
                          }
                      }
                  }
              }
            },
            ready:function(){
                $(document).ready(function(){
                    $('table').DataTable();
                });
                console.log('vue ready')
            }
        })
    </script>
@stop
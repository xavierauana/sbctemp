@extends('partials.adminLayout')

@section('content')
    <div id="permissionSetting">
        <form class="form-horizontal">
        <div class="form-group">
            <label for="profile" class="col-sm-3 control-label">現有權限類別名稱</label>
            <div class="col-sm-9">
                <select name="profile" id="profile" class="form-control" v-model="existingProfile" @change="selectExistingProfile" autofocus>
                    <option  value="" > Can Select A Existing Profile </option>
                    <option v-for="profile in profiles" :value="profile.id" > @{{profile.name}}</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="newProfile"  class="col-sm-3 control-label">新增權限名稱</label>
            <div class="col-sm-9">
                <input type="text" v-model="newProfile" @keyup="enterNewProfile" class="form-control" id="newProfile" placeholder="Create New Permission Profile">
            </div>
        </div>

        <h5><strong>設定權限</strong></h5>

        <permission :my-permissions="permissions" :profile-id="existingProfile" :selected-permissions.sync="selectedPermissions" :profiles="profiles"></permission>

        <div class="row button-group">
            <div class="col-sm-3" v-show="newProfile">
                <button class="btn btn-block" @click.prevent="createNewProfile">新增</button>
            </div>
            <div class="col-sm-3" v-show="existingProfile">
                <button class="btn btn-block" @click.prevent="updateProfile">更新</button>
            </div>
            <div class="col-sm-3">
                <button class="btn btn-block" @click.prevent="resetInputs">取消</button>
            </div>
        </div>

        <div class="row button-group">
            <div class="col-sm-3" v-show="existingProfile">
                <button class="btn btn-block"  @click.prevent="deleteProfile">刪除</button>
            </div>
        </div>
    </form>
    </div>
@stop

@section('scripts')
    <template id="template-permission-table">
        <div class="row permissions" >
            <div class="col-md-4 col-xs-6" v-for="permission in myPermissions">
                <label>
                    <input type="checkbox" name="" v-model="selectedPermissions" :value="permission.code"> @{{ permission.label }}
                </label>
            </div>
        </div>
    </template>
    <script>
        Vue.component('permission', {
           template: "#template-permission-table",
            props: ['myPermissions','profileId','selectedPermissions','profiles'],
            watch:{
                profileId: function(value){
                    var self = this;
                    if(value){
                        this.selectedPermissions = this.profiles.filter(function(profile){
                            return profile.id == value;
                        })[0].permissions;
                    }
                }
            }
        });
        new Vue({
            el: "#permissionSetting",
            data:{
                existingProfile:"",
                newProfile:"",
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
                selectedPermissions:[],
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
                createNewProfile: function(){
                    console.log("Post to server and create a new profile");
                    var profile = {
                        id : this.profiles.length,
                        name : this.newProfile,
                        permissions : this.selectedPermissions
                    }
                    this.profiles.push(profile);
                    alert('created');
                    this.newProfile = "";
                    this.selectedPermissions=[];
                },
                updateProfile: function(){
                    var self;
                    self = this;
                    console.log("put to server and update info");
                    this.profiles.filter(function(profile){
                        return self.existingProfile == profile.id;
                    })[0].permissions = this.selectedPermissions;
                    alert('updated');
                    this.existingProfile = "";
                    this.selectedPermissions=[];
                },
                deleteProfile: function(){
                    var self;
                    self = this;
                    if(confirm('Are you sure u want to delete profile "'+this.profiles.filter(function(profile){
                                        return self.existingProfile == profile.id
                                    })[0].name +'"?')){
                        console.log("delete to server and delete the profile");
                        this.profiles.map(function(profile, index){
                            if(self.existingProfile == profile.id) {
                                self.profiles.splice(index, 1)
                            }
                        });
                        this.existingProfile="";
                        this.selectedPermissions=[];
                    }
                },
                resetInputs: function(){
                    this.existingProfile="";
                    this.newProfile="";
                    this.selectedPermissions=[];
                },
                selectExistingProfile: function(){
                    this.newProfile = "";
                    this.updatePermissionCheckboxes();
                },
                enterNewProfile: function(){
                    if(this.newProfile !== ""){
                        this.existingProfile = "";
                    }
                    this.updatePermissionCheckboxes();
                },
                updatePermissionCheckboxes:function(){
                    var self = this;
                    if(this.existingProfile == ""){
                        this.selectedPermissions =[];
                    }else{
                        this.profiles.map(function(profile){
                            if(profile.id == self.existingProfile){
                                self.selectedPermissions = profile.permissions;
                            }
                        })
                    }
                }
            },
            watch:{
                selectedPermissions:function(value){
                    console.log(value)
                }
            }
        })
    </script>
@stop
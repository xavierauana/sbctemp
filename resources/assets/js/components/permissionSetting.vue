<template>
    <div>
        <h3>權限類別設定 Permissions Setting</h3>
        <form class="form-horizontal">
            <div class="form-group">
                <label for="profile" class="col-sm-3 control-label">現有權限類別名稱</label>
                <div class="col-sm-9">
                    <select name="profile" id="profile" class="form-control" v-model="existingProfile" @change="selectExistingProfile" autofocus>
                        <option  value="" selected> Can Select A Existing Profile </option>
                        <option v-for="profile in profiles" :value="getSelectedProfile(profile)" > {{profile.label}}</option>
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
            <permissions v-show="showPermissionTable" :editable="true" :profile="existingProfile" :selected-permissions.sync="selectedPermissions"></permissions>
            <div class="row button-group">
                <div class="col-sm-3" v-show="showCreate">
                    <button class="btn btn-block btn-purple" @click.prevent="createNewProfile">新增 Create</button>
                </div>
                <div class="col-sm-3" v-show="existingProfile">
                    <button class="btn btn-block btn-purple" @click.prevent="updateProfile">更新 Update</button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-block btn-purple" @click.prevent="reset">重設 Reset</button>
                </div>
            </div>
            <div class="row button-group">
                <div class="col-sm-3" v-show="existingProfile">
                    <button class="btn btn-block btn-purple"  @click.prevent="deleteProfile">刪除 Delete</button>
                </div>
                <div class="col-sm-3" v-show="existingProfile">
                    <button class="btn btn-block btn-purple"  @click.prevent="revertToDefault">返回原有設定 Default</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Permissions from './permissions.vue'
    export default{
        data: function(){
            return {
                profiles:[],
                existingProfile:"",
                newProfile:"",
                selectedPermissions: []
            }
        },
        computed:{
            showPermissionTable: function(){
                return this.existingProfile || this.newProfile;
            },
            showCreate: function(){
                return this.selectedPermissions.length > 0 && this.newProfile;
            }
        },
        components:{
            Permissions
        },
        methods:{
            getSelectedProfile: function(profile){
                if(profile){
                    return JSON.parse(JSON.stringify(profile));
                }
            },
            enterNewProfile: function(){
                if(this.existingProfile) this.existingProfile = "";
            },
            selectExistingProfile: function(){
              if(this.newProfile) this.newProfile = "";
            },
            createNewProfile: function(){
                console.log('create new profile')
            },
            updateProfile: function () {
                console.log('update profile')
            },
            reset: function(){
                console.log('reset inputs');
                this.newProfile = "";
                this.selectedPermissions = [];
            },
            deleteProfile: function()  {
                console.log('post to server to delete the profile');
                if(confirm('Are you sure you want to delete the profile')){
                    this.profiles.$remove(this.existingProfile);
                    this.existingProfile = "";
                }
            },
            revertToDefault: function(){
                var self = this;
                console.log('revert to default setting.');
                if(this.existingProfile){
                   this.profiles.map(function(profile){
                        if(profile.id == self.existingProfile.id){
                            self.existingProfile.permissions = profile.permissions;
                            self.selectedPermissions = profile.permissions;
                        }
                    });
                    console.log('will revert');
                }
            }
        },
        created: function(){
            this.$http.get('/getpermissionprofiles', function(response){
                this.$set('profiles', response);
            })
        }

    }
</script>
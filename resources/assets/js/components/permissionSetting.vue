<template>
    <div>
        <h3>權限類別設定 Permissions Setting</h3>

        <form class="form-horizontal">
            <div class="form-group">
                <label for="profile" class="col-sm-3 control-label">現有權限類別</label>

                <div class="col-sm-9">
                    <select name="profile" id="profile" class="form-control" v-model="existingProfile"
                            @change="selectExistingProfile" autofocus>
                        <option value="" selected> Existing Permission Type</option>
                        <option v-for="profile in profiles" :value="getSelectedProfile(profile)"> {{profile.label}}
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="newProfile" class="col-sm-3 control-label">新增權限</label>

                <div class="col-sm-9">
                    <input type="text" v-model="newProfile" @keyup="enterNewProfile" class="form-control"
                           id="newProfile" placeholder="Create New Permission Profile">
                </div>
            </div>
            <h5><strong>現有權限 Existing Permission</strong></h5>
            <permissions v-show="showPermissionTable" :editable="!!existingProfile||!!newProfile"
                         :profile="existingProfile" :selected-permissions.sync="selectedPermissions"></permissions>
            <div class="row button-group">
                <div class="col-sm-3" v-show="!!newProfile">
                    <button class="btn btn-block" :class="{'btn-purple':!!newProfile}" @click.prevent="createNewProfile"
                            :disabled="!showCreate">新增 Create
                    </button>
                </div>
                <div class="col-sm-3" v-show="!newProfile">
                    <button class="btn btn-block" :class="{'btn-purple':!!existingProfile}" :disabled="!existingProfile"
                            @click.prevent="updateProfile">更新 Update
                    </button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-block" :class="{'btn-purple':!!newProfile || !!existingProfile}"
                            :disabled="!newProfile && !existingProfile" @click.prevent="reset">重設 Reset
                    </button>
                </div>
            </div>
            <div class="row button-group">
                <div class="col-sm-3" v-show="!newProfile">
                    <button class="btn btn-block btn-purple" :class="{'btn-purple':!!existingProfile}"
                            :disabled="!existingProfile" @click.prevent="deleteProfile">刪除 Delete
                    </button>
                </div>
                <div class="col-sm-3" v-show="!newProfile">
                    <button class="btn btn-block" :class="{'btn-purple':!!existingProfile}" :disabled="!existingProfile"
                            @click.prevent="revertToDefault">返回原有設定 Default
                    </button>
                </div>
            </div>
        </form>

        <h3>IP Filtering</h3>

        <div class="panel panel-default">
            <table class="table table-hover">
                <thead>
                <th>IP Address</th>
                <th>指令 Actions</th>
                </thead>
                <tbody>
                <tr v-for="ip in ipAddresses">
                    <td>{{ip}}</td>
                    <td class="actionButtons">
                        <div class="btn-group-vertical" role="group" aria-label="Basic example">
                            <button
                                    class="btn btn-xs btn-danger" @click.prevent="deleteIp(ip)"><i class="fa fa-trash fa-2x"></i></button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="panel-footer clearfix">
                <form class="form-horizontal" action="" @submit.prevent="addNewIp">
                    <div class="from-group">
                        <label class="col-sm-2 control-label">New IP Address</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="newIpAddress" id="newIpAddress" v-model="newIpAddress"
                                   @blur='validateIpAddressInput'>
                        </div>
                    </div>
                    <div class="from-group">
                        <button class="pull-right btn btn-purple" style="margin-top: 15px">Add New IP Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Permissions from './permissions.vue'
    export default{
        data: function () {
            return {
                profiles: [],
                existingProfile: "",
                newProfile: "",
                selectedPermissions: [],
                ipAddresses: [],
                newIpAddress:""
            }
        },
        computed: {
            showPermissionTable: function () {
                return true;
                return this.existingProfile || this.newProfile;
            },
            showCreate: function () {
                return this.selectedPermissions.length > 0 && this.newProfile;
            }
        },
        components: {
            Permissions
        },
        methods: {
            getSelectedProfile: function (profile) {
                if (profile) {
                    return JSON.parse(JSON.stringify(profile));
                }
            },
            enterNewProfile: function () {
                if (this.existingProfile) this.existingProfile = "";
            },
            selectExistingProfile: function () {
                if (this.newProfile) this.newProfile = "";
            },
            createNewProfile: function () {
                console.log('create new profile')
            },
            updateProfile: function () {
                console.log('update profile')
            },
            reset: function () {
                console.log('reset inputs');
                this.newProfile = "";
                this.selectedPermissions = [];
            },
            deleteProfile: function () {
                console.log('post to server to delete the profile');
                if (confirm('Are you sure you want to delete the profile')) {
                    this.profiles.$remove(this.existingProfile);
                    this.existingProfile = "";
                }
            },
            revertToDefault: function () {
                var self = this;
                console.log('revert to default setting.');
                if (this.existingProfile) {
                    this.profiles.map(function (profile) {
                        if (profile.id == self.existingProfile.id) {
                            self.existingProfile.permissions = profile.permissions;
                            self.selectedPermissions = profile.permissions;
                        }
                    });
                    console.log('will revert');
                }
            },
            validateIpAddressInput: function () {
                var pattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
                if(this.newIpAddress.length > 0){
                    if(!this.newIpAddress.match(pattern)){
                        alert('not correct input ip');
                        return false;
                    }
                    return true;
                }
                return false
            },
            deleteIp:function(ip){
                if(confirm('Are you sure you want to delete the ip?')){
                    this.ipAddresses.$remove(ip)
                }
                console.log('delete from db')
            },
            addNewIp: function(){
                if(this.validateIpAddressInput()){
                    this.ipAddresses.push(this.newIpAddress);
                    this.newIpAddress = "";
                    console.log('insert to database!')
                }
            }
        },
        created: function () {
            this.$http.get('/getpermissionprofiles', function (response) {
                    this.$set('profiles', response.profiles);
                    this.$set('ipAddresses', response.ipAddresses);
            })
        }

    }
</script>
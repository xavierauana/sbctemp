<template>
    <div>
        <h3>新增管理人員 Add New Admin</h3>
        <form id="createNewAdmin" class="form-horizontal" @submit.prevent="submitForm">
            <div class="form-group">
                <label for="loginName" class="col-sm-3 control-label">管理人員登入名稱</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" v-model="inputs.loginName" id="loginName" placeholder="Login Name" autofocus required>
                </div>
            </div>
            <div class="form-group">
                <label for="profile" class="col-sm-3 control-label">管理人員權限類別</label>
                <div class="col-sm-9">
                    <select name="profile" id="profile" class="form-control" required v-model="inputs.profile" >
                        <option value="" selected>-- Select A Profile --</option>
                        <option v-for="profile in profiles" :value="profile">{{profile.label}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="profile" class="col-sm-3 control-label">密碼</label>
                <div class="col-sm-9">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" v-model="inputs.password"  pattern=".{3,}" required/>
                </div>
            </div>
            <div class="form-group">
                <label for="profile" class="col-sm-3 control-label">確認密碼</label>
                <div class="col-sm-9">
                    <input type="password" name="confirmation_password" id="confirmation_password" class="form-control" placeholder="Type Password Again" v-model="inputs.confirmation_password"  required />
                </div>
            </div>

            <h5 class="hidden"><strong>設定權限</strong></h5>

            <permissions v-show="inputs.profile" :profile="inputs.profile"></permissions>

            <div class="form-group">
                <div class="col-xs-12 col-sm-4 pull-right">
                    <button type="submit" class="btn btn-block" :class="{'btn-purple':isButtonActive}" :disabled="!isButtonActive"  @click.prevent="resetForm">重設 Reset</button>
                </div>
                <div class="col-xs-12 col-sm-4 pull-right">
                    <button type="submit" class="btn btn-block" :class="{'btn-purple':isButtonActive}" :disabled="!isButtonActive" >新增 Create</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Permissions from './permissions.vue';

    export default {
        components:{
            Permissions
        },
         data :function(){
            return {
                profiles:[],
                selectedProfile:"",
                inputs:{
                    loginName:"",
                    profile: null,
                    password:"",
                    confirmation_password:""
                },
                isButtonActive:false
            }
        },
        watch:{
          inputs:{
              handler: function(){
                  var check = false;
                  for(var key in this.inputs){
                      if(this.inputs[key]) check = true;
                  }
                  this.$set('isButtonActive', check)
              },
              deep: true
          }
        },
        methods:{
            resetForm: function(e){
                for(var key in this.inputs){
                    this.inputs[key] = ""
                }
            },
            submitForm: function(){
                console.log('form submit');
            }
        },
        created: function(){
            this.$http.get('/getpermissionprofiles', function (response) {
                this.profiles = response;
            })
        }
    }
</script>
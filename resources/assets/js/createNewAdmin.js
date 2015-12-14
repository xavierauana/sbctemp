/**
 * Created by Xavier on 9/12/15.
 */
var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.use(require('vue-validator'));

import Permissions from './components/permissions.vue'

new Vue({
    el: "#createNewAdmin",
    components:{
      Permissions
    },
    data:{
        profiles:[],
        selectedProfile:{},
        inputs:{
            loginName:"",
            profile:"",
            password:"",
            confirmation_password:""
        }
    },
    methods:{
        resetForm: function(e){
            for(var key in this.inputs){
                this.inputs[key] = ""
            }
        },
        submitForm:function(){
            if(!this.inputs.loginName){
                alert('Have to input Login Name.');
                return false;
            }else if(!this.inputs.profile){
                alert('Have to select a profile.');
                return false;
            }else if(!this.inputs.password){
                alert('Have to input a password.');
                return false;
            }else if(!this.inputs.confirmation_password){
                alert('Have to input password confirmation field.');
                return false;
            }else if(this.inputs.confirmation_password !== this.inputs.password){
                alert('Password is not correct');
                return false;
            }else{
                console.log("post to server and create a new Login");
                this.resetForm();
            }
        }
    },
    ready:function(){
        this.$http.get('/getpermissionprofiles', function (response) {
            this.$set('profiles', response)
        })
    }
});
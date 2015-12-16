<template>
    <div class="row permissions" >
        <div v-for="permission in permissions" class="col-md-4 col-xs-6">
            <label>
                <input type="checkbox" :value="permission.id" v-model="selectedPermissions" :disabled="!editable"> {{permission.label}}
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            profile: {
                default: {}
            },
            editable:{
                type: Boolean,
                default: false
            },
            selectedPermissions:{
                type: Array,
                default: function () {
                    return [];
                }
            }
        },
        data: function(){
            return {
                permissions:[]
            }
        },
        watch:{
            profile: function(){
                if(typeof  this.profile !== 'undefined' && this.profile !== null){
                    if(Array.isArray(this.profile.permissions)){
                        this.selectedPermissions = this.profile.permissions;
                    }else{
                        this.selectedPermissions = [];
                    }
                }
            }
        },
        events:{
          'reset-selectedPermissions': function(){
              this.selectedPermissions = [];
          }
        },
        created: function(){
            this.$http.get('/getpermissions', function(response){
                this.$set('permissions', response)
            })
        }
    }
</script>
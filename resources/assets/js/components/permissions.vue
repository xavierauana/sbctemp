<style>
    input.checkboxes {
        width: 20px;
        height: 20px;
        background-color: green;
        margin: 0;
        padding: 0;
    }

    li {
        margin-bottom: 15px;
    }

    label.active.btn-custom{
        color: white;
        background-color: #398439;
        border-color: #255625;
    }
    div.permissions label[disabled].btn-custom.active:hover,
    div.permissions label[disabled].btn-custom.active:focus,
    label[disabled].active.btn-custom{
        color: white;
        background-color: #398439;
        border-color: #255625;
    }

    div.permissions label[disabled].btn-custom:hover,
    div.permissions label[disabled].btn-custom:focus{
        background-color: white;
    }
    div.permissions label.btn-custom:hover,
    div.permissions label.btn-custom:focus{
        background-color: rgba(67, 143, 67, 0.36);
    }



    div.permissions label.btn-custom.active:hover,
    div.permissions label.btn-custom.active:focus{
        color: white;
        background-color: #2f682f;
    }

</style>
<template>
    <div class="row permissions">
        <div v-for="group in permissions" class="col-xs-4 permissions">
            <ul class="list-unstyled">
                <li v-for="permission in group">
                    <div class="btn-group">
                        <label class="btn btn-xs btn-default text-center btn-custom" :class="{'active':isChecked(permission.id)}"  @click.prevent="updateSelectedPermissions(permission.id)" :disabled="!editable">
                            <input style="display: none" type="checkbox" :value="permission.id"> {{permission.label}}<br>{{permission.chi_label}}
                        </label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            profile: {
                default: {}
            },
            editable: {
                type: Boolean,
                default: false
            },
            selectedPermissions: {
                type: Array,
                default: function () {
                    return [];
                }
            }
        },
        data: function () {
            return {
                permissions: []
            }
        },
        methods: {
            isChecked: function (id) {
                return this.selectedPermissions.indexOf(id) >= 0;
            },
            updateSelectedPermissions: function (id) {
                if(this.editable){
                    var index = this.selectedPermissions.indexOf(id);
                    if ( index > -1) {
                        this.selectedPermissions.splice(index, 1);
                    } else {
                        this.selectedPermissions.push(id)
                    }
                }
            }
        },
        watch: {
            profile: function () {
                if (typeof  this.profile !== 'undefined' && this.profile !== null) {
                    if (Array.isArray(this.profile.permissions)) {
                        this.selectedPermissions = this.profile.permissions;
                    } else {
                        this.selectedPermissions = [];
                    }
                }
            }
        },
        events: {
            'reset-selectedPermissions': function () {
                this.selectedPermissions = [];
            }
        },
        created: function () {
            this.$http.get('/getpermissions', function (response) {
                this.$set('permissions', response)
            })
        }
    }
</script>
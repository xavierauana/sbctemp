<style>
    table.table-hover tr.active td{
        background-color: #cfcfcf;
    }
</style>
<template>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>登入名稱 Administrator Name</th>
            <th>權限類別 Permission Type</th>
        </tr>
        </thead>
        <tbody>
        <tr @click="selectUser(user)" v-for="user in users" :class="{'active':isActive(user)}">
            <td>{{ user.loginName }}</td>
            <td>{{ user.profile_id }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: {
            profiles: null,
            users: null,
            selectedUser:{
                twoWay: true
            }
        },
        methods:{
            selectUser: function(user){
                this.selectedUser = user;
            },
            isActive:function(user){
                return user == this.selectedUser
            },
            getProfileLabel:function(){
                return "Yes"
            }
        }
    }
</script>
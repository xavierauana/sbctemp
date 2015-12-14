<template>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>登入名稱</th>
            <th>權限類別</th>
        </tr>
        </thead>
        <tbody>
        <tr @click="selectUser(user)" v-for="user in users">
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
            getProfileLabel:function(){
                return "Yes"
            }
        }
    }
</script>
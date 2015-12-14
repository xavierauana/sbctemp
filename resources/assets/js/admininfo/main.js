/**
 * Created by Xavier on 28/11/15.
 */
new Vue({
    el: "#editAdminInfo",
    data:{
        users:[],
        profiles: require('./data/profiles'),
        permissions: require('./data/systemPermissions')
    },
    ready: function(){
        alert('this is vue')
    }
});

module.exports = App;
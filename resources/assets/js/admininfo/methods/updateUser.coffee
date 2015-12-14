module.exports = ->
  console.log('Put to server and update user');
  this.user.loginName = this.inputs.loginName;
  this.user.profile_id = this.inputs.profile_id;
  this.user.password = this.inputs.password;
                
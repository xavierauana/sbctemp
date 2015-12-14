module.exports = ->
  this.inputs.loginName = this.user.loginName;
  this.inputs.profile_id = this.user.profile_id;
  this.inputs.password = this.user.password;

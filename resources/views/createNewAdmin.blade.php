@extends('partials.adminLayout')

@section('content')
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
                    <option value="">Please select permission profile</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">自定</option>
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

        <div class="row permissions hidden" >
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 讀取客戶資料
                </label>
            </div>
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 讀取管理人員資料
                </label>
            </div>
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 上載文件
                </label>
            </div>
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 新增客戶
                </label>
            </div>
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 新增管理人員
                </label>
            </div>
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 刪除文件
                </label>
            </div>
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 更改客戶資料
                </label>
            </div>
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 更改管理人員資料
                </label>
            </div>
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 更改文件類別資料
                </label>
            </div>
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 刪除客戶
                </label>
            </div>
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 更改及刪除管理人員
                </label>
            </div>
            <div class="col-md-4 col-xs-6 hidden-xs">
                <div class="empty"></div>
            </div>
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 讀取 / 更改客戶登入名稱及密碼
                </label>
            </div>
            <div class="col-md-4 col-xs-6">
                <label>
                    <input type="checkbox" value="1" > 讀取 / 更改管理人員登入名稱及密碼
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-4 pull-right">
                <button type="submit" class="btn btn-block" @click.prevent="resetForm">Reset</button>
            </div>
            <div class="col-xs-12 col-sm-4 pull-right">
                <button type="submit" class="btn btn-block">Confirm</button>
            </div>
        </div>
    </form>
@stop

@section('scripts')
    <script>
        new Vue({
            el: "#createNewAdmin",
            data:{
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
            }
        });
    </script>
@stop
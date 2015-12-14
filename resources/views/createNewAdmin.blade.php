@extends('partials.adminLayout')

@section('content')
    <components :is="currentView"></components>
    {{--<form id="createNewAdmin" class="form-horizontal" @submit.prevent="submitForm">--}}
        {{--<div class="form-group">--}}
            {{--<label for="loginName" class="col-sm-3 control-label">管理人員登入名稱</label>--}}
            {{--<div class="col-sm-9">--}}
                {{--<input type="text" class="form-control" v-model="inputs.loginName" id="loginName" placeholder="Login Name" autofocus required>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="profile" class="col-sm-3 control-label">管理人員權限類別</label>--}}
            {{--<div class="col-sm-9">--}}
                {{--<select name="profile" id="profile" class="form-control" required v-model="inputs.profile" >--}}
                    {{--<option value="">Please select permission profile</option>--}}
                    {{--<option v-for="profile in profiles" :value="profile">@{{profile.label}}</option>--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="profile" class="col-sm-3 control-label">密碼</label>--}}
            {{--<div class="col-sm-9">--}}
                {{--<input type="password" name="password" id="password" class="form-control" placeholder="Password" v-model="inputs.password"  pattern=".{3,}" required/>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="profile" class="col-sm-3 control-label">確認密碼</label>--}}
            {{--<div class="col-sm-9">--}}
                {{--<input type="password" name="confirmation_password" id="confirmation_password" class="form-control" placeholder="Type Password Again" v-model="inputs.confirmation_password"  required />--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<h5 class="hidden"><strong>設定權限</strong></h5>--}}

        {{--<permissions v-show="inputs.profile" :profile="inputs.profile"></permissions>--}}

        {{--<div class="form-group">--}}
            {{--<div class="col-xs-12 col-sm-4 pull-right">--}}
                {{--<button type="submit" class="btn btn-block" @click.prevent="resetForm">Reset</button>--}}
            {{--</div>--}}
            {{--<div class="col-xs-12 col-sm-4 pull-right">--}}
                {{--<button type="submit" class="btn btn-block">Confirm</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</form>--}}
@stop

@section('scripts')
    <script src="/js/app.js"></script>
@stop
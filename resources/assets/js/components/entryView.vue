<style>
    button.btn.btn-block{
        margin-bottom: 15px;
    }
</style>

<template>
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <button class="btn btn-block btn-purple btn-lg" @click.prevent="changeViewTo('UploadFile')">
                上載文件 Upload Files
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <button class="btn btn-block btn-purple btn-lg" @click.prevent="changeViewTo('SearchUser')">
                搜尋用戶 Search User
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title text-center">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                管理人員設定 Administrator Settings
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <ul class="list-group">
                            <!--<li class="list-group-item text-center"><a @click.prevent="changeViewTo('CustomerDocuments')" href="/">用戶文件</a></li>-->
                            <li class="list-group-item text-center"><a @click.prevent="changeViewTo('CreateNewAdmin')" href="/">新增管理人員 Add New Admin</a></li>
                            <li class="list-group-item text-center"><a @click.prevent="changeViewTo('AdminInfo')" href="/">管理人員資料 Admin Info</a></li>
                             <li class="list-group-item text-center"><a @click.prevent="changeViewTo('EditDocumentType')" href="/">文件類別設定 Doc Type Setting</a></li>
                             <li class="list-group-item text-center"><a @click.prevent="changeViewTo('PermissionSetting')" href="/">權限類別設定 Permissions Setting</a></li>
                             <li class="list-group-item text-center"><a @click.prevent="changeViewTo('ExportData')" href="/">賬戶資料總匯表 Export User Info</a></li>
                             <li class="list-group-item text-center"><a @click.prevent="changeViewTo('CreateLinkage')" href="/">Create Linkage</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props:{
            currentView: String
        },
        methods:{
            changeViewTo: function(view){
                console.log(view);
                this.$dispatch('change-base-view', view);
            }
        }
    }
</script>
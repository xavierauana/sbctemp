<style>
    span.nav-item-span{
        display:inline-block;
        width: 50%;
    }
</style>

<template>
    <div class="sidebar-nav">
        <div class="navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="visible-xs navbar-brand">Administration menu</span>
            </div>
            <div class="navbar-collapse collapse sidebar-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a @click.prevent="changeViewTo('UploadFile')" :class="{'active': isCurrentView('UploadFile')}" href="/">
                        <span class="nav-item-span">上載文件</span><span class="nav-item-span">Upload File</span>
                    </a></li>
                    <li><a @click.prevent="changeViewTo('SearchUser')" :class="{'active': isCurrentView('SearchUser')}" href="/">
                        <span class="nav-item-span">搜尋用戶</span><span class="nav-item-span">Search User</span>
                    </a></li>
                    <!--<li><a @click.prevent="changeViewTo('CustomerDocuments')" :class="{'active': isCurrentView('CustomerDocuments')}" href="/">用戶文件</a></li>-->
                    <li><a @click.prevent="changeViewTo('CreateNewAdmin')" :class="{'active': isCurrentView('CreateNewAdmin')}" href="/">
                        <span class="nav-item-span">新增管理人員</span><span class="nav-item-span">Create Administrator</span>
                    </a></li>
                    <li><a @click.prevent="changeViewTo('AdminInfo')" :class="{'active': isCurrentView('AdminInfo')}" href="/">
                        <span class="nav-item-span">管理人員資料</span><span class="nav-item-span">Administrator Info</span>
                     </a></li>
                    <li><a @click.prevent="changeViewTo('EditDocumentType')" :class="{'active': isCurrentView('EditDocumentType')}" href="/">
                        <span class="nav-item-span">文件類別設定</span><span class="nav-item-span">Doc Types Setting</span>
                     </a></li>
                    <li><a @click.prevent="changeViewTo('PermissionSetting')" :class="{'active': isCurrentView('PermissionSetting')}" href="/">
                        <span class="nav-item-span">權限類別設定</span><span class="nav-item-span">Permissions Setting</span>
                     </a></li>
                    <li><a @click.prevent="changeViewTo('ExportData')" :class="{'active': isCurrentView('ExportData')}" href="/">
                        <span class="nav-item-span">賬戶資料總匯表</span><span class="nav-item-span">Export Clients Info</span>
                     </a></li>
                    <li><a @click.prevent="changeViewTo('CreateLinkage')" :class="{'active': isCurrentView('CreateLinkage')}" href="/">
                        <span class="nav-item-span">Create Linkage</span><span class="nav-item-span"></span>
                     </a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</template>

<script>
    export default{
        props:['CurrentView'],
        methods: {
            changeViewTo: function(view){
                this.$dispatch('change-base-view', view)
            },
            isCurrentView: function(view){
                return this.CurrentView == view;
            }
        }
    }
</script>
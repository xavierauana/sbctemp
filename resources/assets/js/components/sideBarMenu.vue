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
                    <li><a @click.prevent="changeViewTo('UploadFile')" :class="{'active': isCurrentView('UploadFile')}" href="/">上載文件</a></li>
                    <li><a @click.prevent="changeViewTo('SearchUser')" :class="{'active': isCurrentView('SearchUser')}" href="/">搜尋用戶</a></li>
                    <li><a @click.prevent="changeViewTo('CreateNewAdmin')" :class="{'active': isCurrentView('CreateNewAdmin')}" href="/">新增管理人員</a></li>
                    <li><a @click.prevent="changeViewTo('AdminInfo')" :class="{'active': isCurrentView('AdminInfo')}" href="/">管理人員資料</a></li>
                    <li><a @click.prevent="changeViewTo('EditDocumentType')" :class="{'active': isCurrentView('EditDocumentType')}" href="/">文件類別設定</a></li>
                    <li><a @click.prevent="changeViewTo('PermissionSetting')" :class="{'active': isCurrentView('PermissionSetting')}" href="/">權限類別設定</a></li>
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
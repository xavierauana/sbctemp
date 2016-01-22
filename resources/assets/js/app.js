/**
 * Created by Xavier on 10/12/15.
 */
var Vue = require('vue');

Vue.use(require('vue-resource'));

Vue.config.debug = true;

import EntryView from './components/entryView.vue';
import CreateNewAdmin from './components/createNewAdmin.vue'
import AdminInfo from './components/adminInfo.vue'
import SideBarMenu from './components/sideBarMenu.vue'
import EditDocumentType from './components/editDocumentType.vue'
import PermissionSetting from './components/permissionSetting.vue'
import SearchUser from './components/searchUser.vue'
import UploadFile from './components/uploadFile.vue'
import CustomerDocuments from './components/customerDocuments.vue'
import ExportData from './components/exportData.vue'
import CreateLinkage from './components/createLinkage.vue'
import SearchPNumber from './components/searchPNumber.vue'


new Vue({
    el: "body",
    data: {
        entryView: true,
        currentView: ""
    },
    events: {
        "change-base-view": function (view) {
            this.entryView = false;
            this.currentView = view;
        }
    },
    components: {
        EntryView,
        CreateNewAdmin,
        AdminInfo,
        SideBarMenu,
        EditDocumentType,
        PermissionSetting,
        SearchUser,
        UploadFile,
        CustomerDocuments,
        ExportData,
        CreateLinkage,
        SearchPNumber
    }
})
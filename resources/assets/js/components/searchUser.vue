<template>
    <div>
        <div class="well">
            <h3>搜尋用戶 Search User</h3>

            <form action="" method="POST" @submit.prevent="searchUser">
                <div class="input-group">
                    <input type="number" v-model="cNumber" id="searchCNumber" class="form-control"
                           placeholder="客戶公司序號 C Number" autofocus>
                  <span class="input-group-btn">
                    <button class="btn" type="button" @click.prevent="searchUser">Search</button>
                  </span>
                </div>
            </form>
        </div>

        <form class="form-horizontal" v-show="user">
            <div class="form-group">
                <label for="cNumber" class="col-sm-3 control-label">客戶公司序號 C Number</label>

                <div class="col-sm-9">
                    <input type="number" class="form-control" name="cNumber" v-model="inputs.id"
                           placeholder="C Number" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="cNumber" class="col-sm-3 control-label">公司中文名稱 Chinese Company Name</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" v-model="inputs.chinese_name"
                           placeholder="Chinese Company Name" @paste="pasteCompanyName"
                           @keypress.prevent="pressOnCompanyName" @keydown="disableBackSpace" oncut="return false;">
                </div>
            </div>
            <div class="form-group">
                <label for="cNumber" class="col-sm-3 control-label">公司英文名稱 English Company Name</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" name="cNumber" v-model="inputs.english_name"
                           placeholder="English Company Name" @keypress.prevent="pressOnCompanyName"
                           @keydown="disableBackSpace" oncut="return false;">
                </div>
            </div>
            <div class="form-group">
                <label for="login" class="col-sm-3 control-label">登入名稱 Login Name</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" id="login" v-model="inputs.loginname" name="login"
                           placeholder="Login Name">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-3 control-label">登入密碼 Password</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" id="password" v-model="inputs.password" name="password"
                           placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">電郵 Email</label>

                <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" v-model="inputs.email" name="email"
                           placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-3 control-label">狀況 Status</label>
                <div class="col-sm-9" data-toggle="buttons">
                    <label class="btn"  :class="{'btn-danger':!inputs.status, 'btn-success':inputs.status}" @click.prevent="toggleInputStatus">
                        <input type="checkbox" autocomplete="off" v-model="inputs.status" id="status" value="1"> {{showStatusButton}}
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="is_activated" class="col-sm-3 control-label">客戶己啟動賬戶 Client Activated Account</label>
                <div class="col-sm-9">
                    <label class="btn" :class="{'btn-danger':!inputs.is_activated, 'btn-success':inputs.is_activated}" >
                        <span> {{showIsActivatedButton}}</span>
                    </label>
                </div>
            </div>
            <div class="row button-group pull-right clearfix">
                <button class="btn" :class="{'btn-purple':!isButtonActive}" @click.prevent="update" :disabled="isButtonActive">更新 Update</button>
                <button class="btn" :class="{'btn-purple':!isButtonActive}" @click.prevent="reset" :disabled="isButtonActive">重設 Reset</button>
                <button class="btn" :class="{'btn-purple':!isButtonActive}" @click.prevent="revert" :disabled="isButtonActive">返回原本設定 Revert to Default</button>
                <button class="btn" class="btn-purple" @click.prevent="printLetter" >Print Letter</button>
            </div>
        </form>
        <br>
        <br>

        <div v-show="hasDocuments">
            <grid
                    :data.sync="documents"
                    :columns="columns"
                    :can-preview="true"
                    :filter-key="searchQuery">
            </grid>
            <iframe v-show="showPreview" id="viewer" :src="" frameborder="0" scrolling="no" width="500"
                    height="770"></iframe>
        </div>
    </div>
</template>

<script>
    import Grid from './grid.vue'
    export default{
        components: {
            Grid
        },
        data: function () {
            return {
                searchQuery: '',
                columns: [{
                    label: '上載日期 Upload Date',
                    code: 'uploadDate'
                }, {
                    label: '文件類別 Document Type',
                    code: 'docType'
                }, {
                    label: '文件名稱 Document Name',
                    code: 'docName'
                }],
                cNumber: "",
                user: {},
                inputs: {},
                documents: [],
                table: "",
                previewing: false,
                isButtonActive: true
            }
        },
        computed: {
            hasDocuments: function () {
                return !!this.documents.length
            },
            showStatusButton: function () {
                return this.inputs.status ? "Active" : "Not Active";
            },
            showIsActivatedButton: function () {
                return this.inputs.is_activated ? "己啟動 Activated" : "尚未啟動 Not Activated";
            }
        },
        watch: {
            user: function () {
                if (!!this.user) {
                    var url = '/getUserDocuments/' + this.user.id;
                    this.$http.get(url, function (response) {
                        Array.isArray(response) ? this.$set('documents', response) : this.$set('documents', [])
                    })
                }
            },
            inputs: {
                handler: function(){
                    var check = true;
                     for( var key in this.inputs){
                         if(this.inputs[key] !== this.user[key]){
                             check = false;
                             break
                         }
                     }
                    this.isButtonActive = check
                },
                deep: true
            }
        },
        methods: {
            revert: function(){
              for(var key in this.user){
                  this.inputs[key] = this.user[key];
              }
            },
            disableBackSpace: function (e) {
                if (e.keyCode == 8) e.preventDefault();
            },
            pasteCompanyName: function (e) {
                console.log('paste something')
            },
            pressOnCompanyName: function (e) {
                console.log(e.keyCode);
                return false;
            },
            sortBy: function (key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1
            },
            toggleInputIsActivate: function () {
                this.inputs.is_activated = !this.inputs.is_activated;
            },
            toggleInputStatus: function () {
                this.inputs.status = !this.inputs.status;
            },
            toggleTooltip: function (e) {
                $('#searchCNumber').tooltip({
                    trigger: 'manual',
                    title: "只可輸入數字 number only"
                });
                (e.keyCode < 48 || e.keyCode > 57) && e.keyCode !== 13 ? $('#searchCNumber').tooltip('show') : $('#searchCNumber').tooltip('hide');
            },
            searchUser: function () {
                console.log('get request to server to find the user');
                if (this.cNumber) {
                    var url = "/searchcustomer/" + this.cNumber;
                    this.$http.get(url, function (response) {
                        console.log(response);
                        if (response) {
                            this.$set('inputs', response.customer);
                            this.$set('user', JSON.parse(JSON.stringify(response.customer)));
                        } else {
                            alert('no one match the c number! Please verify.')
                        }
                    })
                } else {
                    alert('You have to input the C Number!');
                }
            },
            reset: function () {
                for (var key in this.inputs) {
                    if (key !== 'id') this.inputs[key] = "";
                }
            },
            update: function () {
                console.log('put to server. and update info!');
            },
            printLetter:function(){
                window.open(
                        '/template/print/'+this.cNumber,
                        '_blank' // <- This is what makes it open in a new window.
                );
                console.log('print letter');
            }
        },
        ready: function () {
            document.getElementById("searchCNumber").addEventListener("keypress", this.toggleTooltip);
        }
    }
</script>
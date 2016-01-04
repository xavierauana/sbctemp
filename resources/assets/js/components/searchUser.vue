<template>
    <div>
        <div class="well">
            <h3>搜尋用戶 Search User</h3>

            <form action="" method="POST" @submit.prevent="searchUser">
                <div class="input-group">
                    <input type="number" v-model="cNumber" id="searchCNumber" class="form-control"
                           placeholder="客戶公司序號 C Number" autofocus>
                  <span class="input-group-btn">
                    <button class="btn" type="button" @click.prevent="searchUser">Go!</button>
                  </span>
                </div>
            </form>
        </div>

        <form class="form-horizontal" v-show="user">
            <div class="form-group">
                <label for="cNumber" class="col-sm-3 control-label">客戶公司序號 C Number</label>

                <div class="col-sm-9">
                    <input type="number" class="form-control" name="cNumber" v-model="inputs.cNumber"
                           placeholder="C Number" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="cNumber" class="col-sm-3 control-label">公司中文名稱 Chinese Company Name</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" v-model="inputs.chinese_name"
                           placeholder="Chinese Company Name">
                </div>
            </div>
            <div class="form-group">
                <label for="cNumber" class="col-sm-3 control-label">公司英文名稱 English Company Name</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" name="cNumber" v-model="inputs.english_name"
                           placeholder="English Company Name">
                </div>
            </div>
            <div class="form-group">
                <label for="login" class="col-sm-3 control-label">登入名稱 Login Name</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" id="login" v-model="inputs.login" name="login"
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
                <label for="status" class="col-sm-3 control-label">Status</label>

                <div class="col-sm-9" data-toggle="buttons">
                    <label class="btn {{getStatusButtonClass}}" @click.prevent="toggleInputStatus">
                        <input type="checkbox" autocomplete="off" v-model="inputs.status"> {{showStatusButton}}
                    </label>
                </div>
            </div>
            <div class="row button-group pull-right clearfix">
                <button class="btn btn-purple" @click.prevent="update">更新 Update</button>
                <button class="btn btn-purple" @click.prevent="reset">重設 Reset</button>
            </div>
        </form>
        <br>
        <br>
        <div v-show="hasDocuments">
            <grid
                    :data.sync="documents"
                    :columns="columns"
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
        components:{
          Grid
        },
        data: function () {
            return {
                searchQuery: '',
                columns: [{
                    label:'上載日期 Upload Date',
                    code:'uploadDate'
                },{
                    label:'文件類別 Document Type',
                    code:'docType'
                },{
                    label:'文件名稱 Document Name',
                    code:'docName'
                }],
                cNumber: "",
                user: "",
                inputs: {},
                documents: [],
                table: "",
                previewing: false
            }
        },
        computed: {
            hasDocuments: function () {
                return !!this.documents.length
            },
            showStatusButton: function () {
                return this.inputs.status ? "Active" : "Not Active";
            },
            getStatusButtonClass: function () {
                return this.inputs.status ? 'btn-success' : 'btn-danger';
            }
        },
        watch: {
            user: function () {
                if (!!this.user) {
                    var url = '/getUserDocuments/' + this.user.cNumber;
                    this.$http.get(url, function (response) {
                        Array.isArray(response)? this.$set('documents', response):this.$set('documents', [])
                    })
                }
            }
        },
        methods: {
            sortBy: function (key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1
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
                            this.$set('user', response);
                            this.$set('inputs', response);
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
                    if (key !== 'cNumber') this.inputs[key] = "";
                }
            },
            update: function () {
                console.log('put to server. and update info!');
            }
        },
        ready: function () {
            document.getElementById("searchCNumber").addEventListener("keypress", this.toggleTooltip);
        }
    }
</script>
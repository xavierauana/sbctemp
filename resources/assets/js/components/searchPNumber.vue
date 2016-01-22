<template>
    <div>
        <div class="well">
            <h3>Search P Number</h3>

            <form action="" method="POST" @submit.prevent="searchForPNumber">
                <div class="input-group">
                    <input type="number" v-model="pNumber" id="searchPNumber" class="form-control"
                           placeholder="P number" autofocus>
                  <span class="input-group-btn">
                    <button class="btn" type="button" @click.prevent="searchForPNumber">Go!</button>
                  </span>
                </div>
            </form>
        </div>

        <form class="form-horizontal" v-show="user">
            <div class="form-group">
                <label for="pNumber" class="col-sm-3 control-label">P Number</label>

                <div class="col-sm-9">
                    <input type="number" class="form-control" name="pNumber" v-model="inputs.id"
                           placeholder="P Number" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="pNumber" class="col-sm-3 control-label">Person Name</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" v-model="inputs.name"
                           placeholder="Info 1" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="pNumber" class="col-sm-3 control-label">P number info 2</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" name="pNumber" v-model="inputs.english_name"
                           placeholder="Info 2" @keypress.prevent="pressOnCompanyName"
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
                <div class="col-sm-9" data-toggle="buttons">
                    <label class="btn" :class="{'btn-danger':!inputs.is_activated, 'btn-success':inputs.is_activated}" @click.prevent="toggleInputIsActivate">
                        <input type="checkbox" autocomplete="off" v-model="inputs.is_activated" id="is_activated" value="1"> {{showIsActivatedButton}}
                    </label>
                </div>
            </div>
            <div class="row button-group pull-right clearfix">
                <button class="btn" :class="{'btn-purple':!isButtonActive}" @click.prevent="update" :disabled="isButtonActive">更新 Update</button>
                <button class="btn" :class="{'btn-purple':!isButtonActive}" @click.prevent="reset" :disabled="isButtonActive">重設 Reset</button>
                <button class="btn" :class="{'btn-purple':!isButtonActive}" @click.prevent="revert" :disabled="isButtonActive">返回原本設定 Revert to Default</button>
                <button class="btn" :class="{'btn-purple':!isButtonActive}" @click.prevent="modalShow=true" :disabled="isButtonActive">Add Company Linkage</button>
            </div>
        </form>
        <br>
        <br>
        <modal :show.sync="modalShow">
            <h2 slot="header">Create Linkage</h2>
            <div slot="body">
                <div class="input-group">
                    <input type="number" class="form-control" v-model="cnumber"
                           placeholder="C number" autofocus>
                  <span class="input-group-btn">
                    <button class="btn" type="button" @click.prevent="searchForCompany">Go!</button>
                  </span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Company English Name" v-model="company.english_name" disabled>
                </div>
            </div>
            <div slot="footer">
                <button class="btn btn-default" @click.prevent="createLinkage">Link</button>
                <button class="btn btn-default" @click.prevent="modalShow=false">Cancel</button>
            </div>
        </modal>


        <div v-show="hasCompanies">
            <grid
                    :data.sync="companies"
                    :columns="columns"
                    :filter-key="searchQuery">
            </grid>
        </div>
    </div>
</template>

<script>
    import Grid from './grid.vue'
    import Modal from './modal.vue'
    export default{
        components: {
            Grid,
            Modal
        },
        data: function () {
            return {
                searchQuery: '',
                modalShow: false,
                columns: [{
                    label: 'C Number',
                    code: 'id'
                },{
                    label: 'Chinese Company Name',
                    code: 'chinese_name'
                },  {
                    label: 'English Company Name',
                    code: 'english_name'
                }],
                pNumber: "",
                cnumber: "",
                user: {},
                inputs: {},
                companies: [],
                company: {},
                table: "",
                previewing: false,
                isButtonActive: true
            }
        },
        computed: {
            hasCompanies: function () {
                return !!this.companies.length
            },
            showStatusButton: function () {
                return this.inputs.status ? "Active" : "Not Active";
            },
            showIsActivatedButton: function () {
                return this.inputs.is_activated ? "己啟動 Activated" : "尚未啟動 Not Activated";
            }
        },
        watch: {
            user:function(){
              if(this.user) this.companies = this.inputs.companies;
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
            createLinkage: function(){
              if(this.pNumber && this.cnumber){
                  this.$http.get('/createLinkage/user/'+this.pNumber+'/company/'+this.cnumber, function(response){
                      if(response.code == 201){
                          alert('the company already associate with other p number')
                      }else if(response.code == 202){
                          alert('the company already associate with you');
                          this.$set('modalShow', false);
                          this.$set('cnumber', "");
                          this.$set('company', {});
                      }else if(response.code == 200){
                         alert('successfully create linkage');
                        this.companies.push(this.company);
                         this.$set('modalShow', false);
                         this.$set('cnumber', "");
                         this.$set('company', {});
                     }
                  });
              }
            },
            searchForCompany: function(){
                this.$http.get('/searchcustomer/'+this.cnumber, function(response){
                    if(response.customer){
                        this.company = response.customer;
                    }
                })
            },
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
                $('#searchPNumber').tooltip({
                    trigger: 'manual',
                    title: "只可輸入數字 number only"
                });
                (e.keyCode < 48 || e.keyCode > 57) && e.keyCode !== 13 ? $('#searchPNumber').tooltip('show') : $('#searchPNumber').tooltip('hide');
            },
            searchForPNumber: function () {
                console.log('get request to server to find the user');
                if (this.pNumber) {
                    var url = "/searchpumber/" + this.pNumber;
                    this.$http.get(url, function (response) {
                        console.log(response);
                        if (response) {
                            this.$set('inputs', response.user);
                            this.$set('user', JSON.parse(JSON.stringify(response.user)));
                        } else {
                            alert('no one match the p number! Please verify.')
                        }
                    })
                } else {
                    alert('You have to input the P Number!');
                }
            },
            reset: function () {
                for (var key in this.inputs) {
                    if (key !== 'id') this.inputs[key] = "";
                }
            },
            update: function () {
                console.log('put to server. and update info!');
            }
        },
        ready: function () {
            document.getElementById("searchPNumber").addEventListener("keypress", this.toggleTooltip);
        }
    }
</script>
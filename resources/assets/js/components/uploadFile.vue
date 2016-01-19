<template>
    <div>
        <form class="form-horizontal" method="POST" encrtype="multipart/form-data">
            <legend>上載文件 Upload Files</legend>
            <div class="form-group">
                <label for="uploadDate" class="sr-only">Document Upload Date</label>
                <div class="col-sm-8">
                    <input type="text" v-model="inputs.uploadDate" :value="uploadDate" name="uploadDate" class="form-control" id="uploadDate" placeholder="文件日期" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="cnumber" class="sr-only">C Number</label>
                <div class="col-sm-8">
                    <input type="number" name="cnumber" v-model="inputs.cNumber" class="form-control" placeholder="客戶公司序號 C Number" @change="checkValidity" pattern="/[1-9]{10}/" title="This is an error message" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label for="cnumber" class="sr-only">Company Name</label>
                <div class="col-sm-8">
                    <input type="number" name="cnumber" v-model="customer.name" class="form-control" placeholder="客戶公司名稱 Company Name "  title="This is an error message" required>
                </div>
            </div>
            <div class="form-group">
                <label for="docDate" class="sr-only">Document Date</label>

                <div class="col-sm-8">
                    <div class='input-group date' id='datetimepicker'>
                        <input type='text' class="form-control" name="docDate"  v-model="inputs.docDate" id="docDate" placeholder="文件日期 Document Date (YYYY/MM/DD)" @keypress="showkeypress" pattern="/[0-9]\//" required/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="docType" class="sr-only">Document Type</label>
                <div class="col-sm-8">
                    <select name="docType" id="docType" v-model="inputs.docType" class="form-control" style="width:100%">
                        <option value="" selected> -- 文件類別 Document Type -- </option>
                        <option v-for="docType in documentTypes" :value="docType.id">{{docType.type}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="docName" class="sr-only">Document Name</label>
                <div class="col-sm-8">
                    <input type="docName" name="docName" v-model="inputs.docName" class="form-control" id="docName" placeholder="文件描述 Document Description" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8">
                    <button class="btn btn-default" @click.prevent="browseFile">Browser File 瀏覽檔案</button>
                    <p class="help-block">File size should not bigger than 5MB. 文件容量不可超過5MB。</p>
                    <input type="file" class="hidden" name="files" id="file" @change="checkFileInput"  required>
                </div>
            </div>
            <div v-show="hasFile" class="col-sm-8" style="padding-left: 0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>File Name</th>
                            <th>File Size</th>
                            <th>Preview</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{inputFile.name}}</td>
                            <td>{{inputFile.size/(1000*1000)}} mb</td>
                            <td>
                                <button class="btn btn-default btn-sm" @click.prevent="previewPDF">{{previewButtonText}}</button>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-danger" @click.prevent="removeFile">刪除</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-block btn-purple" @click.prevent="uploadFile">Upload File 上載文件</button>
                </div>
            </div>
        </form>
        <div class="row"  v-show="showPreview">
            <div class="col-sm-8">
                <iframe :src="previewSrc" id="viewer" frameborder="0" scrolling="no" width="100%" height="550"></iframe>
            </div>
        </div>
    </div>

</template>

<script>
    export default{
        data: function(){
            return {
                maxFileSize: 5,
                documentTypes:[],
                inputs:{
                    cNumber:"",
                    docType:"",
                    docDate:"",
                    uploadDate:"",
                    docName:""
                },
                checking:{
                    cNumberValidity:false,
                    fileValidity:false
                },
                inputFile:{
                    name:"",
                    size:"",
                    data:"",
                },
                customer:{},
                previewing:false,
                previewSrc:""
            }
        },
        computed:{
            uploadDate: function(){
                var date =moment().format('YYYY/MM/DD');
                return date;
                return date.getFullYear()+"/"+ date.getMonth()+"/"+ date.getDate();
            },
            hasFile: function(){
                return !!this.inputFile.name;
            },
            showPreview: function(){
                return !!this.inputFile.name && this.previewing
            },
            previewButtonText:function(){
                return this.previewing? "Close Window" : "Preview"
            }
        },
        methods:{
            checkFileApiSupport: function checkForFileApiSupport() {
                if (window.File && window.FileReader && window.FileList && window.Blob) {
                    return true
                }
                else {
                    alert("The File APIs are not fully supported in this browser.");
                    return false
                }
            },
            checkValidity: function(){
                if(!this.inputs.cNumber){
                    alert('Have to input cnumber')
                }else{
                    var url = '/searchcustomer/'+this.inputs.cNumber;
                    this.$http.get(url, function(response){
                        if(!response){
                            this.checking.cNumberValidity = false;
                            alert('that is a incorrect C number! Please verify')
                        }else{
                            this.checking.cNumberValidity = true;
                            this.customer = response;
                        }
                    })
                }
            },
            removeFile: function(){
                console.log('remove file');
                for(var key in this.inputFile){
                    this.inputFile[key] = "";
                }
                $("#viewer").attr('src', "");
            },
            validation:function(){
                var check = true;
                if(!this.inputs.cNumber){
                    check = false;
                    alert('have input cNumber');
                }else{
                    if(!this.checking.cNumberValidity){
                        check = false;
                        alert('You have input wrong C number! Please verify');
                    }
                }
                if(!this.inputs.docDate){
                    check = false;
                    alert('You have to input Document Date');
                }
                if(!this.inputs.docName){
                    check = false;
                    alert('You have to input Document Name');
                }
                if(!this.inputs.docType){
                    check = false;
                    alert('You have to pick a document type');
                }
                if(!this.checking.fileValidity){
                    check = false;
                    alert('Something wrong with your file, please double check!');
                }
                return check;
            },
            mergeData: function(){
                var data = new FormData();
                for(var key in this.inputs){
                    data.append(key, this.inputs[key])
                }
                data.append('file', this.inputFile.data);

                return data;
            },
            uploadFile: function(){
                if(this.validation()){
                    var data = this.mergeData();
                    this.$http.post('/uploadfile', data, function(response){
                        console.log(response);
                        this.reset();
                    },{
                        headers:{
                            "X-CSRF-TOKEN" : $('meta[name="token"]').attr("content")
                        }
                    });
                };
                console.log('upload file')
            },
            checkFileInput: function(){
                var file = document.querySelector("#file").files[0];
                console.log(file);
                if(file && file.size > 0){
                    if(file.size > (this.maxFileSize * 1000 * 1000)){
                        alert('file size is too large!');
                        this.checking.fileValidity = false;
                    }else if(file.type != "application/pdf"){
                        alert('Only pdf allowed!');
                        this.checking.fileValidity = false;
                    }else{
                        this.inputFile['name'] = file.name;
                        this.inputFile['data'] = file;
                        this.inputFile['size'] = file.size;
                        this.checking.fileValidity = true;
                    }
                }
            },
            browseFile:function(){
                console.log('browser file');
                document.querySelector("#file").click();
            },
            previewPDF: function () {
                console.log('preview pdf');
                this.previewSrc = this.previewing? "" : URL.createObjectURL(this.inputFile.data);
                this.previewing = !this.previewing;
            },
            reset:function(){
                for(var key in this.inputs){
                    this.inputs[key] = ""
                }
                for(var key in this.checking){
                    this.checking[key] = false
                }
                for(var key in this.inputFile){
                    this.inputFile[key] = ""
                }
                this.customer = {};
                this.previewing = false;

                var date = new Date();
                this.inputs.uploadDate = date.getFullYear()+"/"+ date.getMonth()+"/"+ date.getDate();

            },
            showkeypress: function(e){
                console.log(e.keyCode);
                if(e.keyCode < 47 || e.keyCode > 57 ) return false;
            }
        },
        created: function(){
            this.$http.get('/getdoctypes', function(response){
                response.map(function(type){
                    type['status'] = false;
                });
                this.$set("documentTypes", response);
            })
        },
        ready: function(){
            $('#datetimepicker').datetimepicker({
                format:"YYYY/MM/DD"
            });
            this.checkFileApiSupport();
        }
    }
</script>
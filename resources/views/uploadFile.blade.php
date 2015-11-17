<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.15/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>


    <link rel="stylesheet" href="/css/sass/main.css">
</head>
<body>
<div class="container" id="app">
    <nav class="navbar">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-4">
                    <img src="/imgs/sbc_logo.png" class="img-responsive" alt="">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-8">
                    <ul class="list-inline list-unstyled pull-right">
                        <li>Hello, Admin Rainbow</li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
    </nav>

    <form class="form-horizontal" method="POST" encrtype="multipart/form-data">
            <legend> Upload Files</legend>
            <div class="form-group">
                <label for="cnumber" class="sr-only">C Number</label>
                <div class="col-sm-8">
                    <input type="number" name="cnumber" class="form-control" id="cnumber" placeholder="C No." v-on="blur: checkValidility" pattern="/[1-9]{10}/" title="This is an error message" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label for="docDate" class="sr-only">Document Date</label>
                <div class="col-sm-8">
                    <input type="text" name="docDate" class="form-control" id="docDate" placeholder="文件日期" required>
                </div>
            </div>
            <div class="form-group">
                <label for="docType" class="sr-only">Document Type</label>
                <div class="col-sm-8">
                    <select name="docType" id="docType" class="form-control" style="width:100%">
                        <option value="">Document Type</option>
                        <option value="1">Type 1</option>
                        <option value="2">Type 2</option>
                        <option value="3">Type 3</option>
                        <option value="4">Type </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="docName" class="sr-only">Document Name</label>
                <div class="col-sm-8">
                    <input type="docName" name="docName" class="form-control" id="docName" placeholder="文件名稱" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8">
                    <button class="btn btn-default" v-on="click: browseFile">Browser File</button>
                    <p class="help-block">File size should not bigger than 5,000kb</p>
                    <input type="file" class="hidden" name="files" id="files" v-on="change: checkFileInput" accept=".pdf, application/pdf" required multiple>

                </div>
            </div>
            <div class="panel panel-default" v-show="hasFiles">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>File Name</th>
                            <th>File Size</th>
                            <th class="hidden-xs">Validity</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-repeat="file: files" v-class="bg-warning: !file.valid">
                            <td>@{{file.name}}</td>
                            <td>@{{file.size}} kb</td>
                            <td class="hidden-xs">@{{file.valid}}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" v-on="click:removeFile($index)">Remove</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-lg  btn-block" v-on="click: uploadFiles">Save</button>
                </div>
            </div>
        </form>
</div>

<script type="text/javascript">

    function cl(item){
        console.log(item)
    }
    $(function () {
        $('#docDate').datetimepicker({
            format: "DD MMM, YYYY",
            useCurrent:true
        });
        var selectObject = $("#docType").select2();
        var container =  $(".select2-selection");
        container.on('focus', function(){
            selectObject.select2('open')
        });
    });

    new Vue({
        el: "#app",
        data:{
          files:[],
          maxSize: 5000000
        },
        computed:{
            hasFiles:function(){
                return this.files.length > 0
            }
        },
        methods: {
            checkValidility: function(e){
                if(!e.target.checkValidity()) e.target.focus();
            },
            browseFile:function(){
              $("#files").click()
            },
            uploadFiles : function(e){
                e.preventDefault();
                console.log('fired')
                this.beforeSend()
            },
            beforeSend: function(){
                this.files.filter(function(file){
                    return file.valid
                }).map(function(file){
                    console.log(file.name)
                });
            },
            checkFileInput: function(e){
                for(var index in e.target.files){
                    var valid, size, file;
                    file = e.target.files[index];
                    if(file instanceof File){
                        var test = this.files.filter(function(exitingFile){
                            return exitingFile.name == file.name
                        })
                        if(!test.length){
                            file.size < this.maxSize? valid=true : valid=false;
                            size = (file.size/1000).toFixed(2);
                            this.files.push({
                                name: file.name,
                                size: size,
                                valid: valid,
                                file: file
                            })
                        }
                    }
                }
                e.target.value = "";
            },
            removeFile:function(index){
                this.files.splice(index, 1)
            }
        }
    })

</script>
</body>
</html>
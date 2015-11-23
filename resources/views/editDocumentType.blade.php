@extends('partials.adminLayout')

@section('content')
    <div id="editDocumentType">
        <div class="panel panel-default">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>編號</th>
                    <th>文件類別名稱</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="docType in documentTypes">
                        <td style="max-width:25%">
                            <input class="form-control" type="text" name="index" :value="docType.index" disabled >
                        </td>
                        <td style="max-width:25%">
                            <input class="form-control" type="text" name="type" :value="docType.type" disabled>
                        </td>
                        <td style="min-width:30%">
                            <div class="btn-group hidden-xs" role="group" aria-label="Basic example">
                                <input type="submit"
                                       :value="docType.status?'更新':'編輯'"
                                       class="btn btn-sm"
                                       v-bind:class=" {'btn-success': docType.status, 'btn-primary': !docType.status}"
                                       @click.prevent="edit($event, docType)"/>
                                <button class="btn btn-danger btn-sm" v-on:click="deleteDocType($event, docType)" >刪除</button>
                            </div>
                            <div class="btn-group-vertical visible-xs" role="group" aria-label="Basic example">
                                <input type="submit"
                                       :value="docType.status?'更新':'編輯'"
                                       class="btn btn-sm"
                                       v-bind:class=" {'btn-success': docType.status, 'btn-primary': !docType.status}"
                                       @click.prevent="edit($event, docType)"/>
                                <button class="btn btn-danger btn-sm" v-on:click="deleteDocType($event, docType)">刪除</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <form class="form-horizontal">
            <div class="form-group">
                <label for="docTypeIndex" class="col-sm-3 control-label">編號</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="docTypeIndex" v-model="index" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="docType" class="col-sm-3 control-label">文件類別名稱</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="docType" v-model="type" placeholder="">
                </div>
            </div>
            <div class="row button-group">
                <div class="col-sm-3">
                    <button class="btn btn-block" v-on:click="addNewDocumentType">新增</button>
                </div>
                <div class="col-sm-3 hidden">
                    <button class="btn btn-block ">編輯</button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-block" v-on:click="resetForm">取消</button>
                </div>
            </div>

            <div class="row button-group">
                <div class=" col-sm-3 hidden">
                    <button class="btn btn-block">存檔</button>
                </div>
                <div class="col-sm-3 hidden">
                    <button class="btn btn-block">刪除</button>
                </div>
                <div class="col-sm-offset-3 col-sm-3 hidden">
                    <button class="btn btn-block">退出</button>
                </div>
            </div>
        </form>
    </div>
@stop

@section('scripts')
    <script>
        new Vue({
            el: "#editDocumentType",
            data:{
                index:"",
                type:"",
              documentTypes: [
                  {id:1, index: "001", type: "B.R. 商業登記證", status:false},
                  {id:2, index: "002", type: "自定", status:false}
              ]
            },
            methods: {
                deleteDocType: function(e, docType) {
                    e.preventDefault();
                    console.log("will delete the docType" );
                    if(confirm("Are you sure to delete document type \""+docType.type+"\"?")){
                        this.documentTypes = this.documentTypes.filter(function(doc){
                            return doc.id !== docType.id
                        })
                    }
                },
                edit: function (e, docType) {
                    var docType, inputs, button;
                    button = e.target;
                    inputs = $(button).parents('tr').find("input[type='text']");
                    theDocType = this.documentTypes.filter(function(item){return item.id == docType.id })[0];
                    if(theDocType.status == false){
                        theDocType.status = !theDocType.status;
                        button.className = e.target.className.replace('btn-primary','btn-success');
                        for (var i=0; i< inputs.length; i++) {
                            if ( inputs[i].hasAttribute('disabled') && inputs[i].type =='text') {
                                inputs[i].removeAttribute('disabled')
                            }
                        }
                    }else{
                        console.log('will PUT to update');
                        console.log($(e.target.form).serialize());
                        theDocType.status = !theDocType.status;
                        e.target.className = e.target.className.replace('btn-success','btn-primary');
                        for (var i=0; i< inputs.length; i++) {
                            if (! inputs[i].hasAttribute('disabled') && inputs[i].type =='text') {
                                inputs[i].setAttribute('disabled', true)
                            }
                        }
                    }
                },
                addNewDocumentType: function(e){
                    e.preventDefault();
                    console.log('add new doc type');
                    var temp = {
                        id:"",
                        index: this.index,
                        type: this.type,
                        status: false
                    };
                    temp.id = this.documentTypes.length + 1;
                    this.documentTypes.push(temp);
                    this.index = this.type = "";
                },
                resetForm: function(e){
                    e.preventDefault();
                    e.target.form.reset();
                }
            }
        })
    </script>
@stop
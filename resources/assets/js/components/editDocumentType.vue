<template>
    <div>
        <h3>文件類別設定 Doc Types Setting</h3>

        <div class="panel panel-default">
            <document-type-table></document-type-table>
        </div>
        <form class="form-horizontal">
            <div class="form-group">
                <label for="docTypeIndex" class="col-sm-3 control-label">編號</label>

                <div class="col-sm-9">
                    <input type="text"
                           class="form-control"
                           id="docTypeIndex"
                           v-model="inputs.index"
                           @focus.prevent="resetEdit"
                           placeholder="Codes">
                </div>
            </div>
            <div class="form-group">
                <label for="docType" class="col-sm-3 control-label">文件類別名稱</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" id="docType" v-model="inputs.type"
                           placeholder="Document Type Name" @focus.prevent="resetEdit">
                </div>
            </div>
            <div class="row button-group">
                <div class="col-sm-3">
                    <button class="btn btn-block" :class="{'btn-purple':isButtonActive}"
                            @click.prevent="addNewDocumentType" :disabled="!isButtonActive">新增 Create
                    </button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-block btn-purple" :class="{'btn-purple':isButtonActive}"
                            @click.prevent="reset" :disabled="!isButtonActive">重設 Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import DocumentTypeTable from "./documentTypeTable.vue";

    export default {
        data: function () {
            return {
                inputs: {
                    type: "",
                    index: ""
                },
                isButtonActive: false
            }
        },
        watch: {
            inputs: {
                handler: function () {
                    var check = false;
                    for (var key in this.inputs) {
                        if (this.inputs[key]) check = true;
                    }
                    this.$set('isButtonActive', check)
                },
                deep: true
            }
        },
        components: {
            DocumentTypeTable
        },
        methods: {
            reset: function () {
                console.log('reset inputs')
                for (var key in this.inputs) {
                    this.inputs[key] = "";
                }
            },
            addNewDocumentType: function () {
                console.log('post to server to add a new document type')
            },
            resetEdit: function(){
                this.$broadcast('restEdit')
            }

        }
    }
</script>
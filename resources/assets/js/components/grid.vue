<style>
    /*body {*/
        /*font-family: Helvetica Neue, Arial, sans-serif;*/
        /*font-size: 14px;*/
        /*color: #444;*/
    /*}*/

    table.grid {
        border: 2px solid #42b983;
        border-radius: 3px;
        background-color: #fff;
    }

    table.grid th {
        background-color: #42b983;
        color: rgba(255,255,255,0.66);
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -user-select: none;
    }

    table.grid td {
        background-color: #f9f9f9;
    }

    table.grid th, table.grid td {
        min-width: 120px;
        padding: 10px 20px;
    }

    table.grid.table>thead>tr>th.active {
        color: #fff;
        background-color: #00007b;
    }

    table.grid th:active {
        background-color: #00007b;
    }

    table.grid th.active .arrow {
        opacity: 1;
    }

    .arrow {
        display: inline-block;
        vertical-align: middle;
        width: 0;
        height: 0;
        margin-left: 5px;
        opacity: 0.66;
    }

    .arrow.asc {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-bottom: 4px solid #fff;
    }

    .arrow.dsc {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 4px solid #fff;
    }

    table.grid #search {
        margin-bottom: 10px;
    }

    table.grid .table-responsive{
        width:100%;
    }

    #search-label{
        padding-top: 7px;
        text-align: right;
    }
    .pagination_button{
        cursor: pointer;
    }
</style>

<template>
    <div class="table-responsive">
        <div class="col-xs-5">
            每頁顯示 Show
            <select v-model="itemPerPage" id="">
                <option value="5" selected>5</option>
                <option value="10" >10</option>
                <option value="15" >15</option>
                <option value="20" >20</option>
            </select>
            檔案 Entries Per Page
        </div>
        <div class="col-xs-7 col-sm-4 pull-right">
            <form action="" class="form-horizontal">
                <div class="form-group">
                    <label for="search" class="col-xs-5" id="search-label">搜尋 Search: </label>
                    <div class="col-xs-7">
                        <input type="text" name="search" v-model="filterKey" class="form-control" placeholder="search terms">
                    </div>
                </div>
            </form>
        </div>
        <table class="table grid">
            <thead>
            <tr>
                <th v-for="key in columns"
                    @click="sortBy(key)"
                    :class="{active: sortKey == key.code}">
                    {{key.label}}
          <span class="arrow"
                :class="sortOrders[key.code] > 0 ? 'asc' : 'dsc'">
          </span>
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="
                entry in data
                | filterBy filterKey
                | orderBy sortKey sortOrders[sortKey]" v-show="paginate($index)" track-by="id">
                <td v-for="key in columns" >
                    {{entry[key.code]}}
                </td>
                <td>
                    <button v-show="canPreview" class="btn btn-default btn-xs" @click.prevent="previewPDF(entry)"><i class="fa fa-search fa-2x"></i></button>
                    <button class="btn btn-danger btn-xs" @click.prevent="deleteDocument(entry)"><i class="fa fa-trash fa-2x"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <div>
            <div class="col-xs-6">
                <span>There are total {{data.length}} records.</span>
                <span>共有 {{data.length}} 個記錄。</span>
            </span>
            </div>
            <div class="col-xs-6" v-show="needPaginated">
                <span class="pull-right">
                    <span class="pagination_button" @click="previousPage"><</span>
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-xs btn-default" v-for="n in totalPages" @click="toPage(n+1)">{{n+1}}</button>
                    </div>
                    <span class="pagination_button" @click="nextPage">></span>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            data: {
                type: Array,
                default: function(){
                    return []
                }
            },
            canPreview:{
              type: Boolean,
                default: false,
            },
            columns: Array
        },
        data: function () {
            var sortOrders = {}
            this.columns.forEach(function (key) {
                sortOrders[key.code] = 1
            });
            return {
                filterKey:'',
                sortKey: '',
                currentPage: 1,
                sortOrders: sortOrders,
                itemPerPage:"",
                totalPages:1
            }
        },
        computed:{
            needPaginated: function(){
                if(this.filterKey) return false;
                return this.data.length > this.itemPerPage;
            },
            countTableColumns:function(){
                return Object.keys(this.columns).length + 1;
            }
        },
        watch:{
          data: function(){
              if(this.data){
                  return this.totalPages = Math.ceil( this.data.length / this.itemPerPage);
              }
          }
        },
        methods: {
            paginate: function(itemIndex){
                var max = this.currentPage * this.itemPerPage;
                var min = this.currentPage * this.itemPerPage - this.itemPerPage;

                return (min <= itemIndex) && (max > itemIndex);
            },
            toPage: function(pageNumber){
                this.currentPage = pageNumber;
            },
            previousPage: function () {
                if(this.currentPage > 1){
                    this.currentPage = this.currentPage-1
                }
            },
            nextPage: function () {
                if(this.currentPage < this.totalPages){
                    this.currentPage = this.currentPage+1
                }
            },
            sortBy: function (key) {
                this.sortKey = key.code;
                this.sortOrders[key.code] = this.sortOrders[key.code] * -1
            },
            previewPDF: function (document) {
                console.log('preview pdf');
                this.previewSrc = this.previewing ? "" : "some url to document link";
                this.previewing = !this.previewing;
            },
            deleteDocument: function (document) {
                if (confirm('Are you sure you want to delete ' + document.docName + '?')) {
                    this.data.$remove(document);
                    console.log('post to server to delete the doc');
                }
            }
        }
    }
</script>
<style>
    body {
        font-family: Helvetica Neue, Arial, sans-serif;
        font-size: 14px;
        color: #444;
    }

    table {
        border: 2px solid #42b983;
        border-radius: 3px;
        background-color: #fff;
    }

    th {
        background-color: #42b983;
        color: rgba(255,255,255,0.66);
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -user-select: none;
    }

    td {
        background-color: #f9f9f9;
    }

    th, td {
        min-width: 120px;
        padding: 10px 20px;
    }

    .table>thead>tr>th.active {
        color: #fff;
        background-color: #00007b;
    }

    th:active {
        background-color: #00007b;
    }

    th.active .arrow {
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

    #search {
        margin-bottom: 10px;
    }

    .table-responsive{
        width:100%;
    }

    #search-label{
        padding-top: 7px;
        text-align: right;
    }
</style>

<template>
    <div class="table-responsive">
        <div class="col-xs-4">
            Show
            <select v-model="itemPerPage" id="">
                <option value="5" selected>5</option>
                <option value="10" >10</option>
                <option value="15" >15</option>
                <option value="20" >20</option>
            </select>
            Entries
        </div>
        <div class="col-xs-8 col-sm-4 pull-right">
            <form action="" class="form-horizontal">
                <div class="form-group">
                    <label for="search" class="col-xs-4" id="search-label">Search: </label>
                    <div class="col-xs-8">
                        <input type="text" name="search" v-model="filterKey" class="form-control" placeholder="testing search">
                    </div>
                </div>
            </form>
        </div>
        <table class="table">
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
                    <button class="btn btn-default btn-xs" @click.prevent="previewPDF(entry)">Preview 預覽</button>
                    <button class="btn btn-danger btn-xs" @click.prevent="deleteDocument(entry)">Remove 刪除
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <div v-show="needPaginated">
            <tr>
                <td colspan="{{countTableColumns()}}">
                        <span class="pull-right">
                            <span class="pagination_button">Previous</span>
                            <div class="btn-group" role="group" aria-label="...">
                                <button type="button" class="btn btn-xs btn-default" v-for="n in totalPages" @click="toPage(n+1)">{{n+1}}</button>
                            </div>
                            <span class="pagination_button">Next</span>
                        </span>
                </td>
            </tr>
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
            columns: Array
        },
        data: function () {
            var sortOrders = {}
            this.columns.forEach(function (key) {
                sortOrders[key.code] = 1
            })
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
                console.log((min <= itemIndex) && (max > itemIndex));

                return (min <= itemIndex) && (max > itemIndex);
            },
            toPage: function(pageNumber){
                this.currentPage = pageNumber;
            },
            display: function(itemIndex){
                if(this.filterKey){
                    return true;
                }
                var max = this.currentPage * this.itemPerPage;
                var min = this.currentPage * this.itemPerPage - this.itemPerPage;

                return (min <= itemIndex) && (max > itemIndex);
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
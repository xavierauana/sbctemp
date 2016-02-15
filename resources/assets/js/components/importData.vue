<template>
    <div>
        <h3>匯入賬戶資料 Import Clients Info</h3>
        <form class="form" action="/exportData" @submit.prevent="checkInputs" method="post">
            <input type="hidden" name="_token" v-model="token">
            <input type="file" id="file" v-show="false" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            <button class="btn btn-purple btn-lg" @click.prevent="selectFile">選擇滙入檔案 Select Import CSV</button>
        </form>
    </div>
</template>

<script>
    export default{
        data:function(){
            return {
                token: document.getElementById('csrf_token').getAttribute('content'),
                start: 0,
                end: 1000
            }
        },
        methods:{
            selectFile: function(){
                document.querySelector('#file').click()
            }
        }
    }
</script>

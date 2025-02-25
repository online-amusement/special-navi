<template>
    <div class="container">
        <div class="title-contents">
            <h1 class="title">モデルラインナップ管理</h1>
        </div>
        <div class="contents">
            <form action="/model-lineup" method="GET" >
                <div class="search-contents">
                    <div class="search-name">
                        <label class="name-title">名前</label>
                        <input v-model="name" type="text" class="name" name="name" id="name" />
                    </div>
                    <div class="search-amount">
                        <label class="amount-title">金額</label>
                        <input v-model="amount" type="text" class="amount" name="amount" id="amount" />
                    </div>
                    <div class="search-period">
                        <div class="search-startedAt">
                            <label class="status-title">開始日時</label>
                            <input v-model="startedAt" type="date" class="startedAt" name="startedAt" id="startedAt" />
                        </div>
                        <div class="search-operator">〜</div>
                        <div class="search-endedAt">
                            <label class="status-title">終了日時</label>
                            <input v-model="endedAt" type="date" class="endedAt" name="endedAt" id="endedAt" />
                        </div>
                    </div>
                    <div class="search-sort">
                        <label class="sort-title">ソート</label>
                        <select v-model="sort" class="sort" name="sort" id="sort">
                            <option>降順</option>
                            <option>昇順</option>
                        </select>
                    </div>
                    <div class="search-btn">
                        <button class="btn" type="submit">検索</button>
                    </div>
                    <div class="search-clear-btn">
                        <button class="clear-btn" type="submit">クリア</button>
                    </div>
                </div>
            </form>
            <div class="table">
                <button type="submit" class="update-btn">
                    <a class="create-btn" :href=" '/model-lineup/create' ">作成</a>
                </button>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th>タグ名</th>
                            <th>金額</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(modelLineup, index) in modelLineupData" :key="index">
                            <td>{{ modelLineup.id }}</td>
                            <td>{{ modelLineup.name }}</td>
                            <td>{{ modelLineup.amount }}</td>
                            <td class="btn-area">
                                <button type="submit" class="update-btn">
                                    <a class="edit-btn" :href=" '/model-lineup/' + modelLineup.id + '/edit' ">更新</a>
                                </button>
                                <button type="submit" class="dele-btn">
                                    <a class="delete-btn" :href=" '/model-lineup/' + modelLineup.id + '/delete' ">削除</a>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { ref, onMounted } from "vue";

const props = defineProps(['model_lineups']);
const modelLineups = ref(props.model_lineups);
const modelLineupData = ref(modelLineups.value.data)
const name = ref('');
const amount = ref();
const startedAt = ref('');
const endedAt = ref('');
const sort = ref([
    {text: '昇順', value: 'asc'},
    {text: '降順', value: 'desc'}
])

onMounted(() => {
    console.log(props.model_lineups)
    console.log(modelLineupData)
})

</script>
<style lang="scss" scoped>
.title {
    display: flex;
    justify-content: center;
    margin-bottom: 50px;
}
input {
    height: 40px;
}
select {
    height: 40px;
}
.search-name {
    display: grid;
}
.search-amount {
    display: grid;
    margin-bottom: 15px;
}
.search-sort {
    display: grid;
}
.search-contents {
    width: 400px;
    margin: 0 auto;
}
.search-btn {
    display: flex;
    justify-content: center;
    margin-top: 30px;
    margin-bottom: 10px;
}
.search-clear-btn {
    display: flex;
    justify-content: center;
    margin-bottom: 70px;
}
.search-period {
    display: flex;
    margin-bottom: 15px;
}
.search-operator {
    margin:0 10px 0px 10px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.btn {
    width: 300px;
    height: 35px;
    background: #00F;
    color: #fff;
    border: none;
    border-radius: 5px;
}
.clear-btn {
    width: 300px;
    height: 35px;
    background: #F00;
    color: #fff;
    border: none;
    border-radius: 5px;
}
.update-btn {
    color: #fff;
    background: #00F;
    margin: 0 2.5px;
    border: none;
    border-radius: 5px;
    width: 60px;
    height: 40px;
}
a {
    text-decoration: none;
    color: #fff;
}
.dele-btn {
    color: #fff;
    background: #F00;
    margin: 0 2.5px;
    border: none;
    border-radius: 5px;
    width: 60px;
    height: 40px;
}
.link-btn {
    display: flex;
    justify-content: center;
    width: 40px;
    height: 40px;
    align-items: center;
}
.paginate-contents {
    display: flex;
    justify-content: center;
}
a {
    text-decoration: none;
    color: #fff;
}
.link-btn {
    background: #00F;
}
.gray {
    background: #808080;
}
</style>
<template>
    <div class="container">
        <div class="title-contents">
            <h1 class="title">サブカテゴリータグ管理</h1>
        </div>
        <div class="contents">
            <form action="/sub-category-tag" method="GET">
                <div class="search-contents">
                    <div class="search-name">
                        <label class="name-title">種別ID</label>
                        <input v-model="categoryTagId" type="text" class="categoryTagId" name="categoryTagId" id="categoryTagId" />
                    </div>
                    <div class="search-name">
                        <label class="name-title">名前</label>
                        <input v-model="name" type="text" class="name" name="name" id="name" />
                    </div>
                    <div class="search-status">
                        <label class="status-title">ステータス</label>
                        <select v-model="status" type="text" class="status" name="status" id="status">
                            <option :value="0">表示</option>
                            <option :value="1">非表示</option>
                        </select>
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
                    <a class="create-btn" :href=" '/sub-category-tag/create' ">作成</a>
                </button>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">種別ID</th>
                            <th>種別名</th>
                            <th>職種名</th>
                            <th>ステータス</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(subCayegory, index) in subCayegoryTagData" :key="index">
                            <td>{{ subCayegory.id }}</td>
                            <td>{{ subCayegory.category_tag.id }}</td>
                            <td>{{ subCayegory.category_tag.name }}</td>
                            <td>{{ subCayegory.name }}</td>
                            <td>{{ subCayegory.status }}</td>
                            <td class="btn-area">
                                <button type="submit" class="update-btn">
                                    <a class="edit-btn" :href=" '/sub-category-tag/' + subCayegory.id + '/edit' ">更新</a>
                                </button>
                                <button type="submit" class="dele-btn">
                                    <a class="delete-btn" :href=" '/sub-category-tag/' + subCayegory.id + '/delete' ">削除</a>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="paginate-contents">
                <div class="paginate" v-for="(pagination, index) in paginations" :key="index">
                    <button class="link-btn" type="submit" :class="{ 'gray' : pagination.active == true }">
                        <a class="links" :href="pagination.url">{{ pagination.label.replaceAll('&amp;laquo; Previous', '<<').replaceAll('Next &amp;raquo;', '>>') }}</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { onMounted, ref } from 'vue';

const props = defineProps(['sub_category']);
const subCayegoryTag = ref(props.sub_category)
const subCayegoryTagData = ref(subCayegoryTag.value.data)
const paginations = ref(subCayegoryTag.value.link);
const categoryTagId = ref();
const name = ref('');
const status = ref([
    {text: '表示', value: 0},
    {text: '非表示', value: 1}
])
const sort = ref([
    {text: '昇順', value: 'asc'},
    {text: '降順', value: 'desc'}
])

onMounted(() => {
    console.log(props.sub_category)
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
.search-status {
    display: grid;
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
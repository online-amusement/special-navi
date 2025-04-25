<template>
    <div class="container">
        <div class="title-contents">
            <h1 class="title">カテゴリータグ管理</h1>
        </div>
        <div class="contents">
            <form action="/category-tag" method="GET" >
                <div class="search-contents">
                    <div class="search-name">
                        <label class="name-title">名前</label>
                        <input v-model="name" type="text" class="name" name="searchName" id="searchName" />
                    </div>
                    <div class="search-status">
                        <label class="status-title">ステータス</label>
                        <select v-model="selectedStatus" type="text" class="status" name="searchStatus" id="searchStatus">
                            <option v-for="option in statusOptions" :key="option.value">{{ option.text }}</option>
                        </select>
                    </div>
                    <div class="search-sort">
                        <label class="sort-title">ソート</label>
                        <select v-model="selectedSort" class="sort" name="searchSort" id="searchSort">
                            <option v-for="option in sortOptions" :key="option.value">{{ option.text }}</option>
                        </select>
                    </div>
                    <div class="search-btn">
                        <button class="btn" type="submit" @click.prevent="searchCategory(page)">検索</button>
                    </div>
                    <div class="search-clear-btn">
                        <button @click="clear()" class="clear-btn" type="submit">クリア</button>
                    </div>
                </div>
            </form>
            <div class="table">
                <button type="submit" class="update-btn">
                    <a class="create-btn" :href=" '/category-tag/create' ">作成</a>
                </button>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th>タグ名</th>
                            <th>ステータス</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(categoryTag, index) in categorytagsData" :key="index">
                            <td>{{ categoryTag.id }}</td>
                            <td>{{ categoryTag.name }}</td>
                            <td>{{ categoryTag.status }}</td>
                            <td class="btn-area">
                                <button type="submit" class="update-btn">
                                    <a class="edit-btn" :href=" '/category-tag/' + categoryTag.id + '/edit' ">更新</a>
                                </button>
                                <button type="submit" class="dele-btn">
                                    <a class="delete-btn" :href=" '/category-tag/' + categoryTag.id + '/delete' ">削除</a>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="no-contents" v-if="categorytagsData.length == 0">
            <p class="warning">{{ "検索結果がありません。" }}</p>
        </div>
        <div class="paginate-contents">
            <div class="paginate" v-for="(pagination, index) in categorytags.links" :key="index">
                <button type="submit" class="link-btn" :class="{ isSelected: pagination.active == true  }" ><a href="#" @click.prevent="searchCategory(pagination.label)">{{ pagination.label.replaceAll('&amp;laquo; Previous', '<<').replaceAll('Next &amp;raquo;', '>>') }}</a></button>
            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { onMounted, ref } from 'vue';

interface OptionsStatus {
     text: string, 
     value: number 
}

interface OptionsSort {
     text: string, 
     value: string 
}

const props = defineProps(['categorytags']);
const categorytags = ref(props.categorytags)
const categorytagsData = ref(categorytags.value.data)
const name = ref('');
const statusOptions = ref<OptionsStatus[]>([
    {text: '表示', value: 0},
    {text: '非表示', value: 1}
])
const sortOptions = ref<OptionsSort[]>([
    {text: '昇順', value: '昇順'},
    {text: '降順', value: '降順'}
])
const selectedStatus = ref('');
const selectedSort = ref('');
const page = ref('1');

onMounted(() => {
    console.log(categorytagsData.value)
})

const searchCategory = ((pageNum) => {
    page.value = pageNum
    const searchParams = new URLSearchParams(document.location.search)
    const val = searchParams.get("page")
    //urlのパラメータの値を変更
    if(page.value == val) {
        searchParams.set("page", page.value);
    }else {
        searchParams.set("page", page.value);
    }
    const params = {
        'searchName': name.value ? name.value : "",
        'searchStatus': selectedStatus.value ? selectedStatus.value : "",
        'searchSort': selectedSort.value ? selectedSort.value : "",
        'page': page.value
    }
    for(let param of searchParams) {
        params[param[0]] = param[1]
    }
    let baseUrl = categorytags.value.path;
    let url = baseUrl + "?" + Object.entries(params).map((e) => {
        let key = e[0];
        let value = encodeURI(e[1]);
        return `${key}=${value}`;
    }).join("&");
    location.href = url
})

const clear = (() => {
    const searchParams = new URLSearchParams(document.location.search);
    const val = searchParams.get("page");
    searchParams.set("searchName", "");
    searchParams.set("searchStatus", "");
    searchParams.set("searchSort", "");
    searchParams.set("page", "1");
    const params = {
        'searchName' : name.value ? name.value : "",
        'searchStatus' : selectedStatus.value ? selectedStatus.value : "",
        'searchSort' : selectedSort.value ? selectedSort.value : "",
        'page' : page.value
    }
    let baseUrl = categorytags.value.path
    console.log(baseUrl);
    let url = baseUrl + "?" + Object.entries(params).map((e) => {
        console.log(e);
        let key = e[0];
        let value = encodeURI(e[1]);
        return `${key}=${value}`;
    }).join("&");
    location.href = url
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
.warning {
    display: flex;
    justify-content: center;
    font-weight: 900;
    color: #F00;
}
.isSelected {
    background: #808080;
}
</style>
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
                        <input v-model="categoryTagId" type="text" class="categoryTagId" name="searchCategoryTagId" id="searchCategoryTagId" />
                    </div>
                    <div class="search-name">
                        <label class="name-title">名前</label>
                        <input v-model="name" type="text" class="name" name="searchName" id="searchName" />
                    </div>
                    <div class="search-status">
                        <label class="status-title">ステータス</label>
                        <select v-model="selectedStatus" type="text" class="status" name="searchStatus" id="searchStatus">
                            <option v-for="option in optionStatus" :key="option.value">{{ option.text }}</option>
                            
                        </select>
                    </div>
                    <div class="search-sort">
                        <label class="sort-title">ソート</label>
                        <select v-model="selectedSort" class="sort" name="searchSort" id="searchSort">
                            <option v-for="option in optionStatus" :key="option.value">{{ option.text }}</option>
                        </select>
                    </div>
                    <div class="search-btn">
                        <button @click="searchSubCategory()" class="btn" type="submit">検索</button>
                    </div>
                    <div class="search-clear-btn">
                        <button @click="clear()" class="clear-btn" type="submit">クリア</button>
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
        </div>
        <div class="no-contents" v-if="subCayegoryTagData.length == 0">
            <p class="warning">{{ "検索結果がありません。" }}</p>
        </div>
        <div class="paginate-contents">
            <div class="paginate" v-for="(pagination, index) in subCayegoryTag.links" :key="index">
                <button type="button" class="link-btn" :class="{ isSelected: pagination.active }" ><a href="#" @click.prevent="searchSubCategory(pagination.label)">{{ pagination.label.replaceAll('&amp;laquo; Previous', '<<').replaceAll('Next &amp;raquo;', '>>') }}</a></button>
            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { onMounted, ref } from 'vue';

interface Options {
    text: string,
    value: string
}

const props = defineProps(['sub_category']);
const subCayegoryTag = ref(props.sub_category)
const subCayegoryTagData = ref(subCayegoryTag.value.data)
const categoryTagId = ref();
const name = ref('');
const optionStatus = ref<Options[]>([
    {text: '表示', value: 0},
    {text: '非表示', value: 1}
])
const optionSort = ref<Options[]>([
    {text: '昇順', value: '昇順'},
    {text: '降順', value: '降順'}
])
const selectedStatus = ref('');
const selectedSort = ref('');

onMounted(() => {
    console.log(props.sub_category)
})

const searchSubCategory = ((pageNum) => {
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
        'searchCategoryTagId': categoryTagId.value ? categoryTagId.value : "",
        'searchName': name.value ? name.value : "",
        'searchStatus': selectedStatus.value ? selectedStatus.value : "",
        'searchSort': selectedSort.value ? selectedSort.value : "",
        'page': page.value
    }
    for(let param of searchParams) {
        params[param[0]] = param[1]
    }
    let baseUrl = subCayegoryTag.value.path;
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
    searchParams.set("searchCategoryTagId", "");
    searchParams.set("searchName", "");
    searchParams.set("searchStatus", "");
    searchParams.set("searchSort", "");
    searchParams.set("page", "1");
    const params = {
        'searchCategoryTagId': categoryTagId.value ? categoryTagId.value : "",
        'searchName' : name.value ? name.value : "",
        'searchStatus' : selectedStatus.value ? selectedStatus.value : "",
        'searchSort' : selectedSort.value ? selectedSort.value : "",
        'page' : page.value
    }
    let baseUrl = subCayegoryTag.value.path
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
.isSelected {
    background: #808080;
}
.warning {
    display: flex;
    justify-content: center;
    font-weight: 900;
    color: #F00;
}
</style>
<template>
    <div class="container">
        <div class="title-contents">
            <h1 class="title">メンバー管理</h1>
        </div>
        <form action="/home" method="GET">
            <div class="search-form">
                <div class="name-search">
                    <label class="name-title">氏名</label>
                    <input v-model="name" type="text" class="name" name="searchName" id="searchName"/>
                </div>
                <div class="email-search">
                    <label class="email-title">メールアドレス</label>
                    <input v-model="email" type="text" class="email" name="searchEmail" id="searchEmail" />
                </div>
                <div class="status-search">
                    <label class="status-title">ステータス</label>
                    <select v-model="selectedStatus" class="status" name="searchStatus" id="searchStatus">
                        <option v-for="option in statusOptions" :key="option.value" :value="option.value">{{ option.text }}</option>
                    </select>
                </div>
                <div class="sort-search">
                    <label class="sort-title">ソート</label>
                    <select v-model="selectedSort" class="sort" name="searchSort" id="searchSort">
                        <option v-for="option in sortOptions" :key="option.value" :value="option.value">{{ option.text }}</option>
                    </select>
                </div>
                <div class="search-btn">
                    <button type="button" class="sent-btn" @click.prevent="searchMember">検索</button>
                </div>
                <div class="clear-search-btn">
                    <button type="submit" class="sent-clear-btn" @click="clear">クリア</button>
                </div>
            </div>
        </form>
        <div class="table">
            <button type="submit" class="update-btn">
                <a class="btn" :href=" '/member/create' ">作成</a>
            </button>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>郵便番号</th>
                        <th>住所1</th>
                        <th>住所2</th>
                        <th>住所3</th>
                        <th>電話番号</th>
                        <th>ステータス</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(member, index) in memberData" :key="index">
                        <td>{{ member.id }}</td>
                        <td>{{ member.name }}</td>
                        <td>{{ member.email }}</td>
                        <td>{{ member.postal_code }}</td>
                        <td>{{ member.address }}</td>
                        <td>{{ member.address2 }}</td>
                        <td>{{ member.address3 }}</td>
                        <td>{{ member.tel }}</td>
                        <td>{{ member.status }}</td>
                        <td class="btn-area">
                            <button type="submit" class="update-btn">
                                <a class="btn" :href=" '/member/' + member.id + '/edit' ">更新</a>
                            </button>
                            <button type="submit" class="dele-btn">
                                <a class="btn" :href=" '/member/' + member.id + '/delete' ">削除</a>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="no-contents" v-if="memberData.length == 0">
            <p class="warning">{{ "検索結果がありません。" }}</p>
        </div>
        <div class="paginate-contents">
            <div class="paginate" v-for="(pagination, index) in members.links" :key="index">
                <button type="button" class="link-btn" :class="{ isSelected: pagination.active == true  }" ><a href="#" @click.prevent="searchMember(pagination.label)">{{ pagination.label.replaceAll('&amp;laquo; Previous', '<<').replaceAll('Next &amp;raquo;', '>>') }}</a></button>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { Value } from "sass";
import { ref, onMounted } from "vue";

interface Option { text: string; value: string; }

const props = defineProps(['members'])
const members = ref(props.members)
const memberData = ref(members.value.data)
const name = ref(null);
const email = ref(null);
const statusOptions = ref<Option[]>([
    { text: '仮登録', value: "0"},
    { text: '通常', value: "1"},
    { text: '退会', value: "2"},
]);
const sortOptions = ref<Option[]>([
    { text: '昇順', value: "昇順"},
    { text: '降順', value: "降順"},
])
const selectedStatus = ref("");
const selectedSort = ref("");
const page = ref("1");


onMounted(() => {
    console.log(members.value)
}) 

const searchMember = ((pageNum) => {
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
        'searchEmail': email.value ? email.value : "",
        'searchStatus': selectedStatus.value ? selectedStatus.value : "",
        'searchSort': selectedSort.value ? selectedSort.value : "",
        'page': page.value
    }
    for(let param of searchParams) {
        params[param[0]] = param[1]
    }
    let baseUrl = members.value.path;
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
    searchParams.set("searchEmail", "");
    searchParams.set("searchStatus", "");
    searchParams.set("searchSort", "");
    searchParams.set("page", "1");
    const params = {
        'searchName' : name.value ? name.value : "",
        'searchEmail' : email.value ? email.value : "",
        'searchStatus' : selectedStatus.value ? selectedStatus.value : "",
        'searchSort' : selectedSort.value ? selectedSort.value : "",
        'page' : page.value
    }
    let baseUrl = members.value.path
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
.title-contents {
    display: flex;
    justify-content: center;
}
.search-form {
    width: 400px;
    margin: 0 auto;
}
.name-search {
    display: grid;
}
.email-search {
    display: grid;
}
.status-search {
    display: grid;
}
.sort-search {
    display: grid;
}
.search-btn {
    display: flex;
    justify-content: center;
    margin-top: 30px;
    margin-bottom: 10px;
}
.clear-search-btn {
    display: flex;
    justify-content: center;
    margin-bottom: 70px;
}
input {
    height: 40px;
}
select {
    height: 40px;
}
.sent-btn {
    width: 300px;
    height: 35px;
    background: #00F;
    color: #fff;
    border: none;
    border-radius: 5px;
}
.sent-clear-btn {
    width: 300px;
    height: 35px;
    background: #F00;
    color: #fff;
    border: none;
    border-radius: 5px;
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
.update-btn {
    color: #fff;
    background: #00F;
    margin: 0 2.5px;
    border: none;
    border-radius: 5px;
}
.dele-btn {
    color: #fff;
    background: #F00;
    margin: 0 2.5px;
    border: none;
    border-radius: 5px;
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

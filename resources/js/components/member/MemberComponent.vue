<template>
    <div class="container">
        <div class="title-contents">
            <h1 class="title">メンバー管理</h1>
        </div>
        <form action="/home" method="GET">
            <div class="search-form">
                <div class="name-search">
                    <label class="name-title">氏名</label>
                    <input v-model="name" type="text" class="name" name="name" id="name"/>
                </div>
                <div class="email-search">
                    <label class="email-title">メールアドレス</label>
                    <input v-model="email" type="text" class="email" name="email" id="email" />
                </div>
                <div class="status-search">
                    <label class="status-title">ステータス</label>
                    <select v-model="status" name="status" id="status">
                        <option :value="0">仮登録</option>
                        <option :value="1">通常</option>
                        <option :value="2">退会</option>
                    </select>
                </div>
                <div class="sort-search">
                    <label class="sort-title">ソート</label>
                    <select v-model="sort" class="sort" name="sort" id="sort">
                        <option>降順</option>
                        <option>昇順</option>
                    </select>
                </div>
                <div class="search-btn">
                    <button type="submit" class="sent-btn" @click="sent">検索</button>
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
        <div class="paginate-contents">
            <div class="paginate" v-for="(pagination, index) in paginations" :key="index">
                <button class="link-btn" type="submit" :class="{ 'gray' : pagination.active == true }">
                    <a @click="pagenation(pagination.label)" class="links" :disabled="url == null" :href="pagination.url">{{ pagination.label.replaceAll('&amp;laquo; Previous', '<<').replaceAll('Next &amp;raquo;', '>>') }}</a>
                </button>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { Value } from "sass";
import { ref, onMounted } from "vue";

const props = defineProps(['members', 'input'])
const members = ref(props.members)
const memberData = ref(members.value.data)
const name = ref("");
const email = ref("");
const status = ref([
    { text: '仮登録', value: 0},
    { text: '通常', value: 1},
    { text: '退会', value: 2},
]);
const sort = ref([
    { text: '昇順', value: "asc"},
    { text: '降順', value: "desc"},
])
const paginations = ref(members.value.links);
const initPage = ref(members.value.links);
const rangeArray = ref([]);
const pageList = ref([]);
const deleNum1 = ref();
const deleNum2 = ref();
const url = ref();
const active = ref('');


onMounted(() => {
    console.log(paginations.value)
}) 

const pagenation = ((currentPage) => {
    /*console.log(currentPage)
    //初期値
    paginations.value = initPage.value
    //削除したい番号
    deleNum1.value = Number(currentPage) - 2;
    deleNum2.value = Number(currentPage) - 3;
    if(currentPage > "5") {
        paginations.value = paginations.value.filter(page => page.label != String(deleNum1.value) && page.label != String(deleNum2.value))
        .map(page => ({
            url: page.url,
            label: page.label,
            active: page.active
            })
        );
        url.value = paginations.value.find((element) => element.label == currentPage)
        //location.replace(url.value["url"])
        //location.href = url.value["url"]
        history.replaceState(null, '', url.value["url"])
    }else {
        url.value = paginations.value[currentPage].url
        console.log(url.value)
        location.href = url.value
    }*/
})

const sent = (() => { 
    console.log(members.value)
})

const clear = (() => {

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
.gray {
    background: #808080;
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
</style>

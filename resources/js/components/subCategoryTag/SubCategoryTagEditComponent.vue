<template>
    <div class="container">
        <div class="title-contents">
            <h1 v-if="!props.sub_category" class="title">サブカテゴリータグ作成</h1>
            <h1 v-if="props.sub_category" class="title">サブカテゴリータグ更新</h1>
        </div>
        <form method="POST" action="/sub-category-tag/save">
            <input type="hidden" name="_token" v-model="csrf">
                <div class="constents">
                    <div class="id-contents">
                        <label class="id-title">ID</label>
                        <input type="text" id="id" name="id" readonly v-model="formData.id">
                        <span v-if="props.errors?.id" class="error">{{ props.errors.id[0] }}</span>
                    </div>
                    <div class="category-id-contents">
                        <label class="categoryTagId-title">種別ID</label>
                        <select v-model="formData.categoryTagId" class="categoryTagId" name="categoryTagId" id="categoryTagId">
                            <option v-for="(categoryTag, index) in categoryTags" :key="index" :value="categoryTag.id">{{ categoryTag.name }}</option>
                            <span v-if="props.errors?.categoryTagId" class="error">{{ props.errors.categoryTagId[0] }}</span>
                        </select>
                    </div>
                    <div class="name-contents">
                        <label class="name-title">名前</label>
                        <input type="text" id="name" name="name" v-model="formData.name">
                        <span v-if="props.errors?.name" class="error">{{ props.errors.name[0] }}</span>
                    </div>
                    <div class="status-contents">
                        <label class="status-title">ステータス</label>
                        <input type="text" id="status" name="status" v-model="formData.status">
                        <span v-if="props.errors?.status" class="error">{{ props.errors.status[0] }}</span>
                    </div>
                    <div class="sent-btn">
                        <button type="submit" class="btn">送信</button>
                    </div>
                </div>
        </form>
    </div>
</template>
<script lang="ts" setup>
import { ref, onMounted, computed, reactive } from 'vue';

const props = defineProps(['sub_category', 'category', 'old', 'errors']);
const csrf = computed(() => {
    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    return tokenMeta?.getAttribute('content') || '';
});

const formData = reactive({
    id: '',
    categoryTagId: '',
    name: '',
    email: '',
    postalCode: '',
    address: '',
    address2: '',
    address3: '',
    tel: '',
    status: ''
});

const categoryTags = ref(props.category);

onMounted(() => {
    console.log(props.sub_category)
    if (typeof props.old === 'string') {
      const parsedOldData = JSON.parse(props.old);
      formData.id = parsedOldData.id || '';
      formData.categoryTagId = parsedOldData.category_tag_id
      formData.name = parsedOldData.name || '';
      formData.status = parsedOldData.status || '0';
    } else if (props.old) {
      formData.id = props.old.id || '';
      formData.categoryTagId = props.old.category_tag_id
      formData.name = props.old.name || '';
      formData.status = props.old.status || '0';
    }
})

</script>
<style lang="scss" scoped>
.title-contents {
    display: flex;
    justify-content: center;
}
.id-title {
letter-spacing: 59px;
}
.category-id-contents {
    letter-spacing: 23px;
}
.name-title {
    letter-spacing: 53px;
}
.category-id-title {
    letter-spacing: 23px;
}
.status-title {
    letter-spacing: 13px;
}
.id-contents {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}
.category-id-contents {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}
.name-contents {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}
.status-contents {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 50px;
}
.sent-btn {
    display: flex;
    justify-content: center;
}
.btn {
    width: 450px;
    height: 40px;
    background: #00F;
    color: #fff;
    border: none;
    border-radius: 5px;
}
input {
    height: 40px;
    width: 300px;
}
select {
    height: 40px;
    width: 300px;
}
</style>
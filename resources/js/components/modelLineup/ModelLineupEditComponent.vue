<template>
    <div class="container">
        <div class="title-contents">
            <h1 v-if="!props.model_lineup" class="title">モデルラインナップ作成</h1>
            <h1 v-if="props.model_lineup" class="title">モデルラインナップ編集</h1>
        </div>
        <form method="POST" action="/model-lineup/save" enctype="multipart/form-data">
            <input type="hidden" name="_token" v-model="csrf">
                <div class="constents">
                    <div class="id-contents">
                        <label class="id-title">ID</label>
                        <input type="text" id="id" name="id" readonly v-model="formData.id">
                        <span v-if="props.errors?.id" class="error">{{ props.errors.id[0] }}</span>
                    </div>
                    <div class="name-contents">
                        <label class="name-title">名前</label>
                        <input type="text" id="name" name="name" v-model="formData.name">
                        <span v-if="props.errors?.name" class="error">{{ props.errors.name[0] }}</span>
                    </div>
                    <div class="detail-contents">
                        <label class="detail-title">詳細</label>
                        <input type="text" id="detail" name="detail" v-model="formData.detail">
                        <span v-if="props.errors?.detail" class="error">{{ props.errors.detail[0] }}</span>
                    </div>
                    <div class="amount-contents">
                        <label class="amount-title">金額</label>
                        <input type="text" id="amount" name="amount" v-model="formData.amount">
                        <span v-if="props.errors?.amount" class="error">{{ props.errors.amount[0] }}</span>
                    </div>
                    <div class="previewFile-contents">
                        <label class="previewFile-title">プレビューファイル</label>
                        <input type="file" id="previewFile" name="previewFile" class="previewFile" >
                        <span v-if="props.errors?.previewFile" class="error">{{ props.errors.previewFile[0] }}</span>
                    </div>
                    <div class="downloadFile-contents">
                        <label class="downloadFile-title">ダウンロードファイル</label>
                        <input type="file" id="downloadFile" name="downloadFile" class="downloadFile" >
                        <span v-if="props.errors?.downloadFile" class="error">{{ props.errors.downloadFile[0] }}</span>
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

const props = defineProps(['model_lineup', 'old', 'errors']);
const csrf = computed(() => {
    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    return tokenMeta?.getAttribute('content') || '';
});
const formData = reactive({
    id: '',
    name: '',
    detail: '',
    amount: '',
    previewFile: '',
    downloadFile: '',
});

onMounted(() => {
    console.log(props.model_lineup)
    if (typeof props.old === 'string') {
      const parsedOldData = JSON.parse(props.old);
      formData.id = parsedOldData.id || '';
      formData.name = parsedOldData.name || '';
      formData.detail = parsedOldData.detail || '';
      formData.amount = parsedOldData.amount || '';
      formData.previewFile = parsedOldData.previewFile || '';
      formData.downloadFile = parsedOldData.downloadFile || '';
    } else if (props.old) {
      formData.id = props.old.id || '';
      formData.name = props.old.name || '';
      formData.detail = props.old.detail || '';
      formData.amount = props.old.amount || '';
      formData.previewFile = props.old.previewFile || '';
      formData.downloadFile = props.old.downloadFile || '';
    }
})

</script>
<style lang="scss" scoped>
.title-contents {
    display: flex;
    justify-content: center;
}
.id-title {
    letter-spacing: 75px;
  }
.name-title {
    letter-spacing: 69px;
}
.detail-title {
    letter-spacing: 69px;
}
.amount-title {
    letter-spacing: 69px;
}
.previewFile-title {
    letter-spacing: 5px;
}
.downloadFile-title {
    letter-spacing: 3px;
}
.id-contents {
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
.detail-contents {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 50px;
}
.amount-contents {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 50px;
}
.previewFile-contents {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 50px;
}
.downloadFile-contents {
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
</style>
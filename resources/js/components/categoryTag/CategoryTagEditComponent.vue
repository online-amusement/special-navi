<template>
    <div class="container">
        <div class="title-contents">
            <h1 v-if="!categorytags" class="title">カテゴリータグ作成</h1>
            <h1 v-if="categorytags" class="title">カテゴリータグ更新</h1>
        </div>
        <form method="POST" action="/category-tag/save">
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

const props = defineProps(['categorytags', 'old', 'errors']);
const csrf = computed(() => {
    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    return tokenMeta?.getAttribute('content') || '';
  });
  const formData = reactive({
    id: '',
    name: '',
    email: '',
    postalCode: '',
    address: '',
    address2: '',
    address3: '',
    tel: '',
    status: ''
  });

onMounted(() => {
    console.log(props.categorytags)
    if (typeof props.old === 'string') {
      const parsedOldData = JSON.parse(props.old);
      formData.id = parsedOldData.id || '';
      formData.name = parsedOldData.name || '';
      formData.email = parsedOldData.email || '';
      formData.postalCode = parsedOldData.postal_code || '';
      formData.address = parsedOldData.address || '';
      formData.address2 = parsedOldData.address2 || '';
      formData.address3 = parsedOldData.address3 || '';
      formData.tel = parsedOldData.tel || '';
      formData.status = parsedOldData.status || '0';
    } else if (props.old) {
      formData.id = props.old.id || '';
      formData.name = props.old.name || '';
      formData.email = props.old.email || '';
      formData.postalCode = props.old.postal_code || '';
      formData.address = props.old.address || '';
      formData.address2 = props.old.address2 || '';
      formData.address3 = props.old.address3 || '';
      formData.tel = props.old.tel || '';
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
    letter-spacing: 58px;
  }
  .name-title {
    letter-spacing: 51px;
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
</style>
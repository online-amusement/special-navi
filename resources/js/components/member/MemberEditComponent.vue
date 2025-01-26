<template>
    <div class="container">
      <h1 v-if="!member" class="title">メンバー作成</h1>
      <h1 v-if="member" class="title">メンバー更新</h1>
      <form method="POST" action="/member/save">
        <input type="hidden" name="_token" v-model="csrf">
        <div class="contents">
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
          <div class="email-contents">
            <label class="email-title">メールアドレス</label>
            <input type="text" id="email" name="email" v-model="formData.email">
            <span v-if="props.errors?.email" class="error">{{ props.errors.email[0] }}</span>
          </div>
          <div class="email-contents">
            <label class="postal-code-title">郵便番号</label>
            <input type="text" id="postalCode" name="postalCode" v-model="formData.postalCode">
            <span v-if="props.errors?.postalCode" class="error">{{ props.errors.postalCode[0] }}</span>
          </div>
          <div class="address-contents">
            <label class="address-title">住所</label>
            <input type="text" id="address" name="address" v-model="formData.address">
            <span v-if="props.errors?.address" class="error">{{ props.errors.address[0] }}</span>
          </div>
          <div class="address-contents">
            <label class="address2-title">住所2</label>
            <input type="text" id="address2" name="address2" v-model="formData.address2">
            <span v-if="props.errors?.address2" class="error">{{ props.errors.address2[0] }}</span>
          </div>
          <div class="address-contents">
            <label class="address3-title">住所3</label>
            <input type="text" id="address3" name="address3" v-model="formData.address3">
            <span v-if="props.errors?.address3" class="error">{{ props.errors.address3[0] }}</span>
          </div>
          <div class="tel-contents">
            <label class="tel-title">電話番号</label>
            <input type="text" id="tel" name="tel" v-model="formData.tel">
            <span v-if="props.errors?.tel" class="error">{{ props.errors.tel[0] }}</span>
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
  import { computed, defineProps, reactive, onMounted } from "vue";
  
  
  const props = defineProps(['member', 'old', 'errors'])
  
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
    console.log(props.member)
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
  });
  </script>
  
  <style lang="scss" scoped>
  .title {
    display: flex;
    justify-content: center;
    margin-bottom: 50px;
  }
  .id-title {
    letter-spacing: 58px;
  }
  .name-title {
    letter-spacing: 51px;
  }
  .email-title {
    letter-spacing: 5px;
  }
  .postal-code-title {
    letter-spacing: 19px;
  }
  .address-title {
    letter-spacing: 53px;
  }
  .address2-title {
    letter-spacing: 33px;
  }
  .address3-title {
    letter-spacing: 33px;
  }
  .tel-title {
    letter-spacing: 20px;
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
  .email-contents {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
  }
  .address-contents {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
  }
  .tel-contents {
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
  
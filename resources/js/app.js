/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});
import MemberComponent from './components/member/MemberComponent.vue';
import MemberEditComponent from './components/member/MemberEditComponent.vue';
import CategoryTagComponent from './components/categoryTag/CategoryTagComponent.vue';
import CategoryTagEditComponent from './components/categoryTag/CategoryTagEditComponent.vue';
import SubCategoryTagComponent from './components/subCategoryTag/SubCategoryTagComponent.vue';
import SubCategoryTagEditComponent from './components/subCategoryTag/SubCategoryTagEditComponent.vue';

app.component('member-component', MemberComponent);
app.component('member-edit-component', MemberEditComponent);
app.component('category-tag-component', CategoryTagComponent);
app.component('category-tag-edit-component', CategoryTagEditComponent);
app.component('sub-category-tag-component', SubCategoryTagComponent);
app.component('sub-category-tag-edit-component', SubCategoryTagEditComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
app.mount('#app');

// require('./bootstrap');
// window.Vue = require('vue');
// import Vuex from 'vuex'
// import storeVuex from './store/index'
// import filter from './filter'
// Vue.use(Vuex)

// import VueChatScroll from 'vue-chat-scroll'
// Vue.use(VueChatScroll)

// const store = new Vuex.Store(storeVuex)

// Vue.component('main-app', require('./components/MainApp.vue').default);


// const app = new Vue({
//     el: '#inbox',
//     store

// });

require('./bootstrap');



Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));

new Vue({
    el: '#inbox',

    data: {
        messages: []
    },

    created() {
        this.fetchMessages();
        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            });
    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        }
    }
});
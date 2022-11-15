import Vue from 'vue'
import AppComponent from "./components/AppComponent";
require('./bootstrap');


const app = new Vue({
    el: '#app',
    components:{
        AppComponent
    }
});

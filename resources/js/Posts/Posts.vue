<template>
    <div>
        <div class="flex justify-between items-center">
            <div class="text-4xl font-medium">All Posts</div>
            <router-link to="/posts/create"
                class="flex text-white text-lg py-2 px-8 border-2 bg-green-500 rounded mr-8 hover:bg-green-600">
                Create Post
            </router-link>
        </div>
        <div class="flex flex-wrap w-full justify-center items-center pt-8">
            <div v-for="(post,index) in posts" :key="index" class="border border-gray-200 rounded-lg w-4/5 mb-8">
                <CardComponent :id="index" :post="post" :myPost="false" :user="users[index]"></CardComponent>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="flex w-1/2 justify-around aling-center">
                <button v-for="n in lenghtPages" :key="n" @click="changePage(n)"
                    class="border border-blue-200 hover:bg-blue-200 rounder-lg px-4 py-2"
                    :class="{'bg-blue-200': checkPage(n) }"> {{ n }} </button>
            </div>
        </div>

    </div>
</template>

<script>
import CardComponent from '../components/CardComponent.vue'

export default {
    data() {
        return {
            posts: null,
            users: null,
            currentePage: 1,
            lenghtPages: 1
        }
    },
    methods: {
        checkPage(n) {
            return this.currentePage == n
        },
        changePage(n) {
            this.currentePage = n
        },
        getPost() {
            axios.get('/api/posts?page=' + this.currentePage).then((res) => {
                this.posts = res.data[0].data
                this.users = res.data[1]
                this.currentePage = res.data[0].current_page
                this.lenghtPages = res.data[0].last_page
            })
        }
    },
    watch: {
        currentePage: function (newcurrentePage, oldcurrentePage) {
            this.debouncedGetPost()
        }
    },
    mounted() {
        this.debouncedGetPost = _.debounce(this.getPost, 500)
        this.getPost()
    },
    components: {
        CardComponent
    }
}
</script>

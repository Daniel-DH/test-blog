<template>
    <div>
        <div class="flex justify-between items-center">
            <div class="text-4xl font-medium">All My Posts</div>
            <router-link to="/posts/create"
                class=" flex text-white text-lg py-2 px-8 border-2 bg-green-500 rounded mr-8 hover:bg-green-600">
                Create Post
            </router-link>
        </div>
        <div class="flex flex-wrap w-full justify-center items-center pt-8">
            <div v-for="(post,index) in posts" :key="index" class="border border-gray-200 rounded-lg w-4/5">
                <CardComponent :id="index"
                :post="post"
                :myPost="true"
                :user="users"
                ></CardComponent>
            </div>
        </div>
    </div>
</template>

<script>
import CardComponent from '../components/CardComponent.vue';

export default {
    data() {
        return {
            posts: null,
            users: null,
        }
    },
    mounted() {
        axios.get('/api/myPosts').then((res) => {
            this.posts = res.data.data
            this.users = res.data[0]
        })
    },
    components:{
        CardComponent
    }
}
</script>

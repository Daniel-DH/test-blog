<template>
    <div class="flex flex-wrap w-full justify-center items-center pt-8">
        <div class="w-4/5 max-w-4/5">
            <div class="p-2 w-full">
                <label for="title">Title</label>
                <input
                    class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                    placeholder="Title" v-model="title" name="title">
            </div>
            <div class="p-2">
                <label for="body">Body</label>
                <textarea
                    class="w-full h-80 bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                    placeholder="Body" v-model="body" name="body">
                </textarea>
            </div>
            <div class="p-2 w-full mt-4">
                <button @click.prevent="makePost" type="submit"
                    class="flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">submit
                    Post</button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            post_id: this.$router.currentRoute.params.PostId,
            title: "",
            body: ""
        }
    },
    methods: {
        makePost() {
            const storePost = {
                title: this.title,
                body: this.body,
            }
            axios.put('/api/posts/'+this.post_id, storePost).then(() => {
                this.$router.push({ name: "MyPosts"});
            }).catch((error) => {
                this.errors = error.response.data.errors;
            })
        }
    },
    mounted() {
        axios.get('/api/posts/'+this.post_id+'/edit').then((res) => {
            const post = res.data.data
            this.title = post.title
            this.body = post.body
        }).catch((e) => console.log(e))
    }
}
</script>

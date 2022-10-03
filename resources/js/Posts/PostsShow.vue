<template>
    <div>
        <div class="flex">
            <div v-if="post" class="text-4xl font-bold">{{post.title}}</div>
        </div>
        <div v-if="name" class="text-2xl">
            {{name}}
        </div>
        <div v-if="post"  class="flex pt-2 m-auto w-5/6 text-justify justify-center content-center items-center pb-16">
            <div class="w-full">
                {{post.body}}
            </div>
        </div>
        <hr>
        <div class="pt-4">
            <div class="text-2xl font-bold">
                Comments
            </div>
            <label class="" for="comment">Make a comment</label>
            <div class="flex ml-8 pb-4">
                <div
                    class=" flex w-2/3 bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2">
                    <textarea v-model="body" placeholder="add a comment" class="w-full"></textarea>
                </div>
                <button @click.prevent="MakeComment" type="submit"
                    class="flex text-white bg-indigo-500 border-0 px-4 focus:outline-none hover:bg-indigo-600 rounded text-lg justify-center content-center items-center">
                    comment
                </button>
            </div>
            <hr>
            <div class="ml-8 w-3/5 flex flex-col">
                <div v-for="(comment,index) in comments" :key="index" class="p-2 mt-4 rounded-lg bg-gray-200">
                    <div class="font-bold">
                        {{users[index]}}

                    </div>
                    {{comment.body}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            post_id: this.$router.currentRoute.params.PostId,
            post: null,
            comments: null,
            body: "",
            name: null,
            users: null
        }
    },
    methods: {
        MakeComment() {
            const storeComment = {
                body: this.body,
                post_id: this.post_id,
            }
            axios.post('/api/comments', storeComment).then(() => {
                location.reload()
            }).catch((error) => {
                this.errors = error.response.data.errors;
            })
        }
    },
    created() {
        axios.get('/api/posts/' + this.post_id).then((res) => {
            this.post = res.data.data
            this.comments = res.data.comments
            this.name = res.data.name
            this.users = res.data.users
        }).catch((e) => console.log(e))
    }
}
</script>

<template>
    <div>
        <div class="flex justify-between items-center px-4 pt-1 pb-2 bg-gray-100 border border-gray-200 rounded-lg">
            <div class="text-2xl font-medium">
                {{post.title}}
            </div>
            <div>
                {{user}}
            </div>
        </div>

        <div class="m-2 px-4 py-1 border border-gray-500 rounded text-justify italic">
            {{post.body}}
        </div>
        <div class="flex justify-between items-center w-full rounded-b-lg">
            <router-link :to="'/posts/'+post.id"
                class="flex justify-center items-center text-white w-full bg-blue-600 border-0 py-2 px-8 focus:outline-none hover:bg-blue-800 text-lg rounded-bl-lg"
                :class="{'rounded-br-lg': !myPost}">
                <p class="text-center">
                    View Post
                </p>
            </router-link>
            <router-link :to="'/posts/'+post.id+'/edit'" v-if="myPost"
                class="flex justify-center items-center text-white w-full bg-purple-600 border-0 py-2 px-8 focus:outline-none hover:bg-purple-800 text-lg">
                <p class="text-center">
                    Edit Post
                </p>
            </router-link>
            <button @click.prevent="deletePost(post.id)" type="submit" v-if="myPost"
                class="flex justify-center items-center text-white w-full bg-red-600 border-0 py-2 px-8 focus:outline-none hover:bg-red-800 text-lg rounded-br-lg">
                <p class="text-center">
                    Delete Post
                </p>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CardComponent',
    props: {
        post: {},
        myPost: Boolean,
        user: String
    },
    methods: {
        deletePost(id) {
            axios.delete('/api/posts/' + id, this.form).then(() => {
                location.reload()
            }).catch((error) => {
                this.errors = error.response.data.errors;
            })
        }
    },
}
</script>

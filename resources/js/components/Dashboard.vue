<template>
    <div>
        <div class="flex justify-between items-center">
            <div class="text-4xl font-medium">Dashboard</div>
            <button v-if="user" @click.prevent="logout"
                class="text-2xl px-2 py-1 border-2 border-gray-500 rounded mx-8 hover:bg-gray-500 hover:text-white">
                Logout
            </button>
        </div>
        <br>
        <div v-if="user" class="flex flex-wrap w-full justify-center items-center pt-8 text-xl ">
            <div class="flex flex-wrap w-1/4 max-w-md">
                <div class="p-2 w-full">
                    Name
                    <div class="font-medium text-center">
                        {{user.name}}
                    </div>
                </div>
                <div class="p-2 w-full">
                    Email
                    <div class="font-medium text-center">
                        {{user.email}}
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    data() {
        return {
            user: null
        }
    },
    methods: {
        logout() {
            axios.post('/api/logout').then(() => {
                location.reload()
                this.$router.push({ name: "Login" })
            })
        }
    },
    mounted() {
        axios.get('/api/user').then((res) => {
            this.user = res.data
        })
    }
}
</script>

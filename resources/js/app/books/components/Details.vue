<template>
    <div class="flex flex-col sm:flex-row -mx-4">
        <div class="px-4 w-full sm:w-auto">
            <div class="rounded shadow overflow-hidden h-56 w-40 mx-auto">
                <img class="w-full h-full object-cover" :src="book.image" :alt="book.title + ' Cover'">
            </div>
        </div>
        <div class="px-4 text-center sm:text-left mt-6 sm:mt-0">
            <h1 class="text-4xl font-bold">{{ book.title }}</h1>
            <p class="mt-2 text-lg"><span class="text-gray-500">Written by:</span> {{ book.authors }}</p>
            <router-link class="button is-primary mt-6" :to="{ name: 'reading' }">Back to Reading List</router-link>
        </div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                book: []
            }
        },

        mounted () {
            axios.get('/api/books/' + this.$route.params.id).then((response) => {
                this.book = response.data.data;
            }).catch((error) => {
                this.$router.replace({ name: 'not-found' }).catch(() => {})
            })
        }
    }
</script>

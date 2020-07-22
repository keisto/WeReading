<template>
    <div>
        <div v-if="errors.root" class="p-3 bg-red-100 border-2 border-red-400 text-red-400 rounded flex items-center mb-4">
            <i class="fal fa-exclamation-triangle mr-3 text-2xl"></i>
            {{ errors.root }}
        </div>
        <h1 class="text-4xl font-bold">Book Search</h1>
        <div class="flex items-center relative mt-2">
            <div class="input w-full">
                <input id="search" type="text" v-model="input" name="input" placeholder="Find a new book...">
            </div>
            <button class="button is-primary absolute right-0 mr-1" @click.prevent="search">
                <i class="fal fa-search"></i>
            </button>
        </div>
        <div>
            <div v-for="(book, index) in books" :key="index" v-cloak>
                <Book :book="book"/>
            </div>
            <p class="text-center py-4" v-if="books && books.length === 0">No Books Found...</p>
            <button class="button w-full" @click.prevent="showMore" v-if="books && books.length > 0">Show More</button>
        </div>
    </div>
</template>

<script>
    import Book from './Book'

    export default {
        data () {
            return {
                index: 0,
                input: '',
                books: null,
                errors: []
            }
        },

        components: {
            Book
        },

        methods: {
            search () {
                axios.post('api/books/search', {
                    input: this.input
                }).then((response) => {
                    this.errors = []
                    this.books = response.data.data
                    this.index++
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                })
            },

            showMore () {
                axios.post('/api/books/search', {
                    input: this.input,
                    index: this.index
                }).then((response) => {
                    this.books.push(...response.data.data)
                    this.index++
                })
            }
        }
    }
</script>

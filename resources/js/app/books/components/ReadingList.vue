<template>
    <div>
        <h1 class="text-4xl font-bold" v-if="user.data">👋 Hello {{ user.data.name }}</h1>

        <div class="flex justify-between w-full items-center my-2">
            <p class="text-lg text-gray-500" v-if="books.length === 0" >No books added.</p>
            <p class="my-2 text-lg text-gray-500" v-else>Hears what your are reading:</p>
            <router-link class="button is-primary" :to="{ name: 'books' }">Add Books</router-link>
        </div>

        <div v-show="books.length > 0">
            <hr>
            <div class="mt-6">
                <draggable :list="books"
                           handle=".draggable"
                           @change="updateList">
                    <div v-for="(book, index) in books" :key="index">
                        <ReadingListItem :book="book" @remove="remove" />
                    </div>
                </draggable>
            </div>
            <div v-if="message" class="p-3 bg-green-100 border-2 border-green-400 text-green-400 rounded flex items-center relative">
                <i class="fal fa-random mr-3 text-2xl"></i>
                {{ message }}
                <button class="px-3 py-2 mr-3 text-green-400 absolute right-0" @click.prevent="message = null"><i class="fal fa-times"></i></button>
            </div>
            <button class="button is-primary mt-6 w-full" @click.prevent="submit" v-if="books.length > 1">Update Priority</button>
        </div>
    </div>
</template>
<script>
    import { mapGetters } from "vuex";
    import ReadingListItem from './ReadingListItem'
    import draggable from 'vuedraggable'

    export default {
        data () {
            return {
                books: [],
                errors: [],
                message: null
            }
        },

        components: {
            ReadingListItem, draggable
        },

        computed: mapGetters({
            user: 'auth/user',
        }),

        methods: {
            submit () {
                axios.patch('/api/books', {
                    books: this.books
                }).then((response) => {
                    // Success
                    this.message = 'Sort order updated.'
                }).catch((error) => {
                    // TODO: Flash error
                })
            },
            updateList () {
                this.books.map((book, index) => {
                    book.sort_order = index + 1
                })
            },
            remove (id) {
                axios.delete('/api/books/' + id).then((response) => {
                    this.books = this.books.filter(book => book.id !== id)
                    this.updateList()
                    // TODO: Toast message
                }).catch((error) => {
                    // TODO: Display error
                })
            }
        },

        mounted () {
            axios.get('/api/books').then((response) => {
                this.books = response.data.data;
            }).catch((error) => {
                // TODO: Display error
            })
        }
    }
</script>

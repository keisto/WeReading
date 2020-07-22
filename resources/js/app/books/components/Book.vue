<template>
    <div class="w-full py-2">
        <div class="flex p-4 rounded bg-white relative transition-colors justify-center duration-200 hover:bg-gray-100 border sm:border-none">
            <div class="flex flex-col sm:flex-row justify-between w-full -m-3">

                <div class="flex flex-col items-center w-full sm:w-1/5 lg:w-1/6 p-3">
                    <div class="rounded overflow-hidden w-24 h-32 shadow-md mb-2">
                        <img class="w-full h-full object-cover" :src="book.image" :alt="book.title + ' Cover'">
                    </div>
                    <p class="mb-2">
                        <i class="fal fa-star mr-2 text-orange-400"></i>
                        {{ book.rating }}
                        <span class="text-gray-500">
                            ({{ book.ratings }})
                        </span>
                    </p>
                    <ul class="flex flex-wrap -m-2">
                        <li v-for="(category, index) in book.categories" :key="index" class="p-2">
                            <span class="bg-gray-300 text-gray-700 rounded px-2 py-1 text-xs">{{ category }}</span>
                        </li>
                    </ul>
                </div>

                <div class="w-full sm:w-2/5 lg:w-7/12 p-3">
                    <h2 class="font-bold flex items-center">
                        {{ book.title }}
                    </h2>
                    <p>
                        {{ book.description }}
                    </p>
                </div>

                <div class="flex flex-col w-full sm:w-2/5 lg:w-3/12 p-3 sm:text-right">
                    <p><span class="text-gray-500">Written by:</span> {{ book.authors }}</p>
                    <p><span class="text-gray-500">Published by:</span> {{ book.publisher }}</p>
                    <p><span class="text-gray-500">Date:</span> {{ book.published }}</p>

                    <button class="button is-primary text-sm w-full mt-4"
                            @click.prevent="addBook"
                            v-if="user.authenticated && !added">
                        Add To Reading List
                    </button>

                    <p class="text-center w-full mt-4 text-sm text-gray-500 py-3" v-else-if="added">Added To List</p>

                    <router-link class="button is-primary text-sm w-full mt-4"
                                 :to="{ name: 'login' }"
                                 v-else>Login to Add</router-link>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    import { mapGetters } from "vuex";

    export default {
        data () {
          return {
              added: false
          }
        },

        props: {
            book: {
                required: true,
                type: Object
            },
        },

        computed: mapGetters({
            user: 'auth/user',
        }),

        methods: {
            addBook() {
                axios.post('/api/books', {
                    lookup_id: this.book.lookup_id,
                    title: this.book.title,
                    authors: this.book.authors,
                    image: this.book.image,
                }).then((response) => {
                    this.added = true
                }).catch((error) => {
                    // TODO: Flash error
                })
            }
        }
    }
</script>

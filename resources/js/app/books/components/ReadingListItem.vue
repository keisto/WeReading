<template>
    <div class="my-2 rounded hover:bg-gray-100 w-full flex items-center flex-col sm:flex-row border sm:border-0">
        <div class="p-3 flex-shrink">
            <div class="bg-gray-100 hover:bg-gray-300 transition-colors duration-200 flex flex-col items-center border rounded draggable p-2">
                <i class="fal fa-grip-lines text-2xl"></i>
                <span class="text-gray-500 text-xs">DRAG</span>
            </div>
        </div>

        <div class="p-3 flex-grow">
            <i class="fal fa-book mr-2"></i>
            <strong>{{ book.title }}</strong> <span class="text-gray-500">by</span> {{ book.authors }}
        </div>

        <div class="p-3 flex-shrink">
            <span class="bg-gray-300 text-gray-700 rounded px-2 py-1 text-xs">Priority <strong>{{ book.sort_order }}</strong></span>
        </div>

        <div class="p-3 flex-shrink text-xs">
            <router-link class="button" :to="{ name: 'book', params: { id: book.id } }">View Details</router-link>
            <button class="px-3 py-2 ml-3 text-red-400 rounded border border-red-200" @click.prevent="$emit('remove', book.id)"><i class="fal fa-times"></i></button>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            book: {
                required: true,
                type: Object
            },
        },
    }
</script>

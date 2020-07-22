import Vue from 'vue'

export const Books = Vue.component('books', require('./Books').default)
export const Book = Vue.component('book', require('./Book').default)
export const Details = Vue.component('book-details', require('./Details').default)
export const ReadingList = Vue.component('reading-list', require('./ReadingList').default)


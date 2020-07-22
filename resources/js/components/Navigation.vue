<template>
    <nav class="w-full py-4 mb-4 sm:mb-12">
        <div class="container flex items-center">
            <div class="text-lg flex items-center">
                <router-link :to="{ name: 'home' }">
                    <h1 class="font-bold">WeReading</h1>
                </router-link>
            </div>
            <div class="ml-auto grid grid-cols-3 gap-2 sm:gap-4">
                <router-link class="col-auto button" :to="{ name: 'books' }">
                    <i class="fal fa-search mr-0 sm:mr-2"></i>
                    <span class="hidden sm:inline">Search</span>
                </router-link>
                <template v-if="!user.authenticated">
                    <router-link class="col-auto button" :to="{ name: 'login' }">
                        <i class="fal fa-door-open mr-0 sm:mr-2"></i>
                        <span class="hidden sm:inline">Login</span>
                    </router-link>
                    <router-link class="col-auto button is-primary" :to="{ name: 'register' }">
                        <i class="fal fa-hiking mr-0 sm:mr-2"></i>
                        <span class="hidden sm:inline">Register</span>
                    </router-link>
                </template>
                <template v-else>
                    <router-link class="col-auto button" :to="{ name: 'reading' }">
                        <i class="fal fa-books mr-0 sm:mr-2"></i>
                        <span class="hidden sm:inline">My Books</span>
                    </router-link>
                    <button class="col-auto button" @click="signout">
                        <span class="hidden sm:inline">Logout</span>
                        <i class="fal fa-door-closed ml-0 sm:ml-2"></i>
                    </button>
                </template>
            </div>
        </div>
    </nav>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        computed: mapGetters({
            user: 'auth/user',
        }),
        methods: {
            ...mapActions({
                logout: 'auth/logout'
            }),
            signout () {
                this.logout().then(() => this.$router.replace({ name: 'home' }))
            }
        }
    }
</script>

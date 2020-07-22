<template>
    <div class="flex items-center">
        <div class="mx-auto w-full max-w-sm">
            <form role="form" @submit.prevent="submit" class="bg-white shadow-2xl p-8 rounded-lg w-full">
                <div v-if="errors.root" class="p-3 bg-red-100 border-2 border-red-400 text-red-400 rounded flex items-center">
                    <i class="fal fa-exclamation-triangle mr-3 text-2xl"></i>
                    {{ errors.root }}
                </div>
                <div class="input" :class="{ 'has-error' : errors.email }">
                    <label for="email">Email</label>
                    <input id="email" type="text" name="email" placeholder="Email@domain.com" v-model="form.email">
                    <span class="hint" v-if="errors.email">{{ errors.email[0] }}</span>
                </div>

                <div class="input" :class="{ 'has-error' : errors.password }">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="⋅⋅⋅⋅⋅⋅" v-model="form.password">
                    <span class="hint" v-if="errors.password">{{ errors.password[0] }}</span>
                </div>

                <button type="submit" class="button is-primary mt-6 w-full">
                    <i class="fal fa-door-open mr-2"></i>
                    Login
                </button>
            </form>
            <div class="text-center my-8">
                <p>Don't have an account? <router-link class="link" :to="{ name: 'register' }">Register</router-link></p>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'
    import localforage from 'localforage'
    import { isEmpty } from 'lodash'

    export default {
        data () {
            return {
                form: {
                    email: null,
                    password: null
                },
                errors: []
            }
        },
        methods: {
            ...mapActions({
                login: 'auth/login'
            }),
            submit () {
                const form = this.form
                this.login({ payload: { ...form }, context: this }).then(() => {
                    // If your was redirected to login
                    // THEN direct them back to intended page
                    // ELSE go to default dashboard (ie: 'reading')
                    localforage.getItem('intended').then((name) => {
                        if (isEmpty(name)) {
                            this.$router.replace({ name: 'reading' }).catch(() => {})
                            return
                        }

                        localforage.removeItem('intended')
                        this.$router.replace({ name: name }).catch(() => {})
                    })
                })
            }
        }
    }
</script>

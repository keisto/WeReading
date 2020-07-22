<template>
    <div class="flex items-center">
        <div class="mx-auto w-full max-w-sm">
            <form role="form" @submit.prevent="submit" class="bg-white shadow-2xl p-8 rounded-lg w-full mt-4 sm:mt-0">
                <div class="input" :class="{ 'has-error' : errors.name }">
                    <label for="name">Your Name</label>
                    <input id="name" type="text" name="name" placeholder="Your Name" v-model="form.name">
                    <span class="hint" v-if="errors.name">{{ errors.name[0] }}</span>
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
                    <i class="fal fa-hiking mr-2"></i>
                    Register
                </button>
            </form>
            <div class="text-center my-8">
                <p>Already have an account? <router-link class="link" :to="{ name: 'login' }">Login</router-link></p>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'
    import localforage from "localforage"
    import { isEmpty } from 'lodash'

    export default {
        data () {
            return {
                form: {
                    name: null,
                    email: null,
                    password: null
                },
                errors: []
            }
        },
        methods: {
            ...mapActions({
                register: 'auth/register'
            }),
            submit () {
                const form = this.form
                this.register({ payload: { ...form }, context: this }).then(() => {
                    localforage.getItem('authToken').then((token) => {
                        if (!isEmpty(token)) {
                            this.$router.replace({ name: 'reading' }).catch(() => {})
                        }
                    })
                })
            }
        }
    }
</script>

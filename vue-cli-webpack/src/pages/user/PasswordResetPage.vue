<template>
    <v-container fluid fill-height>
        <div v-if="sended">
            <h1>Пароль обновлён.</h1>
        </div>
        <v-layout align-center justify-center v-else>
            <v-flex xs12 sm8 md4>
                <v-card class="elevation-12">
                    <v-toolbar :color="preferences.cardHeaderColor">
                        <v-toolbar-title><h2 :style="{color: preferences.cardHeaderTextColor}">Смена
                            пароля</h2></v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        Пожалуйста, выберите новый пароль:
                        <v-form
                                ref="form"
                                v-model="valid"
                                lazy-validation
                        >
                            <v-text-field
                                    @keyup.enter="attemptPasswordReset"
                                    v-model="password"
                                    prepend-icon="vpn_key"
                                    placeholder="Пароль"
                                    @input="clearError"
                                    :append-icon="show ? 'visibility' : 'visibility_off'"
                                    :rules="passwordRules"
                                    :type="show ? 'text' : 'password'"
                                    @click:append="show = !show"

                            ></v-text-field>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-spacer></v-spacer>
                        <v-btn
                                large
                                :disabled="!valid"
                                color="success"
                                class="mr-3"
                                @click="attemptPasswordReset"
                        >
                            Выслать ссылку
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        data() {
            return {
                sended: false,
                valid: true,
                server_error: '',
                password: '',
                passwordRules: [
                    v => !!v || 'Введите пароль',
                    v => (v.length >= 6 && v.length <= 255) || 'Пароль должен быть не менее 6 символов'
                ],
            }
        },
        computed: {
            ...mapGetters('menu', {
                preferences: 'preferences'
            })
        },

        methods: {
            attemptPasswordReset() {
                if (this.$refs.form.validate()) {
                    axios({
                        method: 'post',
                        url: '/api/password-reset',
                        responseType: 'json',
                        data: {
                            password: this.password,
                            token: this.$route.params.token
                        }
                    }).then((response) => {
                        this.refreshCSRFToken(response.data.token);
                        if (response.data.result == 'success') {
                            this.sended = true;
                        } else {
                            this.server_error = response.data.messages.email;
                        }
                    })
                }
            },
            clearError() {
                this.server_error = '';
            },
            refreshCSRFToken(token) {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
            }
        }
    }
</script>

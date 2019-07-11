<template>
    <v-container fluid fill-height>
        <div v-if="sended">
            <h1>Проверьте свой почтовый ящик {{login}} для дальнейших инструкций </h1>
        </div>
        <v-layout align-center justify-center v-else>
            <v-flex xs12 sm8 md4>
                <v-card class="elevation-12">
                    <v-toolbar :color="preferences.cardHeaderColor">
                        <v-toolbar-title><h3 :style="{color: preferences.cardHeaderTextColor}">Восстановление
                            пароля</h3></v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        Пожалуйста, укажите свой E-mail, на него будет выслана ссылка на восстановление
                        пароля:
                        <v-form
                                ref="form"
                                v-model="valid"
                                lazy-validation
                        >
                            <v-text-field
                                    @keyup.enter="attemptPasswordRequest"
                                    v-model="login"
                                    prepend-icon="email"
                                    :rules="loginRules"
                                    placeholder="E-mail"
                                    @input="clearError"
                                    :error-messages="server_error"
                                    required
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
                                @click="attemptPasswordRequest"
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
                login: '',
                loginRules: [
                    v => !!v || 'Введите Е-mail',
                ],
            }
        },
        computed: {
            ...mapGetters('menu', {
                preferences: 'preferences'
            })
        },

        methods: {
            attemptPasswordRequest() {
                if (this.$refs.form.validate()) {
                    axios({
                        method: 'post',
                        url: '/api/password-request',
                        responseType: 'json',
                        data: {
                            email: this.login
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

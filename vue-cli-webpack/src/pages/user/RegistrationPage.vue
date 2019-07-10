<template>
    <v-container fluid fill-height>
        <div v-if="user.id">
            <h1>Активный пользователь {{user.email}}. Для регистрации выйдите из учётной записи.</h1>
        </div>
        <v-layout align-center justify-center v-else>
            <v-flex xs12 sm8 md4>
                <v-card class="elevation-12" >
                    <v-toolbar :color="preferences.cardHeaderColor">
                        <v-toolbar-title><h1 :style="{color: preferences.cardHeaderTextColor}">Регистрация</h1></v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        Пожалуйста, заполните следующие поля для регистрации:
                        <v-form
                                ref="form"
                                v-model="valid"
                                lazy-validation
                        >
                            <v-text-field
                                    @keyup.enter="attemptRegistration"
                                    v-model="login"
                                    prepend-icon="email"
                                    :rules="loginRules"
                                    placeholder="E-mail"
                                    @input="clearError"
                                    :error-messages="server_error"
                                    required
                            ></v-text-field>

                            <v-text-field
                                    @keyup.enter="attemptRegistration"
                                    v-model="password"
                                    prepend-icon="vpn_key"
                                    placeholder="Пароль"
                                    @input="clearError"
                                    :append-icon="show ? 'visibility' : 'visibility_off'"
                                    :rules="passwordRules"
                                    :type="show ? 'text' : 'password'"
                                    @click:append="show = !show"

                            ></v-text-field>

                            <v-text-field
                                    @keyup.enter="attemptRegistration"
                                    mask="+38(###) ### ## ##"
                                    v-model="phone"
                                    prepend-icon="phone"
                                    :rules="phoneRules"
                                    placeholder="Телефон"
                                    @input="clearError"
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
                                @click="attemptRegistration"
                        >
                            Зарегистрироваться
                        </v-btn>
                    </v-card-actions>
                    <v-card-actions class="py-0">
                        <p class="text-xs-left caption mx-2">Если Вы уже зарегистрированы, можете</p>
                        <v-btn flat
                               color="primary"
                               @click="goLogin"
                        >
                            Войти
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                    <v-card-actions class="pt-0 pb-1">
                        <p class="text-xs-left caption mx-2"> Если Вы забыли пароль, можете его</p>
                        <v-btn flat
                               color="warning"
                               @click="passwordRequest"
                        >
                            Восстановить
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import {mapActions} from 'vuex';
    import {mapGetters} from 'vuex';

    export default {
        data() {
            return {
                valid: true,
                remember_me: 0,
                server_error: '',
                login: '',
                show: false,
                password: '',
                phone: '',
                loginRules: [
                    v => !!v || 'Введите Е-mail',
                    v => /.+@.+/.test(v) || 'E-mail имеет неверный формат',
                    v => v.length <= 255 || 'E-mail must be less than 255 characters'
                ],
                passwordRules: [
                    v => !!v || 'Введите пароль',
                    v => (v.length >= 6 && v.length <= 255) || 'Пароль должен быть не менее 6 символов'
                ],
                phoneRules: [
                    v => v.length == 12 || v.length == 0 || 'Неверный номер телефона'
                ],
            }
        },
        computed:{
            ...mapGetters('user', {
                user : 'user'
            }),
            ...mapGetters('menu', {
                preferences: 'preferences'
            })
        },

        methods: {
            ...mapActions('user', {
                initUser: 'initUser'
            }),
            attemptRegistration() {
                if (this.$refs.form.validate()) {
                    axios({
                        method: 'post',
                        url: '/api/registration',
                        responseType: 'json',
                        data: {
                            email: this.login,
                            password: this.password,
                            phone: this.phone
                        }
                    }).then((response) => {
                        console.log(response.data);
                        this.refreshCSRFToken(response.data.token);
                        if (response.data.result == 'success') {
                            this.initUser();
                            this.$router.push('/');
                        } else {
                            this.server_error = response.data.messages.email;
                        }
                    })
                }
            },
            goLogin() {
                this.$router.push('/login');
            },
            passwordRequest() {
                this.$router.push('/password-request');
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

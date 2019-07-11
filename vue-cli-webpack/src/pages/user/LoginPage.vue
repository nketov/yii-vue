<template>
    <v-container fluid fill-height>
        <div v-if="user.id">
            <h1>Активный пользователь {{user.email}}</h1>
        </div>
        <v-layout align-center justify-center v-else>
            <v-flex xs12 sm8 md4>
                <v-card class="elevation-12" >
                    <v-toolbar :color="preferences.cardHeaderColor">
                        <v-toolbar-title><h1 :style="{color: preferences.cardHeaderTextColor}">Вход</h1></v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        Пожалуйста, заполните следующие поля для входа:
                        <v-form
                                ref="form"
                                v-model="valid"
                                lazy-validation
                        >
                            <v-text-field
                                    v-model="login"
                                    prepend-icon="email"
                                    :rules="loginRules"
                                    placeholder="E-mail"
                                    @input="clearError"
                                    @keyup.enter="attemptLogin"
                                    required
                            ></v-text-field>

                            <v-text-field
                                    v-model="password"
                                    prepend-icon="vpn_key"
                                    placeholder="Пароль"
                                    @input="clearError"
                                    @keyup.enter="attemptLogin"
                                    :append-icon="show ? 'visibility' : 'visibility_off'"
                                    :rules="passwordRules"
                                    :type="show ? 'text' : 'password'"
                                    :error-messages="server_error"
                                    @click:append="show = !show"

                            ></v-text-field>
                        </v-form>
                    </v-card-text>
                    <v-card-actions class="py-1">
                        <v-spacer></v-spacer>
                        <v-checkbox
                                v-model="remember_me"
                                label="Запомнить меня"
                        ></v-checkbox>
                        <v-spacer></v-spacer>
                        <v-btn
                                large
                                :disabled="!valid"
                                color="success"
                                class="mr-3"
                                @click="attemptLogin"
                        >
                            Войти
                        </v-btn>
                    </v-card-actions>
                    <v-card-actions class="py-1">
                        <p class="text-xs-left caption mx-2">Если Вы новый пользователь, то можете</p>
                        <v-btn flat
                                color="primary"
                                @click="registration"
                        >
                            Зарегистрироваться
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
                loginRules: [
                    v => !!v || 'Введите Е-mail',
                ],
                password: '',
                passwordRules: [
                    v => !!v || 'Введите пароль'
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
            attemptLogin() {
                if (this.$refs.form.validate()) {
                    axios({
                        method: 'post',
                        url: '/api/login',
                        responseType: 'json',
                        data: {
                            email: this.login,
                            password: this.password,
                            rememberMe: this.remember_me
                        }
                    }).then((response) => {
                        this.refreshCSRFToken(response.data.token);
                        if (response.data.result == 'success') {
                            this.initUser();
                            this.$router.push('/');
                        } else {
                            this.server_error = response.data.messages.password;
                        }
                    })
                }
            },
            registration() {
                this.$router.push('/registration');
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

<template>
    <v-flex xs12 sm6 offset-sm3>
        <v-card class="elevation-10">
            <v-img
                    contain
                    class="white--text"
                    height="500px"
                    src="/images/404.png"
            >
            </v-img>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn tag="v-btn" color="primary" large @click="redirectMain">Вернуться на главную</v-btn>
            </v-card-actions>
        </v-card>
    </v-flex>


</template>

<script>
    export default {
        methods: {
            redirectMain() {
                this.$router.push('/');
            }
        }
    }
</script>
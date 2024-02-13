<template>
    <div class="login-container">
        <form class="login-box" @submit.prevent="submit">
            <el-input
                v-model="form.name"
                placeholder="Nome"
                size="large"
            />
            <el-input
                v-model="form.email"
                placeholder="E-mail"
                size="large"
            />
            <el-input
                v-model="form.password"
                placeholder="Senha"
                size="large"
                type="password"
            />
            <el-input
                v-model="form.password_confirmation"
                placeholder="Confirme a senha"
                size="large"
                type="password"
            />
            <el-button type="primary">
                Registrar
            </el-button>
        </form>
    </div>
</template>

<script>
export default {
    data: () => ({
        form: {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        }
    }),
    methods: {
        submit() {
            router.post('/login', this.form);
        }
    }
}
</script>

<style>
    .login-container {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .login-container button {
        width: 100%;
    }

    .login-box {
        max-height: 100vh;
        background-color: white;
        padding: 20px;
    }

    .login-box > * {
        margin-bottom: 10px;
    }

    body {
        background-color: var(--el-color-primary);
    }
</style>

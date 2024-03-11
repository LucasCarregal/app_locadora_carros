<script setup>
import { ref } from "vue";

const props = defineProps(["csrf_token", "url_login"]);

const email = ref(null);
const password = ref(null);

function login(e) {
    const config = {
        method: "post",
        body: new URLSearchParams({
            email: email.value,
            password: password.value,
        }),
    };

    fetch(props.url_login, config)
        .then((resp) => resp.json())
        .then((data) => {
            if (data.token) {
                document.cookie = "token =" + data.token + "; SameSite=Lax";
            }
            e.target.submit(); // envia o form de autenticação por sessão
        });
}
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="POST" @submit.prevent="login($event)">
                            <input
                                type="hidden"
                                :value="props.csrf_token"
                                name="_token"
                            />
                            <div class="row mb-3">
                                <label
                                    for="email"
                                    class="col-md-4 col-form-label text-md-end"
                                    >E-mail</label
                                >
                                <div class="col-md-6">
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        value=""
                                        required
                                        autocomplete="email"
                                        autofocus
                                        v-model="email"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    for="password"
                                    class="col-md-4 col-form-label text-md-end"
                                    >Senha</label
                                >
                                <div class="col-md-6">
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        required
                                        autocomplete="current-password"
                                        v-model="password"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="remember"
                                            id="remember"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="remember"
                                        >
                                            Lembre-me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Login
                                    </button>
                                    <a class="btn btn-link" href="#">
                                        Esqueceu sua senha?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

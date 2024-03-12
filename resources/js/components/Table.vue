<script setup>
import { computed } from "vue";

const props = defineProps(["dados", "cabecalho"]);
const dadosFiltrados = computed(() => {
    return props.dados.map((e) => {
        let retorno = {};
        Object.keys(e).forEach((chave) => {
            if (Object.keys(props.cabecalho).includes(chave)) {
                retorno[chave] = e[chave];
            }
        });
        return retorno;
    });
});

function formatarData(dataISO) {
    const data = new Date(dataISO);
    const dia = data.getDate().toString().padStart(2, "0");
    const mes = (data.getMonth() + 1).toString().padStart(2, "0"); // getMonth() retorna 0 para janeiro, 1 para fevereiro, etc.
    const ano = data.getFullYear();
    return `${dia}/${mes}/${ano}`;
}
</script>

<template>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" v-for="(th, key) in cabecalho" :key="key">
                    {{ th.titulo }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(dado, i) in dadosFiltrados" :key="i">
                <td v-for="(vlr, key) in dado" :key="key">
                    <img
                        :src="'storage/' + vlr"
                        width="30"
                        height="30"
                        v-if="cabecalho[key].tipo == 'imagem'"
                    />
                    <span v-if="cabecalho[key].tipo == 'data'">
                        {{ formatarData(vlr) }}
                    </span>
                    <span v-if="cabecalho[key].tipo == 'text'">
                        {{ vlr }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</template>

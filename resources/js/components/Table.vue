<script setup>
const props = defineProps(["dados", "cabecalho"]);
</script>

<template>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" v-for="(th, key) in cabecalho" :key="key">
                    {{ th }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="dado in dados" :key="dado.id">
                <td v-for="(vlr, key) in dado" :key="key">
                    <img
                        :src="'storage/' + vlr"
                        width="30"
                        height="30"
                        v-if="key == 'imagem'"
                    />
                    <span v-else>
                        {{ vlr }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</template>

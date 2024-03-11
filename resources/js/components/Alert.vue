<script setup>
const { tipo, textoAleta } = defineProps(["tipo", "textoAleta"]);

const classe = "alert alert-" + tipo;
</script>

<template>
    <div :class="classe" role="alert">{{ textoAleta }}</div>
</template>

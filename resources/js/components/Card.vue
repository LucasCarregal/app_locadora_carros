<script setup>
const props = defineProps(["titulo"]);
</script>

<template>
    <div class="card mb-5">
        <div class="card-header">{{ titulo }}</div>
        <div class="card-body">
            <slot name="conteudo"></slot>
        </div>
        <div class="card-footer">
            <slot name="rodape"></slot>
        </div>
    </div>
</template>

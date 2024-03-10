<template>
    <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <a href="#" class="nav-link">Clientes</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Locações</a>
        </li>
        <li class="nav-item dropdown">
            <button
                href="#"
                class="nav-link dropdown-toogle"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                Veiculos
            </button>
            <ul class="dropdown-menu">
                <li><a href="#" class="dropdown-item">Carros</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <a :href="rotaMarcas" class="dropdown-item">Marcas</a>
                </li>
                <li><a href="#" class="dropdown-item">Modelos</a></li>
            </ul>
        </li>
    </ul>
</template>

<script setup>
const props = defineProps(["rotaMarcas"]);
</script>

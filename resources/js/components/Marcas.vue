<script setup>
import { ref, onMounted } from "vue";

const urlBase = "http://localhost:8000/api/v1/marca";

const token =
    "Bearer " +
    document.cookie
        .split(";")
        .find((i) => i.startsWith("token"))
        .split("=")[1];

onMounted(carregarList());

var nomeMarca = ref(null);
var arquivoImagem = ref(null);
var statusTransacao = ref("");
var msgTransacao = ref("");
var marcas = ref([]);

function limparAlertas(time) {
    setTimeout(() => {
        statusTransacao.value = "";
        msgTransacao.value = "Erro!";
    }, time);
}

function carregarImagem(e) {
    arquivoImagem = e.target.files;
}

function carregarList() {
    let config = {
        headers: {
            Accept: "aplication/json",
            Authorization: token,
        },
    };

    axios
        .get(urlBase, config)
        .then((resp) => {
            marcas.value = resp.data;
        })
        .catch((errors) => {
            console.log(errors);
        });
}

function salvar() {
    let formData = new FormData();
    formData.append("nome", nomeMarca.value);
    formData.append("imagem", arquivoImagem[0]);

    let config = {
        headers: {
            "Content-Type": "multipart/form-data",
            Accept: "aplication/json",
            Authorization: token,
        },
    };

    axios
        .post(urlBase, formData, config)
        .then((resp) => {
            statusTransacao.value = "success";
            msgTransacao.value =
                "Marca " + resp.data.nome + " adicionada com sucesso!";
            marcas.value.push(resp.data);
            limparAlertas(3000);
        })
        .catch((errors) => {
            statusTransacao.value = "danger";
            msgTransacao.value = errors.response.data.message;
            limparAlertas(3000);
        });
}
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- inicio card busca -->
                <Card titulo="Busca de Marcas">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="mb-3 col">
                                <InputContainer
                                    id="inputId"
                                    titulo="ID"
                                    id-help="idHelp"
                                    texto-ajuda="Informe o ID da Marca"
                                >
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="inputId"
                                        aria-describedby="idHelp"
                                        placeholder="ID"
                                    />
                                </InputContainer>
                            </div>
                            <div class="mb-3 col">
                                <InputContainer
                                    id="inputNome"
                                    titulo="Nome da Marca"
                                    id-help="nomeHelp"
                                    texto-ajuda="Informe o Nome da Marca"
                                >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="inputNome"
                                        aria-describedby="nomeHelp"
                                        placeholder="Nome da Marca"
                                    />
                                </InputContainer>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="button" class="btn btn-primary float-end">
                            Adicionar
                        </button>
                    </template>
                </Card>
                <!-- fim card busca -->
                <!-- inicio card listagem -->
                <Card titulo="Relação de Marcas">
                    <template v-slot:conteudo>
                        <Table
                            :cabecalho="{
                                id: { titulo: 'ID', tipo: 'text' },
                                nome: { titulo: 'Nome', tipo: 'text' },
                                imagem: { titulo: 'Logo', tipo: 'imagem' },
                                created_at: {
                                    titulo: 'Data Criação',
                                    tipo: 'data',
                                },
                            }"
                            :dados="marcas"
                        />
                    </template>
                    <template v-slot:rodape>
                        <button
                            type="button"
                            class="btn btn-primary float-end"
                            data-bs-toggle="modal"
                            data-bs-target="#modalMarca"
                        >
                            Adicionar
                        </button>
                    </template>
                </Card>
                <!-- fim card listagem -->
            </div>
        </div>
        <Modal id="modalMarca" titulo="Adicionar Marca">
            <template v-slot:alertas>
                <Alert
                    :tipo="statusTransacao"
                    :texto-aleta="msgTransacao"
                    v-if="statusTransacao != ''"
                />
            </template>
            <template v-slot:conteudo>
                <InputContainer
                    id="novoNomeInput"
                    titulo="Nome da Marca"
                    id-help="nomeHelpModal"
                    texto-ajuda="Informe o Nome da Marca"
                >
                    <input
                        type="text"
                        class="form-control"
                        id="novoNomeInput"
                        aria-describedby="nomeHelpModal"
                        placeholder="Nome"
                        v-model="nomeMarca"
                    />
                </InputContainer>
                <InputContainer
                    id="novoImagemInput"
                    titulo="Imagem"
                    id-help="imagemHelpModal"
                    texto-ajuda="Selecione uma imagem no formato PNG"
                >
                    <input
                        type="file"
                        class="form-control"
                        id="novoImagemInput"
                        aria-describedby="imagemHelpModal"
                        placeholder="Selecione a imagem da Marca"
                        @change="carregarImagem($event)"
                    />
                </InputContainer>
            </template>
            <template v-slot:rodape>
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Fechar
                </button>
                <button type="button" class="btn btn-primary" @click="salvar()">
                    Salvar
                </button>
            </template>
        </Modal>
    </div>
</template>

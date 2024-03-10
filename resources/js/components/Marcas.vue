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
                        <Table></Table>
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
                <button type="button" class="btn btn-primary">Salvar</button>
            </template>
        </Modal>
    </div>
</template>

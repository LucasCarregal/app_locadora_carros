<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Busca de Marcas</div>
                    <div class="card-body">
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
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-end">
                            Pesquisar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

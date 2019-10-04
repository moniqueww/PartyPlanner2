<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered servicos" role="document">
        <div class="modal-content">                  
                <div class="modal-header" style="padding: 1.5rem;">
                    <select id="categoriaPesq" class="form-control form-control-alternative" style="width: 40%;">
                        <option value="todos">Todos</option>
                        <?php
                            if(!empty($categorias)) {
                                foreach($categorias as $ca) {
                                    echo "<option value=".$ca->getId().">".$ca->getNome()."</option>";
                                }
                            }
                        ?>
                    </select>
                    <input id="nomePesq" type="text" class="form-control form-control-alternative" style="height: calc(2.25rem + 2px); width: 50%; position: absolute; right: 64px;" placeholder="Pesquise pelo nome"/>
                    <button id="cancelaListaServicos" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: calc(1.5rem + 86px) 1.5rem 1.5rem 1.5rem;">
                    <div style="width: 49%; max-height: calc(90vh - 86px - 3rem); overflow: auto; float: left;">

                        <div style="    position: sticky;
    top: 0;
    background-color: #2d2c2c; z-index: 50;">
                            <div style="
                            display: inline-block;
                            font-weight: 600;
                            text-transform: uppercase;
                            color: #fff;
                            margin-right: 20px;
                            letter-spacing: -0.02rem;
                            padding-bottom: 5px;
                            border-bottom: solid 3px #f0438f;
                        ">Mais populares</div>
                            <div style="
                            display: inline-block;
                            font-weight: 600;
                            text-transform: uppercase;
                            letter-spacing: -0.02rem;
                            color: #505050;
                            margin-right: 15px;
                        ">Seus favoritos</div>
                        </div>

                        <table id="tabela_servicos" style="width: 100%;">
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div style="box-shadow: 0px 2px 50px 0px #17171717;
                        width: 49%;
                        height: calc(90vh - 86px - 3rem);
                        background: #201f1f;
                        border-radius: 0.3rem;
                        float: right;
                    ">
                                            
                        <div style="
                        width: 100%;
                        height: 200px;
                        background: linear-gradient(45deg, #f0438f, #6758ef);
                        border-radius: 0.3rem 0.3rem 0 0;
                    "></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
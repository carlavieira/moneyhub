<section>
    <div class="transacoes">
        <div class="container">
            <div class="col-md-3"></div>
            <div class="col-md-9">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h1>TRANSAÇÕES</h1>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat animi odit repudiandae, recusandae voluptate consectetur enim excepturi ea voluptas libero accusantium quis soluta!
                    </p>
                    <div class="espace"></div>
                    <div class="transacoes-box">
                    
                    <form id="frmCadastro">
                        <input type="text" id="txtCpf" placeholder="CPF/CNPJ" required><br>
                        <input type="text" id="txtConta" placeholder="CONTA" required><br>
                                                
                        <fieldset>
                            <legend>TIPO DE TRANSAÇÃO</legend>
                            <input type="radio" name="tipo" value="doc" id="rdoDoc" checked>
                            <label for="rdoDoc">DOC</label><br>		
                            
                            <input type="radio" name="tipo" value="ted" id="rdoTed">
                            <label for="rdoTed">TED</label>
                        </fieldset>

                        <input type="text" id="txtValor" placeholder="VALOR" required><br>
                        
                        <input type="submit" name="" id="btnCadastrarSalvar" value="Cadastrar">
                    </form>
            

                        <table>
                        <caption><h2>Tabela</h2></caption>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>cpf/cnpj</th>
                                    <th>conta</th>
                                    <th>tipo</th>
                                    <th>valor</th>
                                    <th>Dia da transação</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyResultados"></tbody>
                            <tfoot></tfoot>
                        </table>                        
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
<br><br><br><br><br><br><br><br><br><br>
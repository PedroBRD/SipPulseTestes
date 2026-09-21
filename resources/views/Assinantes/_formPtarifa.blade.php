            <label for="name">Nome do Plano de Tarifas: </label>
            <input type="text" id="name" name="name" required><br>

            <label for="rateId">ID da Tarifa (RateId): </label>
            <input type="text" id="rateId" name="rateId" placeholder="ID da tarifa associada ao plano" required><br>

            <label for="prepaid">O plano é Pré-Pago? </label>
            <input type="checkbox" id="prepaid" name="prepaid" value=1><br>

            <label for="blockCallsWithoutRate">Bloquear Chamadas para Destinos sem Tarifa? </label>
            <input type="checkbox" id="blockCallsWithoutRate" name="blockCallsWithoutRate" value=1><br> 

            <label for="txConnection">Taxa de Conexão: </label>
            <input type="text" id="txConnection" name="txConnection" required><br>

            <label for="cadency">Taxa de Cadência: </label>
            <input type="text" name="cadency" id="cadency" required><br>

            <label for="txDelay">Taxa de delay: </label>
            <input type="text" name="txDelay" id="txDelay"><br>

            <label for="txDiscard">Taxa de Descarte: </label>
            <input type="text" name="txDiscard" id="txDiscard"><br>

            <label for="limitToCreditExpires">Limite para a Validade dos Créditos (em dias): </label>
            <input type="text" id="limitToCreditExpires" name="limitToCreditExpires"><br>  
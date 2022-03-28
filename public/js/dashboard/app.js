$(function () {
    /*
        Zerando as configuracoes dos formularios
    **/
    /*$('a').click(function(e){
        e.preventDefault();
    });*/
    $('#form-carteira-movel').hide();
    $('#form-recargas').hide();
    //$('#form-servicos-informaticos').hide();

    hideAll();

    function hideAll() {
        $('#form-carteira-movel');
        $('#form-recargas');
        $('.form-credelec').hide();
        $('.form-movel').hide();
        $('.form-antena').hide();
        $('.form-fipag').hide();
    }

    /*
        Programando o funcionamento da calculadora
    **/
    $('#calculator').draggable();
    
    $('#background-calculator').hide();

    $('#show-calculator').click(function () {
        $('#background-calculator').toggle();
    });

    $('#hide-calculator').click(function () {
        $('#background-calculator').fadeOut();
    });

    var lcd = $('#calc-lcd').val();

    $(".expression").click(function () {
        lcd = lcd + $(this).val();
        $('#calc-lcd').val(lcd);
    });

    $('#btn-result').click(function () {
        $('#result').text(eval(lcd));
    });

    $('#btn-clear').click(function () {
        lcd = '';
        $('#calc-lcd').val(lcd);
    });

    /*
        Programando o formulario de Carteiras moveis, recargas e servicos informaticos
    **/

    $('#carteira-movel').draggable();

    $('#background-carteira-movel').hide();

    /*$('#hide-carteira-movel').click(function () {
        hideAll();
        $('#carteira-movel').toggle();
        $('#background-carteira-movel').toggle();
    });*/

    $('.btn-show-carteira-movel').click(function () {
        $('#form-carteira-movel').toggle();
        $('#movimento-title').text('Carteiras moveis');
        $('#background-carteira-movel').toggle();
    });


    /*
        Programando o formulario de recargas e servicos informaticos
    **/

    //Programando os servicos de credelec
    $('#show-credelec').click(function () {
        $('#movimento-title').text('Credelec');
        $('#background-carteira-movel').show();
        $('.form-credelec').show();
    });

    //Programando os servicos de recargas moveis
    $('#show-mobile-recharge').click(function () {
        $('#movimento-title').text('Recargas moveis');
        $('#background-carteira-movel').show();
        $('.form-movel').show();
    });

    //Programando os ervicos de recargas de tv
    $('#show-tv').click(function () {
        $('#movimento-title').text('Recargas TV');
        $('#background-carteira-movel').show();
        $('.form-antena').show();
    });

    //Programando os ervicos de recargas de fipag
    $('#show-fipag').click(function () {
        $('#movimento-title').text('Fipag');
        $('#background-carteira-movel').show();
        $('.form-fipag').show();
    });
    

    //Programando os servicos de investimento
    $('.show-form-investment').click(function () {
        $('#movimento-title').text('Investimentos');
        $('#background-carteira-movel').show();
        $('#form-investment').show();
    });

    //funcao generica para listar os servicos de acordo com o codigo
    function getService(code){
        var service;
        $.ajax({
            url: 'getService/' + code,
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function(result){
                service = result;
            }
        });

        return service;
    };

    /*
        Servicos informaticos
    **/

    $('.btn-show-servicos-informaticos').click(function () {
        $('#form-servicos-informaticos').toggle();
        $('#movimento-title').text('Servicos informaticos');
        $('#background-carteira-movel').toggle();

        //BUSCANDO OS SERVICOS DO BANCO DE DADOS
        var code = 3;
        var service = getService(code)
        //console.log(service);

        for (let index = 0; index < service.length; index++) {

            var name = service[index].name.toLowerCase();
            if(!$(`#div-${name}`).length)
            {
                $('#form-group-informatico').append(
                    `
                        <div class="input-label" id="div-${name}">
                            <div>
                                <input class="checkbox" type="checkbox" value="${service[index].id}" name="" id="${name}">
                                <label style="margin-right: 10px;" for="${name}">${name}</label>
                            </div>
                        </div>
                    `
                );
            }
            
        }
        if(!$(`#btn-submit-form-servic-informatic`).length)
        {
            $('#form-group-informatico').append(`
                <button type="submit" class="btn-cadastrar" id='btn-submit-form-servic-informatic'>Cadastrar</button>
            `);
        }
        //chamando a funcao de copias;
        formCopy();
        formDigitacao();
        formEncadernacao();
        formImplastasticacao();
        formImpressao();

        //var forms = [formCopy(), formDigitacao(), formEncadernacao(), formImplastasticacao(), formImpressao()];
        
        
    });

    /*
        Zerando as paginas movimentos informaticos
    **/
   var amount_sinfo = [];

   var amount_total = $('#amount_total');

   function getAmount()
   {
        var amount = 0;
    
        /*for (let index = 0; index < amount_sinfo.length; index++) {
            console.log(amount_sinfo);
            return
            amount = amount + amount_sinfo[index].amount;
            console.log(amount_sinfo[index]);
        }*/
        console.log('o tamanho e: ' + amount_sinfo.length);
        amount_sinfo.forEach(element => {
            amount = amount + element.amount;
            amount_total.text(amount);
        });
   }

   //amount_total.text(amount_sinfo);

   //ajax para retornar precos de materias informaticos
    function prices(code){
        var prices = 0;
        $.ajax({
            url: 'getPrices/'+code,
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function(result){
                prices = result;
            }
        });

        return prices;
    }

    //scrpt para criar inputs relacionados a copias
    function formCopy()
    {
        $('#copia').click(function () {
            var code = parseInt($(this).val());
            var indice = 0;
            var page = 0;
            var amount = 0;

            if ($('#copia-pagina').length) {
                $('#copia-papel').remove();
                $('#copia-pagina').remove();
                amount_sinfo[indice] = {id: code, amount: 0}
                getAmount()
            } else {
                var price = prices(code);

                $('#div-copia').append(`
                    <select name="" id="copia-papel" class="papel" id="" required>
                        <option value="">Papel</option>
                    </select>
                    <input type="text" class="papel" placeholder="paginas" id="copia-pagina" min="1" required></input>
                `);
                for (let index = 0; index < price.length; index++) {
                    
                    $('#copia-papel').append(
                        `
                            <option value="${price[index].amount}">${price[index].label}</option>
                        
                        `
                    );
                    
                }

            }

            // capturando o valor do option selecionado e atribuito a variavel que faz a referencia do preco
            $('#copia-papel').change(function(){
                if (parseFloat($(this).val()) >= 1) {
                    price = parseFloat($(this).val());
                    //console.log('O valor e: ' + price);
                }else{
                    price = 0;
                }
                getAmountCopy();
                getAmount()
            });

            //capturando a quantidade de pagina
            $('#copia-pagina').keyup(function(){
                if (parseInt($(this).val()) >= 1) {
                    page = parseInt($(this).val());
                    //console.log('O numero de pagina e: ' + page);
                }else{
                    page = 0;
                }
                getAmountCopy();
                getAmount()
            });

            //funcao que determina o montante a se pagar
            function getAmountCopy() {
                amount = price * page;
                amount_sinfo[indice] = {id: code, amount: amount}

                //console.log(amount_sinfo);
            }

        });
    }

    //scrpt para criar inputs relacionados a digitacao
    function formDigitacao()
    {
        $('#digitacao').click(function () {
            var code = parseInt($(this).val());
            var indice = 1;
            var price = 0;
            var page = 0;
            var amount = 0;
            
            if ($('#digitacao-pagina').length) {
                $('#digitacao-papel').remove();
                $('#digitacao-pagina').remove();
                amount_sinfo[indice] = {id: code, amount: 0}
                getAmount()
            } else {
                var price = prices(code);
                $('#div-digitacao').append(`
                    <select name="" id="digitacao-papel" class="papel" id="" required>
                        <option value="0">Papel</option>
                    </select>
                    <input type="text" class="papel" placeholder="paginas" id="digitacao-pagina" min="1" required></input>
                `);
                for (let index = 0; index < price.length; index++) {
                    
                    $('#digitacao-papel').append(
                        `
                            <option value="${price[index].amount}">${price[index].label}</option>
                        
                        `
                    );
                    
                }
            }

            //capturando o preco atravez dos valores dos options
            $('#digitacao-papel').change(function(){
                if (parseFloat($(this).val()) >= 1) {
                    price = $(this).val();
                } else {
                    price = 0;
                }

                getAmountDigitacao();
                getAmount()
            });

            //capturando a quqntidade de paginas
            $('#digitacao-pagina').keyup(function(){
                if (parseInt($(this).val()) >= 1) {
                    page = $(this).val();
                } else {
                    page = 0;
                }

                getAmountDigitacao();
                getAmount()
            });

            //funcao para detyerminar o montante total
            function getAmountDigitacao(){
                amount = price * page;
                amount_sinfo[indice] = {id: code, amount: amount}
                //console.log(amount_sinfo);
            }
        });
    }

    //scrpt para criar inputs relacionados a impressao
    function formImpressao()
    {
        $('#impressao').click(function () {
            var code = parseInt($(this).val());
            var indice = 2;
            var price = 0;
            var page = 0;
            var amount = 0;

            if ($('#impressao-pagina').length) {
                $('#impressao-papel').remove();
                $('#impressao-pagina').remove();
                amount_sinfo[indice] = {id: code, amount: 0}
                getAmount()
            } else {
                var price = prices(code);

                $('#div-impressao').append(`
                    <select name="" id="impressao-papel" class="papel" id="" required>
                        <option value="">Papel</option>
                    </select>
                    <input type="text" class="papel" placeholder="paginas" id="impressao-pagina" min="1" required></input>
                `);
                for (let index = 0; index < price.length; index++) {
                    
                    $('#impressao-papel').append(
                        `
                            <option value="${price[index].amount}">${price[index].label}</option>
                        
                        `
                    );
                    
                }
            }

            //capturando o preco atravez dos valores dos options
            $('#impressao-papel').change(function(){
                if (parseInt($(this).val()) >= 1) {
                    price = $(this).val();
                } else {
                    price = 0;
                }

                getAmountImpressao();
                getAmount()
            });

            //capturando a quqntidade de paginas
            $('#impressao-pagina').keyup(function(){
                if (parseInt($(this).val()) >= 1) {
                    page = $(this).val();
                } else {
                    page = 0;
                }

                getAmountImpressao();
                getAmount()
            });

            //funcao para detyerminar o montante total
            function getAmountImpressao(){
                amount = price * page;
                amount_sinfo[indice] = {id: code, amount: amount}
                console.log(amount_sinfo);
            }
        });
    }

    //scrpt para criar inputs relacionados a implasticacao
    function formImplastasticacao()
    {
        $('#implasticacao').change(function () {
            var code = parseInt($(this).val());
            var indice = 3;
            var price = 0;
            var page = 0;
            var amount = 0;

            if ($('#implasticacao-pagina').length) {
                $('#implasticacao-papel').remove();
                $('#implasticacao-pagina').remove();
                amount_sinfo[indice] = {id: code, amount: 0}
                getAmount()
            } else {
                var price = prices(code);

                $('#div-implasticacao').append(`
                    <select name="" id="implasticacao-papel" class="papel" id="" required>
                        <option value="">Papel</option>
                    </select>
                    <input type="text" class="papel" placeholder="paginas" id="implasticacao-pagina" min="1" required></input>
                `);
                for (let index = 0; index < price.length; index++) {
                    
                    $('#implasticacao-papel').append(
                        `
                            <option value="${price[index].amount}">${price[index].label}</option>
                        
                        `
                    );
                    
                }
            }

            //capturando o preco atravez dos valores dos options
            $('#implasticacao-papel').change(function(){
                if (parseInt($(this).val()) >= 1) {
                    price = $(this).val();
                } else {
                    price = 0;
                }

                getAmountImplasticacao();
                getAmount()
            });

            //capturando a quqntidade de paginas
            $('#implasticacao-pagina').keyup(function(){
                if (parseInt($(this).val()) >= 1) {
                    page = $(this).val();
                } else {
                    page = 0;
                }

                getAmountImplasticacao();
                getAmount()
            });

            //funcao para detyerminar o montante total
            function getAmountImplasticacao(){
                amount = price * page;
                amount_sinfo[indice] = {id: code, amount: amount}
                console.log(amount_sinfo);
            }
            
        });
    }

    //scrpt para criar inputs relacionados a encadernacao
    function formEncadernacao()
    {
        $('#encadernacao').click(function () {
            var code = parseInt($(this).val());
            var indice = 4;
            var price = 0;
            var qnt = 0;
            var amount = 0;

            if ($('#encadernacao-argola').length) {
                $('#encadernacao-argola').remove();
                $('#qnt-encadernacao').remove();
                amount_sinfo[indice] = {id: code, amount: 0}
                getAmount()
            } else {
                var price = prices(code);

                $('#div-encadernacao').append(`
                    <select name="" id="encadernacao-argola" class="papel" id="" required>
                        <option value="">Papel</option>
                    </select>
                    <input type="text" name='encader' class="papel" placeholder="paginas" id="qnt-encadernacao" min="1" required></input>
                `);
                for (let index = 0; index < price.length; index++) {
                    
                    $('#encadernacao-argola').append(
                        `
                            <option value="${price[index].amount}">${price[index].label}</option>
                        
                        `
                    );
                    
                }
            }

            //capturando o preco atravez dos valores dos options
            $('#encadernacao-argola').change(function(){
                if (parseInt($(this).val()) >= 1) {
                    price = $(this).val();
                } else {
                    price = 0;
                }

                getAmountEncadernacao();
                getAmount()
            });

            //capturando a quqntidade de paginas
            $('#qnt-encadernacao').keyup(function(){
                if (parseInt($(this).val()) >= 1) {
                    qnt = $(this).val();
                } else {
                    qnt = 0;
                }

                getAmountEncadernacao();
                getAmount()
            });

            //funcao para detyerminar o montante total
            function getAmountEncadernacao(){
                amount = price * qnt;
                amount_sinfo[indice] = {id: code, amount: amount}
                console.log(amount_sinfo);
            }
        });
    }

    //cadastrando os movimentos do servicos informaticos
    $('#form-service-informatic').submit(function(e){
        e.preventDefault();
        var token = $("input[name='_token']").val();
        amount_sinfo.forEach(element => {
            if (element.amount > 0) {
                $.ajax({
                    url: 'movement-informatic-storeAll',
                    type: 'POST',
                    dataType: 'json',
                    data: {_token: token, element},
                    success: function(result){
                        if (!result) {
                            alert('Falha ao cadastrar movimento verifica e tenta novamente');
                        }
                    }
                });
            }

        });
        alert('Cadastro efetuado com sucesso!');
        reload();
    })


    //Progaramando o formulario dos servicos de recargas moveis
    $('#form-mobile-recharge').submit(function(e){
        e.preventDefault();
        console.log($(this).serialize());
        $.ajax({
           url: 'movement-mobile-recharge',
           type: 'POST',
           dataType: 'json',
           data: $(this).serialize(),
           success: function(result){
                if (result) {
                    alert('Cadastro efetuado com sucesso!');
                } else {
                    alert('verifica os dados e tenta novamente!');
                }
                reload();
           } 
        });
    });


    //Progaramando o formulario dos servicos de recargas de tv 
    $('#form-tv-recharge').submit(function(e){
        e.preventDefault();
        console.log($(this).serialize());

        $.ajax({
           url: 'movement-tv',
           type: 'POST',
           dataType: 'json',
           data: $(this).serialize(),
           success: function(result){
                if (result) {
                    alert('Cadastro efetuado com sucesso!');
                } else {
                    alert('verifica os dados e tenta novamente!');
                }
                reload();
           } 
        });
    });
    
    //Progaramando o formulario dos servicos de fipag
    $('#form-fipag').submit(function(e){
        e.preventDefault();
        
        console.log($(this).serialize());

        $.ajax({
           url: 'movement-fipag',
           type: 'POST',
           dataType: 'json',
           data: $(this).serialize(),
           success: function(result){
                if (result) {
                    alert('Cadastro efetuado com sucesso!');
                } else {
                    alert('verifica os dados e tenta novamente!');
                }
                //console.log(result);
                reload();
           } 
        });
    });

    //Progaramando o formulario dos servicos de credelec
    $('#form-credelec').submit(function(e){
        e.preventDefault();
        console.log($(this).serialize());

        $.ajax({
           url: 'movement-credelec',
           type: 'POST',
           dataType: 'json',
           data: $(this).serialize(),
           success: function(result){
                if (result) {
                    alert('Cadastro efetuado com sucesso!');
                } else {
                    alert('verifica os dados e tenta novamente!');
                }
                reload();
           } 
        });
    });

    /* painel de controlo */
    //$('.card').draggable();

    function controlpainel() {
        $.ajax({

            url: 'getData',
            method: 'GET',
            dataType: 'json',
            success: function (result) {
                console.log(result);
                $('#func').text(result.funcionarios);
                $('#client').text(result.clientes);
                $('#invest').text(result.investimento.investment);
                $('#invest2').text(result.investimento.investment);
                $('#invest3').text(result.investimento.virtual);
                $('#invest4').text(result.investimento.fisic);
                $('#invest5').text(result.divid);
                $('#coin').text(result.moedas);
                $('#mobile_wallet').text(result.carteiras_moveis.total);
                $('#in').text(result.carteiras_moveis.deposito);
                $('#out').text(result.carteiras_moveis.levantamento);
                $('#sinformatic').text(result.servicos_informaticos);
                $('#rmoveis').text(result.recargas_moveis);
                $('#rtv').text(result.recargas_tv);
                $('#fipags').text(result.fipag);
                $('#credelecs').text(result.credelec);
                $('#service').text(result.servicos);
                $('#material').text(result.materias);
                //updateChart(result.investimento.investment, result.investimento.virtual, result.investimento.fisic, result.carteiras_moveis.deposito, result.carteiras_moveis.levantamento, result.servicos_informaticos, result.recargas_moveis, result.recargas_tv, result.fipag, result.credelec)
            }
        });
    }

    /*controlpainel();

    setInterval(() => {
        controlpainel();
    }, 5000);*/


    /*
    *   CADASTRO DE MOVIMENTOS
    */

    //programando o preloader dos formularios
    $('#form-preloader').hide();


    /*
    *   MOVIMENTOS DE CARTEIRAS MOVEIS
    */

    $('#form-carteira-movel').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'movement-mobile-wallet',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(result){
                if (result) {
                    $('.input-form-carteira-movel').val('');
                    alert('Cadastro efetuado com sucesso!');
                } else {
                    alert('verifica os dados e tenta novamente!');
                }
                reload();
            }
        });
    });

    // atualizado dados da cartaeira movel
    $('.movement-mobile-wallet-update-status').submit(function(e){
        e.preventDefault();
        var conf = confirm('Quer alterar o status?');
        if (conf) {
            $.ajax({
                url: 'movement-mobile-wallet-update-status',
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result){
                    if (!result.status) {
                        alert('operacao falhada tenta novamente!');
                    }
                    reload();
                }
            });
        }
    });

    // deletando dados da cartaeira movel
    $('.form-movement-mobile-wallet-delete').submit(function(e){
        e.preventDefault();
        var id = $(this.id).val();
        var conf = confirm(`Quer realmente deletar o registro? ${id}`);

        if (conf) {
            $.ajax({
                url: `movement-mobile-wallet/${id}`,
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result){
                    reload();
                }
            });
        }
    });

    // atualizado dados do servico informaticos
    $('.movement-informatic-update-status').submit(function(e){
        e.preventDefault();
        var conf = confirm('Quer alterar o status?');
        if (conf) {
            $.ajax({
                url: 'movement-informatic-update-status',
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result){
                    if (!result.status) {
                        alert('operacao falhada tenta novamente!');
                    }
                    reload();
                }
            });
        }
    });

    // deletando dados do servico informaticos
    $('.form-movement-informatic-delete').submit(function(e){
        e.preventDefault();
        var id = $(this.id).val();
        var conf = confirm(`Quer realmente deletar o registro? ${id}`);

        if (conf) {
            $.ajax({
                url: `movement-informatic/${id}`,
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result){
                    reload();
                }
            });
        }
    });

    // atualizado dados do servico de recargas moveis
    $('.movement-mobile-recharge-update-status').submit(function(e){
        e.preventDefault();
        var conf = confirm('Quer alterar o status?');
        if (conf) {
            $.ajax({
                url: 'movement-mobile-recharge-update-status',
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result){
                    console.log(result);
                    if (!result.status) {
                        alert('operacao falhada tenta novamente!');
                    }
                    reload();
                }
            });
        }
    });

    // deletando dados do servico de recargas moveis
    $('.form-movement-mobile-recharge-delete').submit(function(e){
        e.preventDefault();
        var id = $(this.id).val();
        var conf = confirm(`Quer realmente deletar o registro? ${id}`);

        if (conf) {
            $.ajax({
                url: `movement-mobile-recharge/${id}`,
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result){
                    reload();
                }
            });
        }
    });

    // atualizado dados do servico de recargas de televisaoo
    $('.movement-tv-update-status').submit(function(e){
        e.preventDefault();

        var conf = confirm('Quer alterar o status?');
        if (conf) {
            $.ajax({
                url: 'movement-tv-update-status',
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result){
                    console.log(result);
                    if (!result.status) {
                        alert('operacao falhada tenta novamente!');
                    }
                    reload();
                }
            });
        }
    });

    // deletando dados do servico de recargas de televisaoo
    $('.form-movement-tv-delete').submit(function(e){
        e.preventDefault();
        var id = $(this.id).val();
        var conf = confirm(`Quer realmente deletar o registro? ${id}`);

        if (conf) {
            $.ajax({
                url: `movement-tv/${id}`,
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result){
                    reload();
                }
            });
        }
    });

    // atualizado dados do servico de recargas de televisaoo
    $('.movement-fipag-update-status').submit(function(e){
        e.preventDefault();
        var conf = confirm('Quer alterar o status?');
        if (conf) {
            $.ajax({
                url: 'movement-fipag-update-status',
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result){
                    console.log(result);
                    if (!result.status) {
                        alert('operacao falhada tenta novamente!');
                    }
                    reload();
                }
            });
        }
    });

    // deletando dados do servico de recargas de televisaoo
    $('.form-movement-fipag-delete').submit(function(e){
        e.preventDefault();
        var id = $(this.id).val();
        var conf = confirm(`Quer realmente deletar o registro? ${id}`);

        if (conf) {
            $.ajax({
                url: `movement-fipag/${id}`,
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result){
                    reload();
                }
            });
        }
    });

    // atualizado dados do servico de recargas de televisaoo
    $('.movement-credelec-update-status').submit(function(e){
        e.preventDefault();
        var conf = confirm('Quer alterar o status?');
        if (conf) {
            $.ajax({
                url: 'movement-credelec-update-status',
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result){
                    console.log(result);
                    if (!result.status) {
                        alert('operacao falhada tenta novamente!');
                    }
                    reload();
                }
            });
        }
    });

    // deletando dados do servico de recargas de televisaoo
    $('.form-movement-credelec-delete').submit(function(e){
        e.preventDefault();
        var id = $(this.id).val();
        var conf = confirm(`Quer realmente deletar o registro? ${id}`);

        if (conf) {
            $.ajax({
                url: `movement-credelec/${id}`,
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result){
                    reload();
                }
            });
        }
    });


    function reload(){
        location.reload(false);
    }


    //voltando de pagina
    $('#back-page').click(function(){
        window.history.back();
    });

    // trabalhando com grafico de analize de carteira movel
    $('#hide-saldo').click(function(){
        $('#background-saldo').hide();
    });

    $('#background-saldo').draggable();
    var ctx = document.getElementById('myChart');
    /*myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['INVESTIMENTO', 'MAQUINA', 'CAIXA', 'DEPOSITOS', 'LEVANTAMENTOS', 'INFORMATICOS', 'RECARGAS MOVEIS', 'RECARGAS TV', 'FIPAG', 'CREDELEC'],
            datasets: [
                {
                    label: "RELATORIO INSTANTANEO - MZN",
                    data: [],
                    borderWidth: 6,
                    borderColor: 'rgba(0, 255, 85, 0.623)',
                    backgroundColor: 'trasparent'
                }
            ]
        }
    });*/

    function updateChart(a, b, c, dep, lev, sinfo, rm, rt, fipag, credelec) {
        myChart.data.datasets[0].data[0] = a;
        myChart.data.datasets[0].data[1] = b;
        myChart.data.datasets[0].data[2] = c;
        myChart.data.datasets[0].data[3] = dep;
        myChart.data.datasets[0].data[4] = lev;
        myChart.data.datasets[0].data[5] = sinfo;
        myChart.data.datasets[0].data[6] = rm;
        myChart.data.datasets[0].data[7] = rt;
        myChart.data.datasets[0].data[8] = fipag;
        myChart.data.datasets[0].data[9] = credelec;
        myChart.update();
    }
    
});


function sair(){
    confirm('voce pretende sair do site?')
}
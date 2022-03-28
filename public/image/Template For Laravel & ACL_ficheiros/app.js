/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
$(function () {
  /*
      Zerando as configuracoes dos formularios
  **/

  /*$('a').click(function(e){
      e.preventDefault();
  });*/
  $('#form-carteira-movel').hide();
  $('#form-recargas').hide();
  $('#form-servicos-informaticos').hide();
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
  $('#hide-carteira-movel').click(function () {
    $('#carteira-movel').hide();
    $('#background-carteira-movel').hide();
  });
  $('#show-carteira-movel').click(function () {
    $('#form-carteira-movel').show();
    $('#movimento-title').text('Carteiras moveis');
    $('#background-carteira-movel').show();
  });
  /*
      Programando o formulario de recargas e servicos informaticos
  **/
  //Programando os servicos de credelec

  $('#show-credelec').click(function () {
    $('#movimento-title').text('Credelec');
    $('#background-carteira-movel').show();
    $('.form-credelec').show();
  }); //Programando os servicos de recargas moveis

  $('#show-mobile-recharge').click(function () {
    $('#movimento-title').text('Recargas moveis');
    $('#background-carteira-movel').show();
    $('.form-movel').show();
  }); //Programando os ervicos de recargas de tv

  $('#show-tv').click(function () {
    $('#movimento-title').text('Recargas TV');
    $('#background-carteira-movel').show();
    $('.form-antena').show();
  }); //Programando os ervicos de recargas de fipag

  $('#show-fipag').click(function () {
    $('#movimento-title').text('Fipag');
    $('#background-carteira-movel').show();
    $('.form-fipag').show();
  });
  /*
      Servicos informaticos
  **/

  $('#show-servicos-informaticos').click(function () {
    $('#form-servicos-informaticos').show();
    $('#movimento-title').text('Servicos informaticos');
    $('#background-carteira-movel').show();
  });
  /*
      Zerando as paginas
  **/

  $('#copia-pagina').hide();
  $('#digitacao-pagina').hide();
  $('#impressao-pagina').hide();
  $('#implasticacao-pagina').hide();
  $('#encadernacao-pagina').hide();
  $('#copia').change(function () {
    $('#input-copy').html("\n            <input type=\"text\" class=\"papel\" placeholder=\"paginas\" id=\"copia-pagina\" required>\n            <span id=\"close-copy\" style=\"cursor: pointer;\">x</span>\n        ");
    $('#close-copy').click(function () {
      $('#input-copy').html('');
    });
  });
  $('#digitacao').click(function () {
    $('#digitacao-pagina').toggle();
  });
  $('#impressao').click(function () {
    $('#impressao-pagina').toggle();
  });
  $('#implasticacao').click(function () {
    $('#implasticacao-pagina').toggle();
  });
  $('#encadernacao').click(function () {
    $('#encadernacao-pagina').toggle();
  });
  $('#form-service-informatic').submit(function (e) {
    e.preventDefault();
    alert('submetido');
  });
  /* painel de controlo */
  //$('.card').draggable();

  function controlpainel() {
    $.ajax({
      url: 'getData',
      method: 'GET',
      dataType: 'json',
      success: function success(result) {
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
      }
    });
  }
  /* controlpainel();
   setInterval(() => {
      controlpainel();
  }, 5000); */

  /*
  *   CADASTRO DE MOVIMENTOS
  */
  //programando o preloader dos formularios


  $('#form-preloader').hide();
  /*
  *   MOVIMENTOS DE CARTEIRAS MOVEIS
  */

  $('#form-carteira-movel').submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: 'movement-mobile-wallet',
      type: 'POST',
      dataType: 'json',
      data: $(this).serialize(),
      success: function success(result) {
        if (result) {
          $('.input-form-carteira-movel').val('');
          alert('Cadastro efetuado com sucesso!');
        } else {
          alert('verifica os dados e tenta novamente!');
        }
      }
    });
  });
});
/******/ })()
;
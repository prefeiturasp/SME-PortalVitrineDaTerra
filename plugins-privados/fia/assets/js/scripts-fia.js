
jQuery(document).ready(function ($) {
    "use strict";

    $("#wcpv-cep").blur(function () {

        $("#wcpv-error").html("");

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {


            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {


                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.

                        $("#wcpv-bairro").val(dados.bairro);
                        $("#wcpv-cidade").val(dados.localidade);
                        $("#wcpv-estado").val(dados.uf);
                        $("#wcpv-cep").val(cep);
                    }
                    else {

                        $("#wcpv-error").html("CEP não localizado");
                        $("#wcpv-cep").val("");
                    }

                });
            } //end if.
            else {

                //cep é inválido.
                $("#wcpv-error").html("CEP inválido");
                $("#wcpv-cep").val("");
            }
        } //end if.
        else {
            $("#wcpv-error").html("CEP inválido");
            $("#wcpv-cep").val("");
        }
    });
});

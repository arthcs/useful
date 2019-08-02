<script>
    function numberToReal(numero) {
        var numero = numero.toFixed(2).split('.');
        numero[0] = numero[0].split(/(?=(?:...)*$)/).join('.');
        return numero.join(',');
    }

    //teste
	var x = numberToReal(9999000.33);
	console.log(x);

	var y = numberToReal(100000);
	console.log(y);

	var z = numberToReal(10.50);
	console.log(z);
	
//melhor utilizada
$(document).ready(function() {
		//$("input, select, textarea").attr("disabled", "true");

		var numero = document.getElementById('valorProcedimento').value;
		// console.log(numero);

		numero = parseFloat(numero);
        numero = numero.toFixed(2).split('.');
        numero[0] = numero[0].split(/(?=(?:...)*$)/).join('.');

        $('#valorProcedimento').val(numero.join(','));
    });

</script>

Primeiro pego o número e fixo ele com 2 casas decimais e separo a string em um array de 2 partes (antes e depois do ponto).

var numero = numero.toFixed(2).split('.');
// Se o número inicial for 100.00, numero[0] será 100 e numero[1] será 00
Dessa forma na segunda linha eu posso trabalhar o número excluindo as casas decimais (numero[0]), 

numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
Depois é só retornar o número formatado juntando com as casas decimais usando a virgula.

return numero.join(',');

O que o split, o regex e o join fazem:
Vamos por parte:

/(?=(?:...)*$)/
?= Vai capturar o espaço seguido da expressão após o =.
?: Define toda a expressão dentro dos parênteses em um grupo de não captura.
... Qualquer caractere 3 vezes.
*$ Repetindo várias vezes no final da string.
Explicando na prática:

O que acontece é o seguinte, essa expressão agrupa 3 caracteres: (?:...), e faz a captura antes deles: ?=, o que garante que isso seja feito de trás pra frente infinitas vezes é o: *$, aplicando o split o número 1000000 ficaria dividido assim: 1|000|000, depois é só ele juntar com um ponto .join('.') que a mágica está feita.

OBS.: O grupo de não captura ?: serve para não atrapalhar na hora de capturar o que realmente importa, que é antes dos 3 caracteres.



<script type="text/javascript">
	//função que calcula diferença entre datas
	$('#data_desembarque').blur(
    function() {
      //var cod = $('#codigo_beneficiario').val(); //Pegando o id

	var d1 = new Date($('#data_embarque').val());
	var d2 = new Date($('#data_desembarque').val());
	
	if (d1 != null && d2 != null) {

		//$('#dias_utilizados').val( Math.round( (d2.getTime() - d1.getTime()) / (1000*60*60*24) ) +1);

      var diffMilissegundos = d2 - d1;

      var diffSegundos = diffMilissegundos / 1000;
      var diffMinutos = diffSegundos / 60;
      var diffHoras = diffMinutos / 60;
      var diffDias = diffHoras / 24;
      //var diffMeses = diffDias / 30;

      $('#dias_utilizados').val(diffDias);

		} else {
			$('#dias_utilizados').val(0);
		}

    }
);
</script>

<script type="text/javascript">
	//valida codigo CPF
	function validarCPF(strCPF) {

	      strCPF = strCPF.replace(/[^\d]+/g,'');
	      var Soma;
	      var Resto;
	      Soma = 0;
	      //if (strCPF == "00000000000") return false;

	      for (var i = 0; i < 10; i++) {
	         var nulo = ""+i+i+i+i+i+i+i+i+i+i+i;
	         console.log(nulo);
	         if (strCPF == nulo) return false;
	       }
	       
	      for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
	      Resto = (Soma * 10) % 11;
	       
	      if ((Resto == 10) || (Resto == 11))  Resto = 0;
	      if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
	       
	      Soma = 0;
	      for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
	      Resto = (Soma * 10) % 11;
	       
	      if ((Resto == 10) || (Resto == 11))  Resto = 0;
	      if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
	      return true;
	  }
</script>
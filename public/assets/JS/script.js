/*function createConfig(details, data) {
	return {
		type: 'line',
		data: {
			labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
			datasets: [{
				label: "",
				steppedLine: details.steppedLine,
				data: data,
				borderColor: details.color,
				backgroundColor: [
					'#000',
					'#000',
					'#000',
					'#000',
					'#000',
					'#000',
					'#000',
					'#000',
					'#000',
					'#000',
					'#000',
					'#000'
				],
				fill: false,
			}]
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text: details.label,
			}
		}
	};
}


window.onload = function () {
	var container = document.querySelector('.graficoAnterior');

	var data = [
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor()
	];

	var steppedLineSettings = [{
		steppedLine: false,
		label: 'Saldo Anterior',
		color: window.chartColors.yellow
	}];

	steppedLineSettings.forEach(function (details) {
		var div = document.createElement('div');
		div.classList.add('chart-container');

		var canvas = document.createElement('canvas');
		div.appendChild(canvas);
		container.appendChild(div);

		var ctx = canvas.getContext('2d');
		var config = createConfig(details, data);
		new Chart(ctx, config);
	});

	var container = document.querySelector('.graficoDespesas');

	var data = [
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor()
	];

	var steppedLineSettings = [{
		steppedLine: false,
		label: 'Despesas',
		color: '#2AEE2A'
	}];

	steppedLineSettings.forEach(function (details) {
		var div = document.createElement('div');
		div.classList.add('chart-container');

		var canvas = document.createElement('canvas');
		div.appendChild(canvas);
		container.appendChild(div);

		var ctx = canvas.getContext('2d');
		var config = createConfig(details, data);
		new Chart(ctx, config);
	});

	var container = document.querySelector('.graficoReceitas');

	var data = [
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor()
	];

	var steppedLineSettings = [{
		steppedLine: false,
		label: 'Receitas',
		color: '#F12929'
	}];

	steppedLineSettings.forEach(function (details) {
		var div = document.createElement('div');
		div.classList.add('chart-container');

		var canvas = document.createElement('canvas');
		div.appendChild(canvas);
		container.appendChild(div);

		var ctx = canvas.getContext('2d');
		var config = createConfig(details, data);
		new Chart(ctx, config);
	});

	var container = document.querySelector('.graficoSaldo');

	var data = [
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor(),
		randomScalingFactor()
	];

	var steppedLineSettings = [{
		steppedLine: false,
		label: 'Saldo Atual',
		color: '#4040DF'
	}];

	steppedLineSettings.forEach(function (details) {
		var div = document.createElement('div');
		div.classList.add('chart-container');

		var canvas = document.createElement('canvas');
		div.appendChild(canvas);
		container.appendChild(div);

		var ctx = canvas.getContext('2d');
		var config = createConfig(details, data);
		new Chart(ctx, config);
	});
};
*/

function excluir(id, valor, registro) {
    valor = valor.toFixed(2);
    valor = valor.toString().replace(".", ",");
    $.ajax({
        // Vai requisitar
        url: 'apagar',
        // Pelo Post
        type: 'get',
        // Vai enviar os seguintes dados para o savar.php
        data: { id: id, valor: valor },
        success: function() {
            // alert("Usuario excluido com sucesso!"+id);

            $('#janela').find('.modal-body').html("Tem certeza que deseja excluir o valor de R$" + valor + "? <br><br>" + "<a href='apagar/" + id + "'><button class='btn btn-success'>SIM</button></a>");
        }
    });
}

function confirmar(id) {
    $.ajax({
        // Vai requisitar
        url: 'excluir',
        // Pelo Post
        type: 'POST',
        // Vai enviar os seguintes dados para o savar.php
        data: { id: id },
        success: function() {
            alert("Usuario excluido com sucesso!");
            window.location.href = window.location.href

        }
    });
}
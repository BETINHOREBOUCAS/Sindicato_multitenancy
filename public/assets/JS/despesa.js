function createConfig(details, data) {
			return {
				type: 'line',
				data: {
					labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6'],
					datasets: [{
						label: 'steppedLine: ' + details.steppedLine,
						steppedLine: details.steppedLine,
						data: data,
						borderColor: details.color,
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


		window.onload = function() {
			var container = document.querySelector('.graficoDespesas');

			var data = [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor()
			];

			var steppedLineSettings = [{
				steppedLine: false,
				label: 'No Step Interpolation',
				color: window.chartColors.red
			}];

			steppedLineSettings.forEach(function(details) {
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
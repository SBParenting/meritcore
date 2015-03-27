<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Front</title>

	<script src="{{ asset("/public/front/libs/jquery/jquery.min.js") }}"></script>
	<script src="{{ asset("/public/front/libs/bootstrap/js/bootstrap.min.js") }}"></script>

	<script type="text/javascript" src="{{ asset("/public/front/libs/canvg/rgbcolor.js") }}"></script> 
	<script type="text/javascript" src="{{ asset("/public/front/libs/canvg/StackBlur.js") }}"></script>
	<script type="text/javascript" src="{{ asset("/public/front/libs/canvg/canvg.js") }}"></script>
	<script type="text/javascript" src="{{ asset("/public/front/libs/chartjs/chart.min.js") }}"></script>

	<style>
		#myChart { position: absolute; z-index: 10; }
		#loader  { position: absolute; z-index: 20; width: 800px; height: 400px; top: 0; left: 0; padding: 100px 0 0 150px; font-family: 'Arial', sans-serif; background: #fff; }
	</style>

</head>

<body>

	<div id="loader">Generating report, please wait....</div>

	<canvas id="myChart" height="400" width="800"></canvas>

	{!! Form::open(['id' => 'form']) !!}

	{!! Form::textarea('chart', null, ['id' => 'data', 'style' => 'display:none']) !!}

	{!! Form::close() !!}

	<script>
        $(document).ready(function() {


	        var lineData = {
                labels: {!! json_encode($categories) !!},
                datasets: {!! json_encode($gdata) !!}
            };

            var lineOptions = {
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.1)",
                scaleGridLineWidth: 1,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                responsive: false,
                animation: false,
                scaleFontColor: '#000',
                showTooltips: false,
            };


            var ctx = document.getElementById("myChart").getContext("2d");
            var myNewChart = new Chart(ctx).Line(lineData, lineOptions);

            var canvas = $('#myChart').get(0);

            var dataURL = canvas.toDataURL();

			$('#data').val(dataURL);
			$('#form').submit();
        });
    </script>
	
</body>
</html>

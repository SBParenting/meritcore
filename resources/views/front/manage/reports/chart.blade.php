<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Front</title>

	<script src="{{ asset("/public/front/libs/jquery/jquery.min.js") }}"></script>
	<script src="{{ asset("/public/front/libs/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script type="text/javascript" src="{{ asset("/public/front/libs/canvg/rgbcolor.js") }}"></script> 
	<script type="text/javascript" src="{{ asset("/public/front/libs/canvg/StackBlur.js") }}"></script>
	<script type="text/javascript" src="{{ asset("/public/front/libs/canvg/canvg.js") }}"></script>
	<script type="text/javascript" src="{{ asset("/public/front/libs/chartjs/chart.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("/public/front/libs/morris/morris.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("/public/front/libs/highcharts/highcharts.js") }}"></script>

	<style>
		#myChart { position: absolute; z-index: 10; border: 1px solid red; }
		#loader  { position: absolute; z-index: 20; width: 800px; height: 400px; top: 0; left: 0; padding: 100px 0 0 150px; font-family: 'Arial', sans-serif; background: #fff; }
	</style>

</head>

<body>

	<div id="loader">Generating report, please wait....</div>

	<canvas id="myChart" height="400px" width="800px"></canvas>

	{!! Form::open(['id' => 'form']) !!}

	{!! Form::textarea('chart', null, ['id' => 'data', 'style' => 'display:none']) !!}

	{!! Form::close() !!}

	<script>
        $(document).ready(function() {
               /*Morris.Bar({
                element: 'myChart',
                data: {!! json_encode($gdata) !!},
                xkey: "categories",
                parseTime: false,
                xLabels: "competencies",
                ykeys: ['strong','vulnerable'],
                labels: ['strong','vulnerable'],
                barRatio: 0.2,
                xLabelMargin: 10,
                hideHover: 'auto',
                goals: [0,0],
                goalLineColors:["#9da3a9"],
                barColors: ["#a6e182", "#30a1ec", "#76bdee", "#c4dafe"]
            });*/

               /* $('#myChart').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    xAxis: {
                        categories: {!! json_encode($categories) !!}
                    },
                    yAxis: {
                        title: {
                            text: 'Number of Students'
                        }
                    },
                    series: {!! json_encode($gdata) !!},
                    credits: { enabled:false }
                });
                 Highcharts.setOptions({
                    chart: {
                        backgroundColor: {
                            linearGradient: [0, 0, 500, 500],
                            stops: [
                                [0, 'rgb(224, 176, 73)'],
                                [1, 'rgb(159, 194, 77)']
                                ]
                        },
                        borderWidth: 2,
                        plotBackgroundColor: 'rgba(255, 255, 255, .9)',
                        plotShadow: true,
                        plotBorderWidth: 1
                    }
                });*/
	        var barData = {
                labels: {!! json_encode($categories) !!},
                datasets: {!! json_encode($gdata) !!}
            };

            var barOptions = { 
                scaleBeginAtZero : true,
                scaleShowGridLines : true,
                scaleGridLineColor : "rgba(0,0,0,.05)",
                scaleGridLineWidth : 1,
                scaleShowHorizontalLines: true,
                scaleShowVerticalLines: true,
                barShowStroke : true,
                barStrokeWidth : 2,
                barValueSpacing : 5,
                barDatasetSpacing : 1,
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
            };


            var ctx = document.getElementById("myChart").getContext("2d");
            var myNewChart = new Chart(ctx).Bar(barData, barOptions);

            setTimeout(function()
            {
                var canvas = $('#myChart').get(0);

                var dataURL = canvas.toDataURL();

    			$('#data').val(dataURL);
    			$('#form').submit();
            }, 1000);
        });
    </script>
	
</body>
</html>

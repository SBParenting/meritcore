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
        .count{
          position:absolute;
          width:10px;
          height:20px;
          line-height:20px;
          color:white;
          font-weight:bold;
          z-index: 55;
          }
	</style>

</head>

<body>

	<div id="loader">Generating report, please wait....</div>

    <div id="myChart" style="height:400px;width:500px;"></div>
	<canvas id="canvasChart" style="height:400px;width:500px;"></canvas>

	{!! Form::open(['id' => 'form']) !!}

	{!! Form::textarea('chart', null, ['id' => 'data', 'style' => 'display:none']) !!}

	{!! Form::close() !!}

	<script>

    function parseSVG(s) {
        var div= document.createElementNS('http://www.w3.org/1999/xhtml', 'div');
        div.innerHTML= '<svg xmlns="http://www.w3.org/2000/svg">'+s+'</svg>';
        var frag= document.createDocumentFragment();
        while (div.firstChild.firstChild)
            frag.appendChild(div.firstChild.firstChild);
        return frag;
    }

        $(document).ready(function() {
            var graphData = {!! json_encode($gdata) !!};
               var bar = Morris.Bar({
                element: 'myChart',
                data: graphData,
                xkey: 'categories',
                parseTime: false,
                xLabels: "competencies",
                xLabelAngle: 90,
                ykeys: ['vulnerable', 'strong'],
                labels: ['vulnerable', 'strong'],
                barSizeRatio: 0.5,
                barGap: 1,
                xLabelMargin: 5,
                hideHover: 'auto',
                goals: [0,0],
                stacked: true,
                goalLineColors:["#9da3a9"],
                barColors: ["#9fc24d", "#e0b049"]
            });

        var barWidth=(($('#myChart').width()/10)*(0.8))/2;

        //now each thru each bar (rect)

        jQuery('rect').each(function (i) {
            var rect = i%2,
                i = Math.floor(i/2),
                pos=$(this).offset(),
                top=pos.top;
              
            top-=10; //originate at the top of the bar

          //get the height of the bar
          var barHeight=bar.bars[i];
            
            if (barHeight[0] == 0 && barHeight[1] == 0) {
                top = -999999;
            } else if (barHeight[0] == barHeight[1]) {
                if (rect == 0) {
                top+=barHeight[rect]/2; //so we can now stick the number in the vertical-center of the bar as desired
                } else {
                    top = -9999999;
                }
            } else if (barHeight[0] == 0) {
                if (rect == 0) {
                    top=-999999999; //so we can now stick the number in the vertical-center of the bar as desired
                } else {
                    top+= barHeight[rect]/2;
                }
            } else {
                if (rect == 0) {
                    top+=barHeight[rect]/2; //so we can now stick the number in the vertical-center of the bar as desired
                } else {
                    top+= (barHeight[rect]-barHeight[0])/2;
                }
            }
            

            var left=pos.left;
          //move it over a bit
          left+=barWidth/2; 
          //-size of element...
          left-=8;//should approximately be horizontal center

          var val = "";

            if (rect) {
                val = graphData[i].strong; //get the count
            } else {
                val = graphData[i].vulnerable; //get the count
            }

            var div = '<text x="'+left+'" y="'+top+'" text-anchor="middle" font="10px &quot;Arial&quot; thinner" stroke="none" fill="#FFFFFF" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: lighter; font-stretch: normal; font-size: 10px; line-height: normal; font-family: sans-serif;" font-size="10px" font-family="sans-serif" font-weight="lighter" transform="matrix(1,0,0,1,0,6)">'+val+'</text>'; 
          document.getElementsByTagName('svg')[0].appendChild(parseSVG(div)); //stick it into the dom

        });           

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
                });*/
	        /*var barData = {
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
            var myNewChart = new Chart(ctx).Bar(barData, barOptions);*/

            setTimeout(function()
            {
                var oSerializer = new XMLSerializer(),
                    sXML = oSerializer.serializeToString($('#myChart').find('svg').get(0));

                canvg($('#canvasChart').get(0), sXML,{ ignoreMouse: true, ignoreAnimation: true })

                var canvas = $('#canvasChart').get(0);

                var dataURL = canvas.toDataURL();

    			$('#data').val(dataURL);
    			$('#form').submit();
            }, 500);
        });
    </script>
	
</body>
</html>

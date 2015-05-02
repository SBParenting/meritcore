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
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

	<style>
       body{position: fixed;width: 100%;height: 100%;overflow: hidden;}
		#myChart1 { position: absolute; z-index: 10; border: 1px solid red; }
        #myChart2 { position: absolute; z-index: 10; border: 1px solid red; }
        #myChart3 { position: absolute; z-index: 10; border: 1px solid red; }
		#loader  { position: absolute; z-index: 20; width: 100%; height: 100%; top: 0; left: 0; padding: 100px 0 0 150px; font-family: 'Arial', sans-serif; background: #fff; }
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
    
    <div id="myChart1" style="height:400px;width:500px;"></div>
	<canvas id="canvasChart1" style="height:400px;width:500px;"></canvas>
    
    <div id="myChart2" style="height:1000px;width:500px;"></div>
    <canvas id="canvasChart2" style="height:400px;width:500px;"></canvas>
    
    <div id="myChart3" style="height:400px;width:500px;"></div>
    <canvas id="canvasChart3" style="height:400px;width:500px;"></canvas>

    <div id="improve" style="height:400px;width:500px;"></div>
    <canvas id="canvasImprove" style="height:400px;width:500px;"></canvas>

    <div id="demonstrate" style="height:400px;width:500px;"></div>
    <canvas id="canvasDemonstrate" style="height:400px;width:500px;"></canvas>

	{!! Form::open(['id' => 'form']) !!}

    {!! Form::textarea('chart1', null, ['id' => 'data1', 'style' => 'display:none']) !!}
    {!! Form::textarea('chart2', null, ['id' => 'data2', 'style' => 'display:none']) !!}
	{!! Form::textarea('chart3', null, ['id' => 'data3', 'style' => 'display:none']) !!}
    {!! Form::textarea('improve', null, ['id' => 'improves', 'style' => 'display:none']) !!}
    {!! Form::textarea('demonstrate', null, ['id' => 'demonstrates', 'style' => 'display:none']) !!}

	{!! Form::close() !!}

	<script>
    google.load('visualization', '1.0', {'packages': ['corechart']});

    $(document).ready(function() {
        var arrayData =  {!! json_encode($gdata) !!};
        var graphData3, graphData4, graphData5;
        google.setOnLoadCallback(drawChart);
        
        function drawChart() {
            var data = new google.visualization.DataTable();
                
            data.addColumn('string', 'Competencies');
            data.addColumn('number', 'Vulnerable');
            data.addColumn('number', 'Strong');

            for (var i in arrayData){
                data.addRow([arrayData[i][0], parseInt(arrayData[i][2]), parseInt(arrayData[i][1])]);
            }

            var view = new google.visualization.DataView(data);
                
            view.setColumns([0, 1, {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
                },2,{
                calc: "stringify",
                sourceColumn: 2,
                type: "string",
                role: "annotation"
            }]);

            var options = {
                legend: {position:'top'},
                annotation:{
                    textStyle:{
                        marginTop:'10px'
                    }
                },
                hAxis: {
                    title: 'Competencies', 
                    titleTextStyle: {color: 'black'}, 
                    textSize: 4,
                    slantedText: true,
                    slantedTextAngle: 90
                },  
                vAxis: {
                    title: 'Number of Students', 
                    titleTextStyle: {color: 'black'}, 
                    count: -1,
                    format:'#',
                },
                isStacked:true,
                bar: {
                    groupWidth: '90%'
                },
                chartArea: {
                    height: '50%',
                    top: "5%"
                },
                backgroundColor: "transparent",
                colors: ["#e0b049","#9fc24d"]
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('myChart1'));
            chart.draw(view, options);    
        }

        graphData3 = {!! isset($gdata_3)?json_encode($gdata_3):'""' !!};

        if(graphData3!=""){
        var arrayData3 = graphData3;
        google.setOnLoadCallback(drawChart3);

        function drawChart3() {
            var data = google.visualization.arrayToDataTable(arrayData3);
            var view = new google.visualization.DataView(data);
                                
            view.setColumns([0, 1, {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
                },
                2, {
                calc: "stringify",
                sourceColumn: 2,
                type: "string",
                role: "annotation"
                }
            ]);
                    
            var options = {
                title: "Impact",
                background: "#f0f0ef",
                width: 400,
                height: 600,
                vAxis: {
                    title: "Questions"
                },
                isStacked: true,
                hAxis: {
                    title: "Number of Students"
                },
                bar: {
                    groupWidth: "60%"
                },
                colors: ["#e0b049", "#9fc24d"],
                backgroundColor: "transparent"
            };
                    
            var chart = new google.visualization.BarChart(document.getElementById('myChart3'));
            chart.draw(view, options);
        }
        }

        graphData4 = {!! isset($improve)?json_encode($improve):'""' !!};

        if(graphData4!=""){
        var arrayData4 = graphData4;
        
        google.setOnLoadCallback(drawChart4);
        google.load("visualization", "1", {packages:["corechart"],callback: drawChart4});
        
        function drawChart4() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Competencies');
            data.addColumn('number', 'Students');

            for (var i in arrayData4){
                data.addRow([arrayData[i][0], parseInt(arrayData[i][1])]);
            }

            var view = new google.visualization.DataView(data);
                            
            view.setColumns([0, 1, {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }]);

            var options = {
                legend: {position:'none'},
                annotation:{
                    textStyle:{
                        marginTop:'10px'
                    }
                },
                hAxis: {
                    title: 'Competencies', 
                    titleTextStyle: {color: 'black'}, 
                    textSize: 4,
                    slantedText: true,
                    slantedTextAngle: 90
                },  
                vAxis: {
                    title: 'Number of Students', 
                    titleTextStyle: {color: 'black'}, 
                    count: -1,
                    format:'#',
                    viewWindowMode: 'explicit',
                    viewWindow:{ min:0 }
                },
                bar: {
                    groupWidth: '90%'
                },
                chartArea: {
                    height: '50%',
                    top: "5%"
                },
                backgroundColor: "transparent",
                colors: ["#9fc24d"]
            };

            var chart = new google.visualization.ColumnChart(document.getElementById("improve"));
            chart.draw(view, options);    
        }
        }

        graphData5 = {!! isset($demonstrate)?json_encode($demonstrate):'""' !!};

        if(graphData5!=""){
        var arrayData5 = graphData5;
        
        google.setOnLoadCallback(drawChart5);
        google.load("visualization", "1", {packages:["corechart"],callback: drawChart5});
        
        function drawChart5() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Competencies');
            data.addColumn('number', 'Students');

            for (var i in arrayData5){
                data.addRow([arrayData[i][0], parseInt(arrayData[i][1])]);
            }

            var view = new google.visualization.DataView(data);
                            
            view.setColumns([0, 1, {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }]);

            var options = {
                legend: {position:'none'},
                annotation:{
                    textStyle:{
                        marginTop:'10px'
                    }
                },
                hAxis: {
                    title: 'Competencies', 
                    titleTextStyle: {color: 'black'}, 
                    textSize: 4,
                    slantedText: true,
                    slantedTextAngle: 90
                },  
                vAxis: {
                    title: 'Number of Students', 
                    titleTextStyle: {color: 'black'}, 
                    count: -1,
                    format:'#',
                    viewWindowMode: 'explicit',
                    viewWindow:{ min:0 }
                },
                bar: {
                    groupWidth: '90%'
                },
                chartArea: {
                    height: '50%',
                    top: "5%"
                },
                backgroundColor: "transparent",
                colors: ["#9fc24d"]
            };

            var chart = new google.visualization.ColumnChart(document.getElementById("demonstrate"));
            chart.draw(view, options);    
        }
        }

        setTimeout(function()
        {
                var oSerializer = new XMLSerializer(),
                    sXML = oSerializer.serializeToString($('#myChart1').find('svg').get(0));
                canvg($('#canvasChart1').get(0), sXML,{ ignoreMouse: true, ignoreAnimation: true })
                var canvas = $('#canvasChart1').get(0);
                var dataURL = canvas.toDataURL();

                if(graphData3!=""){
                var oSerializer = new XMLSerializer(),
                sXML = oSerializer.serializeToString($('#myChart3').find('svg').get(0));
                canvg($('#canvasChart3').get(0), sXML,{ ignoreMouse: true, ignoreAnimation: true })
                var canvas3 = $('#canvasChart3').get(0);
                var dataURL3 = canvas3.toDataURL();}

                if(graphData4!=""){
                var oSerializer = new XMLSerializer(),
                sXML = oSerializer.serializeToString($('#improve').find('svg').get(0));
                canvg($('#canvasImprove').get(0), sXML,{ ignoreMouse: true, ignoreAnimation: true })
                var canvas4 = $('#canvasImprove').get(0);
                var dataURL4 = canvas4.toDataURL();}
                //console.log(dataURL4);

                if(graphData5!=""){
                var oSerializer = new XMLSerializer(),
                sXML = oSerializer.serializeToString($('#demonstrate').find('svg').get(0));
                canvg($('#canvasDemonstrate').get(0), sXML,{ ignoreMouse: true, ignoreAnimation: true })
                var canvas5 = $('#canvasDemonstrate').get(0);
                var dataURL5 = canvas5.toDataURL();}
                
                $('#data1').val(dataURL);
                //$('#data2').val(dataURL2);
    			if(graphData3!=""){$('#data3').val(dataURL3);}
                if(graphData4!=""){$('#improves').val(dataURL4);}
                if(graphData5!=""){$('#demonstrates').val(dataURL5);}
    			$('#form').submit();
            }, 500);
        });
    </script>
	
</body>
</html>

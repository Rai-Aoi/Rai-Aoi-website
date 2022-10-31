@extends('layouts.main')
@section('content')
    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" id="downloadPdf">Download Report Page as PDF <svg aria-hidden="true" class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a>
    <div id="reportPage" class="static">
        <div class="chartbox flex w-1/3">
            <canvas id="myChart"></canvas>
            <canvas id="lineChart"></canvas>
        </div>
        <br/><br/><br/>
        <div class="chartbox flex w-2/4">
            <canvas id="barChart"></canvas>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>
    <script type="module">
        import chartjsPluginOuterlabels from 'https://cdn.skypack.dev/chartjs-plugin-outerlabels';
      </script>
    <script type="text/javascript">
        //Data From Php to JAVASCRIPT
        var type_labels = {!! json_encode($types_labels) !!};
        var type_dataset = {!! json_encode($types_dataset) !!};
        var tag_labels = {!! json_encode($tags_labels) !!};
        var tags_dataset = {!! json_encode($tags_dataset) !!};
        var processes_label = {!! json_encode($processes_labels) !!};
        var processes_dataset = {!! json_encode($processes_dataset) !!};


        //type set up
        const typeData = {
            labels: type_labels,
            datasets: [{
                label: 'Type Count',
                backgroundColor: ['rgba(255, 99, 132,0.5)',
                    'rgba(54, 162, 235,0.5)',
                    'rgba(255, 206, 86,0.5)',
                    'rgba(75, 192, 192,0.5)',
                    'rgba(153, 102, 255,0.5)',
                    'rgba(255, 159, 64,0.5)'
                ],
                borderColor: ['rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                data: type_dataset,
                borderWidth: 1,
            }]
        };

        //set up for tags data
        const tagData = {
            labels: tag_labels,
            datasets: [{
                label: 'Tag Count',
                backgroundColor: ['rgba(255, 99, 132)',
                    'rgba(54, 162, 235)',
                    'rgba(255, 206, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(153, 102, 255)',
                    'rgba(255, 159, 64)'
                ],
                borderColor: ['rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                data: tags_dataset,
                borderWidth: 1,
            }]
        }

        //set up for tags data
        const processData = {
            labels: processes_label,
            datasets: [{
                label: 'Process Count',
                backgroundColor: ['rgb(255, 99, 132)'],
                data: processes_dataset,
                borderWidth: 1,
            }]
        }

        //config
        const config = {
            type: 'polarArea', // type of chart
            data: typeData,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'ประเภทสำนักงาน'
                    },
                }
            }
        };
        //render barChart
        const config2 = {
            type: 'doughnut',
            data: tagData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'หมวดหมู่ปัญหารายเดือน'
                    }
                }
            },
        };
        //reader for tagData (barChart)
        const config3 = {
            type: 'bar',
            data: processData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },

                },
                plugins: {
                    title: {
                        display: true,
                        text: 'สถานะรับงาน'
                    },
                }
            }
        };

        //config init blog
        const myChart = new Chart(
            document.getElementById('myChart'), config
        );


        //config lineChart
        const lineChart = new Chart(
            document.getElementById('lineChart'), config2
        );

        //config pieChart
        const pieChart = new Chart(
            document.getElementById('barChart'), config3
        );

        $('#downloadPdf').click(function(event) {
  // get size of report page
  var reportPageHeight = $('#reportPage').innerHeight();
  var reportPageWidth = $('#reportPage').innerWidth();

  // create a new canvas object that we will populate with all other canvas objects
  var pdfCanvas = $('<canvas />').attr({
    id: "canvaspdf",
    width: reportPageWidth,
    height: reportPageHeight
  });

  // keep track canvas position
  var pdfctx = $(pdfCanvas)[0].getContext('2d');
  var pdfctxX = 5;
  var pdfctxY = 2;
  var buffer = 200;

  // for each chart.js chart
  $("canvas").each(function(index) {
    // get the chart height/width
    var canvasHeight = $(this).innerHeight();
    var canvasWidth = $(this).innerWidth();

    // draw the chart into the new canvas
    pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
    pdfctxX += canvasWidth + buffer;

    // our report page is in a grid pattern so replicate that in the new canvas
    if (index % 2 === 1) {
      pdfctxX = 0;
      pdfctxY += canvasHeight + buffer;
    }
  });

  // create new pdf and add our new canvas as an image
  var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
  pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);

  // download the pdf
  pdf.save('chart.pdf');
});
    </script>
@endsection

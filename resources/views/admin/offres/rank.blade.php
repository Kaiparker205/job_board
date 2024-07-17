@extends('admin.layout.default')
@section('content')

    <div class="form-group">
        <label for="date">Select Date:</label>
        <select class="form-control" name="date" id="date">
            @foreach ($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
    </div>

    <div id="chart" class="chart">
        <!-- Chart will render here -->
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function() {
            var year = new Date().getFullYear();
            fetchTopEmplois(year);

            $('#date').change(function() {
                var year = this.value ? this.value : new Date().getFullYear();
                fetchTopEmplois(year);
            });
        });

        function fetchTopEmplois(year) {
            $.ajax({
                url: '/admin/rank',
                type: 'get',
                data: {
                    year: year // Send the current year value
                },
                success: function(response) {
                    renderChart(response, year); // Call the function to render the chart
                },
                error: function(error) {
                    console.error('Error fetching top emplois:', error);
                }
            });
        }

        function renderChart(data, year) {
            var options = {
                series: [{
                    name: 'Postules Count',
                    data: data.map((item) => item.count || 0)
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                    events: {
                        mounted: function(chartContext, config) {
                            // Add initial series data if needed
                            chartContext.updateSeries([{
                                data: data.map((item) => item.count || 0)
                            }]);
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top',
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val.toString();
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },
                xaxis: {
                    categories: data.map((item) => item.name),
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                    }
                },
                title: {
                    text: 'Top 10 Emplois with Most Postules in ' + year,
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    </script>
@endsection

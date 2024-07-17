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
            fetchTopEmployers(year);

            $('#date').change(function() {
                var year = this.value;
                fetchTopEmployers(year);
            });
        });

        function fetchTopEmployers(year) {
            $.ajax({
                url: '/admin/company',
                type: 'get',
                data: {
                    year: year
                },
                success: function(response) {
                    renderBarChart(response, year);
                },
                error: function(error) {
                    console.error('Error fetching top employers:', error);
                }
            });
        }

        function renderBarChart(data, year) {
            var options = {
                series: [{
                    name: 'Emplois Count',
                    data: data.map((item) => item.nb)
                }],
                chart: {
                    height: 350,
                    type: 'bar',
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
                    categories: data.map((item) => item.title),
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
                    text: 'Top 10 Employers with Most Emplois in ' + year,
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

            if (chart) {
                chart.updateSeries([{
                    data: data.map((item) => item.nb)
                }]);
            }
        }
    </script>
@endsection

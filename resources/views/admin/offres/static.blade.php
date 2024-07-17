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

    <div id="chart" class="chart  container my-5">
        <!-- Chart will render here -->
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function() {
            var year = new Date();
            fetchStatu(year.toISOString().slice(0, 4));

            $('select').change(function() {
                var year = this.value ? this.value : new Date().getFullYear();
                fetchStatu(year);
            });
        });

        function fetchStatu(year) {
            $.ajax({
                url: '/admin/static',
                type: 'get',
                data: {
                    year: year // Send the current year value
                },
                success: function(response) {
                    data = response; // Assign the retrieved data to the global variable

                    calculateTotalAndRenderChart(year); // Call the function to calculate total and render the chart
                },
                error: function(error) {
                    console.error('Error fetching filtered emplois:', error);
                }
            });
        }

        function fixData(data) {
            // Create an array with counts initialized to 0 for all months
            const monthlyCounts = Array.from({ length: 12 }, () => ({
                month: 0,
                count: 0
            }));

            // Fill in the actual counts based on the data
            data.forEach((item) => {
                const monthIndex = item.month - 1; // Month indices are 0-based (January is 0)
                monthlyCounts[monthIndex] = {
                    ...item,
                    month: monthIndex + 1
                };
            });

            // Fill in any missing months
            monthlyCounts.forEach((item, index) => {
                if (item.month === 0) {
                    monthlyCounts[index] = {
                        month: index + 1,
                        count: 0
                    };
                }
            });

            return monthlyCounts;
            // Now monthlyCounts contains the counts for all months (0 to 11)
        }

        function calculateTotalAndRenderChart(year) {
            let total = fixData(data).reduce((total, data) => total + data.count, 0);
            var options = {
                series: [{
                    name: 'Inflation',
                    data: fixData(data).map((item) => (item.count * 100 / total)).map((percentage) => percentage.toFixed(2))
                }],
                chart: {
                    height: 350,
                    type: 'line',
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val + "%";
                    },
                    offsetY: -10,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    position: 'bottom',
                    axisBorder: {
                        show: true
                    },
                    axisTicks: {
                        show: true
                    },
                    crosshairs: {
                        show: true
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: true
                    },
                    axisTicks: {
                        show: true,
                    },
                    labels: {
                        show: true,
                        formatter: function(val) {
                            return val + "%";
                        }
                    }
                },
                title: {
                    text: 'Jobs Inflation, ' + year,
                    floating: true,
                    offsetY: 10,
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
                    data: fixData(data).map((item) => (item.count * 100 / total)).map((percentage) => percentage.toFixed(2))
                }]);
            }
        }
    </script>
@endsection

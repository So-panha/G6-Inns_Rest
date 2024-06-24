<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <!-- <div class="container mx-auto px-6 py-8"> -->
            <!--

                <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->name }}</h3>

                <p>Role : <b>
                    @foreach(auth()->user()->roles as $role)
                        {{ $role->name }}
                    @endforeach
                </b> </p> -->

            <!-- </div> -->
            <div class="row">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
                    <!-- Card 1 -->
<<<<<<< HEAD
                    <div class="card-1  rounded-lg border border-gray-200 shadow-md">
                        <div class="p-5">
                            <span class="text-white text-base mb-4">
                                 $6.200 (+12.80%)
</span>
=======
                    <div class="card1 rounded-lg border border-gray-200 shadow-md">
                        <div class="p-5">
                            <span class="text-white text-base mb-4">
                                $6.200 (+12.80%)
                            </span>
>>>>>>> 9d8cefc9a3c0a80c766afdc9b7a8e4567488f778
                            <p class="text-white text-base mb-4">
                                Total
                            </p>

                        </div>
                    </div>
<<<<<<< HEAD
                    <!-- Card 1 -->
                    <div class="card-2  rounded-lg border border-gray-200 shadow-md">
=======
                    <!-- Card 2 -->
                    <div class="card2 rounded-lg border border-gray-200 shadow-md">
>>>>>>> 9d8cefc9a3c0a80c766afdc9b7a8e4567488f778
                        <div class="p-5">
                            <span class="text-white text-base mb-4">
                                26K (+15.5%)
                            </span>
                            <p class="text-white text-base mb-4">
                                Users
                            </p>
<<<<<<< HEAD
                        

                        </div>
                    </div>
                    <!-- Card 1 -->
                    <div class="card-3 rounded-lg border border-gray-200 shadow-md">
=======
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="card3 rounded-lg border border-gray-200 shadow-md">
>>>>>>> 9d8cefc9a3c0a80c766afdc9b7a8e4567488f778
                        <div class="p-5">
                            <span class="text-white text-base mb-4">
                                44K (+15.5%)
                            </span>
                            <p class="text-white text-base mb-4">
<<<<<<< HEAD
                            Owner
=======
                                Owner
>>>>>>> 9d8cefc9a3c0a80c766afdc9b7a8e4567488f778
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
    <div class="row">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
            <div class="rounded-lg border border-gray-200 shadow-md">
                <div id="curve_chart_tolal" style="width: 300px; height: 200px; "></div>
                <span class="total_content p-3">Daily totla of price</span><br>
                <span class="total_content p-3">55% increase in today</span>
                <hr class="border-hr-solid">
                <div class="p-1">
                    <span>
                    <svg width="30" height="30" viewBox="0 0 175 148" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect width="175" height="148" fill="url(#pattern0_499_397)" />
                        <defs>
                            <pattern id="pattern0_499_397" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_499_397" transform="scale(0.00571429 0.00675676)" />
                            </pattern>
                            <image id="image0_499_397" width="175" height="148" xlink:href="data:image/png;base64,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" />
                        </defs>
                    </svg>
                </span>
                <span class="total_content">Update 3 minute ago</span>
                </div>
            </div>
            <div class="rounded-lg border border-gray-200 shadow-md">
                <div id="curve_chart_user" style="width: 300px; height: 200px"></div>
                <span class="total_content p-3">Daily totla of users</span><br>
                <span class="total_content p-3">100% increase in today</span>
                <hr class="border-hr-solid">
                <div class="p-1">
                    <span>
                    <svg width="30" height="30" viewBox="0 0 175 148" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect width="175" height="148" fill="url(#pattern0_499_397)" />
                        <defs>
                            <pattern id="pattern0_499_397" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_499_397" transform="scale(0.00571429 0.00675676)" />
                            </pattern>
                            <image id="image0_499_397" width="175" height="148" xlink:href="data:image/png;base64,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" />
                        </defs>
                    </svg>
                </span>
                <span class="total_content">Update 3 minute ago</span>
                </div>
            </div>
            <div class="rounded-lg border border-gray-200 shadow-md">
                <div id="curve_chart_owner" style="width: 300px; height: 200px"></div>
                <span class="total_content p-3">Daily totla of owners</span><br>
                <span class="total_content p-3">30% increase in today</span>
                <hr class="border-hr-solid">
                <div class="p-1">
                    <span>
                    <svg width="30" height="30" viewBox="0 0 175 148" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect width="175" height="148" fill="url(#pattern0_499_397)" />
                        <defs>
                            <pattern id="pattern0_499_397" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_499_397" transform="scale(0.00571429 0.00675676)" />
                            </pattern>
                            <image id="image0_499_397" width="175" height="148" xlink:href="data:image/png;base64,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" />
                        </defs>
                    </svg>
                </span>
                <span class="total_content">Update 3 minute ago</span>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Total price'],
            ['2004', 1000],
            ['2005', 1170],
            ['2006', 660],
            ['2007', 1030]
        ]);

        var options = {
            curveType: 'function',
            content: 'Dealy total price',
            backgroundColor: '#818181',
            colors: ['red', 'green', 'purple'],
            legend: {
                position: 'bottom'
            }

        };

        var data1 = google.visualization.arrayToDataTable([
            ['Year', 'Total users'],
            ['2004', 10],
            ['2005', 20],
            ['2006', 30],
            ['2007', 40]
        ]);

        var options1 = {
            curveType: 'function',
            content: 'Dealy total price',
            backgroundColor: '#818181',
            colors: ['green', 'purple'],
            legend: {
                position: 'bottom'
            }
        };

        var data2 = google.visualization.arrayToDataTable([
            ['Year', 'Total users'],
            ['2004', 10],
            ['2005', 50],
            ['2006', 30],
            ['2007', 40]
        ]);

        var options2 = {
            curveType: 'function',
            content: 'Dealy total price',
            backgroundColor: '#818181',
            colors: ['purple'],
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart_tolal'));
        var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart_user'));
        var chart2 = new google.visualization.LineChart(document.getElementById('curve_chart_owner'));

        chart.draw(data, options);
        chart1.draw(data1, options1);
        chart2.draw(data2, options2);
    }
</script>


<style>
    .custom-shape-divider-top {
        position: relative;
        overflow: hidden;
        width: 100%;
        height: 20px;
        /* Smaller height for a subtle curve */
        line-height: 0;
    }

    .custom-shape-divider-top svg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .custom-shape-divider-top .shape-fill {
        fill: #000000;
    }

    .card1 {
        background-color: #0017E3;
    }

    .card2 {
        background-color: #7500E0;
    }

    .card3 {
        background-color: #DA5D5B;
    }

    .total_content {
        font-size: small;

    }

    .border-hr-solid {
        border: 1px solid gray;
        width: 93%;
        /* padding-left: 15px; */
        margin: 10px;
    }
</style>

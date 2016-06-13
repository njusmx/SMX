$(function () {
    var chartJs = function() {

        var doughnutData = [{
                value: 300,
                color: "#1ABC9C",
                highlight: "#1ABC9C",
                label: "Chrome"
            }, {
                value: 50,
                color: "#556B8D",
                highlight: "#556B8D",
                label: "IE"
            }, {
                value: 100,
                color: "#EDCE8C",
                highlight: "#EDCE8C",
                label: "Safari"
            }, {
                value: 40,
                color: "#CED1D3",
                highlight: "#1F7BB6",
                label: "Other"
            }, {
                value: 120,
                color: "#1F7BB6",
                highlight: "#1F7BB6",
                label: "Firefox"
            }

        ];



        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100)
        };
        var lineChartData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                // labels:["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","67","68","69","70","71","72"],
                datasets: [{
                    label: 'Network Usage',
                    fillColor: 'rgba(26,188,156,0.5)',
                    strokeColor: 'rgba(26,188,156,1)',
                    pointColor: 'rgba(220,220,220,1)',
                    pointStrokeColor: '#fff',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    // data:[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72]
                    data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
                }, {
                    label: 'CPU Load',
                    fillColor: 'rgba(31,123,182,0.5)',
                    strokeColor: 'rgba(31,123,182,1)',
                    pointColor: 'rgba(151,187,205,1)',
                    pointStrokeColor: '#fff',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(151,187,205,1)',
                    data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
                    // data:[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72]

                }]

            }



         var randomScalingFactor = function() {
            return Math.round(Math.random() * 100)
        };
        var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                fillColor: 'rgba(26,188,156,0.5)',
                strokeColor: 'rgba(255,255,255,0.8)',
                highlightFill: 'rgba(26,188,156,1)',
                highlightStroke: 'rgba(255,255,255,0.8)',
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            }, {
                label: 'CPU Load',
                fillColor: 'rgba(31,123,182,0.5)',
                strokeColor: 'rgba(255,255,255,0.8)',
                highlightFill: 'rgba(31,123,182,1)',
                highlightStroke: 'rgba(255,255,255,0.8)',
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            }]

        }


        var chartData = [{
            value: Math.random(),
            color: "#1ABC9C"
        }, {
            value: Math.random(),
            color: "#556B8D"
        }, {
            value: Math.random(),
            color: "#EDCE8C"
        }, {
            value: Math.random(),
            color: "#CED1D3"
        }, {
            value: Math.random(),
            color: "#1F7BB6"
        }, {
            value: Math.random(),
            color: "#1ABC9C"
        }];



        window.onload = function() {
            var ctx1 = document.getElementById("canvas1").getContext("2d");
            window.myLine = new Chart(ctx1).Line(lineChartData, {
                responsive: true
            });

            var ctx2 = document.getElementById("bar").getContext("2d");
            window.myBar = new Chart(ctx2).Bar(barChartData, {
                responsive: true
            });

            var ctx3 = document.getElementById("doughnut").getContext("2d");
            window.myDoughnut = new Chart(ctx3).Doughnut(doughnutData, {
                responsive: true
            });

            var ctx4 = document.getElementById("polarArea").getContext("2d");
            window.myPolarArea = new Chart(ctx4).PolarArea(chartData, {
                responsive: true
            });

        };

    };
});
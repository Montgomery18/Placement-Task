CheckForTrendsPage();

function CheckForTrendsPage()
{
    var bodyTags = document.getElementsByTagName('body');
    //console.log(bodyTags);

    if (bodyTags[0].classList.contains('TrendsPage'))
    {
        //console.log("Test");
        StartChart();
    }
}


function StartChart()
{
    var chart1_select = document.getElementById('chart1_select');
    var chart2_select = document.getElementById('chart2_select');
    var weight = [];
    var steps = [];
    var hr = [];
    var cb = [];
    var temp = [];
    var cc = [];
    var wc = [];
    var br = [];
    var dates = [];
    var x_label = 'Date';
    var total_cc = 0;
    var total_cb = 0;
    var total_steps = 0;
    var total_wc = 0;
    var weight_gain = 0;

    //console.log(window.data)
    window.data.forEach(getValues);

    function getValues(item){
        weight.push(item.Weight);
        steps.push(item.Activity_Level);
        hr.push(item.Heart_Rate);
        cb.push(item.Calorie_Burn);
        temp.push(item.Temperature);
        cc.push(item.Food_Intake);
        wc.push(item.Water_Intake);
        br.push(item.Breathing_Rate);
        if(item.Hour != null){
            dates.push(item.Hour);
            x_label = item.Date;
        }
        else{
            dates.push(item.Date);
        }
    }

    weight_gain = (weight[(weight.length-1)] - weight[0]);
    total_steps = Math.round(window.sumData[0] * 100) / 100;
    total_cb = Math.round(window.sumData[1] * 100) / 100;
    total_cc = Math.round(window.sumData[2] * 100) / 100;
    total_wc = Math.round(window.sumData[3] * 100) / 100;

    //console.log(dates);
    //console.log(values)
    /*console.log("Total Steps is " + total_steps)
    console.log("Total Calories Eaten is " + total_cc)
    console.log("Total Calories Burned is " + total_cb)
    console.log("Calorie Deficit is " + (total_cc - total_cb))
    console.log("Total Water Consummed is " + total_wc)*/

    var Chart1Set = {
        type: "line",
        data: {
            labels: dates,
            datasets: [{
            borderColor: "blue",
            backgroundColor: "",
            data: steps
            }]
        },
        options: {
            legend: {display: false},
            title: {
                display: true,
                text: "Steps"
            }, 
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: x_label
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    }
    var myChart = new Chart("Chart1", Chart1Set);

    var Chart2Set = {
        type: "line",
        data: {
            labels: dates,
            datasets: [{
            borderColor: "red",
            backgroundColor: "",
            data: hr
            }]
        },
        options: {
            legend: {display: false},
            title: {
                display: true,
                text: "Heart Rate"
            },
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: x_label
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    }
    var myChart2 = new Chart("Chart2", Chart2Set);

    var start = document.getElementById('start');
    var end = document.getElementById('end');
    var day_mode = document.getElementById('day_mode');
    var bar_1 = document.getElementById('chart_1_bar');
    var bar_2 = document.getElementById('chart_2_bar');


    start.addEventListener('change', function() {
        if (start.value)
            var startDate = new Date(start.value);
            var endDate = new Date(startDate);
            endDate.setDate(startDate.getDate() + 30);
            end.min = start.value;
            end.max = endDate.toISOString().split('T')[0];
    }, false);

    end.addEventListener('change', function() {
        if (end.value)
            var endDate = new Date(end.value);
            var startDate = new Date(endDate);
            startDate.setDate(endDate.getDate() - 30);
            start.max = end.value;
            start.min = startDate.toISOString().split('T')[0];
    }, false);

    day_mode.addEventListener('load', function(){
        if (day_mode.value){
            document.getElementById('day_form').style.display = "block";
            document.getElementById('hour_form').style.display = "hide";
        }
        else{
            document.getElementById('day_form').style.display = "hide";
            document.getElementById('hour_form').style.display = "block";
        }
    })

    day_mode.addEventListener('change', function(){
        if (document.getElementById('day_form').style.display == "block"){
            document.getElementById('day_form').style.display = "none";
            document.getElementById('hour_form').style.display = "block";
            console.log("hidden");
        }
        else if(document.getElementById('day_form').style.display == "none"){
            document.getElementById('day_form').style.display = "block";
            document.getElementById('hour_form').style.display = "none";
            console.log("shown");
        }
    })

    chart1_select.addEventListener('change', function(){
        //console.log(chart1_select.value);
        myChart.options.title.text = chart1_select.value;
        switch(chart1_select.value){
            case "Weight":
                myChart.data.datasets.forEach((dataset) => {
                    dataset.data = weight;
                })
                break;
            case "Steps":
                //console.log(steps);
                myChart.data.datasets.forEach((dataset) => {
                    dataset.data = steps;
                })
                break;
            case "Heart Rate":
                myChart.data.datasets.forEach((dataset) => {
                    dataset.data = hr;
                })
                break;
            case "Calories Burned":
                myChart.data.datasets.forEach((dataset) => {
                    dataset.data = cb;
                })
                break;
            case "Temperature":
                myChart.data.datasets.forEach((dataset) => {
                    dataset.data = temp;
                })
                break;
            case "Calories Consumed":
                myChart.data.datasets.forEach((dataset) => {
                    dataset.data = cc;
                })
                break;
            case "Water Consumed":
                myChart.data.datasets.forEach((dataset) => {
                    dataset.data = wc;
                })
                break;
            case "Breathing Rate":
                myChart.data.datasets.forEach((dataset) => {
                    dataset.data = br;
                })
                break;
            default:
                break;
        }
        myChart.update();
    })

    chart2_select.addEventListener('change', function(){
        //console.log(chart2_select.value);
        myChart2.options.title.text = chart2_select.value;
        switch(chart2_select.value){
            case "Weight":
                myChart2.data.datasets.forEach((dataset) => {
                    dataset.data = weight;
                })
                break;
            case "Steps":
                //console.log(steps);
                myChart2.data.datasets.forEach((dataset) => {
                    dataset.data = steps;
                })
                break;
            case "Heart Rate":
                myChart2.data.datasets.forEach((dataset) => {
                    dataset.data = hr;
                })
                break;
            case "Calories Burned":
                myChart2.data.datasets.forEach((dataset) => {
                    dataset.data = cb;
                })
                break;
            case "Temperature":
                myChart2.data.datasets.forEach((dataset) => {
                    dataset.data = temp;
                })
                break;
            case "Calories Consumed":
                myChart2.data.datasets.forEach((dataset) => {
                    dataset.data = cc;
                })
                break;
            case "Water Consumed":
                myChart2.data.datasets.forEach((dataset) => {
                    dataset.data = wc;
                })
                break;
            case "Breathing Rate":
                myChart2.data.datasets.forEach((dataset) => {
                    dataset.data = br;
                })
                break;
            default:
                break;
        }
        myChart2.update();
    })

    bar_1.addEventListener('change', function(){
        //console.log(bar_1.value);
        if(Chart1Set.type == "line"){
            Chart1Set.type = "bar";
            myChart.data.datasets.forEach((dataset) => {dataset.backgroundColor="blue"});
            myChart.update();
        }
        else{
            Chart1Set.type = "line";
            myChart.data.datasets.forEach((dataset) => {dataset.backgroundColor=""});
            myChart.update();
        }
    })

    bar_2.addEventListener('change', function(){
        //console.log("Change");
        if(Chart2Set.type == "line"){
            Chart2Set.type = "bar";
            myChart2.data.datasets.forEach((dataset) => {dataset.backgroundColor="red"});
            myChart2.update();
        }
        else{
            Chart2Set.type = "line";
            myChart2.data.datasets.forEach((dataset) => {dataset.backgroundColor=""});
            myChart2.update();
        }
    })

    document.getElementById('steps').innerHTML = ("Total Steps: " + total_steps);
    document.getElementById('cc').innerHTML = ("Total Calories Eaten: " + total_cc);
    document.getElementById('cb').innerHTML = ("Total Calories Burned: " + total_cb);
    document.getElementById('cd').innerHTML = ("Calorie Difference: " + (total_cc - total_cb));
    document.getElementById('wc').innerHTML = ("Water Drank: " + total_wc);
    document.getElementById('weight').innerHTML = ("Your Dog Gained " + weight_gain + "kg");
}

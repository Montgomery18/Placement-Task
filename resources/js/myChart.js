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
    let error_message = "";

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

    function findAnomolies(array){
        let temp_array, q1, q3, iqr, max, min, errors = "";

        temp_array = array.toSorted();

        if((temp_array.length / 4) % 1 === 0){//find quartiles
            q1 = 1/2 * (temp_array[(temp_array.length / 4)] + temp_array[(temp_array.length / 4) + 1]);
            q3 = 1/2 * (temp_array[(temp_array.length * (3 / 4))] + temp_array[(temp_array.length * (3 / 4)) + 1]);
        } else {
            q1 = temp_array[Math.floor(temp_array.length / 4 + 1)];
            q3 = temp_array[Math.ceil(temp_array.length * (3 / 4) + 1)];
        }

        iqr = q3 - q1;
        //max = q3 + iqr;
        //min = q1 - iqr;
        if(iqr == 0){
            iqr = 0.5;
        }
        else if(iqr < 2){
            //console.log("I have a tiny iqr");
            max = q3 + iqr * 2;
            min = q1 - iqr * 2;
        }
        else{
            max = q3 + iqr * 1.5;
            min = q1 - iqr * 1.5;
        }


        for(let i = 0; i < array.length; i+=1){
            if(array[i] < min || array[i] > max){
                errors += (array[i] + ", ");
            }
        }

        return errors;
    }

    error_message += ("Activity Level Outliers: " + findAnomolies(steps) + "<br>");
    error_message += ("Calories Consumed Outliers: " + findAnomolies(cc) + "<br>");
    error_message += ("Calories Burned Outliers: " + findAnomolies(cb) + "<br>");
    error_message += ("Water Consumed Outliers: " + findAnomolies(wc) + "<br>");
    error_message += ("Temperature Outliers: " + findAnomolies(temp) + "<br>");
    error_message += ("Heart Rate Outliers: " + findAnomolies(hr) + "<br>");
    error_message += ("Weight Outliers: " + findAnomolies(weight) + "<br>");
    error_message += ("Breathing Rate Outliers: " + findAnomolies(br) + "<br>");

    weight_gain = (weight[(weight.length-1)] - weight[0]);
    total_steps = Math.round(window.sumData[0] * 100) / 100;
    total_cb = Math.round(window.sumData[1] * 100) / 100;
    total_cc = Math.round(window.sumData[2] * 100) / 100;
    total_wc = Math.round(window.sumData[3] * 100) / 100;

    var Chart1Set = {
        type: "line",
        data: {
            labels: dates,
            datasets: [{
                label: "Steps",
                borderColor: "blue",
                backgroundColor: "",
                data: steps
            }]
        },
        options: {
            legend: {
                display: true,
            },
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
                label: "Heart Rate",
                borderColor: "red",
                backgroundColor: "",
                data: hr
            }]
        },
        options: {
            legend: {display: true},
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
                myChart.data.datasets = [];
                myChart.data.datasets.push({
                    borderColor: "blue",
                    data: weight,
                    label: "Weight(kg)"
                })
                break;
            case "Steps":
                myChart.data.datasets = [];
                myChart.data.datasets.push({
                    borderColor: "blue",
                    data: steps,
                    label: "Steps"
                })
                break;
            case "Heart Rate":
                myChart.data.datasets = [];
                myChart.data.datasets.push({
                    borderColor: "blue",
                    data: hr,
                    label: "Heart Rate(bpm)"
                })
                break;
            case "Calories Burned":
                myChart.data.datasets = [];
                myChart.data.datasets.push({
                    borderColor: "blue",
                    data: cb,
                    label: "Calories Burned(cal)"
                })
                break;
            case "Temperature":
                myChart.data.datasets = [];
                myChart.data.datasets.push({
                    borderColor: "blue",
                    data: temp,
                    label: "Temperature(C)"
                })
                break;
            case "Calories Consumed":
                myChart.data.datasets = [];
                myChart.data.datasets.push({
                    borderColor: "blue",
                    data: cc,
                    label: "Calories Eaten(cal)"
                })
                break;
            case "Water Consumed":
                myChart.data.datasets = [];
                myChart.data.datasets.push({
                    borderColor: "blue",
                    data: wc,
                    label: "Water Drank(ml)"
                })
                break;
            case "Breathing Rate":
                myChart.data.datasets = [];
                myChart.data.datasets.push({
                    borderColor: "blue",
                    data: br,
                    label: "Breathing Rate(bpm)"
                })
                break;
            case "Show All":
                myChart.data.datasets.pop();
                myChart.data.datasets.push({
                    borderColor: "rgba(0, 255, 223, 0.8)",
                    data: steps,
                    label: "Steps"
                })
                myChart.data.datasets.push({
                    borderColor: "rgba(255, 42, 126, 0.8)",
                    data: weight,
                    label: "Weight(kg)"
                })
                myChart.data.datasets.push({
                    borderColor: "red",
                    data: hr,
                    label: "Heart Rate(bpm)"
                })
                myChart.data.datasets.push({
                    borderColor: "green",
                    data: br,
                    label: "Breathing Rate(bpm)"
                })
                myChart.data.datasets.push({
                    borderColor: "yellow",
                    data: temp,
                    label: "Temperature(C)"
                })
                myChart.data.datasets.push({
                    borderColor: "rgba(203, 0, 255, 0.8)",
                    data: cc,
                    label: "Calories Eaten(cal)"
                })
                myChart.data.datasets.push({
                    borderColor: "rgba(229, 84, 255, 1)",
                    data: cb,
                    label: "Calories Burned(cal)"
                })
                myChart.data.datasets.push({
                    borderColor: "blue",
                    data: wc,
                    label: "Water Drank(ml)"
                })
            default:
                break;
        }
        myChart.update();
    })

    chart2_select.addEventListener('change', function(){
        myChart2.options.title.text = chart2_select.value;
        switch(chart2_select.value){
            case "Weight":
                myChart2.data.datasets = [];
                myChart2.data.datasets.push({
                    borderColor: "red",
                    data: weight,
                    label: "Weight(kg)"
                })
                break;
            case "Steps":
                myChart2.data.datasets = [];
                myChart2.data.datasets.push({
                    borderColor: "red",
                    data: steps,
                    label: "Steps"
                })
                break;
            case "Heart Rate":
                myChart2.data.datasets = [];
                myChart2.data.datasets.push({
                    borderColor: "red",
                    data: hr,
                    label: "Heart Rate(bpm)"
                })
                break;
            case "Calories Burned":
                myChart2.data.datasets = [];
                myChart2.data.datasets.push({
                    borderColor: "red",
                    data: cb,
                    label: "Calories Burned(cal)"
                })
                break;
            case "Temperature":
                myChart2.data.datasets = [];
                myChart2.data.datasets.push({
                    borderColor: "red",
                    data: temp,
                    label: "Temperature(C)"
                })
                break;
            case "Calories Consumed":
                myChart2.data.datasets = [];
                myChart2.data.datasets.push({
                    borderColor: "red",
                    data: cc,
                    label: "Calories Eaten(cal)"
                })
                break;
            case "Water Consumed":
                myChart2.data.datasets = [];
                myChart2.data.datasets.push({
                    borderColor: "red",
                    data: wc,
                    label: "Water Drank(ml)"
                })
                break;
            case "Breathing Rate":
                myChart2.data.datasets = [];
                myChart2.data.datasets.push({
                    borderColor: "red",
                    data: br,
                    label: "Breathing Rate(bpm)"
                })
                break;
            case "Show All":
                myChart2.data.datasets.pop();
                myChart2.data.datasets.push({
                    borderColor: "red",
                    data: steps,
                    label: "Steps"
                })
                myChart2.data.datasets.push({
                    borderColor: "orange",
                    data: weight,
                    label: "Weight(kg)"
                })
                myChart2.data.datasets.push({
                    borderColor: "yellow",
                    data: hr,
                    label: "Heart Rate(bpm)"
                })
                myChart2.data.datasets.push({
                    borderColor: "green",
                    data: br,
                    label: "Breathing Rate(bpm)"
                })
                myChart2.data.datasets.push({
                    borderColor: "blue",
                    data: temp,
                    label: "Temperature(C)"
                })
                myChart2.data.datasets.push({
                    borderColor: "purple",
                    data: cc,
                    label: "Calories Eaten(cal)"
                })
                myChart2.data.datasets.push({
                    borderColor: "pink",
                    data: cb,
                    label: "Calories Burned(cal)"
                })
                myChart2.data.datasets.push({
                    borderColor: "black",
                    data: wc,
                    label: "Water Drank(ml)"
                })
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
    document.getElementById('cd').innerHTML = ("Calorie Difference: " + (Math.round(total_cc - total_cb*100)/100));
    document.getElementById('wc').innerHTML = ("Water Drank: " + total_wc);
    document.getElementById('weight').innerHTML = ("Your Dog Gained " + (Math.round(weight_gain *100)/100) + "kg");
    document.getElementById('warnings').innerHTML = error_message;
}

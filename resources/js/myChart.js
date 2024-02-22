CheckForTrendsPage();

function CheckForTrendsPage()
{
    var bodyTags = document.getElementsByTagName('body');
    console.log(bodyTags);

    if (bodyTags[0].classList.contains('TrendsPage'))
    {
        console.log("Test");
        StartChart();
    }
}


function StartChart()
{
    var day_form_select = document.getElementById('day_form_select');
    var weight = [];
    var steps = [];
    var hr = [];
    var cb = [];
    var temp = [];
    var cc = [];
    var wc = [];
    var br = [];
    var dates = [];

    console.log(window.data)
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
        }
        else{
            dates.push(item.Date);
        }
    }

    //console.log(dates);
    //console.log(values)


    const xValues = dates;
    const lineColor = "blue";

    var myChart = new Chart("myChart", {
    type: "line",
    data: {
        labels: xValues,
        datasets: [{
        borderColor: lineColor,
        data: weight
        }]
    },
    options: {
        legend: {display: false},
        title: {
            display: true,
            text: "Weight"
        },    
    }
    });

    var start = document.getElementById('start');
    var end = document.getElementById('end');
    var day_mode = document.getElementById('day_mode')

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

    day_form_select.addEventListener('change', function(){
        console.log(day_form_select.value);
        myChart.options.title.text = day_form_select.value;
        switch(day_form_select.value){
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
}

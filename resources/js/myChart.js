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
    var weight = [];
    var dates = [];
    window.data.forEach(getWeight);
    function getWeight(item){
        weight.push(item.Weight);
        dates.push(item.Date);
    }

    const xValues = dates;
    const yValues = weight;
    const barColors = "blue";

    var myChart = new Chart("myChart", {
    type: "line",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "Dog Data"
        }
    }
    });

    var start = document.getElementById('start');
    var end = document.getElementById('end');
    var day_mode = document.getElementById('day_mode')
    var day_form_select = document.getElementById('day_form_select');

    start.addEventListener('change', function() {
        if (start.value)
            end.min = start.value;
    }, false);

    end.addEventListener('change', function() {
        if (end.value)
            start.max = end.value;
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
        myChart.update();
    })
}

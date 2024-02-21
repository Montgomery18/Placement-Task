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

    new Chart("myChart", {
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
        text: "World Wine Production 2018"
        }
    }
    });

    /*var start = document.getElementById('start');
    var end = document.getElementById('end');
    var day_mode = document.getElementById('day_mode')

    start.addEventListener('change', function() {
        if (start.value)
            end.min = start.value;
    }, false);

    end.addEventListener('change', function() {
        if (end.value)
            start.max = end.value;
    }, false);

    day_mode.addEventListener('click', function(){
        var x = document.getElementById('end_div');
        if(x.hidden)
            x.hidden = false;
        else
            x.hidden = true;
    })*/
}

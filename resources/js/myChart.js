const xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
const yValues = [55, 49, 44, 24, 15];
const barColors = ["red", "green","blue","orange","brown"];

new Chart("myChart", {
type: "bar",
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

var start = document.getElementById('start');
var end = document.getElementById('end');
var day = document.getElementById('day')

start.addEventListener('change', function() {
    if (start.value)
        end.min = start.value;
}, false);

end.addEventListener('change', function() {
    if (end.value)
        start.max = end.value;
}, false);

day.addEventListener('click', function(){
    var x = document.getElementById('end_div');
    if(x.hidden)
        x.hidden = false;
    else
        x.hidden = true;
})



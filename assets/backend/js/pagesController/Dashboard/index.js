
$(document).ready(function(){
    const colorPallet = ['#16a34a', '#dc2626', '#eab308'];

    postData(`${baseUrl}get-data-count-tamu-kehadiran`, {}, 'GET').then((response) => {
        echarts.init(document.querySelector("#trafficChart")).setOption({
            tooltip: {
                trigger: 'item'
            },
            legend: {
                top: '5%',
                left: 'center'
            },
            series: [{
                // name: 'Access From',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: '18',
                        fontWeight: 'bold'
                    }
                },
                labelLine: {
                    show: false
                },
                data: response,
                color: colorPallet
            }]
        });
    })
})





// document.addEventListener("DOMContentLoaded", () => {
    
// });
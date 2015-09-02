$(function () {

    console.log($base_url);
    var _year = (new Date()).getFullYear();

    $.get($base_url + "admin/reports/", function (data) {
        var data = JSON.parse(data);

        $('#container').highcharts({
            title: {
                text: 'Monthly Reports / Year ' + _year,
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Numbers'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Signups',
                data: data.signups
            }, {
                name: 'Invites',
                data: data.invites
            }, {
                name: 'Commitments',
                data: data.commitments
            }, {
                name: 'Contributions',
                data: data.contributions
            }]
        });
    });
});
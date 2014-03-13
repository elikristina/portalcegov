google.load("visualization", "1", {
    packages: ["corechart"]
});
google.setOnLoadCallback(loadCharts);

function drawChart(container) {

    var rubrica = $(container).attr("data-rubrica"),
        orcamentado = parseFloat($(container).attr("data-orcamentado")),
        recebido = parseFloat($(container).attr("data-recebido")),
        gasto_comprometido = parseFloat($(container).attr("data-gasto-comprometido")),
        gasto_corrente = parseFloat($(container).attr("data-gasto-corrente")),
        saldo_disponivel = parseFloat($(container).attr("data-saldo-disponivel")),
        saldo_corrente = parseFloat($(container).attr("data-saldo-corrente")),
        verbaCompartilhada = $(container).attr("data-verba-compartilhada");


    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Nome');
    data.addColumn('number', 'Orçamentado');
    data.addColumn('number', 'Recebido');
    data.addColumn('number', 'Gastos Comprometidos');
    data.addColumn('number', 'Gastos Correntes');
    data.addColumn('number', 'Saldo Disponível');
    data.addColumn('number', 'Saldo Corrente');
    data.addRows([
        ['Valor', orcamentado, recebido, gasto_comprometido, gasto_corrente, saldo_disponivel, saldo_corrente],
    ]);

    var options = {
        title: rubrica
        //,chartArea:{left:0,top:0,width:"70%",height:"75%"}
        ,
        chartArea: {
            left: 100,
            width: "70%"
        },
        width: 800,
        height: 280,
        colors: ['#25BA37', '#40C950', '#CC4523', '#E37768', '#3E60CF', '#5F7DDE'],
        series: (verbaCompartilhada == "true") ? {
            1: {
                color: '#E0C61B',
                visibleInLegend: true
            }
        } : {}
        //, legend: {position: 'in'}
        ,
        vAxes: [{
                title: 'Valor (R$)',
                textStyle: {
                    color: 'black'
                }
            },

        ]
    };


    var formatter = new google.visualization.NumberFormat({
        prefix: 'R$ ',
        negativeColor: 'red',
        negativeParens: false
    });


    formatter.format(data, 1);
    formatter.format(data, 2);
    formatter.format(data, 3);
    formatter.format(data, 4);
    formatter.format(data, 5);
    formatter.format(data, 6);

    var chart = new google.visualization.ColumnChart(document.getElementById($(container).attr('id')));
    chart.draw(data, options);
}

function loadCharts() {
    $.each($('.bar_chart'), function(k, container) {
        drawChart(container);

    });
    drawPie();

}

function drawPie() {
    var despesas = Array();
    despesas.push(['Rubrica', 'Valor']);

    var formatter = new google.visualization.NumberFormat({
        prefix: 'R$ ',
        negativeColor: 'red',
        negativeParens: false
    });


    //Carrega valores
    $.each($('.rub_chart'),
        function(k, container) {
            var rubrica = $(container).attr("data-rubrica"),
                gasto_comprometido = parseFloat($(container).attr("data-gasto-comprometido"));

            if (gasto_comprometido < 0) gasto_comprometido = 0;
            //gasto_comprometido = formatter.formatValue(gasto_comprometido);

            despesas.push([rubrica, gasto_comprometido]);
        });

    //console.log(despesas);
    var data = google.visualization.arrayToDataTable(despesas);

    formatter.format(data, 1);

    var options = {
        title: 'Gastos de Rubricas',
        chartArea: {
            left: 100,
            width: "70%"
        },
        width: 800,
        height: 280
    };

    var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
    chart.draw(data, options);

}
$(document).on('ready', function () {
    $('body').on('click', '.pagina', function () {
        paginacion($(this).attr("pagina"), $(this).attr("nombre"), $(this).attr("parametros"));
    });
    var paginacion = function (pagina, nombrelista, datos) {
        var pagina = 'pagina=' + pagina;

        $.post(_root_ + 'busqueda/index/_paginacion_' + nombrelista + '/' + datos, pagina, function (data) {
            $("#" + nombrelista).html('');
            $("#" + nombrelista).html(data);
        });
    };
    
    PalabrasMasBuscadas('todos', 'todos',$("#titulo1").val());
    buscar('todos', 'todos');
    
    $("body").on('click', "#btn_buscar", function () {
        PalabrasMasBuscadas($("#iano").val(), $("#imes").val(),$("#titulo1").val());
        buscar($("#iano").val(), $("#imes").val());
    });
});
function buscar(iano, imes) {
    $.post(_root_ + 'busqueda/index/BuscarBusqueda',
            {
                iano: iano,
                imes: imes
            }, function (data) {
        $("#divListarBusqueda").html('');
        $("#divListarBusqueda").html(data);
    });
}

function PalabrasMasBuscadas(iano, imes, titulo) {
    $.post(_root_ + 'busqueda/index/c_BusquedasMasFrecuentes',
            {
                iano: iano,
                imes: imes,
                titulo: titulo
            }, function (data) {
        $("#js_PalabrasMasBuscadas").html('');
        $("#js_PalabrasMasBuscadas").html(data);
    });
}

function fun_Busqueda(cat_Busqueda, dat_Busqueda, titulo) {
    var chart_Busqueda = new Highcharts.Chart({
        chart: {
            renderTo: 'c_PalabrasMasBuscadas',
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: cat_Busqueda,
            /*tickmarkPlacement: 'on',
            title: {
                disabled: true
            }*/
            tickmarkPlacement: 'off',
            title: {
                enabled: true
            }
        },
        yAxis: {
            title: {
                text: ''
            }/*,
            labels: {
                formatter: function () {
                    return this.value / 1000;
                }
            }*/
        },
        tooltip: {
            formatter: function () {
                return '' +
                         this.x + ' = ' + this.y + ' ' ;
            }
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [{
                data: dat_Busqueda,
                name: titulo
            }]
        , exporting: {
            enabled: true
        }
    });
}

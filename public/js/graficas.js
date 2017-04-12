//En el home esta 2 librerias  para las graficas 


function cambiar_fecha_grafica(){

    var anio_sel=$("#anio_sel").val();
    var mes_sel=$("#mes_sel").val();

    cargar_grafica_barras(anio_sel,mes_sel);
    cargar_grafica_lineas(anio_sel,mes_sel);
}


//Tipos de grafica

//Graficas de barras
function cargar_grafica_barras(anio,mes){


//Todo esto son objetos de javascript
//Opciones

//Para modificar los elementos de la grafica
var options={
	 chart: {
        //Es el div donde se va ha mostrar la grafica
        	renderTo: 'div_grafica_barras',
            //Es el tipo
            type: 'column'
        },
        title: {
            //El tema
            text: 'Numero de Registros en el Mes'
        },
        subtitle: {
            text: 'Source: plusis.net'
        },
        xAxis: {
            //En el eje x numero de ias del mes
            categories: [],
             title: {
                text: 'dias del mes'
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'REGISTROS AL DIA'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'registros',
          //Este es importante aqui se almacenan los datos del eje y
            data: []

        }]
}

$("#div_grafica_barras").html( $("#cargador_empresa").html() );

var url = "grafica_registros/"+anio+"/"+mes+"";


$.get(url,function(resul){

//Estas variables estan enviadads desde el controlador Graficas controller pilasss

//Este es la respuesta
var datos= jQuery.parseJSON(resul);
//Nombre del dato enviado dessde el controller totaldias and registrosdia
var totaldias=datos.totaldias;
var registrosdia=datos.registrosdia;
var i=0;
	for(i=1;i<=totaldias;i++){
	//Dias que posee ese mes y ese año
    //Asigna en el grafico estadistico  es como menu opciones    

//Aigna cuandotos ussuarios se registraron en esos dias ver  en la funcion  cargar_grafica_barras(anio,mes){
    //Es como un menu de opciones que se puede ir accediendo a esos objetos
	options.series[0].data.push( registrosdia[i] );

    //Asigna dias
	options.xAxis.categories.push(i);


	}


 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);

})


}


//Graficas de linea

function cargar_grafica_lineas(anio,mes){

var options={
     chart: {
            renderTo: 'div_grafica_lineas',
           
        },
          title: {
            text: 'Numero de Registros en el Mes',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: Plusis.net',
            x: -20
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            title: {
                text: 'REGISTROS POR DIA'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' registros'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'registros',
            data: []
        }]
}

$("#div_grafica_lineas").html( $("#cargador_empresa").html() );
var url = "grafica_registros/"+anio+"/"+mes+"";
$.get(url,function(resul){
var datos= jQuery.parseJSON(resul);
var totaldias=datos.totaldias;
var registrosdia=datos.registrosdia;
var i=0;
    for(i=1;i<=totaldias;i++){
    
    options.series[0].data.push( registrosdia[i] );
    options.xAxis.categories.push(i);


    }
 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 //Aqui se actualiza con todads las opciones
 chart = new Highcharts.Chart(options);

})


}



//Grafica de pastel
function cargar_grafica_pie(){

var options={
     // Build the chart
     
            chart: {
                renderTo: 'div_grafica_pie',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Grafica publicaciones'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: []
            }]
     
}

$("#div_grafica_pie").html( $("#cargador_empresa").html() );

var url = "grafica_publicaciones";


$.get(url,function(resul){
var datos= jQuery.parseJSON(resul);
var tipos=datos.tipos;
var totattipos=datos.totaltipos;
var numeropublicaciones=datos.numerodepubli;

    for(i=0;i<=totattipos-1;i++){  
    var idTP=parseInt(tipos[i].id);
    //Aqui se almacena el titulo y el numero de publicaciones valor x y x ...
    var objeto= {name: tipos[i].titulo, y:numeropublicaciones[idTP] };     
    //Se agrega a qui los objetos
    options.series[0].data.push( objeto );  
    }
 //options.title.text="aqui e podria cambiar el titulo dinamicamente"; 

 //Aqui se actualiza con toda las nuevas opciones 
 chart = new Highcharts.Chart(options);

})








}
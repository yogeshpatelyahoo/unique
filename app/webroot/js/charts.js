function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x - 125 ,
                "z-index": 99999,
                border: '1px solid #333',
                padding: '4px',
                color: '#fff',
                'border-radius': '3px',
                'background-color': '#333',
                opacity: 0.80
            }).appendTo("body").fadeIn(200);
        }

/*  ##################### Graph 1 ###################
 *  ################## Line Chart ###################
 */        
        var plot = $.plot($("#placeholder3"), [{
            data: transactions,
            label: "Monthly New Transactions"
        }, {
            data: recurring,
            label: "Recurring Transactions"
        }], {
            series: {
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.05
                        }, {
                            opacity: 0.01
                        }]
                    }
                },
                points: {
                    show: true
                },
                shadowSize: 2
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#eee",
                borderWidth: 0
            },
            colors: ["#d12610", "#709CD2", "#52e136"],
            xaxis: {
            	ticks: txTicks,
                tickDecimals: 0
            },
            yaxis: {
                ticks: 11,
                tickDecimals: 0
            }
        });
        var previousPoint = null;
        $("#placeholder3").bind("plothover", function (event, pos, item) {
            $("#x").text(pos.x.toFixed(2));
            $("#y").text(pos.y.toFixed(2));
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
                    showTooltip(item.pageX, item.pageY, item.series.label + " "+Math.floor(y)	);
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
        
  /*############### Graph 3 ##################*/      
var options = {
					
				    tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + '' %> Registration(s)",
				    multiTooltipTemplate: "<%= value + '' %> ",
				    responsive: true,
				};
				
                   if(!$.isEmptyObject(barChartData)){
                	   var ctx = document.getElementById("canvas123").getContext("2d");

       					var myBarChart = new Chart(ctx).Bar(barChartData, options);
                   } else {
                	   $(".redDataResponse").html('<div class="text-center" style="padding:110px;"><strong>No Data Available</strong></div>');
                   }
                   
                   if(prof_data_pie.length>0) {
                   
	                   $.plot('#placeholder8', prof_data_pie, {
	                       series: {
	                           pie: {
	                               show: true,
	                               radius: 1,
	                               label: {
	                                   show: true,
	                                   radius: 1,
	                                   formatter: function (label, series) {
	                                       return '<div style="font-size:8pt;text-align:center;padding:3px;color:white;">' + label + '<br/>(' + parseInt(series.percent) +"%, "+series.data[0][1] + ')</div>';
	
	                                   },
	                                   background: {
	                                       opacity: 0.5,
	                                       color: '#000'
	                                   }
	                               }
	                           }
	                       },
	                       grid: {
		           				hoverable: true,
		           			},
	                       legend: {
	                           show: false
	                       }
	                   });
                   } else {
                	   $("#placeholder8").html('<div class="text-center" style="padding:110px;"><strong>No Data Available</strong></div>');
                   }
                   /*############### Graph 4 ##################*/     
                   if(ref_data_pie.length>0) {
                   
	                   $.plot('#placeholder4', ref_data_pie, {
	                       series: {
	                       	points: {
	           					show: true
	           				},
	                           pie: {
	                           	innerRadius: .3,
	                               show: true,
	                               label: {
	                                   show: true,
	                                   radius: 3/4,
	                                   formatter: function (label, series) {
	                                       return '<div style="font-size:8pt;text-align:center;padding:3px;color:white;">' + label + '<br/>(' + parseInt(series.percent) +"%, "+series.data[0][1] + ')</div>';
	
	                                   },
	                                   threshold: 0.1,	
	                                   background: {
	                                       opacity: 0.5,
	                                       color: '#000'
	                                   }
	                               }
	                           }
	                       },
	                       grid: {
	           				hoverable: true,
	           			},
	                   });
                   } else {
                	   $("#placeholder4").html('<div class="text-center" style="padding:110px;"><strong>No Data Available</strong></div>');
                   }
                   
   /*  ##################### Graph 6 ###################
	*  ################## Line Chart ###################
	*/        
	   var plot = $.plot($("#placeholder50"), [{
	   data: totalHits,
	   label: "Total visitors"
	   }, {
	       data: uniqueHits,
	       label: "Unique visitors"
	   }], {
	       series: {
	           lines: {
	               show: true,
	               lineWidth: 2,
	               fill: true,
	               fillColor: {
	                   colors: [{
	                       opacity: 0.05
	                   }, {
	                       opacity: 0.01
	                   }]
	               }
	           },
	           points: {
	               show: true
	           },
	           shadowSize: 2
	       },
	       grid: {
	           hoverable: true,
	           clickable: true,
	           tickColor: "#eee",
	       borderWidth: 0
	   },
	   colors: ["#d12610", "#709CD2", "#52e136"],
	       xaxis: {
	       	ticks: visitTicks,
	           tickDecimals: 0
	       },
	       yaxis: {
	           ticks: 11,
	           tickDecimals: 0
	       }
	   });
	   var previousPoint = null;
	   $("#placeholder50").bind("plothover", function (event, pos, item) {
	   $("#x").text(pos.x.toFixed(2));
	   $("#y").text(pos.y.toFixed(2));
	   if (item) {
	       if (previousPoint != item.dataIndex) {
	           previousPoint = item.dataIndex;
	           $("#tooltip").remove();
	           var x = item.datapoint[0].toFixed(2),
	               y = item.datapoint[1].toFixed(2);
	           showTooltip(item.pageX, item.pageY, item.series.label + " "+Math.floor(y)	);
	       }
	   } else {
	       $("#tooltip").remove();
	           previousPoint = null;
	       }
	   });
                           
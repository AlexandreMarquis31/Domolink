document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById("serieEq")) {
        document.getElementById("serieEq").oninput = function () {
            checkNum(document.querySelector("#serieEq"));
        }
    }
});

$(document).ready(function () {
    var thisScript = $('script[src*=dashBoard]');
    let id = thisScript.attr('data-my_var_1');
    let piece = thisScript.attr('data-my_var_2');
    let type;
    if (piece !== "VueGenerale") {
        id = piece;
        type = "piece";
    } else {
        type = "utilisateur";
    }
    var canvas = document.getElementsByTagName("canvas");
    for (var i = 0, canva; canva = canvas[i++];) {
        $.ajax({
            type: 'post',
            url: '../phpRessources/getGraphData.php',
            data: {id: id, idCanva: canva.id, ownerType: type},
            dataType: 'json',
            success: function (data) {
                if (data.datas != null && data.datas.length > 0) {
                    var canva = document.getElementById(data.id);
                    $("#"+data.id).parent().find(".noGraph").text("");
                    var ctx = canva.getContext('2d');
                    var chart = new Chart(ctx, {
                        type: data.type,
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: "Consomation " + data.title,
                                data: data.datas,
                                backgroundColor: 'rgba(0, 99, 227, 0.2)',
                                borderColor: 'rgba(0, 99, 227,1)',
                                borderWidth: 1,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    },
                                }],
                                xAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }],
                            },
                            events: ['mousemove'],
                            tooltips: {
                                callbacks: {
                                    label: function (tooltipItem, data) {
                                        var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                        if (label) {
                                            label += ': ';
                                        }
                                        label += Math.round(tooltipItem.yLabel * 100) / 100;
                                        label += ' heures '
                                        return label;
                                    }
                                }
                            }
                        }
                    });
                } else {
                    $("#"+data.id).parent().find(".noGraph").css("visibility","visible");
                    $("#"+data.id).remove();
                }
            },
        });
        $(".ajouterBox").children().hide();
        $(".ajouterBox").css("visibility", "visible");
    }

});
$(".ajouterBox").click(function () {
    $(this).css("cursor", "default");
    $(this).addClass("hide-bg");
    $(this).children().fadeIn(500);
});
$(".cancelBox").click(function (e) {
    e.stopPropagation();
    $(this).parent().children().fadeOut(200, function () {
        $(this).parent().removeClass("hide-bg");
        $(this).parent().css("cursor", "pointer");
        $(this).parent().find(".errorEqu").text("");
        $(this).parent().find("select").val("Type d'appareil");
    });
});
$(".addBox").click(function (e) {
    e.stopPropagation();
    if ($(this).parent().find("select").val() == "Type d'appareil") {
        $(this).parent().find(".errorEqu").text("Sélectionnez le type d'appareil.");
    } else if ($(this).parent().find("input").val() == "") {
        $(this).parent().find(".errorEqu").text("Entrez le numéro de série.");
    } else {
        $(this).parent().find("form").submit();
    }
});



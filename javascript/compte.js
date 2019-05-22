var thisScript = $('script[src*=compte]');
var mail = thisScript.attr('data-my_var_1');

document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById("accountDelete")) {
        document.getElementById("accountDelete").onclick = function verifyMail(e) {
            if (mail === $('#mail').val()) {
                $('#infoForm').submit();
            }
        };
    }
    if (document.querySelector("#champTel")) {
        document.getElementById("champTel").oninput = function () {
            checkNum(document.getElementById("champTel"));
        }
    }
    if (document.querySelector("#champRue")) {
        document.getElementById("champRue").oninput = function () {
            checkNum(document.getElementById("champRue"));
        }
    }
});
$(document).ready(function () {
    $('#mdpChange').click(function () {
        $.ajax({
            type: 'post',
            url: 'phpRessources/verifyMDP.php',
            data: {mdp: $('#actualMDP').val()},
            dataType: 'json',
            success: function (data) {
                if (data.ok === true) {
                    if ($('#newMDP').val() !== $('#confNewMDP').val()) {
                        let span = document.getElementById("errorText");
                        let txt = document.createTextNode("Les mots de passes ne sont pas identiques.");
                        if (!span.firstChild)
                            span.appendChild(txt);
                    } else {
                        document.getElementById("infoForm").submit();
                    }
                } else {
                    let span = document.getElementById("errorText");
                    let txt = document.createTextNode("Le mot de passe est invalide.");
                    if (!span.firstChild)
                        span.appendChild(txt);
                }
            }
        });
        return false;
    });
    $('#infoSubmit').click(function () {
        var email = $('#mail').val();
        $.ajax({
            type: 'post',
            url: 'phpRessources/check.php',
            data: {email: email},
            dataType: 'json',
            success: function (data) {
                if (data.exist === false) {
                    document.getElementById("infoForm").submit();
                } else {
                    let span = document.getElementById("errorText");
                    let txt = document.createTextNode("L'identifiant existe déjà.");
                    if (!span.firstChild)
                        span.appendChild(txt);
                }
            },
        });
        return false;
    });
})
;


// const controller = '{{ ENV("APP_URL") }}';

var strPad = function(i, l, s) {
    var o = i.toString();
    if (!s) { s = '0'; }
    while (o.length < l) {
        o = s + o;
    }
    return o;
};

function dataLocalHora() {
    var dt = new Date();
    return dt.getFullYear() + "-" + strPad(dt.getMonth() + 1, 2, '0') + "-" + dt.getDate() + " " + dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
}


function gerarPassword() {
    return Math.random().toString(36).substring(0, 12);
}


function formatarDataPtBr(date_es) {
    var dt_formatada = new Date(date_es);
    dt_formatada.toLocaleString("pt-br");

    return dt_formatada;
}

function pad(s) {
    return s < 10 ? "0" + s : s;
}

function dataFormatada(date) {
    var data = new Date(date),
        dia = data.getDate().toString(),
        diaF = dia.length == 1 ? "0" + dia : dia,
        mes = (data.getMonth() + 1).toString(), //+1 pois no getMonth Janeiro começa com zero.
        mesF = mes.length == 1 ? "0" + mes : mes,
        anoF = data.getFullYear();
    let outputHour = [data.getHours(), data.getMinutes()].map(pad).join(":");

    return diaF + "/" + mesF + "/" + anoF + " " + outputHour;
}

$.fn.serializeFormJSON = function () {
    let formJSON = parseJSON(JSON.stringify(this.serializeArray()));

    // GET ARRAY OF FORM'S ARRAY INPUTS
    let inpArray = [];
    $.each(Object.values(formJSON), function (i, value) {
        if (value["name"].substr(value["name"].length - 2) === "[]") {
            let can = true;
            $.each(inpArray, function (j, valor) {
                if (valor === value["name"].substr(0, value["name"].length - 2)) {
                    can = false;
                    return false;
                }
            });

            if (can === true) {
                inpArray.push(value["name"].substr(0, value["name"].length - 2));
            }
        }
    });

    // CONVERT ARRAY OF FORM'S ARRAY INPUTS TO OBJECT
    let inpObj = {};
    $.each(inpArray, function (i, value) {
        let jd = 0;
        let newObj = {};
        $.each(Object.values(formJSON), function (j, valor) {
            if (value === valor["name"].substr(0, valor["name"].length - 2)) {
                newObj[jd] = valor["value"];
                jd++;
            }
        });

        inpObj[value] = newObj;
    });

    // SET RESULT OBJECT ACCORDING EACH FORM INPUTS AND ARRAY OF FORM'S ARRAY INPUTS
    let result = {};

    $.each(Object.values(formJSON), function (i, value) {
        let isInInpObj = false;
        Object.keys(inpObj).forEach(function (key) {
            if (value["name"].substr(0, value["name"].length - 2) === key) {
                result[key] = inpObj[key];
                isInInpObj = true;
            }
        });

        if (!isInInpObj) {
            result[value["name"]] = value["value"];
        }
    });

    return result;
};

$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [ o[this.name] ];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function parseJSON(jsonString) {
    let result = null;

    try {
        result = jQuery.parseJSON(jsonString);
    } catch (ex) {
        throw "Could not parse JSON from String!\n\n" + ex;
    }

    return result;
}


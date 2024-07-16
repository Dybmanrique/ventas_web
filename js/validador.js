var variable1;
var variable2;
var variable3;
var variable4;
var variable5;
var child = null;
var _url_ = '';
var tabs;
function number(e){
    var c = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
    if ((c > 47) && (c < 58) || c==8)
        return true;
    return false;
}
function numberDecimal(e,thix, precision) {
    var keynum = window.event ? window.event.keyCode : e.which;
//    var value = document.getElementById(thix.id).value;
    var value = thix.value;
    if (value.indexOf('.') != -1 && keynum == 46)
        return false;
    if (keynum == 8 || keynum == 48 || keynum == 46)
        return true;
    if (keynum <= 47 || keynum >= 58)
        return false;
    if(value.indexOf('.') != -1){
        var ax = value.split('.');
        if(ax[1].length>=precision)
            return false;
    }
    return /\d/.test(String.fromCharCode(keynum));
}
function letters(e){
    var c = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
    if ((c != 32 && c!=8) && (c < 65 || c > 90) && (c < 97 || c > 122) && c!=241 && c!=209)
        return false;
    return true;
}
function noTilde(e) {
    t = (document.all) ? e.keyCode : e.which;
    tildes=[180,225,233,237,243,250,193,201,205,211,218]; //['´','á','é','í','ó','ú','Á','É','Í','Ó','Ú'];
    if(tildes.indexOf(t) != -1) return false;
    return true; 
}
function verifFecha(f, frmt, de=2016){
    if(frmt == 'dmY'){
        var re=/^(0?[1-9]|[12][0-9]|3[01])[\-](0?[1-9]|1[012])[\-](19|20)\d{2}$/
        var anio = f.split('-')[2];
    }else{
        var re=/^(19|20)\d{2}[\-](0?[1-9]|1[012])[\-](0?[1-9]|[12][0-9]|3[01])$/
        var anio = f.split('-')[0];
    }
    if(f.length==0 || !re.exec(f)){
        f.length==0 ? msg='No has ingresado la fecha.' : msg='La fecha no tiene formato correcto.';
        alert(msg);
        return false;
    }else if(anio<de){
        alert('Año de la fecha invalido!');
        return false;
    }
    return true;
}
var array_meses = {'01':'Enero','02':'Febrero','03':'Marzo','04':'Abril','05':'Mayo','06':'Junio','07':'Julio','08':'Agosto','09':'Septiembre','10':'Octubre','11':'Noviembre','12':'Diciembre'}
var key_meses = Object.keys(array_meses).sort()

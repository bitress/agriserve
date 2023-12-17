var agriserve = {
    Ajax: 'AgriServe/Ajax.php',
    Utils: {}
}
var notyf = new Notyf();


agriserve.Utils.hash = function(plain_password){
    return  CryptoJS.SHA512(plain_password).toString();
}
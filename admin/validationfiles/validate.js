// JavaScript Document
//chk bad character
function chkbadchar(str) {
    badch = new Array('select','insert','delete','drop','alter','change','modify','union','char','convert','cast','--','<','>','#', '*', '^','~','`','!','%','&','+','=','|',':',';','?','{','}','\'','--',')','(','"');	
    //alert(str);
    for (var k = 0; k < badch.length; k++) {
        if (str.toLowerCase().indexOf(badch[k]) != -1) {
            //alert ("Invalid characters found, Please Re-Enter");
            return false;
        }
    }
   
}

//chk bad char for file name

function chkbadchar_f(str) {
    badch = new Array('select','insert','delete','drop','alter','change','modify','union','char','convert','cast',' ','--','<','>','#', '*', '^','~','`','!','%','&','+','=','|',';','?','{','}','\'','--','"');	
   // alert(str);
    for (var k = 0; k < badch.length; k++) {
        if (str.toLowerCase().indexOf(badch[k]) != -1) {
            //alert ("Invalid characters found, Please Re-Enter");
            return false;
        }
    }
   
}
function encrypt_value(encryptid){

var pem = "-----BEGIN PUBLIC KEY-----MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApRpsWwVPJyAlkcAUunf9ry9tKikmxqfUGfKRJgDwxMBp471Q3clAk20vsGmQTPiR62vuFoFNWWvIX+ySwcHdOeVIbkblmJltRpGRCrLe22/qK15t4JLmbNf4wwOMZ4e0xPDWpeCMoM2D89lE/gl8R5O0uEge/Y24wUh+1qjQpj+SayNbcf5Fl8fwUi03pMjF2+ZRRv0pvc1Kok6UILWwIMH5U+aFnRMMrUyWuSMRV1f3CmqJic8QpK81WodTMu8nGUZLML+oDWawhgLSd1K/EipkDm+vRrNIdY0UmUtH6vzrElKfAlGeGTVMRh77Nrr+mxPKBAi6kafSoj7K1Jb4RwIDAQAB-----END PUBLIC KEY-----";
var key = RSA.getPublicKey(pem);
 encrypted=RSA.encrypt(encryptid.value, key);
 return encrypted;

}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

  function ValidateFileUpload(fileChooser) {
        var fuData = document.getElementById(fileChooser);
        //var fuData = str;
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
			return false;
          //  alert("Please upload an image");

        } else {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

//The file uploaded is an image

if (Extension == "gif" || Extension == "png" || Extension == "bmp"
                    || Extension == "jpeg" || Extension == "jpg") {

// To Display
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(fuData.files[0]);
                }

            } 

//The file upload is NOT an image
else {
	return false;
               // alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

            }
        }
    }
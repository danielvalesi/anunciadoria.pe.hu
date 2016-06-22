var parseVideoURL = function(url) {
    
    function getParm(url, base) {
        var re = new RegExp("(\\?|&)" + base + "\\=([^&]*)(&|$)");
        var matches = url.match(re);
        if (matches) {
            return(matches[2]);
        } else {
            return("");
        }
    }
    
    var retVal = {};
    var matches;
    
    if (url.indexOf("youtube.com/watch") != -1) {
        retVal.tipo = 1;
        retVal.id = getParm(url, "v");
    } else if (matches = url.match(/vimeo.com\/(\d+)/)) {
        retVal.tipo = 2;
        retVal.id = matches[1];
    }
	else return ;
	
    return(retVal);
}

var round = function(value, decimals) { return Number(Math.round(value+'e'+decimals)+'e-'+decimals); };

var reais = function(num) {

   x = 0;

   if(num<0) {
      num = Math.abs(num);
      x = 1;
   }

   if(isNaN(num)) num = "0";
      cents = Math.floor((num*100+0.5)%100);

   num = Math.floor((num*100+0.5)/100).toString();

   if(cents < 10) cents = "0" + cents;
      for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
         num = num.substring(0,num.length-(4*i+3))+'.'
               +num.substring(num.length-(4*i+3));

   ret = num + ',' + cents;

   if (x == 1) ret = ' - ' + ret;return ret;

};

var verificaCNPJ = function(val) {
	
	var numeros;
	var digitos;
	var soma;
	var i;
	var out;
	var pos;
	var tamanho;
	var digitos_iguais = 1;
 	var v = val.replace(/[.-]/g,'');
 
	if(v.length < 14 && v.length < 15) return ;
   
  	for(i=0; i<v.length-1; i++)
	{
      	if (v.charAt(i) != v.charAt(i + 1))
		{
         	digitos_iguais = 0;
         	break;
      	}
   	}
		
	if(digitos_iguais) return ;
 
    tamanho = v.length - 2;
	numeros = v.substring(0,tamanho);
	digitos = v.substring(tamanho);
	soma = 0;
    pos = tamanho - 7;
 
    for(i=tamanho; i>=1; i--)
	{
    	soma += numeros.charAt(tamanho-i)*pos--;
        if(pos < 2) pos = 9;
    }
			
    out = soma%11<2?0:11-soma%11;
    if(out != digitos.charAt(0)) return ;
			
    tamanho = tamanho+1;
    numeros = v.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
			
    for(i=tamanho; i>=1; i--)
	{
        soma += numeros.charAt(tamanho-i)*pos--;
        if(pos < 2) pos = 9;
    }
	  
    out = soma%11<2?0:11-soma%11;
      
	if(out != digitos.charAt(1)) return ;
			
    return true;
	
};

var verificaCPF = function(v) {
		
	var out = v.replace(/[.-]/g,'');
		
	var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
	var a = [];
	var b = new Number;
	var c = 11;
			
	for (i=0; i<11; i++)
	{
		a[i] = out.charAt(i);
		if (i < 9) b += (a[i] * --c);
	}
			
	if ((x = b % 11) < 2) a[9] = 0; else a[9] = 11-x;
			
	b = 0;
	c = 11;
			
	for (y=0; y<10; y++) b += (a[y] * c--);
			
	if ((x = b % 11) < 2) a[10] = 0; else a[10] = 11-x;
			
	if (out.charAt(9) != a[9] || out.charAt(10) != a[10] || out.match(expReg)) return false;
			
	return true;
		
};

var verificaEmail = function(v) {

	return new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/).test(v);

};

var Numeros = function(e)
{
	if(e.which == 32 || (!(e.ctrlKey && e.which == 97) && e.which != 0 && e.which != 8 && isNaN(String.fromCharCode(e.which))))
	{ 
		return false;
	}
}

var ConverterDinheiro = function(v) {

	return String(v).replace('.','').replace(',','.');

};

var ConvertePct = function(v) {

	return String(v).replace(',','.');

};

var urlencode = function(str) {
  //       discuss at: http://phpjs.org/functions/urlencode/
  //      original by: Philip Peterson
  //      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      improved by: Brett Zamir (http://brett-zamir.me)
  //      improved by: Lars Fischer
  //         input by: AJ
  //         input by: travc
  //         input by: Brett Zamir (http://brett-zamir.me)
  //         input by: Ratheous
  //      bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      bugfixed by: Joris
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  //             note: This reflects PHP 5.3/6.0+ behavior
  //             note: Please be aware that this function expects to encode into UTF-8 encoded strings, as found on
  //             note: pages served as UTF-8
  //        example 1: urlencode('Kevin van Zonneveld!');
  //        returns 1: 'Kevin+van+Zonneveld%21'
  //        example 2: urlencode('http://kevin.vanzonneveld.net/');
  //        returns 2: 'http%3A%2F%2Fkevin.vanzonneveld.net%2F'
  //        example 3: urlencode('http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a');
  //        returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a'

  str = (str + '')
    .toString();

  // Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
  // PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
  return encodeURIComponent(str)
    .replace(/!/g, '%21')
    .replace(/'/g, '%27')
    .replace(/\(/g, '%28')
    .
  replace(/\)/g, '%29')
    .replace(/\*/g, '%2A')
    .replace(/%20/g, '+');
}

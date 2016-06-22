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
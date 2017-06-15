var t='https://m1.nedstatpro.net/nl/nedstatpro.gif?name=experimentaljets_1';
t+='&v=2.005h&_t='+(new Date()).getTime();var d=document;var n=navigator;var r='';
var f=0;if(top!=self){if('\u0041'=='A'){var u=n.userAgent;if(u.indexOf('Safari')==-1){
var b=u.indexOf('Opera');if(b==-1||(u.charAt(b+6)+0)>5){b=u.indexOf('Mozilla');
var v=b!=-1?u.charAt(b+8)>4:1;if(u.indexOf('compatible')!=-1||v){
var c='try{r=top.document.referrer}catch(e){f=1}';eval(c)}}}}}else{r=d.referrer}
var z=screen;if(z.availWidth>0){t+='&screen='+z.width+'x'+z.height;t+='&colordepth='
+z.colorDepth}var l=n.plugins.length;if(l){t+='&java='+n.javaEnabled()+'&plugins=';
for(var i=0;i<l;i++){t+=escape(n.plugins[i].description+'|')}}
if (f)t+='&foreignframe=1';else if(r)t+='&referrer='+escape(r);
if(d.images){var m=new Image();m.src=t;}else
d.write('<img src='+t+' width="1" height="1" align="right">');
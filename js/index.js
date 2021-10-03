function elementEvent(e){
	var targ;
	if (!e) var e = window.event;
	if (e.target) targ = e.target;
	else if (e.srcElement) targ = e.srcElement;
	if (targ.nodeType == 3) // defeat Safari bug
		targ = targ.parentNode;
	return targ;
}
function redimenciona(){
	var geral=document.getElementById('conteudo_geral').scrollHeight;
	var conteudo_site=document.getElementById('conteudo_site');
	conteudo_site.style.height=geral;
	
}
function trocar_foto(element){
	var endereco=element.src;
	var nome_arquivo="";
	var url="";
	var achou=false;
	for(var i=endereco.length-1;i>=0;i--){
		var letra=endereco.substring(i,i+1);
		if (((letra=="/")||(letra=="\\"))&&(!achou)){
			nome_arquivo=url;
			url="";
			achou=true;
		}
		url=letra+url;
	}
	nome_arquivo="g"+nome_arquivo.substring(1,endereco.length-1);
	endereco=url+nome_arquivo;
	//endereco=element.src;/*------------------------------------*/				
	document.getElementById('ampliar').src=endereco;
	document.getElementById('detalhes_foto').innerHTML=element.name;
}
function redimencionaMenuDinamico(){
	var x=countClassName("div","coluna_menu");
	document.getElementById('menu_dinamico').style.width=140*x;	
}
function countClassName(tag,classname){
	var tags=document.getElementsByTagName(tag)
	var acc=0;
	for(var i=0;i<tags.length;i++){
		if(tags[i].className==classname){
			acc++;
		}
	}
	return acc;
}
function loadPage(){
	redimencionaMenuDinamico();
	redimenciona();
}

$(function() {
				$('#gallery a').lightBox();
});
function buscar(id){
	return document.getElementById(id);
}
function load(){
	if (window.innerHeight)
		buscar("pagina").style.height=(f_clientHeight()-203)+"px";
	else
		buscar("pagina").style.height=(f_clientHeight()-218)+"px";
}

function f_clientHeight() {
	return ((window.innerHeight)? (window.innerHeight) : document.body.clientHeight);
}
function proximo(){
	roller=buscar("rolagem");
	var limite=roller.childNodes.length*149;
	if (limite>roller.scrollLeft)
		roller.scrollLeft=roller.scrollLeft+143;
	else
		roller.scrollLeft=0;
}
function anterior(){
	roller=buscar("rolagem");
	var limite=roller.childNodes.length*149;
	if (0<roller.scrollLeft)
		roller.scrollLeft=roller.scrollLeft-143;
	else
		roller.scrollLeft=limite
}
 
$(function() {
	$('#gallery a').lightBox();
});
function amplia(url){
	document.getElementById('foto_grande_produtos').src=url;
}
/* -- -- -- -- -- -- 버튼 -- -- -- -- -- -- */

function onBtn(i) {
	btn = eval('document.'+i);
	btn.src = 'img/i-pack/snowy/'+i+'_on.gif'
}

function offBtn(i) {
	btn = eval('document.'+i);
	btn.src = 'img/i-pack/snowy/'+i+'.gif'
}

/* -- -- -- -- -- -- 목록 -- -- -- -- -- -- */

function trOver(t) {
	t.background = '#FFE6FF';
}

function trOut(t) {
	t.background = '#FFFFFF';
}
var $ = jQuery;

$( document ).ready( function(){
	setInterval(function(){
		var iscolor = $('.elementor-control-qanva_cme_color .pcr-button').css('color');
		var isHcolor = $('.elementor-control-qanva_cme_color_hover .pcr-button').css('color');
		$('.prevpointer').css('background', iscolor);
		if($('#qmw').length < 1 || isHcolor != localStorage.getItem('qme-val')){
			$('#qmw').remove();
			$('<style id="qmw">.prevouter:hover > .prevpointer{background:' + isHcolor + ' !important}</style>').insertBefore('#qanvamousewrapper');
			localStorage.setItem('qme-val',isHcolor);
		}
		if($('#qmw').length == 1 && isHcolor != localStorage.getItem('qme-val')){
			$('#qmw').remove();
			$('<style id="qmw">.prevouter:hover > .prevpointer{background:' + isHcolor + ' !important}</style>').insertBefore('#qanvamousewrapper');
			localStorage.setItem('qme-val',isHcolor);
		}
		
		var isOutcolor = $('.elementor-control-qanva_cme_framecolor .pcr-button').css('color');
		$('.prevouter').css('border-color', isOutcolor);
		var isPointsize = $('.elementor-control-qanva_cme_pointersize .noUi-handle').attr('aria-valuetext');
		$('.prevpointer').css({'width': isPointsize + 'px','height': isPointsize + 'px','left':'calc(50% - ' + isPointsize/2 +'px)','top':'calc(50% - ' + isPointsize/2 +'px)'});
		var isOutsize = $('.elementor-control-qanva_cme_cursorsize .noUi-handle').attr('aria-valuetext');
		$('.prevouter').css({'width': isOutsize + 'px','height': isOutsize + 'px'});
	},100);
	
});
<TITLE><?php echo $HeadTitle; ?></TITLE>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<META name="language" content="<?php echo $_SESSION["LANGUE"]; ?>">
<META name="description" content="<?php echo $descPage; ?>">
<META name="robots" content="index, follow">
<LINK rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<LINK rel="stylesheet" media="all" type="text/css" href="css/style.css">
<LINK rel="stylesheet" media="all" type="text/css" href="css/textecharte.css">

<!--<LINK rel="stylesheet" media="all" type="text/css" href="css/stylebase.css">
<LINK rel="stylesheet" media="print" type="text/css" href="css/print.css">-->

<!-- Add Jquery -->
<SCRIPT type="text/javascript" src="js/jquery.js"></SCRIPT>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="css/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="css/fancybox/source/jquery.fancybox.css?v=2.1.3" type="text/css" media="screen" />
<script type="text/javascript" src="css/fancybox/source/jquery.fancybox.pack.js?v=2.1.3"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="css/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="css/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="css/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>

<link rel="stylesheet" href="css/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="css/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script type="text/javascript">	

$(document).ready(function () { // quand la page est chargée

	$(".popup").fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '50%',
			height		: '50%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none',
			ajax: {	
				type     : "POST",
				cache    : false,
				data	 : "var=Artcompix à votre service",
				success	 : function(data){ $.fancybox(data); },
			}
	});
	
	$("a.site").fancybox({ 			
		hideOnContentClick: true,
		padding: 0,
		overlayColor:'#D3D3D3',
		transitionIn:'elastic',
		transitionOut:'elastic',
		overlayOpacity: 0.7,
		zoomSpeedIn: 300,
		zoomSpeedOut: 300,
		width: 950,
		height: 400,
		type:'iframe'
		});

	$(".fancybox").fancybox();

});

function updateTextInput(val,compteur) {
    document.getElementById('textInput'+compteur).innerHTML=val;
    //$(#textInput+compteur).html()=val;
}
function updateStockInput(val,compteur) {
    document.getElementById('stockInput'+compteur).innerHTML=val;
    //$(#textInput+compteur).html()=val;
}
</script>
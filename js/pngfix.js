function IE_CorrectAlpha_PNG(){
	for(i = 0; i < document.images.length; i++){
		img = document.images[i];
		imgExt = img.src.substring(img.src.length - 3,img.src.length);
		imgExt = imgExt.toUpperCase();
		if(imgExt == "PNG"){
			imgID = (img.id) ? 'id="' + img.id + '" ' : '';
			imgClass = (img.className) ? 'class="' + img.className + '" ' : '';
			imgTitle = (img.title) ? 'title="' + img.title + '" ' : 'title="' + img.alt + '" ';
			imgStyle = "display: inline-block;" + img.style.cssText;
			if(img.align == "left")
				imgStyle = "float: left;"  + imgStyle;
			else if(img.align == "right")
				imgStyle = "float: right;" + imgStyle;
			if(img.parentElement.href)
				imgStyle = "cursor: hand;" + imgStyle;
			strNewHTML = '<span ' + imgID + imgClass + imgTitle + 'style="width: ' + img.width + 'px; height: ' + img.height + 'px; ' + imgStyle + '; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' + img.src + '\');"></span>';
			img.outerHTML = strNewHTML;
			i--;
		}
	}
}

var userAgent = navigator.userAgent;

if(userAgent.indexOf("MSIE") != -1)
	window.attachEvent("onload",IE_CorrectAlpha_PNG);
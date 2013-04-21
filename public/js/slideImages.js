$(function(){
	$('#main-gallery').crossSlide({
		sleep: 2,
		fade: 1
	}, [
	{src: 'public/img/site/MainPic-1.jpg'},
	{src: 'public/img/site/MainPic-2.jpg'},
	{src: 'public/img/site/MainPic-3.jpg'},
	{src: 'public/img/site/MainPic-4.jpg'},
	{src: 'public/img/site/MainPic-5.jpg'}
	]);
});
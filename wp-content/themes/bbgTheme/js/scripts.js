/* ============================== */
/*  DOCUMENT READY
 /* ============================== */

jQuery(document).ready(function ($) {
	$("#slides").owlCarousel({
		items               : 1,
		autoPlay            : true,
		slideSpeed          : 200,
		paginationSpeed     : 1200,
		pagination          : true,
		paginationNumbers   : false,
		navigation          : false,
		lazyLoad            : true,
		lazyFollow          : true,
		lazyEffect          : "fade",
		addClassActive      : true,
		itemsCustom         : false,
		singleItem          : true
/*		beforeMove          : function () {
			$('.owl-item .link').animate({ opacity: '0' }, 200);
		},
		afterMove           : function () {
			$('.owl-item .active .link').delay(1000).animate({ opacity: '1' }, 200);
		}*/
	});

});
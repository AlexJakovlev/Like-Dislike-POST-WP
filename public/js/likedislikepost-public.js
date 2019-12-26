(function ($) {
	'use strict';
	$(window).load(function () {
		$('.ip_post_likes').click(function (e) {
			
			const evet_elem = e.target;
			evet_elem.blur();
			$.ajax({
				url: $(evet_elem).data("url"),
				type: 'POST',
				data: 'action=post_likes&id=' + $(evet_elem).data("id"), 

				success: function (data) {
					console.log(data);
					var elem_p = "#ldp" + $(evet_elem).data("id") + ">p";
					data = JSON.parse(data);
					$(evet_elem).toggleClass("ldpcheket").text(data['button'])
					$(elem_p).text(data["title"]);
				}
			});
		});
	});
})(jQuery);
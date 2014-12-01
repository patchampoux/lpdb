function collapsible_block(object) {
	object.next().slideToggle("normal");
	object.toggleClass("selected");
	object.parent().toggleClass("collapsible_block_selected");
}

$(function(){
	// Collapsible blocks
	$(".collapsible_content").not('.open').hide();

	$("a.collapsible_link").click(function(e) {
		collapsible_block($(this));
		e.preventDefault();
	});

	// Pre-open a block if an anchor is present in the url
	var anchor = document.location.hash;
	if (anchor) {
		var blockId = anchor.substr(1, anchor.length);
		var objLink = $("#" + blockId).children("a.collapsible_link");
		collapsible_block(objLink);
	}

	// Submit a form on the keydown (otherwise it doesn't work in IE and Safari)
	$("input").keydown(function(e) {
		if (e.keyCode == 13) {
			$(this).parents("form").submit();
			return false;
		}
	});
});
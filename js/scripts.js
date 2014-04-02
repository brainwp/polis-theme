    jQuery(function($)
    {
		$('#categoriaschecklist input[type="checkbox"]').click(function () {
			$(this).parents('li').find('ul.children').toggle(this.checked);
		});
		
    });
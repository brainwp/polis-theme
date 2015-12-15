    jQuery(function($)
    {
		$('#categoriaschecklist input[type="checkbox"]').click(function () {
			$(this).parents('li').find('ul.children').toggle(this.checked);
		});
        function search_load(){
            if ($('#area-input').val().trim() == '') {
            }
        }
    });
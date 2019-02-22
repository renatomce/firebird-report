$("body").on("click", "#csv", function () {
	$('#tabela').each(function () {
			var $table = $(this);
            var csv = $table.table2CSV({
                delivery: 'value'
            });
            window.location.href = 'data:text/csv;charset=UTF-8,' 
			+ encodeURIComponent(csv);
		});
});
		
		<footer>
			<p class="text-primary">&copy; All Rights Reserved. Developed in Capstone Designing Project</p>
		</footer>


		</div> <!-- /right-container -->

	</div> <!-- /wrapper -->
	
</body>
</html>








<script>

	(function(){
	    'use strict';
		var $ = jQuery;
		$.fn.extend({
			filterTable: function(){
				return this.each(function(){
					$(this).on('keyup', function(e){
						$('.filterTable_no_results').remove();
						var $this = $(this), 
	                        search = $this.val().toLowerCase(), 
	                        target = $this.attr('data-filters'), 
	                        $target = $(target), 
	                        $rows = $target.find('tbody tr');
	                        
						if(search == '') {
							$rows.show(); 
						} else {
							$rows.each(function(){
								var $this = $(this);
								$this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
							})
							if($target.find('tbody tr:visible').size() === 0) {
								var col_count = $target.find('tr').first().find('td').size();
								var no_results = $('<tr class="filterTable_no_results"><td colspan="4">No results found</td></tr>')
								$target.find('tbody').append(no_results);
							}
						}
					});
				});
			}
		});
		$('[data-action="filter"]').filterTable();


		$('.sidebar ul li').click(function(){
			$(this).children('ul').slideToggle();
		});

	})(jQuery);

</script>
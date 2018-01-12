<script src="assets/js/bootstrap.min.js" type="text/javascript" charset="utf-8" async defer></script>
	<script	 type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="assets/js/moment-with-locales.js"></script>
	<script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.5.2/randomColor.min.js"></script>
	<script src="assets/js/chatcontrol.js"></script>
	<script>
	
	var color  = randomColor();
	document.getElementById("user-sv").style.color = color;
	
	</script>
	<script>
		window.setTimeout(
			function(){
				$(".special-alert").fadeTo(500, 0).slideUp(500,function(){
					$(this).remove();
				});
			},2000);
	</script>

	<script>
		moment.locale('az');
		$(document).ready(function(){
			setInterval(function(){
				$("#date").text(moment().format('llll'));
				},1000);
		});
		
	</script>


</body>
</html>
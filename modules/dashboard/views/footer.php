<script>
	// autocomplete address
    function initAutoComplete() { 
    	if ($("#address").length > 0) {
	      	new google.maps.places.Autocomplete(document.getElementById('address'));
    	}
      	if ($(".address-input").length > 0){
      		var input = document.getElementsByClassName('address-input');
      		for (var i = 0; i < input.length; i++) {
      			new google.maps.places.Autocomplete(input[i]);
      		}
      	}



    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5K8HOZwRPnmXdn66HmC_ecn-zqTNv3bY&libraries=places&callback=initAutoComplete" async defer></script>

</div></div>
</body>

</html>
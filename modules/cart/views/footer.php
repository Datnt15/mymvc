<script>
	// autocomplete address
    function initAutoComplete() { 
      var input = document.getElementById('address');
      var autocomplete = new google.maps.places.Autocomplete(input);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5K8HOZwRPnmXdn66HmC_ecn-zqTNv3bY&libraries=places&callback=initAutoComplete" async defer></script>

</div></div>
</body>

</html>
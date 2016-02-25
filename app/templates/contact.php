<section id="contact">
	<h1 class="main-title">Contact Us</h1>
	<div class="container">
		<div id="map"></div>
		<div class="row">
			<div id="info">
				<h4>Email</h4>
				<p>info@enseragalleryborneo.com</p>
				<h4>Phone</h4>
				<p>(+6)088-888-888</p>
				<h4>Gallery Hours</h4>
				<p>Tuesday - Saturday 11am - 6pm</p>
				<h4>Address</h4>
				<p>530 West 25th Street New York, NY 10001</p>
			</div>
			<form id="contact-form" method="post" action="/php/mail.php">
				<div class="label-wrapper"><label for="name">Name</label></div>
				<input type="text" name="name" placeholder="Name">
				<div class="label-wrapper"><label for="name">Email</label></div>
				<input type="email" name="email" placeholder="Email">
				<div class="label-wrapper"><label for="name">Subject</label></div>
				<input type="text" name="subject" placeholder="Subject">
				<div class="label-wrapper"><label for="name">Message</label></div>
				<textarea name="message" placeholder="Enter your message"></textarea>
				<div class="btn-wrapper"><input type="submit" value="Contact us!"></div>
			</form>
		</div>
	</div>
</section>

<script>
	function initMap() {
		var mapDiv = document.getElementById('map');
  		var myLatLng = {lat: 5.9843461, lng: 116.0779105};

		var map = new google.maps.Map(mapDiv, {
		  center: myLatLng,
		  zoom: 18
		});

		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map
		});
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
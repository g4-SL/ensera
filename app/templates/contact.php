<section id="contact">
	<div class="header-title">
		<h1>Contact Us</h1>
	</div>
	<div class="container">
		<div id="map"></div>
		<div class="row">
			<form>
				<div class="label-wrapper"><label for="name">Name</label></div>
				<input type="text" name="name" placeholder="Name">
				<div class="label-wrapper"><label for="name">Email</label></div>
				<input type="email" name="email" placeholder="Email">
				<div class="label-wrapper"><label for="name">Subject</label></div>
				<input type="text" name="subject" placeholder="Subject">
				<div class="label-wrapper"><label for="name">Message</label></div>
				<textarea name="message" placeholder="Enter your message"></textarea>
				<div class="btn-wrapper"><input type="submit" value="Submit"></div>
			</form>
			<div id="info">
				<h4>Email</h4>
				<p>info@agora-gallery.com</p>
				<h4>Phone</h4>
				<p>(+1)212-226-4151</p>
				<h4>Gallery Hours</h4>
				<p>Tuesday - Saturday 11am - 6pm</p>
				<h4>Address</h4>
				<p>530 West 25th Street New York, NY 10001</p>
			</div>
		</div>
	</div>
</section>

<script>
	function initMap() {
		var mapDiv = document.getElementById('map');
		var map = new google.maps.Map(mapDiv, {
		  center: {lat: 44.540, lng: -78.546},
		  zoom: 8
		});
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
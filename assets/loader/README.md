
# Overlay Cube #

A simple jQuery plugin to show progress overlay



**Requirements**

- jQuery
- Bootstrap (for design)

Reference the minified script and stylesheet.

	<link rel="stylesheet" href="dist/Overlay.min.css"/>
    <script src="dist/Overlay.min.js"></script>

And start by adding the HTML codes below

	<div data-overlay="YOUR_OVERLAY_ID_HERE">
	    <!-- Animated cube -->
	    <div class="cssload-container">
	        <div class="cssload-cube">
	            <div class="cssload-half1">
	                <div class="cssload-side cssload-s1"></div>
	                <div class="cssload-side cssload-s2"></div>
	                <div class="cssload-side cssload-s5"></div>
	            </div>
	            <div class="cssload-half2">
	                <div class="cssload-side cssload-s3"></div>
	                <div class="cssload-side cssload-s4"></div>
	                <div class="cssload-side cssload-s6"></div>
	            </div>
	        </div>
	    </div>
	    <!-- / Animated cube -->
	    <span data-overlay-msg></span>
	    <br>
	    <br>
	    <button class="btn btn-danger" data-overlay-btn>Cancel</button>
	</div>

Invoke your Overlay:

    Overlay.show('YOUR_OVERLAY_ID_HERE', 'Your progress message here');

	
Result:

![No image](http://i.imgur.com/DGUgBcu.png)


Hide your Overlay:

	Overlay.hide('YOUR_OVERLAY_ID_HERE');

You can also store XMLHttpRequest inside your Overlay and have it cancelled anytime.

	Overlay.show('YOUR_OVERLAY_ID_HERE', 'Your progress message here', $.ajax(...));

This allows the user to cancel the AJAX request you stored.
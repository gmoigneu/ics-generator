<html>
	<head>
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
		<link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
		<link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
		<link rel="stylesheet" href="/main.css">
	</head>
    <body>
		<main class="wrapper">
			<header class="header" id="home">
				<section class="container">
					<a href="/"><svg class="img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 548.291 548.291" style="enable-background:new 0 0 548.291 548.291;" xml:space="preserve"><g><path d="M486.201,196.124h-13.166V132.59c0-0.396-0.062-0.795-0.115-1.196c-0.021-2.523-0.825-5-2.552-6.963L364.657,3.677   c-0.033-0.031-0.064-0.042-0.085-0.073c-0.63-0.707-1.364-1.292-2.143-1.795c-0.229-0.157-0.461-0.286-0.702-0.421   c-0.672-0.366-1.387-0.671-2.121-0.892c-0.2-0.055-0.379-0.136-0.577-0.188C358.23,0.118,357.401,0,356.562,0H96.757   C84.894,0,75.256,9.651,75.256,21.502v174.613H62.092c-16.971,0-30.732,13.756-30.732,30.733v159.812   c0,16.968,13.761,30.731,30.732,30.731h13.164V526.79c0,11.854,9.638,21.501,21.501,21.501h354.776   c11.853,0,21.501-9.647,21.501-21.501V417.392h13.166c16.966,0,30.729-13.764,30.729-30.731V226.854   C516.93,209.872,503.167,196.124,486.201,196.124z M451.534,520.962H96.757v-103.57h354.776V520.962z M117.786,386.209V219.888   h37.746v166.322H117.786z M273.258,357.581c11.344,0,23.933-2.468,31.339-5.428l5.675,29.363   c-6.908,3.467-22.458,7.162-42.683,7.162c-57.502,0-87.114-35.78-87.114-83.168c0-56.759,40.47-88.35,90.812-88.35   c19.498,0,34.302,3.948,40.969,7.415l-7.653,29.859c-7.648-3.213-18.259-6.171-31.586-6.171c-29.861,0-53.056,18.019-53.056,55.026   C219.955,336.608,239.701,357.581,273.258,357.581z M376.431,316.373c-27.649-9.617-45.661-24.925-45.661-49.106   c0-28.378,23.691-50.1,62.931-50.1c18.756,0,32.573,3.947,42.441,8.394l-8.389,30.358c-6.671-3.213-18.51-7.896-34.804-7.896   c-16.288,0-24.179,7.402-24.179,16.029c0,10.62,9.376,15.302,30.846,23.439c29.365,10.865,43.182,26.163,43.182,49.602   c0,27.891-21.475,51.587-67.12,51.587c-19.002,0-37.752-4.937-47.139-10.122l7.647-31.086   c10.128,5.187,25.665,10.361,41.708,10.361c17.28,0,26.409-7.159,26.409-18.017C404.32,329.448,396.415,323.532,376.431,316.373z    M451.534,196.124H96.757V21.502h249.054v110.009c0,5.939,4.817,10.75,10.751,10.75h94.972V196.124z" fill="#933EC5"/></g></svg></a>
					<h1 class="title">ics generator</h1>
					<p class="description">A simple <code>.ics</code> file creation tool.<br><i><small>Currently v0.0.1</small></i></p>
				</section>
			</header>

			<section class="container">
		        <h3 class="title">Simply generate your ICS file!</h3>
		        <form action="/generate" method="post">
		        	<div class="form-element <?php echo (isset($errors) && $errors->has('name')) ? 'error' : '';?>">
			        	<label for="name">Event name: </label>
			        	<input type="text" name="name" placeholder="My wonderful event" value="<?php echo (isset($name) && $name != null) ? $name : ''; ?>"/>
						<?php if (isset($errors) && $errors->has('name')) : ?>
			        		<p class='error-message'><?php echo implode('. ', $errors->get('name')); ?></p>
			        	<?php endif; ?>
			        </div>

					<div class="form-element <?php echo (isset($errors) && $errors->has('start')) ? 'error' : '';?>">
			        	<label for="start">Start date: </label>
			        	<input type="text" name="start" value="<?php echo $startDate; ?>"  value="<?php echo (isset($start) && $start != null) ? $start : ''; ?>"/>
			        	<?php if (isset($errors) && $errors->has('start')) : ?>
			        		<p class='error-message'><?php echo implode('. ', $errors->get('start')); ?></p>
			        	<?php endif; ?>
			        </div>

					<div class="form-element <?php echo (isset($errors) && $errors->has('end')) ? 'error' : '';?>">
			        	<label for="end">End date: </label>
			        	<input type="text" name="end" placeholder="<?php echo $endDate; ?>" value="<?php echo (isset($end) && $end != null) ? $end : ''; ?>"/>
			        	<?php if (isset($errors) && $errors->has('end')) : ?>
			        		<p class='error-message'><?php echo implode('. ', $errors->get('end')); ?></p>
			        	<?php endif; ?>
					</div>

					<div class="form-element <?php echo (isset($errors) && $errors->has('timezone')) ? 'error' : '';?>">
						<label for="timezone">Timezone: </label>
			        	<select name="timezone">
			        		<?php
			        			foreach($timezones as $tz) {
			        				$selected = '';
			        				if (isset($timezone) && $timezone == $tz) {
			        					$selected = 'selected';
			        				}
									echo '<option ' . $selected . ' value="'.$tz.'">'.$tz.'</option>';
			        			}
			        		?>
			        	</select>
		        	</div>

					<div class="form-element <?php echo (isset($errors) && $errors->has('organizer')) ? 'error' : '';?>">
			        	<label for="organizer">Organizer email (optional): </label>
			        	<input type="text" name="organizer" placeholder="hello@example.com" value="<?php echo (isset($organizer) && $organizer != null) ? $organizer : ''; ?>"/>
			        	<?php if (isset($errors) && $errors->has('organizer')) : ?>
			        		<p class='error-message'><?php echo implode('. ', $errors->get('organizer')); ?></p>
			        	<?php endif; ?>
					</div>

					<div class="form-element <?php echo (isset($errors) && $errors->has('description')) ? 'error' : '';?>">
			        	<label for="description">Description: </label>
			        	<input type="text" name="description" placeholder="This can be a URL or a text" value="<?php echo (isset($description) && $description != null) ? $description : ''; ?>"/>
			        	<?php if (isset($errors) && $errors->has('description')) : ?>
			        		<p class='error-message'><?php echo implode('. ', $errors->get('description')); ?></p>
			        	<?php endif; ?>
					</div>

					<div class="form-element <?php echo (isset($errors) && $errors->has('location')) ? 'error' : '';?>">
			        	<label for="location">Location: </label>
			        	<input type="text" name="location" placeholder="Our company headquarters" value="<?php echo (isset($location) && $location != null) ? $location : ''; ?>"/>
			        	<?php if (isset($errors) && $errors->has('location')) : ?>
			        		<p class='error-message'><?php echo implode('. ', $errors->get('location')); ?></p>
			        	<?php endif; ?>
					</div>

					<div class="form-element">
			        	<label for="alarm">Alarm: </label>
			        	<select name="alarm">
			        		<option value="none">None</option>
			        		<option value="PT0S">At time of the event</option>
			        		<option value="-PT5M">5 minutes before</option>
			        		<option value="-PT10M">10 minutes before</option>
			        		<option value="-PT15M">15 minutes before</option>
			        		<option value="-PT30M">30 minutes before</option>
			        		<option value="-PT1H">1 hour before</option>
			        		<option value="-PT2H">2 hours before</option>
			        		<option value="-P1D">1 day before</option>
			        		<option value="-P2D">2 days before</option>
			        	</select>
		        	</div>

		        	<input type="submit" />
		        </form>
		    </section>

		    <footer class="footer">
		    	<section class="container">
		    		<p>Developed by <a href="https://guillaume.moigneu.com">Guillaume Moigneu</a> using the <a href="http://sabre.io/">Sabre.io libraries</a><br/>
		    		This site is using the wonderful <a href="http://milligram.io">Milligram CSS framework</a> designed by<a href="http://cjpatoilo.com" title="CJ Patoilo" target="_blank"> CJ Patoilo</a>.
		    		<br/>Licensed under the MIT License.</p>
		    	</section>
	    	</footer>
	    </main>
    </body>
</html>
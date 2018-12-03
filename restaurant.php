<?php /* Template Name: restaurant */ ?>

<?php get_header(); ?>

	<?php do_action( 'ocean_before_content_wrap' ); ?>

	<div id="content-wrap" class="container clr">

		<?php do_action( 'ocean_before_primary' ); ?>
			
			<html>
			<head>
				<link rel="stylesheet" type="text/css" href="restaurant.css">
			</head>

			<?php

			$db = new mysqli("...", "...", 
						 	"...","..."); #confidential
			if ($db->connect_error) {
				echo "Connect Error: " . $db->connect_error;
			}
			$sql = "SELECT rid, link, img_out
					FROM restaurants
					ORDER BY rid ASC";
			$result = mysqli_query($db,$sql);
			$num_rows = mysqli_num_rows($result);

			if ($num_rows > 0){ ?>
				<center>
					<h1>
						<span id="corners" style="background-color: rgba(255,255,255,0.75)">
							&nbsp <?php echo $num_rows?> Restaurants on Record. &nbsp
						</span>
					</h1>
				</center>
				<br>

				<?php
				while ( $row = $result->fetch_assoc() ){
				?>
					<div class="column" style="vertical-align:middle; text-align:center">
						<a href="<?php echo $row['link']?>">
							<table id="corners"  style="width:250px">
								<tr style="height:200px">
									<td valign="center">
										<center>
											<img src="<?php echo $row['img_out']?>" 
												 width="170" align="middle" alt="<?php $row['rid']?>">
										</center>
									</td>
								</tr>
								<tr>
									<td>
										<center><h4><?php echo $row['rid']?></h4></center>
									</td>
								</tr>
							</table>
						</a>
					</div>
				<?php	
				}
				$result->free();
			}
			?>
			
			</html>

	</div>

	<?php do_action( 'ocean_after_content_wrap' ); ?>

<?php get_footer(); ?>
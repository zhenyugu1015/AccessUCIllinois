<?php get_header(); ?>

	<div id="content-wrap" class="container clr">

		<?php 
			$current = $_SERVER['REQUEST_URI'];

			$db = new mysqli("...", "...", 
							 "...","..."); #confidential
			if ($db->connect_error) {
				echo "Connect Error: " . $db->connect_error;
			}
			$sql = "SELECT rid, link, acc_rating, cuisine, img_out, price, address, rating, 
					desig_park, nearby_park, near_bus, lvl_ground_ent, wide_ramp_entrance,
					short_ent_th, wide_doorway, ez_op_door, wide_oathway, accessible_condiments, 
					lg_kneespace, menu_braille_lgprint, service_animal, aud_vis_alarm, acc_wc_sign, 
					ez_op_wcdoor, wide_wcdoorway, wide_aisleway, wide_stall_door, toilet_ht, grab_bar, 
					stall_length, stall_width, low_basin, sink_kneespace, access_soap, ez_faucet
					FROM restaurants
					WHERE link LIKE '%$current%'";
			$result = mysqli_query($db,$sql);
			$row = $result->fetch_assoc();
		?>

		<html>
			<head>
				<link rel="stylesheet" type="text/css" href="individual.css">
			</head>

			<center>
				<h1>
					<span id="corners" style="background-color: rgba(255,255,255,0.75)">
						&nbsp<?php echo $row['rid']?>&nbsp
					</span>
				</h1>
			</center>

			<table id="corners" style="width:100%">
				<tr style="height:250">
					<th width="10%"></th>
					<th width="30%">
						<center>
							<img src="<?php echo $row['img_out']?>" 
								 width="350" align="middle" alt="<?php $row['rid']?>">
						</center>
					</th>
					<th width="10%"></th>
					<th>
						<br/>
						<b>
						<font size="+1">Cuisine: <font color="#2f4f4f"><?php echo $row['cuisine']?></font></font><br/>
						<font size="+1">Accessibility Rating: <?php 
							if($row['acc_rating']=="Excellent"){?>
								<font color="green"><?php echo $row['acc_rating'];?></font>
							<?php
							}else if($row['acc_rating']=="Good"){?>
								<font color="goldenrod"><?php echo $row['acc_rating'];?></font>
							<?php
							}else{?>
								<font color="red"><?php echo $row['acc_rating'];?></font>
							<?php
							}
							?>
						</font><br/>
						<font size="+1">Price: <?php 
							if($row['price']==1){?>
								<font color="green"><?php echo str_repeat("$",$row['price']);?></font>
							<?php
							}else if($row['price']==2){?>
								<font color="goldenrod">
									<?php echo str_repeat("$",$row['price']);?>
								</font>
							<?php
							}else if($row['price']==3){?>
								<font color="red"><?php echo str_repeat("$",$row['price']);?></font>
							<?php
							}else{?>
								<font color="red"><?php echo "N/A";?></font>
							<?php
							}
							?>
						</font><br/>
						<font size="+1">Location: <font color="#2f4f4f"><?php echo $row['address']?></font></font><br/>
						<font size="+1">Yelp rating: <?php 
							if($row['rating']>=4){?>
								<font color="green"><?php echo $row['rating'];?></font>
							<?php
							}else if($row['rating']<4 && $row['rating']>=3){?>
								<font color="goldenrod"><?php echo $row['rating'];?></font>
							<?php
							}else{?>
								<font color="red"><?php echo $row['rating'];?></font>
							<?php
							}
							?>
						</font>
						</b>
						<br/><br/>
					</th>
				</tr>
			</table>
			<br/>

			<center>
				<h1>
					<span id="corners" style="background-color: rgba(255,255,255,0.75">
						&nbsp Restaurant Accesibility Detail &nbsp
					</span>
				</h1>
			</center>
			<table id="corners">
				<?php
					$sql2 = "SELECT var, quest
								FROM survey";
					$result2 = mysqli_query($db,$sql2);
					$row2 = $result->fetch_assoc();
					while ($row2 = $result2->fetch_assoc() ){?>
						<tr>
							<th width="5%">
							</th>
							<th width="85%">
								<font size="+1">
									<b><?php echo $row2['quest'];?></b>
								</font>
							</th>
							<th width="10%">
							<?php 
								$v2 = $row2['var'];
								$v1 = $row["$v2"];
								if ($v1=="T"){
									print("<font size=\"+1\" color=\"green\"><b>Yes</b></font>");
								}else if($v1=="F"){
									print("<font size=\"+1\" color=\"red\"><b>No</b></font>");
								}else if(is_numeric($v1)){
									print("<font size=\"+1\" color=\"blue\"><b>".$v1."\"</b></font>");
								}else{
									print("<font size=\"+1\"><b>N/A</b></font>");
								}
							?>
							</th>
						</tr>
				<?php
					}
				?>
			</table>
		</html>
	</div>

<?php get_footer(); ?>

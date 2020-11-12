<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Edit Entrance | BS'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = ''; ?>
	<?php include ('includes/navbar.php'); ?>

	<div class="admin-container-wrapper" style="padding-top: 7em !important;">
		<div class="container">
			<?php
				if (isset($_GET['r']) & isset($_GET['ty'])) {
					$report_msg = $_GET['r'];
					$report_type = $_GET['ty'];
					echo '<div class="text-center alert alert-'.$report_type.'">'.strtoupper($report_msg).'</div>';
				}
			?>
			<div class="row">

				<?php $user_panel_nav = 'posted-jobs'; ?>
				<?php include ('includes/user_panel.php'); ?>

				<div class="col-md-9 col-sm-8 col-xs-12">
					<div class="admin-content-wrapper">

						<div class="admin-section-title">
							<h2>Edit Job</h2>
						</div>

						<?php 
							if (isset($_GET['edit'])) {

								require('../php/connect.php');

								$job_id = $_GET['edit'];

								$count_job = "SELECT COUNT(*) FROM tbl_jobs WHERE job_id = '$job_id' AND job_company = '$sess_comp_member_no'";
								$count_job_code = mysqli_query($connection, $count_job);
								$count_job_get = mysqli_fetch_array ($count_job_code);
								$count_job_res = array_shift($count_job_get);

								if ($count_job_res == "0") {

									header("location:posted-jobs");
								} else {

									$get_job_details = "SELECT * FROM tbl_jobs WHERE job_id = '$job_id'";
									$run_job_details = mysqli_query($connection, $get_job_details);

									while ($row_job_details = mysqli_fetch_array($run_job_details)){

										$job_title				= $row_job_details['job_title'];
										$job_city_town			= $row_job_details['job_city_town'];
										$job_category			= $row_job_details['job_category'];
										$job_deadline_date		= $row_job_details['job_deadline_date'];
										$job_type				= $row_job_details['job_type'];
										$job_experience			= $row_job_details['job_experience'];
										$job_description		= $row_job_details['job_description'];
										$job_responsibilities	= $row_job_details['job_responsibilities'];
										$job_requirements		= $row_job_details['job_requirements'];

										?>
										<form class="post-form-wrapper" action="php/update-job" method="POST">
											<input type="text" name="id" hidden value="<?php echo $job_id; ?>">

											<div class="col-sm-8 col-md-8">
												<div class="form-group">
													<label>Entrance Title</label>
													<input name="job_title" required type="text" class="form-control" value="<?php echo $job_title; ?>" placeholder="Enter job title">
												</div>
											</div>

											<div class="col-sm-8 col-md-8">
												<div class="form-group">
													<label>City/Town</label>
													<input name="job_city_town" required type="text" class="form-control" value="<?php echo $job_city_town; ?>" placeholder="E.g Lagos - Ikeja">
												</div>
											</div>

											<!-- <div class="col-sm-8 col-md-8">
												<div class="form-group">
													<label>Job Category</label>
													<input name="job_category" required type="text" class="form-control" value="<?php echo $job_category; ?>" placeholder="E.g Trading, Clothing, Corporate, Marketing, Accounting etc">
													 <input list="category" name="job_category" required type="text" class="form-control" placeholder="Enter job category"> 
													<datalist id="category">
														<?php

															// require('../php/connect.php');

															// $get_job_cat = "SELECT * FROM tbl_categories ORDER BY category";
															// $run_job_cat = mysqli_query($connection, $get_job_cat);

															// while ($row_job_cat = mysqli_fetch_array($run_job_cat)){ 
															?><option value="<?php //echo $row_job_cat['category']; ?>">
														<?php //}
														?>
													</datalist>
												</div> -->
											</div>

											<div class="col-sm-8 col-md-8">
												<div class="form-group">
													<label>Application Deadline</label>
													<!-- <input name="job_deadline_date" required type="text" class="form-control" placeholder="Eg: 30/12/2018"> -->
													<input name="job_deadline_date" required type="text" class="form-control" value="<?php echo $job_deadline_date; ?>" placeholder="Choose a deadline date" id="deadline_date">
												</div>
											</div>

											<div class="row" style="margin-right: 0px; margin-left: 0px; ">
												<div class="col-sm-6 col-md-6">
													<div class="form-group">
													<label>School Section</label>
													<select name="job_type" required class="form-control">
														<option value="">-Select school section-</option>
														<!-- <option value="Full-time">Full-time</option> -->
														<option value="Primary/Elementary">Primary/Elementary</option>
														<option value="Secondary/Middle/High">Secondary/Middle/High</option>
													</select>
												</div>
											</div>

												<div class="col-sm-6 col-md-6">
													<div class="form-group">
														<label>Class</label>
														<select name="job_experience" required class="form-control">
															<option value="">-Select class-</option>
															<option value="All Primary Classes">All Primary Classes</option>
															<option value="Year 7/ JSS 1">Year 7/ JSS 1</option>
															<option value="Year 10/ SS 1">Year 10/ SS 1</option>
															<!-- <option value="5 Years">5 Years</option>
															<option value="Expert">Expert</option> -->
														</select>
													</div>
												</div>
											</div>

											<div class="col-sm-12 col-md-12">
												<div class="form-group">
													<label>Entrance Description <i class="fa fa-info-circle" data-toggle="tooltip" title="Enter a short description about the job to help people know more about the job"></i> </label>
													<textarea name="job_description" required class="form-control" minlength="10" placeholder="Enter entrance description ..." style="height: 200px;"><?php echo $job_description; ?></textarea>
												</div>
											</div>

											<!-- <div class="col-sm-12 col-md-12">
												<div class="form-group">
													<label>Job Responsibilities </label>
													<textarea name="job_responsibilities" required class="form-control" minlength="100" placeholder="Enter job responsibilities ..." style="height: 200px;"><?php echo $job_responsibilities; ?></textarea>
												</div>
											</div> -->

											<div class="col-sm-12 col-md-12">
												<div class="form-group">
													<label>Entrance Requirements </label>
													<textarea name="job_requirements" required class="form-control" minlength="10" placeholder="Enter entrance requirements ..." style="height: 200px;"><?php echo $job_requirements; ?></textarea>
												</div>
											</div>

											<div class="col-sm-12 mt-10">
												<button type="submit" class="btn btn-primary" name="update-job">Update Entrance</button>
												<button type="reset" class="btn btn-primary btn-inverse">Cancel</button>
											</div>
										</form>
										<?php

									}
								}
							} else {

								header("location:./");
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include ('includes/footer.php'); ?>

</body>
</html>
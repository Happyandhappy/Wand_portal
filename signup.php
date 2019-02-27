<?php
include ("layout/header.php");
?>

	<div class="container-fluid page-body-wrapper full-page-wrapper signuppage">
	  	<div class="content-wrapper d-flex align-items-center auth px-0">
		    <div class="row w-100 mx-0">
		      	<div class="col-lg-8 mx-auto">
			        <div class="auth-form-light text-left py-5 px-4 px-sm-5 mt-5">
			          	<div class="brand-logo">
			            	<img src="https://s3-us-west-2.amazonaws.com/hipaadev/images/a0C55000003Ua0QEAS.jpg" alt="logo">
			          	</div>

			          	<h4>New here?</h4>
			          	<h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
			          	<form class="pt-3" id="signupform">
			          		<input type="hidden" name="Organization_Info" value="<?php echo ORGID;?>">
			          		<input type="hidden" name="action" value="signup">
			          		
			          		<div class="row">
				            	<!-- First Name -->
			            		<div class="col-md-6">
					            	<div class="form-group">
					            		<label>First Name<span class="redmark">*</span></label>
					              		<input type="text" class="form-control form-control-lg" name="First_Name" required="">
					            	</div>
				            	</div>
				            	<!-- Last Name -->
			            		<div class="col-md-6">
					            	<div class="form-group">
					            		<label>Last Name<span class="redmark">*</span></label>
					              		<input type="text" class="form-control form-control-lg" name="Last_Name" required="">
					            	</div>
				            	</div>
					        </div>

					        <div class="row">
					        	<div class="col-md-6">
					            	<!-- Email address -->
					            	<div class="form-group">
					            		<label>Email Address <span class="redmark">*</span></label>
					              		<input type="email" class="form-control form-control-lg" name="Email" required="">
					            	</div>
					            </div>
					            <div class="col-md-6">
					            	<!-- Phone number -->					            	
					            	<div class="form-group">
					            		<label>Mobile Phone</label>
					              		<input type="phone" class="form-control form-control-lg" name="Mobile_Phone">
					            	</div>
			            		</div>
			            		<div class="col-md-6">
					            	<!-- Phone number -->					            	
					            	<div class="form-group">
					            		<label>Work Phone</label>
					              		<input type="phone" class="form-control form-control-lg" name="Work_Phone">
					            	</div>
			            		</div>
			            		<div class="col-md-6">
					            	<!-- Phone number -->					            	
					            	<div class="form-group">
					            		<label>Title</label>
					              		<input type="phone" class="form-control form-control-lg" name="Title">
					            	</div>
			            		</div>
			            	</div>

					        <div class="row">
				            	<!-- Address 1-->
				            	<div class="col-md-6">
					            	<div class="form-group">
					            		<label>Address 1</label>
					              		<input type="text" class="form-control form-control-lg" name="Address_1">
					            	</div>
					            </div>
					            <!-- Address 2-->
					            <div class="col-md-6">
					            	<div class="form-group">
					            		<label>Address 2</label>
					              		<input type="text" class="form-control form-control-lg" name="Address_2">
					            	</div>
					            </div>
					        </div>
					        <div class="row">
			        			<input type="hidden" value="<?php echo Legal_Organization_Name ;?>" name="Legal_Organization_Name">
			        			<input type="hidden" name="Organization_Name" value="">
					        </div>					        
					        <div class="row">
					        	<div class="col-md-6">
					            	<div class="form-group">
					            		<label>City</label>
					              		<input type="text" class="form-control form-control-lg" name="City">
					            	</div>
					        	</div>
					        	<div class="col-md-6">
					            	<div class="form-group">
					            		<label>State</label>
					              		<input type="text" class="form-control form-control-lg" name="State">
					            	</div>
					        	</div>
					        	<div class="col-md-6">
					            	<div class="form-group">
					            		<label>Zip</label>
					              		<input type="text" class="form-control form-control-lg" name="Zip">
					            	</div>
					        	</div>
					        	<input type="hidden" class="form-control form-control-lg" name="Lead_Website">
					        	<!-- <div class="col-md-6">
					            	<div class="form-group">
					            		<label>Website URL</label>					              		
					            	</div>
					        	</div> -->
			            		<div class="col-md-6">
					            	<!-- date of birth -->
					            	<!-- <div class="form-group">
					            		<label>Date of birth</label>
			    	                  	<div id="datepicker-popup" class="input-group date datepicker">
					                        <input type="text" class="form-control">
					                        	<span class="input-group-addon input-group-append border-left">
					                          	<span class="far fa-calendar input-group-text"></span>
					                        </span>
				                    	</div>
				                    </div> -->
				                </div>
				            </div>	


		            		<div class="mb-4">
				              	<div class="form-check">
					                <label class="form-check-label text-muted">
					                  	<input type="checkbox" class="form-check-input" required="">
					                  I agree to all Terms & Conditions 
					                </label>
			              		</div>
			            	</div>
			            	<div class="alert alert-none" id="alert"></div>                    			
				            <div class="mt-4">
				              	<button type="submit" id="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"> SIGN UP </button>
				            </div>				            
<!-- 				            <div class="text-center mt-4 font-weight-light">
				              	Already have an account? <a href="login.html" class="text-primary">Login</a>
				            </div> -->
			          	</form>
			        </div>
		      	</div>
		    </div>
	  	</div>
	  <!-- content-wrapper ends -->
	</div>
	<!-- page-body-wrapper ends -->

<?php include "layout/footer.php" ;?>

<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<main id="main">
	<!-- ======= Values Section ======= -->
	
	<section id="values" class="values about">

	  <div class="container" >

	    <header class="section-header ">
	      <h2>Task for Today</h2>
	      <p> <?=($user_row->name)?></p>
	    </header>
	   
	    	
		    <div class="row justify-content-center ">

		      <div class="col-lg-12">
		        <div class="box text-center">
		        	<div class="error-message">
		        	<?php if(Auth::logged_in() && $username == Auth::getUser('username')): ?>
		        			<?php if(message() || (count($errors)>0)): ?>
		        				<div class="alert alert-<?=alertSetter($error)?> mt-4" role="alert">
		        				  <i><?=message('',true)?></i>
			              		  <?php foreach ($errors as $errors):?>
			              		  		<i><?=$errors?></i>
			              		  <?php endforeach; ?>
		        				</div>
		        			<?php endif; ?>
		        		</div>
		        			<form method="post" action="" enctype="multipart/form-data">
				          <table class="table border	">
				            <thead>
				              <tr>
				                <th scope="col" colspan="99">
				                	<label>
					                	<img class="js-profile-image" src = "<?=ROOT?>/assets/img/profile/1666142765face-compressed.jpg" style='height: 200px; width: 200px; object-fit: cover;' class="rounded-circle">
					                	<p><?=esc($user_row->name)?></p>
					                	<input onchange='load_image(this.files[0])' class="image-upload" type="file" name="image" style="display: none;">
				                </label>
				                </th>
				              </tr>
				            </thead>
				            <tbody>
				            	<tr>
				            		<td><label class="form-label">Email</label></td>
				            		<td><input type="email" class="form-control" name="email" value=<?=esc(setValue('email',$user_row->email))?>></td>
				            	</tr>
				            	<tr>
				            		
				            		<td><label class="form-label">Username</label></td>
				            		<td><input type="text" class="form-control" name="username" value=<?=esc(setValue('username',$user_row->username))?>></td>
				            	</tr>
					            <tr>
					            		
					            		<td><label class="form-label">Name</label></td>
					            		<td><input type="text" class="form-control" name="name" value="<?=esc(setValue('name',$user_row->name))?>"></td>
					            </tr>
					            <tr>
					            	<td colspan="99">
					            		<div class="js-prog progress hide my-3">
					            		  <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
					            		</div>
					            	</td>
					            </tr>
					            
					         
				            <th scope="col" colspan="99">
				            	  <div class="text-center text-lg-center">
				            	    <button type="button" class="btn-read-more align-items-center justify-content-center align-self-center" onclick="save_profile(event)">
				            	      <span>Update</span>
				            	      <i class="bi bi-arrow-right"></i>
				            	    </button>
				            	</div>
				            	
				            </tbody>

				          </table>
				      </form>
				    <?php else: ?>

				    		<table class="table border	">
				            <thead>
				              <tr>
				                <th scope="col" colspan="99"><label><img src = "<?=ROOT?>/<?=$user_row->image?>"  style='height: 250px; width: 250px; object-fit: cover;' class="rounded-circle">
				                	<p><?=esc($user_row->name)?></p>
				                </th>
				              </tr>
				            </thead>
				            <tbody>
				            	<tr>
				            		<td><label class="form-label">Email</label></td>
				            		<td><?=esc($user_row->email)?></td>
				            	</tr>
				            	<tr>
				            		
				            		<td><label class="form-label">Username</label></td>
				            		<td><?=esc($user_row->username)?> </td>
				            	</tr>
				            	
				            	
				            </tbody>
				          </table>

		          	<?php endif; ?>

		        </div>
		      </div>
		  	</div>

	 
	  </div>

	</section><!-- End Values Section -->


</main>
<script type="text/javascript">
	var progressBar = document.querySelector(".js-prog");
	function load_image(file)
	{
		file = window.URL.createObjectURL(file);
		document.querySelector(".js-profile-image").src = file;
	}

	//Image Upload Progress file

	function save_profile(e)
	{
		var images = document.querySelector(".image-upload");
		var form = e.currentTarget.form;
		var imageAdded = false;
		var inputs = form.querySelectorAll('input');
		var obj = {};
		var allowed = ['jpg','jpeg','png'];
		for (var i = 0; i < inputs.length; i++)
		 {
			var key = inputs[i].name;
			if(key=="image" && typeof inputs[i].files[0] == "object")
			{
				obj[key]=inputs[i].files[0];
				imageAdded = true;
			}
			else
				obj[key] = inputs[i].value;
		}

		if(imageAdded)
		{
			if(typeof obj.image == 'object')
			{
				var ext = obj.image.name.split('.').pop();

			}

			if(!allowed.includes(ext.toLowerCase()))
			{
				
				alert("Only jpeg and png allowed");
				return;
			}
		}
		

		//console.log(obj);
		//return;
		send_data(obj);

	}

	function send_data(obj)
	{	
		
		progressBar.children[0].style.width = "0%";
		progressBar.classList.remove('hide');
		

		
		var ajax = new XMLHttpRequest();
		var myForm = new FormData();
		for (key in obj)
		{
			myForm.append(key,obj[key]);
		}

		ajax.addEventListener('readystatechange', function(){
			if(ajax.readyState == 4)
			{
				if(ajax.status == 200)
				{
					//alert("Upload Complete");
					//window.location.reload();
					progressBar.children[0].innerHTML = "Updated";
					progressBar.children[0].style.background = "green";
					handleResult(ajax.responseText);
				}
				else
				{
					alert("Something went wrong");
				}
			}
		});

		ajax.upload.addEventListener('progress', function(e){
			
			//alert("hello");
			var percent = Math.round((e.loaded / e.total ) * 100);
			progressBar.children[0].style.width = percent + "%";
			progressBar.children[0].innerHTML = "Saving " + percent + "%";
		}); 
		
		
		ajax.open('post','',true);
		ajax.send(myForm);
		
	}
	function handleResult(result)
	{
		//console.log(result);
		var obj = JSON.parse(result);
		if(typeof obj == 'object')
		{
			if(typeof obj.error == 'object')
			{
				document.querySelector(".error-message").style.display="block";
				show_errors(obj.error);
				progressBar.children[0].innerHTML = "Errors!";
				progressBar.children[0].style.background = "Red";
			}
			else
			{
				document.querySelector(".error-message").style.display="none";
				show_success(obj.message);
			}
		}
	}

	function show_errors(errors)
	{
		document.querySelector(".error-message").innerHTML = "<div class='alert alert-danger mt-4' role='alert'>";
		for(error in errors)
		{
			
			document.querySelector(".error-message").children[0].innerHTML += errors[error];
		}
		document.querySelector(".error-message").innerHTML+="</div";
	}
</script>	

<?php $this->view('includes/footer',$data) ?>
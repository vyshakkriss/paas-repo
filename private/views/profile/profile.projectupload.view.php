	<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<main id="main">
	<!-- ======= Values Section ======= -->
	<section id="about" class="about">
	<?php $noprojectmsg = "You do not have any project uploaded."; ?>
	  <div class="container" >
		<header class="section-header py-3">
			<h3>Title of your Project</h3>
	      <h2><?=empty($project_row) ? '<span style="color:red">'.$noprojectmsg.'<br> Upload Abstract' : $project_row[0]->projectname?></h2>

	      <?php if(empty($project_row[0])): ?>
	      	  <div class="text-center text-lg-center my-4">
	      	   <a href="<?=ROOT?>/projectupload/abstract"><button type="submit" class="border-0 btn-read-more align-items-center justify-content-center align-self-center">
	      	      <span>Upload an Abstract</span>
	      	      <i class="bi bi-arrow-right"></i>
	      	    </button>
	      		</a>
	      	</div>
	     

	      <?php endif; ?>
	    </header>

      <?php if(message()): ?>
      	<div class="alert alert-danger mt-4 text-center" role="alert">
      	  <i><?=message('',true)?></i>
      	</div>
      <?php endif; ?>

      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="box text-center">
          	<?php if(!empty($project_row)) : ?>
          	Your Uploaded Works!
          	<table class="table">
          	  <thead>
          	    <tr>
          	     
          	      <th scope="col">Project Topic </th>
          	      <th scope="col" >Upload</th>
          	      <th scope="col" >View File</th>
          	    </tr>
          	  </thead>
          	  <tbody style="font-size:14px">

          	  	<?php foreach ($stage_row as $stage): ?>
          	  				<tr>
          	  				
          	  						<td><?=$stage->stagename; ?></td>
          	  						<td>
          	  							<?php $stageurl = $stage->stageurl; ?>
          	  							
          	  							<?php if($stage->stageid <= $stage->project_row->stage): ?> 
          	  									<?php if($stage->stageid == $stage->project_row->stage && $stage->project_row->stage != 6):?>
	          	  									<button class="btn btn-success rounded-circle">
	          	  								<a style="color: white" href="<?=ROOT?>/document/<?=$stage->project_row->uid?>/<?=lcfirst($stage->stageurl)?>/<?=$stage->stageid?>"><i class="bi bi-cloud-plus-fill"></i>
	          	  							</button>
	          	  								<?php else: ?>
	          	  									<button class="btn btn-success rounded-circle">
	          	  										<i class="bi bi-patch-check-fill"></i>
	          	  									</button>
	          	  								<?php endif; ?>
          	  								<?php else:?>
          	  									<button class="btn btn-danger rounded-circle">
          	  								<i class="bi bi-x-circle-fill"></i>
          	  							</button>
          	  									
          	  							
          	  							
          	  							<?php //else: ?>
          	  							<!-- 	<button class="btn btn-danger rounded-circle">
          	  								<i class="bi bi-x-circle-fill"></i>
          	  							</button> -->
          	  							<?php endif; ?>	
          	  						</td>
          	  						<td>
          	  							<?php if(!empty($stage->project_progress_row) && $stage->stageid <= $stage->project_row->stage): ?> 
							  								<?php $stageurl = $stage->stageurl; ?>
															<?php if($stage->stageid <= $stage->project_progress_row->stage)	:?>
							          	  										
																<a href="<?=ROOT?>/document/<?=$stage->project_row->uid?>/<?=$stage->stageurl?>/<?=$stage->stageid?>">View <?=$stage->stagename?></a>
														
																<?php else:?>
																<?php if($stage->project_row->stage != 6):?>
																		<?=$stage->stagename?> not Uploaded
																	<?php else: ?>
																		<a href="<?=ROOT?>/document/<?=$stage->project_row->uid?>/fulldocument">View Document</a>
																	<?php endif; ?>
															<?php endif; ?>
														<?php else: ?>
															---
															<?php endif; ?>
          	  						</td>
          	  				</tr>
          	  	<?php endforeach; ?>
          	  </tbody>
          	</table>
          <?php endif; ?>
          </div>
         </div>
      </div>
	         
	      	
</main>

	

<?php $this->view('includes/footer',$data) ?>
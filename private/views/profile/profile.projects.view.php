	<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<main id="main">
	<!-- ======= Values Section ======= -->
	<section id="about" class="about">

	  <div class="container" >
		<header class="section-header py-3">
	      <h3>Central Project Database</h3>
	      <p style="font-size: 12px;">See what others are doing!</p>
	    </header>

	          <?php if(message()): ?>
	          	<div class="alert alert-danger mt-4 text-center" role="alert">
	          	  <i><?=message('',true)?></i>
	          	</div>
	          <?php endif; ?>
	         <div class="row justify-content-center">
	         	<H3> Approved Projects</H3>
	          <div class="col-lg-12">
	            <div class="box text-center">
	              <table class="table">
	                <thead style="font-size: 12px;">
	                  <tr>
	                    <th scope="col">#</th>
	                    <th scope="col" >Project</th>
	                    <th scope="col" >Student</th>
	                    <th scope="col" >Guide</th>
	                  </tr>
	                </thead>
	                <tbody style="font-size:12px">
	                <?php $i = 0; ?>
	                <?php if(!empty($approved_projects_row)): ?>
	                	<?php foreach($approved_projects_row as $approvedrojects):?>
	                	<tr>
	                		<td> <?php echo ++$i?></td>
	                		<td> <?=$approvedrojects->projectname?> </td>
	                		<td> <?=!empty($approvedrojects->student_row->name) ? $approvedrojects->student_row->name : $approvedrojects->student_row->username?> </td>
	                		<td> <?=$approvedrojects->guide_row->name?> </td>
	                	</tr>
	                	<?php endforeach; ?>
	                <?php else: ?>
	                	<tr><th colspan="99"> No Projects Approved Yet! </th></tr>
	                <?php endif; ?>
	                </tbody>
	              </table>
	              
	            </div>

	          </div>
	      	</div>


	      	<div class="row justify-content-center">
	         	<H3> Non Approved Projects</H3>
	          <div class="col-lg-12">
	            <div class="box text-center">
	              <table class="table">
	                <thead style="font-size: 12px;">
	                  <tr>
	                    <th scope="col">#</th>
	                    <th scope="col" >Project</th>
	                    <th scope="col" >Student</th>
	                    <th scope="col" >Guide</th>
	                  </tr>
	                </thead>
	                <tbody style="font-size:12px">
	                <?php $i=0; ?>
	                <?php if(!empty($non_approved_projects_row)): ?>
	                	<?php foreach($non_approved_projects_row as $non_approvedrojects):?>
	                	<tr>
	                		<td> <?php echo ++$i?></td>
	                		<td> <?=$non_approvedrojects->projectname?> </td>
	                		<td> <?=!empty($non_approvedrojects->student_row->name) ? $non_approvedrojects->student_row->name : $non_approvedrojects->student_row->username?> </td>
	                		<td> <?=$non_approvedrojects->guide_row->name?> </td>
	                	</tr>
	                	<?php endforeach; ?>
	                <?php else: ?>
	                	<tr><th colspan="99"> No Projects Approved Yet! </th></tr>
	                <?php endif; ?>
	                </tbody>
	              </table>
	              
	            </div>

	          </div>
	      	</div>
	</section>
</main>

	

<?php $this->view('includes/footer',$data) ?>
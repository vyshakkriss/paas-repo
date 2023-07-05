	<?php 

/**
 * Home Controller
 */
class Document extends Controllers
{
	
	public function index($user_id="",$id="",$stageid="")
	{
		// code...
		$data['title'] ="Document";
		
		if(Auth::logged_in())
		{
			
			$uid = Auth::getUser('user_id');
			$projects_progress = new Projectprogress();
			$project = new Project();
			$uploads = new Uploads();
			$stages = new Stages();
			if($id=='abstract')
			{
				$data['id'] = 'Abstract';
				
			}
			if($id=='objective')
			{
				$data['id'] = 'Objective';
				
			}
			if($id=='software_specification')
			{
				$data['id'] = 'Software_specification';
				
			}
			if($id=='hardware_specification')
			{
				$data['id'] = 'Hardware_specification';
				
			}
			if($id=='conclusion')
			{
				$data['id'] = 'Conclusion';
				
			}
			
			if($_POST)
			{
				//show($_POST);
				
				if(Auth::getUser('role')==3)
				{
					$pid = $project->where(['uid'=>$uid])[0]->pid;
					$col = key($_POST);
					
					//show($_POST);
					//die();
					//$uploads->update($_POST,['uid'=>$uid]);
					$gid = $project->where(['uid'=>$uid])[0]->gid;
					$stage = $project->where(['uid'=>$uid])[0]->stage;
					$stagename = $stages->where(['stageid'=>$stage])[0]->stagename;
					$stagecontent = $_POST[$col];
					$date = date("Y/m/d");
					$post = [
						'gid'=>$gid,
						'uid'=>$uid,
						'pid'=>$pid,
						'stage'=>$stage,
						'date'=>$date,
						'stagecontent'=>$stagecontent,
						'remark'=>'Pending for review',
						'stagename'=>$stagename
					];
					//show($col);
					//echo $stage,$stagename,$gid;
					
					//$uploads->update($_POST,['uid'=>$uid]);
					$projects_progress->insert($post);
					message("Uploaded Successfully!", true);

				}
				else if(Auth::getUser('role')!=3 && !isset($_POST['remark']))
				{
					$pid = $project->where(['gid'=>$uid])[0]->pid;
					
					//$aid = $projects_progress->query('select aid from projectprogress where pid='.$pid)->aid;

					$aid = $projects_progress->query("select aid from projectprogress where gid = ".$uid." and uid =".$user_id." and stage =".$stageid);
					$aid = end($aid)->aid;
						
					$projects_progress->query('update projectprogress set remark="Approved" where aid='.$aid);
					$projects_progress->query('update projectprogress set status = 1 where aid ='.$aid);
					
					$project->query('update projects set stage = stage + 1 where gid ='.$uid." and uid = ".$user_id);

					$project->query('update projects set approved = 1 where gid ='.$uid." and uid = ".$user_id);
					//$project->query('update projects set status = 1 where gid ='.$uid);
					message("Approved!");
					
				}
				else if(Auth::getUser('role')!=3 && isset($_POST['remark']))
				{
					//show($_POST);
					$pid = $project->where(['gid'=>$uid])[0]->pid;
					$remarks = $_POST['remarks'];
					
					$aid = $projects_progress->query("select aid from projectprogress where gid = ".$uid." and uid =".$user_id." and stage =".$stageid);
					$aid = end($aid)->aid;
					
					$projects_progress->query('update projectprogress set remark="'.$remarks.'" where aid='.$aid);
					
					$projects_progress->query('update projectprogress set status = -2 where aid ='.$aid);
					//$project->query('update projects set status = 0 where gid ='.$uid);
					message("Remark sent Successfully");
				}
			}
			

			if($id == "fulldocument")
			{

				if(Auth::getUser('role')==3)
				{
					$data['projectdata'] = $project->where(['uid' => $uid]);
					$data['finaly'] = $project-> get_project_progress_data($data['projectdata'], $user_id);
				}
				else
				{
					$data['projectdata'] = $project->where(['gid' => $uid, 'uid' => $user_id],'',['and']);
					$data['finaly'] = $project-> get_project_progress_data($data['projectdata'], $user_id);
				}
				//show($data['finaly']);
				//die();
				$this->view('profile/profile.document.fulldocument',$data);
			}
			else if($user_id!="" && $id != "" && $stageid != "")
			{
				if(Auth::getUser('role')==3)
				{
					//$data['viewdata'] = $projects_progress->where(['uid'=>$uid]);
					$data['viewdata'] = $projects_progress->query("select * from projectprogress where uid = ".$uid." and stage =".$stageid);
				}
				else{
					
					$data['viewdata'] = $projects_progress->query("select * from projectprogress where gid = ".$uid." and uid =".$user_id." and stage =".$stageid);		
					//$data['viewdata'] = $projects_progress->where(['gid'=>$uid]);
				}
				
				if(!empty($data['viewdata']))
				{
					$data['viewdata'] = end($data['viewdata']);
				}
				//show($data['viewdata']);
				
					$this->view('profile/profile.document',$data);
			}
			else
			{
				$this->view('profile/profile.documnt',$data);
			}
		}
		

	}
	
	

}
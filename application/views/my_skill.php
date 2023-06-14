<div class="main-content">
  <div class="main-content-inner">


      <!-- Content Wrapper. Contains page content -->
      <div class="page-content">

      <div class="container">
    		<div class="row">
    			<div class="col-md-12">

    				<h4 class="page-header">My <small>Skills</small> </h4>

    				<div class="removeMessages"></div>

    				<button class="btn btn-primary btn-xs pull pull-right" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
    					<span class="glyphicon glyphicon-plus-sign"></span>	Make New
    				</button>

    				<br /> <br /> <br />

    				<table class="table" id="manageMemberTable" width="100%">
    					<thead>
    						<tr>
    							<th>No</th>
    							<th>Skills</th>
    							<th>Category</th>
    							<th>Option</th>
    						</tr>
    					</thead>
    				</table>
    			</div>
    		</div>
    	</div>

    	<!-- add modal -->
    	<div class="modal fade" tabindex="-1" role="dialog" id="addMember">
    	  <div class="modal-dialog" role="document">
    	    <div class="modal-content">
    	      <div class="modal-header">
    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	New Skill</h4>
    	      </div>

    	      <form class="form-horizontal" action="<?php echo base_url();?>scrud/php_action/create.php" method="POST" id="createMemberForm">

    	      <div class="modal-body">
    	      	<div class="messages"></div>

    			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
    			    <label for="skill" class="col-sm-2 control-label">Skill</label>
    			    <div class="col-sm-10">
                <input type="hidden" id="userid" name="userid" value="<?=$_SESSION['sess_user_id']?>">
    			      <input type="text" class="form-control" id="skill" name="skill" placeholder="Skill name..">
    				<!-- here the text will apper  -->
    			    </div>
    			  </div>
    			  <div class="form-group">
    			    <label for="category" class="col-sm-2 control-label">Category</label>
    			    <div class="col-sm-10">
    			      <select class="chosen-select form-control" name="category" id="category" data-placeholder="select a category..">
                  <option value=""></option>
                  <?
                          $queryx = "SELECT id, name from tcategory order by name ASC";
                          $queryx = $this->db->query($queryx);
                          if ($queryx->num_rows()>0) {
                            foreach($queryx->result() as $datax) {
                              ?><option  value="<?=$datax->id;?>"><?=$datax->name?></option><?
                            }
                          }
                  ?>
    			      </select>
    			    </div>
    			  </div>

    	      </div>
    	      <div class="modal-footer">
    	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    	        <button type="submit" class="btn btn-primary">Save</button>
    	      </div>
    	      </form>
    	    </div><!-- /.modal-content -->
    	  </div><!-- /.modal-dialog -->
    	</div><!-- /.modal -->
    	<!-- /add modal -->

    	<!-- remove modal -->
    	<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
    	  <div class="modal-dialog" role="document">
    	    <div class="modal-content">
    	      <div class="modal-header">
    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Remove Expertise</h4>
    	      </div>
    	      <div class="modal-body">
    	        <p>Are you sure you want to delete it ?</p>
    	      </div>
    	      <div class="modal-footer">
    	        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
    	        <button type="button" class="btn btn-primary" id="removeBtn" data-dismiss="modal">Yes</button>
    	      </div>
    	    </div><!-- /.modal-content -->
    	  </div><!-- /.modal-dialog -->
    	</div><!-- /.modal -->
    	<!-- /remove modal -->

    	<!-- edit modal -->
    	<div class="modal fade" tabindex="-1" role="dialog" id="editMemberModal">
    	  <div class="modal-dialog" role="document">
    	    <div class="modal-content">
    	      <div class="modal-header">
    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Skills</h4>
    	      </div>

    		<form class="form-horizontal" action="<?php echo base_url();?>scrud/php_action/update.php" method="POST" id="updateMemberForm">

    	      <div class="modal-body">

    	        <div class="edit-messages"></div>

    			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
    			    <label for="editName" class="col-sm-2 control-label">Skill</label>
    			    <div class="col-sm-10">
    			      <input type="text" class="form-control" id="editSkill" name="editSkill" placeholder="Skill name..">
    				<!-- here the text will apper  -->
    			    </div>
    			  </div>
    			  <div class="form-group">
    			    <label for="editCategory" class="col-sm-2 control-label">Category</label>
    			    <div class="col-sm-10">
    			      <select class="form-control" name="editCategory" id="editCategory" data-placeholder="select a category..">
    			      	<option value=""></option>
                  <?
                          $queryx = "SELECT id, name from tcategory order by name ASC";
                          $queryx = $this->db->query($queryx);
                          if ($queryx->num_rows()>0) {
                            foreach($queryx->result() as $datax) {
                              ?><option  value="<?=$datax->id;?>"><?=$datax->name?></option><?
                            }
                          }
                  ?>
    			      </select>
    			    </div>
    			  </div>
    	      </div>
    	      <div class="modal-footer editMemberModal">
    	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    	        <button type="submit" class="btn btn-primary">Update</button>
    	      </div>
    	      </form>
    	    </div><!-- /.modal-content -->
    	  </div><!-- /.modal-dialog -->
    	</div><!-- /.modal -->
    	<!-- /edit modal -->

</div>
</div>
</div>

<!-- jquery plugin -->

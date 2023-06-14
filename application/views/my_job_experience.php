<div class="main-content">
  <div class="main-content-inner">


      <!-- Content Wrapper. Contains page content -->
      <div class="page-content">

      <div class="container">
    		<div class="row">
    			<div class="col-md-12">

    				<h4 class="page-header">Work <small>experience</small> </h4>

    				<div class="removeMessages"></div>

    				<button class="btn btn-primary btn-xs pull pull-right" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
    					<span class="glyphicon glyphicon-plus-sign"></span>	Make new
    				</button>

    				<br /> <br /> <br />

    				<table class="table" id="manageMemberTable" width="100%">
    					<thead>
    						<tr>
    							<th>No</th>
    							<th>Company</th>
    							<th>Year<br>In</th>
                  <th>Year<br>end</th>
    							<th>job status</th>
                  <th>Position</th>
                  <th>Description</th>
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
    	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Make New</h4>
    	      </div>

    	      <form class="form-horizontal" action="<?php echo base_url();?>pengalaman/php_action/create.php" method="POST" id="createMemberForm">

    	      <div class="modal-body">
    	      	<div class="messages"></div>

    			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
    			    <label for="bekerja_di" class="col-sm-2 control-label">Company</label>
    			    <div class="col-sm-10">
                <input type="hidden" id="userid" name="userid" value="<?=$_SESSION['sess_user_id']?>">
    			      <input type="text" class="form-control" id="bekerja_di" name="bekerja_di" placeholder="company name..">
    				<!-- here the text will apper  -->
    			    </div>
    			  </div>

            <div class="form-group"> <!--/here teh addclass has-error will appear -->
    			    <label for="thna" class="col-sm-2 control-label">Year in</label>
    			    <div class="col-sm-10">
                <input type="text" class="form-control" id="thna" name="thna" placeholder="yyyy">
    				<!-- here the text will apper  -->
    			    </div>
    			  </div>

            <div class="form-group"> <!--/here teh addclass has-error will appear -->
    			    <label for="thnb" class="col-sm-2 control-label">Year end</label>
    			    <div class="col-sm-10">
                <input type="text" class="form-control" id="thnb" name="thnb" placeholder="yyyy">
    				<!-- here the text will apper  -->
    			    </div>
    			  </div>

            <div class="form-group">
    			    <label for="status_kerja" class="col-sm-2 control-label">Job status</label>
    			    <div class="col-sm-10">
    			      <select class="form-control" name="status_kerja" id="status_kerja">
    			      	<option value=""></option>
                  <option value="permanent employees">permanent employees</option>
                  <option value="contract employees">contract employees</option>
                  <option value="daily employees">daily employees</option>
                  <option value="Freelance">Freelance</option>
                  <option value="volunteer">volunteer</option>
                  <option value="Training">Training</option>
    			      </select>
    			    </div>
    			  </div>

            <div class="form-group"> <!--/here teh addclass has-error will appear -->
    			    <label for="posisi" class="col-sm-2 control-label">Position</label>
    			    <div class="col-sm-10">
                <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Position..">
    				<!-- here the text will apper  -->
    			    </div>
    			  </div>

            <div class="form-group"> <!--/here teh addclass has-error will appear -->
    			    <label for="uraian_pekerjaan" class="col-sm-2 control-label">Job description</label>
    			    <div class="col-sm-10">
                <textarea id="uraian_pekerjaan" name="uraian_pekerjaan" class="autosize-transition form-control" placeholder="deskripsi pekerjaan"></textarea>
    				<!-- here the text will apper  -->
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
    	        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Delete Experience</h4>
    	      </div>
    	      <div class="modal-body">
    	        <p>are you sure will delete it ?</p>
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
    	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Work Experience</h4>
    	      </div>

    		<form class="form-horizontal" action="<?php echo base_url();?>pengalaman/php_action/update.php" method="POST" id="updateMemberForm">

    	      <div class="modal-body">

    	        <div class="edit-messages"></div>

              <div class="form-group"> <!--/here teh addclass has-error will appear -->
      			    <label for="editbekerja_di" class="col-sm-2 control-label">Company</label>
      			    <div class="col-sm-10">
                  <input type="text" class="form-control" id="editbekerja_di" name="editbekerja_di" placeholder="company name..">
      				<!-- here the text will apper  -->
      			    </div>
      			  </div>

              <div class="form-group"> <!--/here teh addclass has-error will appear -->
      			    <label for="editthna" class="col-sm-2 control-label">Year in</label>
      			    <div class="col-sm-10">
                  <input type="text" class="form-control" id="editthna" name="editthna" placeholder="yyyy">
      				<!-- here the text will apper  -->
      			    </div>
      			  </div>

              <div class="form-group"> <!--/here teh addclass has-error will appear -->
      			    <label for="editthnb" class="col-sm-2 control-label">Year end</label>
      			    <div class="col-sm-10">
                  <input type="text" class="form-control" id="editthnb" name="editthnb" placeholder="yyyy">
      				<!-- here the text will apper  -->
      			    </div>
      			  </div>

              <div class="form-group">
      			    <label for="editstatus_kerja" class="col-sm-2 control-label">Job status</label>
      			    <div class="col-sm-10">
      			      <select class="form-control" name="editstatus_kerja" id="editstatus_kerja">
      			      	<option value=""></option>
                    <option value="permanent employees">permanent employees</option>
                    <option value="contract employees">contract employees</option>
                    <option value="daily employees">daily employees</option>
                    <option value="Freelance">Freelance</option>
                    <option value="volunteer">volunteer</option>
                    <option value="Training">Training</option>
      			      </select>
      			    </div>
      			  </div>

              <div class="form-group"> <!--/here teh addclass has-error will appear -->
      			    <label for="editposisi" class="col-sm-2 control-label">Position</label>
      			    <div class="col-sm-10">
                  <input type="text" class="form-control" id="editposisi" name="editposisi" placeholder="Position..">
      				<!-- here the text will apper  -->
      			    </div>
      			  </div>

              <div class="form-group"> <!--/here teh addclass has-error will appear -->
      			    <label for="edituraian_pekerjaan" class="col-sm-2 control-label">Job description</label>
      			    <div class="col-sm-10">
                  <textarea id="edituraian_pekerjaan" name="edituraian_pekerjaan" class="autosize-transition form-control" placeholder="Job description.."></textarea>
      				<!-- here the text will apper  -->
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

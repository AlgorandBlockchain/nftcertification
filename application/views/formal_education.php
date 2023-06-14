<div class="main-content">
  <div class="main-content-inner">


      <!-- Content Wrapper. Contains page content -->
      <div class="page-content">

      <div class="container">
    		<div class="row">
    			<div class="col-md-12">

    				<h4 class="page-header">Formal <small>Education</small> </h4>

    				<div class="removeMessages"></div>

    				<button class="btn btn-primary btn-xs pull pull-right" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
    					<span class="glyphicon glyphicon-plus-sign"></span>	Make new
    				</button>

    				<br /> <br /> <br />

    				<table class="table" id="manageMemberTable" width="100%">
    					<thead>
    						<tr>
    							<th>No</th>
    							<th>Educational level</th>
    							<th>School name</th>
    							<th>Year of Entry</th>
                  <th>Graduation year</th>
                  <th>Major</th>
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
    	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	New Formal Education</h4>
    	      </div>

    	      <form class="form-horizontal" action="<?php echo base_url();?>formal_edu/php_action/create.php" method="POST" id="createMemberForm">

    	      <div class="modal-body">
    	      	<div class="messages"></div>

    			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
    			    <label for="level" class="col-sm-2 control-label">Level</label>
    			    <div class="col-sm-10">
                <input type="hidden" id="userid" name="userid" value="<?=$_SESSION['sess_user_id']?>">
    			      <select class="chosen form-control" name="level" id="level" data-placeholder="select the education level..">
                  <option value="">~~ choose ~~</option>
                  <option value="elementary school">elementary school</option>
                  <option value="junior high school">junior high school</option>
                  <option value="high school">high school</option>
                  <option value="higher education">higher education</option>
                  <option value="Undergraduate bachelor (S1)">Undergraduate bachelor (S1)</option>
                  <option value="Graduate">Graduate bachelor (S2)</option>
                  <option value="Graduate Doctorate">Graduate Doctorate</option>
                </select>
    				<!-- here the text will apper  -->
    			    </div>
    			  </div>
    			  <div class="form-group">
    			    <label for="nama_sekolah" class="col-sm-2 control-label">Name</label>
    			    <div class="col-sm-10">
    			      <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" placeholder="School name..">
    			    </div>
    			  </div>

            <div class="form-group">
    			    <label for="jurusan" class="col-sm-2 control-label">Major</label>
    			    <div class="col-sm-10">
    			      <select class="chosen-select form-control" name="jurusan" id="jurusan" data-placeholder="Choose a course..">
    			      	<option value=""></option>
                  <?
                          $queryx = "SELECT name from tcategory order by name ASC";
                          $queryx = $this->db->query($queryx);
                          if ($queryx->num_rows()>0) {
                            foreach($queryx->result() as $datax) {
                              ?><option  value="<?=$datax->name;?>"><?=$datax->name?></option><?
                            }
                          }
                  ?>
    			      </select>
    			    </div>
    			  </div>

            <div class="form-group"> <!--/here teh addclass has-error will appear -->
              <label for="thna" class="col-sm-2 control-label">Sign in</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="thna" name="thna" placeholder="year of entry..">
            <!-- here the text will apper  -->
              </div>
            </div>

            <div class="form-group"> <!--/here teh addclass has-error will appear -->
              <label for="thnb" class="col-sm-2 control-label">Graduation</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="thnb" name="thnb" placeholder="Graduation year..">
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
    	        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Delete Formal Education</h4>
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
    	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Formal Education</h4>
    	      </div>

    		<form class="form-horizontal" action="<?php echo base_url();?>formal_edu/php_action/update.php" method="POST" id="updateMemberForm">

    	      <div class="modal-body">

    	        <div class="edit-messages"></div>

              <div class="form-group"> <!--/here teh addclass has-error will appear -->
      			    <label for="editlevel" class="col-sm-2 control-label">Level</label>
      			    <div class="col-sm-10">
                  <select class="form-control" name="editlevel" id="editlevel" data-placeholder="select the education level..">
                    <option value="">~~ choose ~~</option>
                    <option value="elementary school">elementary school</option>
                    <option value="junior high school">junior high school</option>
                    <option value="high school">high school</option>
                    <option value="higher education">higher education</option>
                    <option value="Undergraduate bachelor (S1)">Undergraduate bachelor (S1)</option>
                    <option value="Graduate">Graduate bachelor (S2)</option>
                    <option value="Graduate Doctorate">Graduate Doctorate</option>
                  </select>
      				<!-- here the text will apper  -->
      			    </div>
      			  </div>
      			  <div class="form-group">
      			    <label for="editnama_sekolah" class="col-sm-2 control-label">Sign in</label>
      			    <div class="col-sm-10">
      			      <input type="text" class="form-control" id="editnama_sekolah" name="editnama_sekolah" placeholder="School name..">
      			    </div>
      			  </div>

              <div class="form-group">
      			    <label for="editjurusan" class="col-sm-2 control-label">Major</label>
      			    <div class="col-sm-10">
      			      <select class="form-control" name="editjurusan" id="editjurusan" data-placeholder="Choose a course..">
      			      	<option value=""></option>
                    <?
                            $queryx = "SELECT name from tcategory order by name ASC";
                            $queryx = $this->db->query($queryx);
                            if ($queryx->num_rows()>0) {
                              foreach($queryx->result() as $datax) {
                                ?><option  value="<?=$datax->name;?>"><?=$datax->name?></option><?
                              }
                            }
                    ?>
      			      </select>
      			    </div>
      			  </div>

              <div class="form-group"> <!--/here teh addclass has-error will appear -->
                <label for="thna" class="col-sm-2 control-label">Sign in</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="editthna" name="editthna" placeholder="year of entry..">
              <!-- here the text will apper  -->
                </div>
              </div>

              <div class="form-group"> <!--/here teh addclass has-error will appear -->
                <label for="thnb" class="col-sm-2 control-label">Graduation</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="editthnb" name="editthnb" placeholder="Graduation year..">
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

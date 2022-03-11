<?php //include('header.html'); ?>

<div style="padding-left:20px; padding-top: 10px; padding-right: 20px;">
  <!-- <h1>Responsive Header</h1>
  <p>Resize the browser window to see the effect.</p>
  <p>Some content..</p> -->
  <div class="table-responsive">
    <div class="form-group">
    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Register Customer</a>
  </div>
<table class="table table-bordered table-striped table-responsive table-sm">
  <tr>
  <th>Id</th>
  <th>Name</th>
  <th>CreditLimit</th>
  <th>PaymentTerms</th>
  <th>Action</th>
</tr>
  <tbody>
    <?php //print_r($data);
    foreach ($data as $key => $value) {
     ?>
     <tr>
     <td><?php echo $value->Id; ?></td>
     <td><?php echo $value->Name; ?></td>
     <td><?php echo $value->CreditLimit; ?></td>
     <td><?php echo $value->PaymentTerms; ?></td>
     <td><button type="button" class="btn-success btn-sm">Edit</button> || <button type="button" class="btn btn-danger">Delete</button></td>
   </tr>
     <?php } ?>
  </tbody>
</table>
  </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Register Customer</h4>
      </div>

        <form action="/CreditManagement/Customer/postCustomer" method="post">
      <div class="modal-body">
        <div class="form-group">
          <div class="col-md-4"><label class="form-group">Id</label></div>
          <div class="col-md-8"><input type="text" name="id" class="form-group"></div>
        </div>
        <div class="form-group">
          <div class="col-md-4"><label class="form-group">Name</label></div>
          <div class="col-md-8"><input type="text" name="name" class="form-group"></div>
        </div>
        <div class="form-group">
          <div class="col-md-4"><label class="form-group">Credit Limit</label></div>
          <div class="col-md-8"><input type="text" name="creditlimit" class="form-group"></div>
        </div>
        <div class="form-group">
          <div class="col-md-4"><label class="form-group">Payment Terms</label></div>
          <div class="col-md-8"><input type="text" name="payterms" class="form-group"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>

  </div>
</div>
<?php //include('footer.html'); ?>


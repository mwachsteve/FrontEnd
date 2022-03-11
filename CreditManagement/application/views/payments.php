<?php //include('header.html'); ?>

<div style="padding-left:20px; padding-top: 10px;">
  <!-- <h1>Responsive Header</h1>
  <p>Resize the browser window to see the effect.</p>
  <p>Some content..</p> -->
  <div class="table-responsive">
    <div class="form-group col-md-8">
    <a href="" class="btn btn-primary acc" data-toggle="modal" data-target="#myModal" id="acc">Make Payment</a>
  </div>
  <div class="col-md-4">
    <select class="form-control" name="id" class="id" id="id" onchange="searchFilter();">
      <option>Select Customer</option>
      <?php foreach($data as $value){ ?>
      <option value="<?php echo $value->Id; ?>"><?php echo $value->Name; ?></option>
    <?php } ?>
    </select>
  </div>
  <div  class="dataList" id="dataList">
<table class="table table-bordered table-striped table-responsive">
  <th>Id</th>
  <th>InvoiceId</th>
  <th>Amount</th>
  <th>Paydate</th>
  <th>DueDate</th>
  <th>Action</th>
  <tbody>
    
  </tbody>
</table>
  </div>
</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Make Payments</h4>
      </div>
      <form action="/CreditManagement/customer/makepayments" method="post">
      <div class="modal-body">
        <div class="form-group">
          <div class="col-md-4"><label class="form-group">Invoice Id</label></div>
          <div class="col-md-8"><input type="text" name="invoiceid" class="form-group"></div>
        </div>
        <div class="form-group">
        
    <div class="col-md-12">
    <select class="form-control" name="id" class="idd" id="idd" onchange="searchFilter1();">
      <option>Select Customer</option>
      <?php foreach($data as $value){ ?>
      <option value="<?php echo $value->Id; ?>"><?php echo $value->Name; ?></option>
      <?php } ?>
    </select>
    </div>
    <input type="hidden" name="acno" id="acno" class="acno">
    <input type="hidden" name="acnoo" id="acnoo" class="acnoo">
    </div>
     <div class="form-group">
    <div class="col-md-12">
    <select class="form-control" name="sel_depart" class="sel_depart" id="sel_depart" onchange="searchFilter2();">
      <option></option>
    </select>
  </div>
</div>
        <div class="form-group">
          <div class="col-md-4"><label class="form-group">Amount</label></div>
          <div class="col-md-8"><input type="text" name="amount" class="form-group"></div>
        </div>
        <div class="form-group">
          <div class="col-md-4"><label class="form-group">Pay Date</label></div>
          <div class="col-md-8"><input type="text" name="paydate" class="form-group"></div>
        </div>
        <div class="form-group">
          <div class="col-md-4"><label class="form-group">DueDate</label></div>
          <div class="col-md-8"><input type="text" name="duedate" class="form-group"></div>
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

<script>
function searchFilter(){
    var id = $('#id').val();
    $.ajax({
        type: 'POST',
        url: '/CreditManagement/Customer/postPayments',
        // dataType: 'json',
        data:'id='+id,
        beforeSend: function(){
            $('.loading').show();
        },
        success: function(html){
            // $('#total').html('');
            $('#dataList').html(html);
            $('.loading').fadeOut("slow");
            // searchFilter1(1);
        }
    });
}


function searchFilter1(){
    var id = $('#idd').val();
    $.ajax({
        type: 'POST',
        url: '/CreditManagement/Customer/postacno',
        dataType: 'json',
        data:'id='+id,
        beforeSend: function(){
            $('.loading').show();
        },
        success: function(response){
          $('#sel_depart').find('option').not(':first').remove();
          $.each(response,function(index,data){
             $('#sel_depart').append('<option value="'+data['Id']+'">'+data['AccountNumber']+'</option>');
             $('#acno').val(data['AvailableBalance']);
             $('#acnoo').val(data['ActualBalance']);
          });
        }
    });
}
</script>
<?php //include('footer.html'); ?>

<form action="" id="edit_customer_form">
    <input type="hidden" name="cus_table_id" id="cus_table_id" value="<?php echo $_POST['id']??''; ?>">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Customer Details</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-4">
                            <div class="form-group">
                                <label for="customer_id">Customer ID</label>
                                <input type="text" class="form-control" name="customer_id" id="customer_id" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-4">
                            <div class="form-group">
                                <label for="customer_name">Customer Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter Customer Name">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-4">
                            <div class="form-group">
                                <label for="customer_phone">Customer Phone</label>
                                <input type="number" class="form-control" name="customer_phone" id="customer_phone" placeholder="Enter Customer Phone" onkeypress="if(this.value.length==10) return false;">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-4">
                            <div class="form-group">
                                <label for="customer_email">Customer Email</label>
                                <input type="email" class="form-control" name="customer_email" id="customer_email" placeholder="Enter Customer Email">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-4">
                            <div class="form-group">
                                <label for="customer_address">Customer Address</label>
                                <input type="text" class="form-control" name="customer_address" id="customer_address" placeholder="Enter Customer Address">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-4">
                            <div class="form-group">
                                <label style="visibility: hidden;">Submit</label>
                                <button type="button" class="btn btn-primary" id="submit_customer" name="submit_customer">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="src/js/edit_customer.js"></script>
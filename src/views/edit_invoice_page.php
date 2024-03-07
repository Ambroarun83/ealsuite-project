
<form action="" id="edit_invoice_form">
    <input type="hidden" name="inv_table_id" id="inv_table_id" value="<?php echo $_POST['id']??''; ?>">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Invoice Details</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-4">
                            <div class="form-group">
                                <label for="inv_id">Invoice ID</label>
                                <input type="text" class="form-control" name="inv_id" id="inv_id" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-4">
                            <div class="form-group">
                                <label for="customer">Customer Name<span class="text-danger"> *</span></label>
                                <select class="form-control" name="customer" id="customer">
                                    <option value="">Select </option>
                                    <option value="1">Select Customer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-4">
                            <div class="form-group">
                                <label for="inv_date">Invoice Date</label>
                                <input type="date" class="form-control" name="inv_date" id="inv_date">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-4">
                            <div class="form-group">
                                <label for="inv_amt">Invoice Amount</label>
                                <input type="text" class="form-control" name="inv_amt" id="inv_amt" placeholder="Enter Invoice Amount">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-4">
                            <div class="form-group">
                                <label for="inv_status">Invoice Status</label>
                                <select class="form-control" name="inv_status" id="inv_status">
                                    <option value="">Select Status</option>
                                    <option value="0">Unpaid</option>
                                    <option value="1">Paid</option>
                                    <option value="2">Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-4">
                            <div class="form-group">
                                <label style="visibility: hidden;">Submit</label>
                                <button type="button" class="btn btn-primary" id="submit_inv" name="submit_inv">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="src/js/edit_invoice.js"></script>
<div class="card" id="invoice_list_card">
    <div class="card-header">
        <div class="card-title">
            Invoice List
            <button type="button" class="btn btn-success" id="add_invoice" name="add_invoice" style="float: right;"><i class="fa fa-plus"></i> Create</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Invoice ID</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status </th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody id="invoice_list_body"></tbody>
            </table>
        </div>
    </div>
</div>
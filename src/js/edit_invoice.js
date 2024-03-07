$(document).ready(function () {

    //to get customer list and then trigger check for update
    getCustomerNameList();

    $('#submit_inv').click(function () {
    let customer = $('#customer').val();

        if (customer != '') {
            submitInvoiceDetails();
            $('#customer').css('border', '0px');
        }else{
            $('#customer').css('border', '1px solid red');
        }
    })

})

function getCustomerNameList() {
    //ajax call for fetching customer name list
    $.ajax({
        url: 'src/api/getList.php',
        type: 'post',
        cache: false,
        dataType: 'json',
        data: { list_type: 'customer_list' },
        success: function (response) {
            let customer_list = `<option value="">Select Customer</option>`;
            customer_list += response.map(customer => `<option value="${customer.id}">${customer.name}</option>`);
            $('#customer').empty().html(customer_list);
        }
    }).then(function () {
        checkForUpdate();
    })
}

function checkForUpdate() {
    var inv_table_id = $('#inv_table_id').val();
    if (inv_table_id != '') {
        getInvoiceDetails(inv_table_id);
    }else{
        //generate invoice code if adding invoice
        getInvoiceCode();
    }
}

function getInvoiceDetails(table_id) {
    //ajax call for fetching customer details for edit
    $.ajax({
        url: 'src/api/editDetail.php',
        type: 'post',
        cache: false,
        dataType: 'json',
        data: { type: 'invoice', table_id },
        success: function (response) {
            $('#inv_id').val(response.inv_id);
            $('#customer').val(response.cus_table_id);
            $('#inv_date').val(response.date);
            $('#inv_amt').val(response.amount);
            $('#inv_status').val(response.status);
        }
    });
}

function getInvoiceCode(){
    //auto generate invoice code
    $.post('src/api/getCode.php', { type: 'invoice' }, function (response) {
        $('#inv_id').val(response);
    })

}

function submitInvoiceDetails(){
    //submit ajax call with form data and type:customer sending
    $.ajax({
        url: 'src/api/submitDetails.php',
        type: 'post',
        cache: false,
        dataType: 'json',
        data: $('#edit_invoice_form').serialize() + '&type=invoice',
        success: function (response) {
            if ($('#inv_table_id').val() == '') { var alertText = 'Inserted'; } else { var alertText = 'Updated'; }
            if (response == 'success') {
                Swal.fire({
                    title: "Success",
                    text: alertText + " Successfully",
                    icon: "success",
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                }).then(function () {
                    $('#body_content').load('src/views/invoice_list_page.php');
                    getList('invoice_list')
                })
            } else {
                alert('Error While Submitting');
            }
        }
    })
}

// function validation() {
//     //validations
//     let inv_id = $('#inv_id').val();
//     let customer = $('#customer').val();
//     let inv_date = $('#inv_date').val();
//     let inv_amt = $('#inv_amt').val();
//     let inv_status = $('#inv_status').val();
//     let response = true;

//     validateField(inv_id, '#inv_id');
//     validateField(customer, '#customer');
//     validateField(inv_date, '#inv_date');
//     validateField(inv_amt, '#inv_amt');
//     validateField(inv_status, '#inv_status');

//     function validateField(value, fieldId) {
//         if (value === '') {
//             response = false;
//             event.preventDefault();
//             $(fieldId).css('border', '1px solid red');
//         } else {
//             $(fieldId).css('border', '0px');
//         }

//     }
//     return response;
// }
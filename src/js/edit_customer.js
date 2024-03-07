$(document).ready(function () {
    let cus_table_id = $('#cus_table_id').val();
    if (cus_table_id != '') {
        getCustomerDetails(cus_table_id);
    } else {
        getCustomerCode();
    }

    $('#submit_customer').click(function () {
        let customer_name = $('#customer_name').val();
        if (customer_name != '') {
            submitCustomerDetails();
            $('#customer_name').css('border', '0px');
        }else{
            $('#customer_name').css('border', '1px solid red');
        }
    })
})

function getCustomerDetails(table_id) {
    //ajax call for fetching customer details for edit
    $.ajax({
        url: 'src/api/editDetail.php',
        type: 'post',
        cache: false,
        dataType: 'json',
        data: { type: 'customer', table_id },
        success: function (response) {
            $('#customer_id').val(response.cus_id);
            $('#customer_name').val(response.name);
            $('#customer_phone').val(response.phone);
            $('#customer_email').val(response.email);
            $('#customer_address').val(response.address);
        }
    });
}

function getCustomerCode() {
    //auto generate customer code
    $.post('src/api/getCode.php', { type: 'customer' }, function (response) {
        $('#customer_id').val(response);
    })
}
function submitCustomerDetails() {
    //submit ajax call with form data and type:customer sending
    $.ajax({
        url: 'src/api/submitDetails.php',
        type: 'post',
        cache: false,
        dataType: 'json',
        data: $('#edit_customer_form').serialize() + '&type=customer',
        success: function (response) {
            if ($('#cus_table_id').val() == '') { var alertText = 'Inserted'; } else { var alertText = 'Updated'; }
            if (response == 'success') {
                Swal.fire({
                    title: "Success",
                    text: alertText + " Successfully",
                    icon: "success",
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                }).then(function () {
                    $('#body_content').load('src/views/customer_list_page.php');
                    getList('customer_list')
                })
            } else {
                alert('Error While Submitting');
            }
        }
    })

}

// function validation() {
//     //validations
//     let customer_name = $('#customer_name').val();
//     let customer_phone = $('#customer_phone').val();
//     let customer_email = $('#customer_email').val();
//     let customer_address = $('#customer_address').val();
//     let response = true;

//     validateField(customer_name, '#customer_name');
//     validateField(customer_phone, '#customer_phone');
//     validateField(customer_email, '#customer_email');
//     validateField(customer_address, '#customer_address');

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
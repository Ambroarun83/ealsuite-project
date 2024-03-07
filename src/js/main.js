$(document).ready(function () {

    $('li.sidebar-brand').click(function () {
        let val = $(this).data('value');
        getList(val)

        if (val == 'customer_list') {
            $('#body_content').load('src/views/customer_list_page.php');
            $('#customer_list_card').show()
            $('#invoice_list_card').hide()
        } else if (val == 'invoice_list') { 
            $('#body_content').load('src/views/invoice_list_page.php');
            $('#invoice_list_card').show()
            $('#customer_list_card').hide()
        }
    })

    $('#logout').click(function () {
        //ask for confirmation
        Swal.fire({
            title: "Are you sure?",
            text: "You want to logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, logout!"
        }).then(function (result) {
            if (result.value) {
                logout();
            }
        })

    })
})

function logout() {
    $.get('src/api/logout.php', function () {
        Swal.fire({
            title: "Success",
            text: "Logged out Successfully",
            icon: "success",
            confirmButtonText: 'Login Again'
        }).then(function () {
            location.reload();
        })
    })
}

function getList(list_type) {
    //ajax call to get customer list
    $.ajax({
        url: 'src/api/getList.php',
        type: 'POST',
        data: { list_type },
        dataType: 'json',
        success: function (data) {
            $('#customer_list_body').empty();
            $('#invoice_list_body').empty();
            $.each(data, function (k, val) {
                var html = `<tr>`;
                $.each(val, function (key, value) {
                    html += `<td>${value}</td>`;
                })
                if (list_type == 'customer_list') {
                    html += `<td><i class="fa-solid fa-pencil fa-icons edit_cus" data-value='${val.id}'></i></td>`;
                    html += `</tr>`;
                    $('#customer_list_body').append(html);
                } else {
                    html += `<td><i class="fa-solid fa-pencil fa-icons edit_inv" data-value='${val.id}'></i></td>`;
                    html += `</tr>`;
                    $('#invoice_list_body').append(html);
                }
            });
        }
    }).then(function () {
        //for editing customer information
        $('.edit_cus').off('click').click(function () {
            let id = $(this).data('value');
            $.post(`src/views/edit_customer_page.php`, { id }, function (data) {
                $('#body_content').html(data);
            });

        })
        //for editing invoice information
        $('.edit_inv').off('click').click(function () {
            let id = $(this).data('value');
            $.post(`src/views/edit_invoice_page.php`, { id }, function (data) {
                $('#body_content').html(data);
            });
        });
        
        //for adding customer information
        $('#add_customer').off('click').click(function () {
            $('#body_content').load('src/views/edit_customer_page.php');
        });
        //for adding invoice information
        $('#add_invoice').off('click').click(function () {
            $('#body_content').load('src/views/edit_invoice_page.php');
        });
    })
}
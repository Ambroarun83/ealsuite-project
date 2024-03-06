$(document).ready(function () {

    $('li.sidebar-brand').click(function () {
        let val = $(this).data('value');
        getList(val)

        if (val == 'customer_list') {
            $('#body_content').load('src/views/customer_list_page.php');
            $('#customer_list_card').show()
            $('#invoice_list_card').hide()
        } else {
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
    $.post('src/api/getList.php', { list_type }, function (data) {
        $('#customer_list_body').empty();
        $('#invoice_list_body').empty();
        $.each(data, function (k, val) {
            var html = `<tr>`;
            $.each(val, function (key, value) {
                html += `<td>${value}</td>`;
            })
            if (list_type == 'customer_list') {
                html += `<td><i class="fa-solid fa-pencil fa-icons" class='' data-toggle='modal' data-target='edit_customer' data-value='${val.id}'></i></td>`;
                html += `</tr>`;
                $('#customer_list_body').append(html);
            } else {
                html += `<td><i class="fa-solid fa-pencil fa-icons" class='fa-icons' data-toggle='modal' data-target='edit_invoice' data-value='${val.id}'></i></td>`;
                html += `</tr>`;
                $('#invoice_list_body').append(html);
            }
        });
    }, 'json');
}
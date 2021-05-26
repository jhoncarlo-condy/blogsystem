
    $("#addcategory").validate(
        {
            rules:
            {
                title: "required",
                description:
                {
                    required:true,
                    maxlength:100,
                }
            },
            messages:
            {
                description:
                {
                    required: "Please enter description",
                    maxlength: "description must be 100 characters or below"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            }
        });
        $("#editcategory").validate(
        {
            rules:
            {
                title: "required",
                description:
                {
                    required:true,
                    maxlength:100,
                }
            },
            messages:
            {
                description:
                {
                    required: "Please enter description",
                    maxlength: "description must be 100 characters or below"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            }
        });
    $("#delete").click(function(){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {


                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })

    });




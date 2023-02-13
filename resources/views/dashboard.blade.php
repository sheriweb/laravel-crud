@extends('layouts.main')
@section('content')

    <div class="card-box mb-30">
        <div class="pd-20">
            <a href="#" data-toggle="modal" data-target="#user-modal" class="reset_user">
                <button class="btn btn-info">Add User</button>
            </a>
        </div>

        <div class="pb-20">
            <table class="data-table user_table table stripe hover nowrap">
                <thead>
                <tr>
                    <th class="table-plus datatable-nosort">Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Date Of Birth</th>
                    <th>South African Id</th>
                    <th>Language</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('user.modal')

@endsection

@section('scripts')
    <script>

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        //Empty User Form
        $('.reset_user').click(function () {
            $("#passwords").removeAttr("readonly");
            $("#email").removeAttr("readonly");
            $("#password_confirmation").removeAttr("readonly");
            $("#user_form")[0].reset();
            $(".clear-error").html('');
            $('#interest_name').val('').trigger('change');
        });

        function addOrUpdateUser() {
            var data = $("#user_form").serialize();
            var url = $("#user_form").attr('action');
            var type = $("#user_form").attr('method');
            $(".clear-error").html('');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                method: type,
                data: data,
                success: function (response) {
                    if (response.status === 200) {
                        toastr.success('' + response.message + '', 'Success');
                        $('#user_form')[0].reset();
                        $('#user-modal').modal('hide');
                        getUsers();
                    } else {
                        toastr.warning('' + response.message + '', 'warning');
                    }
                }, error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        }

        //get user
        function getUsers() {
            $(".user_table").DataTable().clear().destroy();
            return $('.user_table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,

                ajax: "/user/list",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile_number', name: 'mobile_number'},
                    {data: 'dob', name: 'dob'},
                    {data: 'south_african_id_no', name: 'south_african_id_no'},
                    {data: 'language', name: 'language'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        }

        function findUser(url) {
            $(".clear-error").html('');
            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    if (response.id) {
                        $("#passwords").prop("readonly", true);
                        $("#email").prop("readonly", true);
                        $('#passwords').val('');
                        $("#password_confirmation").prop("readonly", true);
                    }

                    $.each(response, function (index, value) {
                        $('#' + index).val(value);
                    });

                    if (response.interests) {
                        let interest = [];
                        $.each(response.interests, function (index, value) {
                            interest.push(value.id);
                        });

                        $('#interest_name').val(interest).trigger('change');
                    }

                    $('#user_id').val(response.id)
                    $('#user-modal').modal('show');
                }
            });
        }

        function deleteUser(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Record will be deleted.?',
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: 'get',
                        success: function (response) {
                            if (response.status === 200) {
                                toastr.success('' + response.message + '', 'Success');
                                getUsers();
                            } else {
                                toastr.warning('' + response.message + '', 'warning');
                            }
                        }
                    });
                }
            });
        }

        $(document).ready(function () {
            getUsers();
        });

    </script>
@endsection

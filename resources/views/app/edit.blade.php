@extends('layouts.master')

@section('title')
    Edit Record
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="edit-user-result" class="row text-light"></div>
                    <h4 class="card-title">
                        Records
                    </h4>
                    <p class="p-3 mb-0">Edit Record</p>
                    <div class="row px-5">
                        <form id="edit-user-form" class="px-5" action="{{ route('edit-user') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required
                                       data-parsley-error-message="Enter user's first name"
                                       placeholder="First Name" value="{{ $user->first_name }}"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required
                                       data-parsley-error-message="Enter your user's last name"
                                       placeholder="Last Name" value="{{ $user->last_name }}"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date Of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required
                                       data-parsley-error-message="Select user's date of birth" max="{{ date("Y-m-d") }}"
                                       value="{{ $user->date_of_birth }}"
                                >
                            </div>
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" name="addUserButton" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let editUserForm = $('#edit-user-form');
        editUserForm.parsley();
        $(document).ready( function () {
            editUserForm.on('submit', function (event){
                event.preventDefault();
                if ($(this).parsley().isValid()) {
                    let formData = new FormData(this);
                    // remove both classes as we don't know which was added
                    $('#edit-user-result').removeClass("bg-success");
                    $('#edit-user-result').removeClass("bg-danger");
                    $('#edit-user-result').removeClass("p-3");
                    $('#edit-user-result').text("");
                    $.ajax({
                        url: "/edit-user",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            let result = JSON.parse(response);
                            let bootstrapClass = "bg-success";
                            if(result.error === "true") {
                                bootstrapClass = "bg-danger";
                            }
                            $('#edit-user-result').addClass(bootstrapClass);
                            $('#edit-user-result').addClass("p-3");
                            $('#edit-user-result').text(result.message);
                            window.scrollTo(0, 0);
                        }
                    });
                }
            });
        });
    </script>
@endsection

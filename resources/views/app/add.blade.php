@extends('layouts.master')

@section('title')
    Add Record
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="add-user-result" class="row text-light"></div>
                    <h4 class="card-title">
                        Records
                    </h4>
                    <p class="p-3 mb-0">Add Records</p>
                    <div class="row px-5">
                        <form id="add-user-form" class="px-5" action="{{ route('add-user') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required
                                       data-parsley-error-message="Enter user's first name"
                                       placeholder="First name"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required
                                       data-parsley-error-message="Enter your user's last name"
                                       placeholder="Last name"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date Of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required
                                       data-parsley-error-message="Select user date of birth" max="{{ date("Y-m-d") }}"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="province" class="form-label">Province</label>
                                <select id="province" class="form-select" name="province" required
                                        data-parsley-error-message="Select a province"
                                >
                                    <option value="" selected disabled>Please select</option>
                                    <option value="Eastern Cape">Eastern Cape</option>
                                    <option value="Free State">Free State</option>
                                    <option value="Gauteng">Gauteng</option>
                                    <option value="KwaZulu-Natal">KwaZulu-Natal</option>
                                    <option value="Limpopo">Limpopo</option>
                                    <option value="Mpumalanga">Mpumalanga</option>
                                    <option value="North West">North West</option>
                                    <option value="Northern Cape">Northern Cape</option>
                                    <option value="Western Cape">Western Cape</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" class="form-select" name="gender" required
                                        data-parsley-error-message="Select gender"
                                >
                                    <option value="" selected disabled>Please select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <span>Admin</span>
                                <div class="form-check">
                                    <input type="radio" id="adminNo" name="admin" value="0"
                                           required data-parsley-error-message="Choose an option"
                                    >
                                    <label for="adminNo">No</label>
                                    <input type="radio" id="adminYes" class="ms-3" name="admin" value="1"
                                           required data-parsley-error-message="Choose an option"
                                    >
                                    <label for="adminYes">Yes</label>
                                </div>
                            </div>
                            <input type="hidden" name="addUser" value="1">
                            <div class="mb-3 float-end">
                                <input type="submit" class="btn btn-primary" name="addUserButton" value="Add User">
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
        $('#add-user-form').on('submit', function (event){
            event.preventDefault();
            if ($(this).parsley().isValid()) {
                let formData = new FormData(this);
                $('#add-user-result').removeClass("bg-success");
                $('#add-user-result').removeClass("bg-danger");
                $('#add-user-result').removeClass("p-3");
                $('#add-user-result').text("");
                $.ajax({
                    type: "POST",
                    url: "/add-user",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        let result = JSON.parse(response);
                        let bootstrapClass = "bg-success";
                        if(result.error === "true") {
                            bootstrapClass = "bg-danger";
                        }
                        $('#add-user-result').addClass(bootstrapClass);
                        $('#add-user-result').addClass("p-3");
                        $('#add-user-result').text(result.message);
                        window.scrollTo(0, 0);
                        document.getElementById('add-user-form').reset();
                    }
                });
            }
        });
        addUserForm.parsley();
    </script>
@endsection

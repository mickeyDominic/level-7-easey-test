@extends('layouts.master')

@section('title')
    Delete Record
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="delete-user-result" class="row text-light p-3"></div>
                    <h4 class="card-title">
                        Records
                    </h4>
                    <p class="p-3 mb-0">Delete Record</p>
                    <div class="row px-5">
                        @if(empty($user->first_name))
                            <div class="mb-3">
                                <p><strong>User not found!</strong></p>
                            </div>
                        @else
                            <form id="delete-user-form" class="px-5" action="{{ route('delete-user') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <p>Are you sure you want to delete this user: <strong>{{ $user->first_name. " " . $user->last_name }}</strong> ?</p>
                                </div>
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <div class="mb-3">
                                    <a href="{{ route('list-users') }}" class="btn btn-primary mx-3">No</a>
                                    <input type="submit" class="btn btn-danger mx-3" name="deleteUserButton" value="Yes">
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            let deleteUserForm = $('#delete-user-form');
            deleteUserForm.on('submit', function (event){
                event.preventDefault();
                let formData = new FormData(this);
                // remove both classes as we don't know which was added
                $('#delete-user-result').removeClass("bg-success");
                $('#delete-user-result').removeClass("bg-danger");
                $('#delete-user-result').text("");
                $.ajax({
                    url: "/delete-user",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        let result = JSON.parse(response);
                        let bootstrapClass = "bg-success";
                        if(result.error === "true") {
                            bootstrapClass = "bg-danger";
                        } else {
                            $('#delete-user-form').hide();
                        }
                        $('#delete-user-result').addClass(bootstrapClass);
                        $('#delete-user-result').text(result.message);
                        window.scrollTo(0, 0);
                    }
                });
            });
        });
    </script>
@endsection

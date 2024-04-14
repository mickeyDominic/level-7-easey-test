@extends('layouts.master')

@section('title')
    List Records
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
                    <p class="p-3 mb-0">List Records</p>
                    <div class="row px-5">
                        <table id="userDetails" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date Of Birth</th>
                                    <th>Province</th>
                                    <th>Gender</th>
                                    <th>Admin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($users as $user) {
                                ?>
                            <tr>
                                <td> {{ $user->first_name . " " . $user->last_name }} </td>
                                <td> {{ $user->date_of_birth }} </td>
                                <td> {{ $user->province }} </td>
                                <td> {{ $user->gender }} </td>
                                <td> {{ $user->admin ? "Yes" : "No" }} </td>
                                <td>
                                    <a class="btn btn-info" href="/edit-user/{{ $user->UserId }}">Edit</a>
                                    <a class="btn btn-danger" href="/delete-user/{{ $user->UserId }}">Delete</a>
                                </td>
                            </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

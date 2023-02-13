<div class="modal fade bs-example-modal-lg" id="user-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{route('user-save')}}" method="post" id="user_form">
                @csrf
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" id="name" class="form-control" name="name">
                                <div class="text-danger clear-error" id="name_error"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Surname</label>
                                <input type="text" id="surname" class="form-control" name="surname">
                                <div class="text-danger clear-error" id="surname_error"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" id="email" class="form-control" name="email">
                                <div class="text-danger clear-error" id="email_error"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" id="mobile_number" class="form-control" name="mobile_number">
                                <div class="text-danger clear-error" id="mobile_number_error"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" id="passwords" class="form-control" name="password">
                                <div class="text-danger clear-error" id="password_error"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" id="password_confirmation" class="form-control"
                                       name="password_confirmation">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" id="dob" class="form-control" name="dob">
                                <div class="text-danger clear-error" id="dob_error"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>South Arfican Id</label>
                                <input type="number" id="south_african_id_no" class="form-control" name="south_african_id_no">
                                <div class="text-danger clear-error" id="south_african_id_no_error"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Language</label>
                                <select class="form-control" name="language" id="language">
                                    <option value="">Select Option</option>
                                    <option value="english">English</option>
                                    <option value="urdu">Urdu</option>
                                    <option value="punjabi">Punjabi</option>
                                    <option value="saraeke">Saraeke</option>
                                </select>
                                <div class="text-danger clear-error" id="language_error"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Interests</label>
                                <select class="custom-select2 form-control" id="interest_name"
                                        name="interest_name[]"
                                        multiple="multiple" style="width: 100%;">
                                    @foreach($interests as $interest)
                                        <optgroup>
                                            <option value="{{$interest->id}}">{{$interest->name}}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                                <div class="text-danger clear-error" id="interest_name_error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addOrUpdateUser()">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

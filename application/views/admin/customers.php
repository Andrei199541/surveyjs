<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <button class="btn btn-primary default float-right addNewCustomer">Add New Customer</button>
            </div>
            <div class="col-xl-12 col-lg-12">
                <div class="card h-100">
                    <div class="card-body">
                        <table class="data-table responsive nowrap" data-order="[[ 1, &quot;desc&quot; ]]">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Birthday</th>
                                    <th>Company Name</th>
                                    <th>Job</th>
                                    <th>Address</th>
                                    <th>Contact Number</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($users) && sizeof($users)) {
                                    foreach ($users as $user) {
                                ?>
                                <tr class="user_<?php echo $user->id;?>">
                                    <td>
                                        <p class="list-item-heading name"><?php echo $user->name;?></p>
                                    </td>
                                    <td>
                                        <p class="text-muted email"><?php echo $user->email;?></p>
                                    </td>
                                    <td>
                                        <p class="text-muted gender"><?php echo ($user->gender == 0 ? "Male" : "Female") ;?></p>
                                    </td>
                                    <td>
                                        <p class="text-muted birthday"><?php echo ($user->birthday == "" ? "" : $user->birthday) ;?></p>
                                    </td>
                                    <td>
                                        <p class="text-muted company"><?php echo $user->company;?></p>
                                    </td>
                                    <td>
                                        <p class="text-muted job"><?php echo $user->job;?></p>
                                    </td>
                                    <td>
                                        <p class="text-muted address"><?php echo $user->address;?></p>
                                    </td>
                                    <td>
                                        <p class="text-muted contact"><?php echo $user->contact;?></p>
                                    </td>
                                    <td>
                                        <p class="text-muted status"><?php echo ($user->role == 1 ? "Admin" : ($user->role == 2 ? "Free" : ($user->role == 3 ? "Freemium" : ($user->role == 4 ? "Paid" : "")))) ;?></p>
                                    </td>
                                    <td>
                                        <p class="text-muted status"><?php echo ($user->status == 0 ? "Enabled" : "Disabled") ;?></p>
                                    </td>
                                    <td>
                                        <button class="btn btn-info editBtn simple-icon-pencil" id="edit_<?php echo $user->id;?>"></button>
                                        <button class="btn btn-danger deleteBtn simple-icon-close" id="delete_<?php echo $user->id;?>"></button>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" id="editRow">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit the User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body user-info">
                        <div class="row">
                            <div class="col col-md-6 col-sm-6 col-xs-6">
                                <label>Name </label>
                                <input type="text" id="name"/>
                            </div>
                            <div class="col col-md-6 col-sm-6 col-xs-6">
                                <label>Email </label>
                                <input type="text" id="email" disabled />
                            </div>
                            <div class="col col-md-6 col-sm-6 col-xs-6 mt-2">
                                <label>Gender </label>
                                <select id="gender">
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                            <div class="col col-md-6 col-sm-6 col-xs-6 mt-2">
                                <label>Birthday </label>
                                <input type="date" id="birthday" />
                            </div>
                            <div class="col col-md-6 col-sm-6 col-xs-6 mt-2">
                                <label>Company Name </label>
                                <input type="text" id="company" />
                            </div>
                            <div class="col col-md-6 col-sm-6 col-xs-6 mt-2">
                                <label>Job </label>
                                <input type="text" id="job" />
                            </div>
                            <div class="col col-md-6 col-sm-6 col-xs-6 mt-2">
                                <label>Address </label>
                                <input type="text" id="address" />
                            </div>
                            <div class="col col-md-6 col-sm-6 col-xs-6 mt-2">
                                <label>Contact Number </label>
                                <input type="text" id="contact" />
                            </div>
                            <div class="col col-md-6 col-sm-6 col-xs-6 mt-2">
                                <label>Status </label>
                                <select id="status">
                                    <option value="0">Enabled</option>
                                    <option value="1">Disabled</option>
                                </select>
                            </div>
                            <div class="col col-md-6 col-sm-6 col-xs-6 mt-2">
                                <label>Plan </label>
                                <select id="role">
                                    <option value="2">Free</option>
                                    <option value="3">Freemium </option>
                                    <option value="4">Paid </option>
                                </select>
                            </div>
                            <div class="col col-md-6 col-sm-6 col-xs-6 mt-2">
                                <label>Password </label>
                                <input type="password" id="password" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success changeUserInfo">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
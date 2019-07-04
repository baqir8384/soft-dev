@extends('layouts.master')
@section('content')
  <div class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
                <section class="content-header">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-customer">New Customer</button>
                </section>
            </div>
            <div class="box-body">
              <div class="box">
                  <div class="box-header">
                     
                      <!-- Datatables -->
                      <p id="cust_message" style="display:none">Customer Message</p>
                      <table id="data_tbl5" class="table table-responsive col-md-12 col-xs-6 table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Photo</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Reg. Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($customers as $customer)
                          <tr>
                            <td><a href="#"><img src="{{ asset('image/user_image/user.png') }}" alt="" height="30" width="30"></a></td>
                            <td><a href="#" class="customer-detail" data-toggle="modal" data-target="#customer-profile"
                                data-cust-id="{{ $customer->cust_id }}" data-cust-name="{{ $customer->cust_name }}"
                                data-cust-lastname="{{ $customer->cust_lastname }}" data-cust-phone="{{ $customer->cust_phone }}"
                                data-cust-email="{{ $customer->cust_email }}" data-cust-state="{{ $customer->cust_state }}"
                                data-cust-addr="{{ $customer->cust_addr }}">
                                {{ $customer->cust_name }}</a></td>
                            <td>{{ $customer->cust_lastname }}</td>
                            <td>{{ $customer->cust_state }}, {{ $customer->cust_addr }}</td>
                            <td>{{ Carbon\carbon::parse($customer->created_at)->format('M d Y')  }}</td>
                            <td>
                              <button class="btn btn-danger btn-sm delete-customer" data-cust-id="{{ $customer->cust_id }}"
                                data-toggle="modal" data-target="#modal-delete-customer">
                                <i class="fa fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

        <!-- </div>
    </section> -->

    <!-- Modal AREA -->

    <!-- delete-customer -->
    <div class="modal fade" id="modal-delete-customer">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Customer Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="cust_id">
              <p>Are you sure you want delete this customer?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" onclick="deleteCustomer();">Delete</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    <!-- /.delete-customer -->

     <!-- edit-customer -->
     <div class="modal fade" id="modal-edit-customer">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Customer Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="cust_id">
                  <p>Are you sure you want delete this customer?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" onclick="deleteCustomer();">Delete</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        <!-- /.edit-customer -->
<!-- new-customer modal -->
<div class="modal fade" id="modal-customer">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add New Customer</h4>
              <ul id="msg_area" style="display:none">

              </ul>
            </div>
            <div class="modal-body">
                <div class="register-box-body">
                      @csrf 
                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="cust_name" type="text" class="form-control" name="cust_name" placeholder="Customer Name">
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="cust_lastname" type="text" class="form-control" name="cust_lastname" placeholder="Customer Last Name">
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                <input id="cust_phone" type="text" class="form-control" name="cust_phone" placeholder="Customer Phone">
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="cust_email" type="text" class="form-control" name="cust_email" placeholder="Customer Email (Optional)">
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                <input id="cust_state" type="text" class="form-control" name="cust_state" placeholder="Province/State">
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                <input id="cust_addr" type="text" class="form-control" name="cust_addr" placeholder="Address">
                            </div>
                        </div>
                
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="button" id="btn_add_customer" class="btn btn-primary">Add Now</button>
                      </div>
                  </div>
            </div>
            <!-- end of modal-body div -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.new-customer modal -->

      <!-- customer-profile -->
      <div class="modal fade" id="customer-profile">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Customer Details</h4>
              </div>
              <div class="modal-body">
                <!-- profile-tabs -->
                
                        <div class="nav-tabs-custom">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">About</a></li>
                            <li><a href="#timeline" data-toggle="tab" id="purchase_history">Balance</a></li>
                            <li><a href="#settings" data-toggle="tab">Edit</a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                              <!-- Post -->
                              <div class="post">
                                <div class="user-block">
                                  <img class="img-circle img-bordered-sm" src="{{ asset('image/user_image/user.png') }}" alt="user image">
                                      <span class="username">
                                        <a href="#" id="custName">Jonathan Burke Jr.</a>
                                        <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                      </span>
                                  <span class="description">Shared publicly - 7:30 PM today</span>
                                </div>
                                <!-- /.user-block -->
                               <p id="customer-phone">Customer Phone</p>
                               <p id="customer-email">Customer Email</p>
                               
                                <!-- <ul class="list-inline">
                                  <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                                  <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                  </li>
                                  <li class="pull-right">
                                    <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                      (5)</a></li>
                                </ul>
                
                                <input class="form-control input-sm" type="text" placeholder="Type a comment"> -->
                              </div>
                              <!-- /.post -->
                            </div>
                           
                            <div class="tab-pane" id="settings">
                              <form class="form-horizontal" id="customer-profile-form">
                                <input type="hidden" name="cust_id">
                                <!-- customer name -->
                                    <div class="form-group has-feedback">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                          <input id="edit_cust_name" type="text" class="form-control" name="cust_name" placeholder="Customer Name">
                                      </div>
                                   </div>
                                <!-- customer lastname -->
                                    <div class="form-group has-feedback">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                          <input id="edit_cust_lastname" type="text" class="form-control" name="cust_lastname" placeholder="Customer Last Name">
                                      </div>
                                   </div>
                                <!-- customer phone -->
                                    <div class="form-group has-feedback">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                          <input id="edit_cust_phone" type="number" class="form-control" name="cust_phone" placeholder="Customer Phone">
                                      </div>
                                   </div>
                                <!-- customer email -->
                                    <div class="form-group has-feedback">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                          <input id="edit_cust_email" type="email" class="form-control" name="cust_email" placeholder="Customer Email">
                                      </div>
                                   </div>
                                <!-- customer state -->
                                    <div class="form-group has-feedback">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                          <input id="edit_cust_state" type="text" class="form-control" name="cust_state" placeholder="Customer State">
                                      </div>
                                   </div>
                                <!-- customer address -->
                                    <div class="form-group has-feedback">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                          <input id="edit_cust_addr" type="text" class="form-control" name="cust_addr" placeholder="Customer Address">
                                      </div>
                                   </div>
                               
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right" id="btn-edit-customer">Change</button>
                                </div>
                              </form>
                            </div>
                            <!-- /.tab-pane -->
                          </div>
                          <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                <!-- /. profile-tabs -->
              </div>
              
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  
      <!-- /. customer-profile -->
    <!-- /. Modal AREA -->
@stop
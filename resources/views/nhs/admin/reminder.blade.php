@extends('layouts.main')
@section('page_title')
Reminder
@endsection

@section('page_content')
<div class="row">
    <div class="" align='right' style="float:right">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTop">Add new reminder <i class="ti ti-pin"></i></button>
    </div>
</div>
<div class="row justify-content-center">
        <div>Events reminders</div>
    <div class="col-lg-12 col-sm-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Notification content</th>
                        <th>Event price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-primary btn-xs"><i class="ti ti-edit"></i></button>
                                <button class="btn btn-danger btn-xs delete"><i class="ti ti-trash"></i></button>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>



<!-- Modal -->
                        <div class="modal modal-top fade" id="modalTop" tabindex="-1">
                          <div class="modal-dialog">
                            <form class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalTopTitle">Modal title</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameSlideTop" class="form-label">Name</label>
                                    <input
                                      type="text"
                                      id="nameSlideTop"
                                      class="form-control"
                                      placeholder="Enter Name" />
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="emailSlideTop" class="form-label">Email</label>
                                    <input
                                      type="email"
                                      id="emailSlideTop"
                                      class="form-control"
                                      placeholder="xxxx@xxx.xx" />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobSlideTop" class="form-label">DOB</label>
                                    <input type="date" id="dobSlideTop" class="form-control" />
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="button" class="btn btn-primary">Save</button>
                              </div>
                            </form>
                          </div>
                        </div>

@endsection

<!-- Toast Example -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="..." class="rounded me-2" alt="...">
            <strong class="me-auto">Bootstrap</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Hello, world! This is a toast message.
        </div>
    </div>
</div>


<!-- Logout -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered ">
    <div class="modal-content rounded-2">
      <div class="row modal-header text-center">
          <i class = "h1 material-icons">logout</i>
          <span class = "h3 text-center"><strong>Log Out</strong></span>
      </div>
      <div class="modal-body text-center">
        <strong>Are you sure do you want to log out?</strong>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary btn-lg waves-effect" data-bs-dismiss="modal">No</button>
        <button type="button" id = "modalLogOutBtn" class="btn btn-danger btn-lg waves-effect">Yes</button>
      </div>
    </div>
  </div>
</div>
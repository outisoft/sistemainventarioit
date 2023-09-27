@if (session('status_success'))
 <div class="alert alert-success" role="alert">
   <div class="container">
     <div class="d-flex">
       <div class="alert-icon">
         <i class="ion-ios-checkmark-circle"></i>
       </div>
       <p class="mb-0 ml-2"><b>Todo bien! </b>{{ session('status_success') }}</p>
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true"><i class="ion-ios-close"></i></span>
       </button>
     </div>
   </div>
 </div>
@endif

@if ($errors->any())
 <div class="alert alert-danger" role="alert">
     <ul>
        @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
        @endforeach
     </ul>
 </div>

@endif

@if (session('status_error'))
 <div class="alert alert-danger" role="alert">
   <div class="container">
     <div class="d-flex">
       <div class="alert-icon">
         <i class="ion-ios-checkmark-circle"></i>
       </div>
       <p class="mb-0 ml-2"><b>Algo salio mal! </b>{{ session('status_error') }}</p>
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true"><i class="ion-ios-close"></i></span>
       </button>
     </div>
   </div>
 </div>
@endif
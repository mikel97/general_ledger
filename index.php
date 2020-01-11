<!---include'header file for the frameworks and CSS-->
<?php
  include'includes/header.php';
?>

<?php
  include'includes/navigation.php';
?>
<div class="col-12 col-sm-9">
   <div class="container-fluid mt-3">
        <div class="card shadow-sm">
          <div class="navigation text-white card-header shadow-sm">
            <i class="fas fa-chart-line"></i> Dashboard
          </div>
          <div class="card-body">
            <div class="container-fluid">
              <div class="row">

                <div class="col-6 col-md-4 mb-2">
                  <div class="card">
                <div class="card-header bg-primary text-white">
                  <i class="fas fa-users"></i> Total Revenue
                </div>
                <div class="card-body">
                  <h2 class="card-title text-center"></h2>
                  
                </div>
                <div class="card-footer">
                  <a href="" class="text-center">More info <i class="far fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
             </div>

             <div class="col-6 col-md-4 mb-2">
                  <div class="card">
                <div class="card-header bg-primary text-white">
                  <i class="fas fa-users"></i> Total Expense
                </div>
                <div class="card-body">
                  <h2 class="card-title text-center"></h2>
                  
                </div>
                <div class="card-footer">
                  <a href="" class="text-center">More info <i class="far fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
             </div>

             <div class="col-6 col-md-4 mb-2">
                  <div class="card">
                <div class="card-header bg-primary text-white">
                  <i class="fas fa-users"></i> 
                </div>
                <div class="card-body">
                  <h2 class="card-title text-center"></h2>
                  
                </div>
                <div class="card-footer">
                  <a href="" class="text-center">More info <i class="far fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
             </div>

              </div>
            </div>


          </div>
        </div>
      </div>

      <div class="container-fluid mt-3">
        <div class="row">
          <div class="col-12">
               <div class="card shadow-sm">
                  <div class="card-body">
                    <canvas id="myChart" style="width: 100px; height: 40px;"></canvas>
                
                  </div>
               </div>
          </div>
          
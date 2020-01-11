<!---include'header file for the frameworks and CSS-->
<?php
  include'includes/header.php';
?>
<?php
  include'includes/navigation.php';
  include'classes/dashboardClass.php';
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
                  <h2 class="card-title text-center">
                    <?php 
                      $dashboard = new Dashboard();
                      $dashboard->Query("Income");
                      $total = $dashboard->Total * -1;
                      if ($total < 0) {
                        echo "₱ 0.00";
                      }else{
                        echo "₱ ".number_format($total);
                      }
                    ?>
                  </h2>
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
                  <h2 class="card-title text-center">
                    <?php 
                      $dashboard2 = new Dashboard();
                      $dashboard2->Query("Expense");
                      $total2 = $dashboard2->Total;
                      if ($total2 <= 0) {
                        echo "₱ 0.00";
                      }else{
                        echo "₱ ".number_format($total2);
                      }
                    ?>
                  </h2>
                  
                </div>
                <div class="card-footer">
                  <a href="" class="text-center">More info <i class="far fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
             </div>

             <div class="col-6 col-md-4 mb-2">
                  <div class="card">
                <div class="card-header bg-primary text-white">
                  <i class="fas fa-users"> Net
                    <?php 
                      $net = $total - $total2;
                      if ($net < 0) {
                        echo "Loss";
                        $net = $net * -1;
                      }
                      else{
                        echo "Income";
                      }
                    ?>
                  </i> 
                </div>
                <div class="card-body">
                  <h2 class="card-title text-center">
                    <?php
                      echo "₱ ".number_format($net);
                    ?>
                  </h2>
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
                    <center>
                      <div><h2>Income vs Expense</h2></div>
                      <canvas id="myChart" style="width: 100px; height: 40px;"></canvas>
                    </center>
                    <script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["0"
          <?php 
            $graph = new Dashboard();
            $graph->sort("YEAR");
          ?>
        ],
        datasets: [{
            label: 'Income',
            data: [0
              <?php 
                $graph->chart("Income","YEAR");
              ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        },
        {
            label: 'Expense',
            data: [0
             <?php 
                $graph->chart("Expense","YEAR");
              ?>
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 0.3)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script> 
                  </div>
               </div>
          </div>
        </div>
      </div>
    </div>
          
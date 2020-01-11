<?php
session_start();
  include'classes/database.php';
  $db = new Dbh();

// --------------- JOURNAL -------------

  if (isset($_POST['pdfJournal'])) {
    require('fpdf.php'); 
  
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(30,10,'Date',1,0,'C');
  $pdf->Cell(80,10,'Account Title & Explanation',1,0,'C');
  $pdf->Cell(15,10,'Ref',1,0,'C');
  $pdf->Cell(30,10,'Debit',1,0,'C');
  $pdf->Cell(30,10,'Credit',1,1,'C');

  $pdf->SetFont('Arial','B',10);
  $statement = $db->connect()->query("SELECT * FROM finance_entries where status = 'Inserted' Order by date_of_transaction ASC");
  while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    $newDate = date("M-j-Y", strtotime($row['date_of_transaction']));
    $date = explode("-", $newDate);

    $pdf->Cell(30,7,$date[0]." ".$date[1].", ".$date[2],1);
    $statement2 = $db->connect()->query("SELECT * FROM finance_coa where account_id = '$row[debit]'");
    while($row3 = $statement2->fetch(PDO::FETCH_ASSOC)){
        
      $pdf->Cell(80,7,$row3['account_title'],1);
      $pdf->Cell(15,7,$row3['account_no'],1,0,'C');
      $pdf->Cell(30,7,'P '.$row['amount'],1,0,'R');
      $pdf->Cell(30,7,'',1,1);
    }

  $statement3 = $db->connect()->query("SELECT * FROM finance_coa where account_id = '$row[credit]'");
    while($row4 = $statement3->fetch(PDO::FETCH_ASSOC)){

      $pdf->Cell(30,7,'',1);
      $pdf->Cell(80,7,$row4['account_title'],1);
      $pdf->Cell(15,7,$row4['account_no'],1,0,'C');
      $pdf->Cell(30,7,'',1);
      $pdf->Cell(30,7,'P '.$row['amount'],1,1,'R');
    }

    $pdf->Cell(30,7,'',1);
    $pdf->Cell(80,7,'('.$row['description'].')',1);
    $pdf->Cell(15,7,'',1);
    $pdf->Cell(30,7,'',1);
    $pdf->Cell(30,7,'',1,1);
      
  }
  $pdf->Cell(0,5,'',0,1,'C');
  $pdf->Cell(0,5,'',0,1,'C');
  $pdf->Cell(0,5,'',0,1,'C');
  $pdf->Cell(30,7,'',0);
  $pdf->Cell(80,7,'',0);
  $pdf->Cell(15,7,'',0);
  $pdf->Cell(30,7,$_SESSION['name'],0,1,'C');
  $pdf->Cell(30,5,'',0);
  $pdf->Cell(80,5,'',0);
  $pdf->Cell(15,5,'',0);
  $pdf->Cell(30,5,'('.$_SESSION['role'].')',0,'C');

  $pdf->Output('I', 'Journal.pdf');

  }


  // -------------- LEDGER ----------------
  
if (isset($_POST['pdfLedger'])) {

  require('fpdf.php');
  $pdf = new FPDF();

  $ledger = $db->connect()->query("SELECT DISTINCT category as 'category' FROM finance_coa");
  while($category = $ledger->fetch(PDO::FETCH_ASSOC)){

    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,$category['category'],1,1,'C');
    $pdf->Cell(0,5,'',0,1,'C');

    $statement = $db->connect()->query("SELECT * FROM finance_coa Where category = '$category[category]' Order by account_no");     
      while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        $statement1 = $db->connect()->query("SELECT SUM(amount) as 'Total' FROM finance_entries where debit = '$row[account_id]' and status = 'Inserted' ");
        $total = $statement1->fetch(PDO::FETCH_ASSOC);
        $totaldebit = $total['Total'];
          
        $statement2 = $db->connect()->query("SELECT SUM(amount) as 'Total' FROM finance_entries where credit = '$row[account_id]' and status = 'Inserted'");
        $total = $statement2->fetch(PDO::FETCH_ASSOC);
        $totalcredit = $total['Total'];


        $bal = $totaldebit - $totalcredit;
          $final_Bal=0;
          $mark = null;
          if ($bal < 0) {
            $mark = "Credit";
            $final_Bal = $bal * -1;
          }
          elseif($bal > 0){
            $mark = "Debit";
            $final_Bal = $bal;
          }       

          $pdf->SetFont('Arial','B',12);
          $pdf->Cell(150,7,$row['account_title'],0,0,'C');
          $pdf->Cell(40,7,$row['account_no'],0,1,'C');
          $pdf->Cell(30,7,'Date',1,0,'C');
          $pdf->Cell(100,7,'Explanation',1,0,'C');
          $pdf->Cell(30,7,'Debit',1,0,'C');
          $pdf->Cell(30,7,'Credit',1,1,'C');

          $stmt1 = $db->connect()->query("SELECT * FROM finance_entries where debit = '$row[account_id]' and status = 'Inserted' Order by date_of_transaction");
          while($row4 = $stmt1->fetch(PDO::FETCH_ASSOC)){

            $pdf->Cell(30,7,$row4['date_of_transaction'],1,0,'C');
            $pdf->Cell(100,7,$row4['description'],1,0,'C');
            $pdf->Cell(30,7,'P '.$row4['amount'],1,0,'C');
            $pdf->Cell(30,7,'',1,1,'C');

          }

          $stmt4 = $db->connect()->query("SELECT * FROM finance_entries where credit = '$row[account_id]' and status = 'Inserted' Order by date_of_transaction");
          while($row3 = $stmt4->fetch(PDO::FETCH_ASSOC)){

            $pdf->Cell(30,7,$row3['date_of_transaction'],1,0,'C');
            $pdf->Cell(100,7,$row3['description'],1,0,'C');
            $pdf->Cell(30,7,'',1,0,'C');
            $pdf->Cell(30,7,'P '.$row3['amount'],1,1,'C');
          }

        $pdf->Cell(130,5,'Total',1,0,'L');
        $pdf->Cell(30,5,'P '.$totaldebit,1,0,'C');
        $pdf->Cell(30,5,'P '.$totalcredit,1,1,'C');
        $pdf->Cell(130,5,$mark.' Balance',1,0,'L');
        $pdf->Cell(60,5,'P '.$final_Bal,1,1,'C');
        $pdf->Cell(60,5,'',0,1,'C');         
  }

}

  $pdf->Cell(0,5,'',0,1,'C');
  $pdf->Cell(0,5,'',0,1,'C');
  $pdf->Cell(0,5,'',0,1,'C');
  $pdf->Cell(30,7,'',0);
  $pdf->Cell(80,7,'',0);
  $pdf->Cell(15,7,'',0);
  $pdf->Cell(30,7,'Prepared by:     '.$_SESSION['name'],0,1,'C');
  $pdf->Cell(30,5,'',0);
  $pdf->Cell(80,5,'',0);
  $pdf->Cell(15,5,'',0);
  $pdf->Cell(30,5,'      ('.$_SESSION['role'].')',0,'C');

  $pdf->Output('I', 'Ledger.pdf');

}

// ------------- TRIAL BALANCE -----------------


if (isset($_POST['pdfTBalance'])) {

    require('fpdf.php');
  
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,5,'Skyline Hotel and Restaurant',0,1,'C');
    $pdf->Cell(0,5,'Trial Balance',0,1,'C');
    $pdf->Cell(0,5,'Date',0,1,'C');
    $pdf->Cell(110,10,'Account Title',1,0,'C');
    $pdf->Cell(40,10,'Debit',1,0,'C');
    $pdf->Cell(40,10,'Credit',1,1,'C');
    $pdf->SetFont('Arial','B',10);

  $statement = $db->connect()->query("SELECT * FROM finance_coa Order by account_no");  
    $totalDebit = 0;
    $totalCredit = 0; 

      while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // DEBIT
          $statement3 = $db->connect()->query("SELECT SUM(amount) as 'debit' FROM finance_entries where debit = '$row[account_id]' and status = 'Inserted'");
          $total = $statement3->fetch(PDO::FETCH_ASSOC);
          $totalDebitBal = $total['debit'];
      
      // CREDIT
          $statement6 = $db->connect()->query("SELECT SUM(amount) as 'credit' FROM finance_entries where credit = '$row[account_id]' and status = 'Inserted'");
          $total1 = $statement6->fetch(PDO::FETCH_ASSOC);
          $totalCreditBal =  $total1['credit'];

      $balance = $totalDebitBal - $totalCreditBal;
        if ($balance < 0) {
          $balance = $balance * -1;
          $totalCredit = $totalCredit + $balance;

          $pdf->Cell(110,7,$row['account_title'],1,0);
          $pdf->Cell(40,7,'---',1,0,'C');
          $pdf->Cell(40,7,'P '.number_format($balance),1,1,'C');
        }
        else if ($balance == 0) {
          
        }
        else{
          $totalDebit = $totalDebit + $balance;

          $pdf->Cell(110,7,$row['account_title'],1,0);
          $pdf->Cell(40,7,'P '.number_format($balance),1,0,'C');
          $pdf->Cell(40,7,'---',1,1,'C');
        }

      }

      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(110,10,'Total',1,0);
      $pdf->SetFont('Arial','U',10);
      $pdf->Cell(40,10,'P '.number_format($totalDebit),1,0,'C');
      $pdf->Cell(40,10,'P '.number_format($totalCredit),1,1,'C');

      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(0,5,'',0,1,'C');
      $pdf->Cell(0,5,'',0,1,'C');
      $pdf->Cell(0,5,'',0,1,'C');
      $pdf->Cell(30,7,'',0);
      $pdf->Cell(80,7,'',0);
      $pdf->Cell(15,7,'',0);
      $pdf->Cell(30,7,'Prepared by:     '.$_SESSION['name'],0,1,'C');
      $pdf->Cell(30,5,'',0);
      $pdf->Cell(80,5,'',0);
      $pdf->Cell(15,5,'',0);
      $pdf->Cell(30,5,'         ('.$_SESSION['role'].')',0,'C');

      $pdf->Output('I','Trial balance.pdf');
}







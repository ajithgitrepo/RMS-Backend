

<h3>Hello,</h3>

@if($month != "" && $year != "") 
<h3> Please find the {{$type}}  for the  month of {{$month}} - {{$year}} report.</h3>
@endif 
    
@if($month != "" && $year == "") 
<h3> Please find the {{$type}}  for this month report.</h3>
@endif


<?php
session_start();

if(isset($_SESSION["section"])=="WE"){
    include '../config.php';
    $sql1 = "SELECT job_typ,  COUNT(*) AS 'total' FROM jobservce GROUP BY job_typ";
    $result1 = mysqli_query($conn,$sql1);
    $PJ = $VM = $BJ = $M = $TRG = $PRG = $PR = $STC = $VTI = $DP = 0;
    $total = 100;
    while($row = mysqli_fetch_assoc($result1)){

        if(($row['job_typ'])=="PJ"){
            $PJ = $row['total']; $total = $total + $PJ;
        }
        if(($row['job_typ'])=="VM"){
            $VM = $row['total']; $total = $total + $VM;
        }
        if(($row['job_typ'])=="BJ"){
            $BJ = $row['total']; $total = $total + $BJ;
        }
        if(($row['job_typ'])=="M"){
            $M = $row['total']; $total = $total + $M;
        }
        if(($row['job_typ'])=="TRG"){
            $TRG = $row['total']; $total = $total + $TRG;
        }
        if(($row['job_typ'])=="PRG"){
            $PRG = $row['total']; $total = $total + $PRG;
        }
        if(($row['job_typ'])=="PR"){
            $PR = $row['total']; $total = $total + $PR;
        }
        if(($row['job_typ'])=="STC"){
            $STC = $row['total']; $total = $total + $STC ;
        }
        if(($row['job_typ'])=="VTI"){
            $VTI = $row['total']; $total = $total + $VTI;
        }
        if(($row['job_typ'])=="DP"){
            $DP = $row['total']; $total = $total + $DP;
        }
    }


    $sql2 = "SELECT sec_code, COUNT(*) AS 'total' FROM jobservce GROUP BY sec_code";
    $result2 = mysqli_query($conn,$sql2);
    $ch=$en=$vrs=$ws=$am=$ae=$pe=$mw=$jm=$ba=$bb=$ta=$ac= 0;
    $total = 100;
    while($row1 = mysqli_fetch_assoc($result2)){
        if(($row1['sec_code'])=="CH"){
            $ch = $row1['total']; $total = $total + $ch;
        }
        if(($row1['sec_code'])=="EN"){
            $en = $row1['total']; $total = $total + $en;
        }
        if(($row1['sec_code'])=="VRS"){
            $vrs = $row1['total']; $total = $total + $vrs;
        }
        if(($row1['sec_code'])=="WS"){
            $ws = $row1['total']; $total = $total + $ws;
        }
        if(($row1['sec_code'])=="AM"){
            $am = $row1['total']; $total = $total + $am;
        }
        if(($row1['sec_code'])=="AE"){
            $ae = $row1['total']; $total = $total + $ae;
        }
        if(($row1['sec_code'])=="PE"){
            $pe = $row1['total']; $total = $total + $pe;
        }
        if(($row1['sec_code'])=="MW"){
            $mw = $row1['total']; $total = $total + $mw ;
        }
        if(($row1['sec_code'])=="JM"){
            $jm = $row1['total']; $total = $total + $jm;
        }
        if(($row1['sec_code'])=="BA"){
            $ba = $row1['total']; $total = $total + $ba;
        }
        if(($row1['sec_code'])=="BB"){
            $bb = $row1['total']; $total = $total + $bb;
        }
        if(($row1['sec_code'])=="TA"){
            $ta = $row1['total']; $total = $total + $ta;
        }
        if(($row1['sec_code'])=="AC"){
            $ac = $row1['total']; $total = $total + $ac;
        }
    }

    $sql3 = "SELECT job_typ, job_no, COUNT(*) AS 'total' FROM jobservce WHERE gatepass='F' GROUP BY job_typ";
    $result3 = mysqli_query($conn,$sql3);
    $PJf = $VMf = $BJf = $Mf = $TRGf = $PRGf = $PRf = $STCf = $VTIf = $DPf = 0;
    $total = 100;
    while($row2 = mysqli_fetch_assoc($result3)){
        $b=$row2['job_no'];
        if(($row2['job_typ'])=="PJ"){
            $PJf = $row2['total']; $total = $total + $PJf;
        }
        if(($row2['job_typ'])=="VM"){
            $VMf = $row2['total']; $total = $total + $VMf;
        }
        if(($row2['job_typ'])=="BJ"){
            $BJf = $row2['total']; $total = $total + $BJf;
        }
        if(($row2['job_typ'])=="M"){
            $Mf = $row2['total']; $total = $total + $Mf;
        }
        if(($row2['job_typ'])=="TRG"){
            $TRGf = $row2['total']; $total = $total + $TRGf;
        }
        if(($row2['job_typ'])=="PRG"){
            $PRGf = $row2['total']; $total = $total + $PRGf;
        }
        if(($row2['job_typ'])=="PR"){
            $PRf = $row2['total']; $total = $total + $PRf;
        }
        if(($row2['job_typ'])=="STC"){
            $STCf = $row2['total']; $total = $total + $STCf ;
        }
        if(($row2['job_typ'])=="VTI"){
            $VTIf = $row2['total']; $total = $total + $VTIf;
        }
        if(($row2['job_typ'])=="DP"){
            $DPf = $row2['total']; $total = $total + $DPf;
        }
    }

    $sql4 = "SELECT sec_code, COUNT(*) AS 'total' FROM jobservce WHERE gatepass='F' GROUP BY sec_code";
    $result4 = mysqli_query($conn,$sql4);
    $chf=$enf=$vrsf=$wsf=$amf=$aef=$pef=$mwf=$jmf=$baf=$bbf=$taf=$acf= 0;
    $total = 100;
    while($row3 = mysqli_fetch_assoc($result4)){
        if(($row3['sec_code'])=="CH"){
            $chf = $row3['total']; $total = $total + $chf;
        }
        if(($row3['sec_code'])=="EN"){
            $enf = $row3['total']; $total = $total + $enf;
        }
        if(($row3['sec_code'])=="VRS"){
            $vrsf = $row3['total']; $total = $total + $vrsf;
        }
        if(($row3['sec_code'])=="WS"){
            $wsf = $row3['total']; $total = $total + $wsf;
        }
        if(($row3['sec_code'])=="AM"){
            $amf = $row3['total']; $total = $total + $amf;
        }
        if(($row3['sec_code'])=="AE"){
            $aef = $row3['total']; $total = $total + $aef;
        }
        if(($row3['sec_code'])=="PE"){
            $pef = $row3['total']; $total = $total + $pef;
        }
        if(($row3['sec_code'])=="MW"){
            $mwf = $row3['total']; $total = $total + $mwf ;
        }
        if(($row3['sec_code'])=="JM"){
            $jmf = $row3['total']; $total = $total + $jmf;
        }
        if(($row3['sec_code'])=="BA"){
            $baf = $row3['total']; $total = $total + $baf;
        }
        if(($row3['sec_code'])=="BB"){
            $bbf = $row3['total']; $total = $total + $bbf;
        }
        if(($row3['sec_code'])=="TA"){
            $taf = $row3['total']; $total = $total + $taf;
        }
        if(($row3['sec_code'])=="AC"){
            $acf = $row3['total']; $total = $total + $acf;
        }
    }

    function getPercentage($v,$total){
        $percentage = round($v / $total * 100);
        return $percentage;
    }

    $sql7 = "SELECT COUNT(*) AS 'inboxCount' FROM messages WHERE (t='JO' AND readBy='F')";
    $result7 = mysqli_query($conn,$sql7);
    //$row = mysqli_fetch_assoc($result2);
    //$inboxCount = $row['inboxCount'];

}
else{
    header("Location:index.php");
}
?>
<!DOCTYPE html>

<html>
<head>

    <title>CGTTI JobInfo</title>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <!--<link rel="stylesheet" type="text/css" href="CSS/index.css">-->
    <link rel="stylesheet" type="text/css" href="../CSS/jobOffice.css">
    <!--<link rel="stylesheet" type="text/css" href="CSS/viewJob.css">-->
    <link rel="stylesheet" type="text/css" href="../CSS/button.css">
    <meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=no">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/font-awesome.css">

</head>

<body class="body">

<?php include 'adHeader.php'; ?>
<div class="pageArea">
    <div class="chart-area">
        <div class="chart-header">Ongoing Jobs By Categories</div>
        <div class="chart-area-left">
            <a href="viewjob.php?id=$b"><canvas id="1" width="250" height="250"><script type="text/javascript"></script></canvas></a>
        </div>
        <div class="chart-area-right">
            <div class="chart-list"><div class="color-sqr" style="background-color:#F15854;"></div>
                <div class="detail-name">Private Jobs<span> (<?php echo getPercentage($PJf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#5DA5DA;"></div>
                <div class="detail-name">Bus Jobs<span> (<?php echo getPercentage($BJf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#38437E;"></div>
                <div class="detail-name">Vehicle Maintains<span> (<?php echo getPercentage($VMf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#269546;"></div>
                <div class="detail-name">Institute Maintainance<span> (<?php echo getPercentage($Mf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#B276B2;"></div>
                <div class="detail-name">Training (Full Time)<span> (<?php echo getPercentage($TRGf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#9A2C6B;"></div>
                <div class="detail-name">Training (Part Time)<span> (<?php echo getPercentage($PRGf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#DECF3F;"></div>
                <div class="detail-name">Production<span> (<?php echo getPercentage($PRf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#1F6C85;"></div>
                <div class="detail-name">Special Training Course<span> (<?php echo getPercentage($STCf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#4D4D4D;"></div>
                <div class="detail-name">Borella Institute<span> (<?php echo getPercentage($VTIf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#B2431F;"></div>
                <div class="detail-name">Director Bunglow<span> (<?php echo getPercentage($DPf,$total);?>%)</span></div></div>
        </div>
    </div>


    <div class="chart-area">
        <div class="chart-header">Ongoing Jobs By Sections</div>
        <div class="chart-area-left">
            <a href="jobbysec.php?id=$a"><canvas id="2" width="250" height="250"><script type="text/javascript"></script></canvas></a>
        </div>
        <div class="chart-area-right">
            <div class="chart-list"><div class="color-sqr" style="background-color:#F15854;"></div>
                <div class="detail-name">Chassis<span> (<?php echo getPercentage($chf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#5DA5DA;"></div>
                <div class="detail-name">Engine<span> (<?php echo getPercentage($enf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#38437E;"></div>
                <div class="detail-name">Vehicle Repair<span> (<?php echo getPercentage($vrsf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#269546;"></div>
                <div class="detail-name">Welding<span> (<?php echo getPercentage($wsf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#B276B2;"></div>
                <div class="detail-name">Automobile<span> (<?php echo getPercentage($amf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#9A2C6B;"></div>
                <div class="detail-name">Auto Electrical<span> (<?php echo getPercentage($aef,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#DECF3F;"></div>
                <div class="detail-name">Power Electrica<span> (<?php echo getPercentage($pef,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#1F6C85;"></div>
                <div class="detail-name">Mill Wright<span> (<?php echo getPercentage($mwf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#4D4D4D;"></div>
                <div class="detail-name">Jool Machine<span> (<?php echo getPercentage($jmf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#B2431F;"></div>
                <div class="detail-name">Basic A<span> (<?php echo getPercentage($baf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#7fff00;"></div>
                <div class="detail-name">Basic B<span> (<?php echo getPercentage($bbf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#ff1493;"></div>
                <div class="detail-name">MTTC<span> (<?php echo getPercentage($taf,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#ffa07a;"></div>
                <div class="detail-name">A/C Section<span> (<?php echo getPercentage($acf,$total);?>%)</span></div></div>
        </div>
    </div>



    <div class="chart-area">
        <div class="chart-header">Registered Jobs By Categories</div>
        <div class="chart-area-left">
            <canvas id="3" width="250" height="250"><script type="text/javascript"></script></canvas>
        </div>
        <div class="chart-area-right">
            <div class="chart-list"><div class="color-sqr" style="background-color:#F15854;"></div>
                <div class="detail-name">Private Jobs<span> (<?php echo getPercentage($PJ,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#5DA5DA;"></div>
                <div class="detail-name">Bus Jobs<span> (<?php echo getPercentage($BJ,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#38437E;"></div>
                <div class="detail-name">Vehicle Maintains<span> (<?php echo getPercentage($VM,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#269546;"></div>
                <div class="detail-name">Institute Maintainance<span> (<?php echo getPercentage($M,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#B276B2;"></div>
                <div class="detail-name">Training (Full Time)<span> (<?php echo getPercentage($TRG,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#9A2C6B;"></div>
                <div class="detail-name">Training (Part Time)<span> (<?php echo getPercentage($PRG,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#DECF3F;"></div>
                <div class="detail-name">Production<span> (<?php echo getPercentage($PR,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#1F6C85;"></div>
                <div class="detail-name">Special Training Course<span> (<?php echo getPercentage($STC,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#4D4D4D;"></div>
                <div class="detail-name">Borella Institute<span> (<?php echo getPercentage($VTI,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#B2431F;"></div>
                <div class="detail-name">Director Bunglow<span> (<?php echo getPercentage($DP,$total);?>%)</span></div></div>
        </div>
    </div>

    <div class="chart-area">
        <div class="chart-header">Registered Jobs By Sections</div>
        <div class="chart-area-left">
            <canvas id="4" width="250" height="250"><script type="text/javascript"></script></canvas>
        </div>
        <div class="chart-area-right">
            <div class="chart-list"><div class="color-sqr" style="background-color:#F15854;"></div>
                <div class="detail-name">Chassis<span> (<?php echo getPercentage($ch,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#5DA5DA;"></div>
                <div class="detail-name">Engine<span> (<?php echo getPercentage($en,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#38437E;"></div>
                <div class="detail-name">Vehicle Repair<span> (<?php echo getPercentage($vrs,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#269546;"></div>
                <div class="detail-name">Welding<span> (<?php echo getPercentage($ws,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#B276B2;"></div>
                <div class="detail-name">Automobile<span> (<?php echo getPercentage($am,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#9A2C6B;"></div>
                <div class="detail-name">Auto Electrical<span> (<?php echo getPercentage($ae,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#DECF3F;"></div>
                <div class="detail-name">Power Electrica<span> (<?php echo getPercentage($pe,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#1F6C85;"></div>
                <div class="detail-name">Mill Wright<span> (<?php echo getPercentage($mw,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#4D4D4D;"></div>
                <div class="detail-name">Jool Machine<span> (<?php echo getPercentage($jm,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#B2431F;"></div>
                <div class="detail-name">Basic A<span> (<?php echo getPercentage($ba,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#7fff00;"></div>
                <div class="detail-name">Basic B<span> (<?php echo getPercentage($bb,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#ff1493;"></div>
                <div class="detail-name">MTTC<span> (<?php echo getPercentage($ta,$total);?>%)</span></div></div><br>
            <div class="chart-list"><div class="color-sqr" style="background-color:#20b2aa;"></div>
                <div class="detail-name">A/C Section<span> (<?php echo getPercentage($ac,$total);?>%)</span></div></div>
        </div>
    </div>





    <script>
        var colors = ["#F15854","#5DA5DA","#38437E","#269546","#B276B2","#9A2C6B", "#DECF3F","#1F6C85","#4D4D4D","#B2431F"];
        var data = [<?php echo $PJ; ?>, <?php echo $BJ; ?>, <?php echo $VM; ?>, <?php echo $M; ?>, <?php echo $TRG; ?>, <?php echo $PRG; ?>, <?php echo $PR; ?>, <?php echo $STC; ?>, <?php echo $VTI; ?>, <?php echo $DP; ?>];

        function getTotal(){
            var total = 0;
            for (var j = 0; j < data.length; j++) {
                total += (typeof data[j] == 'number') ? data[j] : 0;
            }
            return total;
        }

        function addData() {
            var canvas;
            var contex;
            var lastValue = 0;
            var total = getTotal();

            canvas = document.getElementById("3");
            contex = canvas.getContext("2d");
            /*contex.shadowBlur=0;
             contex.shadowColor="black";
             contex.shadowOffsetX = 1;
             contex.shadowOffsetY = 1;*/
            contex.clearRect(0, 0, canvas.width, canvas.height);

            for (var i = 0; i < data.length; i++) {
                contex.fillStyle = colors[i];
                contex.beginPath();
                contex.moveTo(125,125);
                contex.arc(125,125,125,lastValue,lastValue+(Math.PI*2*(data[i]/total)),false);
                contex.lineTo(125,125);
                contex.fill();
                lastValue += Math.PI*2*(data[i]/total);
            }
        }

        addData();
    </script>

    <script>
        var colors1 = ["#F15854","#5DA5DA","#38437E","#269546","#B276B2","#9A2C6B", "#DECF3F","#1F6C85","#4D4D4D","#B2431F"];
        var data1 = [<?php echo $PJf; ?>, <?php echo $BJf; ?>, <?php echo $VMf; ?>, <?php echo $Mf; ?>, <?php echo $TRGf; ?>, <?php echo $PRGf; ?>, <?php echo $PRf; ?>, <?php echo $STCf; ?>, <?php echo $VTI; ?>, <?php echo $DP; ?>];

        function getTotal2(){
            var total = 0;
            for (var j = 0; j < data1.length; j++) {
                total += (typeof data1[j] == 'number') ? data1[j] : 0;
            }
            return total;
        }

        function addData2() {
            var canvas;
            var contex;
            var lastValue = 0;
            var total = getTotal2();

            canvas = document.getElementById("1");
            contex = canvas.getContext("2d");
            /*contex.shadowBlur=0;
             contex.shadowColor="black";
             contex.shadowOffsetX = 1;
             contex.shadowOffsetY = 1;*/
            contex.clearRect(0, 0, canvas.width, canvas.height);

            for (var i = 0; i < data1.length; i++) {
                contex.fillStyle = colors1[i];
                contex.beginPath();
                contex.moveTo(125,125);
                contex.arc(125,125,125,lastValue,lastValue+(Math.PI*2*(data1[i]/total)),false);
                contex.lineTo(125,125);
                contex.fill();
                lastValue += Math.PI*2*(data1[i]/total);
            }
        }

        addData2();
    </script>

    <script>
        var colorss = ["#F15854","#5DA5DA","#38437E","#269546","#B276B2","#9A2C6B", "#DECF3F","#1F6C85","#4D4D4D","#B2431F","#7fff00","#ff1493","#20b2aa"];
        var dataa = [<?php echo $ch; ?>, <?php echo $en; ?>, <?php echo $vrs; ?>, <?php echo $ws; ?>, <?php echo $am; ?>, <?php echo $ae; ?>, <?php echo $pe; ?>, <?php echo $mw; ?>, <?php echo $jm; ?>, <?php echo $ba; ?> , <?php echo $bb; ?> , <?php echo $ta; ?> , <?php echo $ac; ?> ];

        function getTotal1(){
            var total = 0;
            for (var j = 0; j < dataa.length; j++) {
                total += (typeof dataa[j] == 'number') ? dataa[j] : 0;
            }
            return total;
        }

        function addData1() {
            var canvas;
            var contex;
            var lastValue = 0;
            var total = getTotal1();

            canvas = document.getElementById("4");
            contex = canvas.getContext("2d");
            /*contex.shadowBlur=0;
             contex.shadowColor="black";
             contex.shadowOffsetX = 1;
             contex.shadowOffsetY = 1;*/
            contex.clearRect(0, 0, canvas.width, canvas.height);

            for (var i = 0; i < dataa.length; i++) {
                contex.fillStyle = colorss[i];
                contex.beginPath();
                contex.moveTo(125,125);
                contex.arc(125,125,125,lastValue,lastValue+(Math.PI*2*(dataa[i]/total)),false);
                contex.lineTo(125,125);
                contex.fill();
                lastValue += Math.PI*2*(dataa[i]/total);
            }
        }

        addData1();
    </script>
    <script>
        var colorss1 = ["#F15854","#5DA5DA","#38437E","#269546","#B276B2","#9A2C6B", "#DECF3F","#1F6C85","#4D4D4D","#B2431F","#7fff00","#ff1493","#20b2aa"];
        var dataa1 = [<?php echo $chf; ?>, <?php echo $enf; ?>, <?php echo $vrsf; ?>, <?php echo $wsf; ?>, <?php echo $amf; ?>, <?php echo $aef; ?>, <?php echo $pef; ?>, <?php echo $mwf; ?>, <?php echo $jmf; ?>, <?php echo $baf; ?> , <?php echo $bbf; ?> , <?php echo $taf; ?> , <?php echo $acf; ?> ];

        function getTotal3(){
            var total = 0;
            for (var j = 0; j < dataa1.length; j++) {
                total += (typeof dataa1[j] == 'number') ? dataa1[j] : 0;
            }
            return total;
        }

        function addData3() {
            var canvas;
            var contex;
            var lastValue = 0;
            var total = getTotal3();

            canvas = document.getElementById("2");
            contex = canvas.getContext("2d");
            /*contex.shadowBlur=0;
             contex.shadowColor="black";
             contex.shadowOffsetX = 1;
             contex.shadowOffsetY = 1;*/
            contex.clearRect(0, 0, canvas.width, canvas.height);

            for (var i = 0; i < dataa1.length; i++) {
                contex.fillStyle = colorss1[i];
                contex.beginPath();
                contex.moveTo(125,125);
                contex.arc(125,125,125,lastValue,lastValue+(Math.PI*2*(dataa1[i]/total)),false);
                contex.lineTo(125,125);
                contex.fill();
                lastValue += Math.PI*2*(dataa1[i]/total);
            }
        }

        addData3();
    </script>

</body>

</html>
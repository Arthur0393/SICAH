<?php
function fecha($cuenta)
	{	
	$result = mysql_query(" SELECT fecha_de_ingreso
                                FROM clientes
                                WHERE Cuenta = '$cuenta'");
	$des2=mysql_fetch_row($result);   
    list($fech,$hr) = split("[ ]", $des2[0]);	
	return $fech;
	}
	
	function descuento($cuenta)
	{
	 $des=$this->fecha($cuenta);	 
     list($year1, $month1, $day1) = split('[/.-]', $des);   
	 $year=$this->year();
	 $month=$this->month();
	 $day=$this->day();
	 $dias=$this->dias($month1,$day1,$year1,$month,$day,$year);
	 $result = mysql_query(" SELECT cuentas.saldo FROM cuentas WHERE Cuenta = '$cuenta'");
	 $saldo=mysql_fetch_row($result);
if($dias>0 && $dias<=30)
{  
 $des2=$saldo[0]*.30;
 $dest=$saldo[0]-$des2;
 echo "Saldo actual:".$saldo[0]."<br>";
 echo "Ahorro:".$des2."<br>";
 echo "Pago con descuento:".$dest."<br>";
 echo $this->agregardescuento($des2,$dest,$cuenta);
}
if($dias>30 && $dias<=60)
{  
 $des2=$saldo[0]*.20;
 $dest=$saldo[0]-$des2;
 echo "Saldo actual:".$saldo[0]."<br>";
 echo "Ahorro:".$des2."<br>";
 echo "Pago con descuento:".$dest."<br>";
 echo $this->agregardescuento($des2,$dest,$cuenta);
}
if($dias>60 && $dias<=180)
{  
 $des2=$saldo[0]*.15;
 $dest=$saldo[0]-$des2;
 echo "Saldo actual:".$saldo[0]."<br>";
 echo "Ahorro:".$des2."<br>";
 echo "Pago con descuento:".$dest."<br>";
 echo $this->agregardescuento($des2,$dest,$cuenta);
}
if($dias>180 && $dias<=240)
{ 
 $des2=$saldo[0]*.10;
 $dest=$saldo[0]-$des2;
 echo "Saldo actual:".$saldo[0]."<br>";
 echo "Ahorro:".$des2."<br>";
 echo "Pago con descuento:".$dest."<br>";
 echo $this->agregardescuento($des2,$dest,$cuenta);
}
if($dias>240)
{ 
 $des2=0;
 $dest=$saldo[0];
 echo "Saldo actual:".$saldo[0]."<br>";
 echo "Ahorro:".$des2."<br>";
 echo "Pago con descuento:".$dest."<br>";
 echo $this->agregardescuento($des2,$dest,$cuenta);
}
}

function year(){$year=date("Y");
	 return $year;
	}
	function month(){$month=date("m");
	return $month;
	}
	function day(){$day=date("d");	
	return $day;
	}
	
function dias($month1,$day1,$year1,$month,$day,$year)
{
$timestamp1 = mktime(0,0,0,$month1,$day1,$year1); 
$timestamp2 = mktime(0,0,0,$month,$day,$year); 

//resto a una fecha la otra 
$segundos_diferencia = $timestamp1 - $timestamp2;  

//convierto segundos en días 
$dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 

//obtengo el valor absoulto de los días (quito el posible signo negativo) 
$dias_diferencia = abs($dias_diferencia); 

//quito los decimales a los días de diferencia 
$dias_diferencia = floor($dias_diferencia);

echo "Dias: ".$dias_diferencia."<br>";
return $dias_diferencia;
}

function agregardescuento($des2,$dest,$cuenta){
        $sql = "UPDATE cuentas SET Descuento = '$dest', Ahorro='$des2' WHERE Cuenta = '$cuenta'";
        $result = mysql_query($sql);        
        /*if(!$result){
            return('Imposible agregar registro: ' .mysql_error());
        }*/

        return 'Descuento Agregado Exitosamente';
    }

function week()
{
 return date("W");  
}

function obtenerpago($cuenta)
{
 $sql = "SELECT cuentas.tipo_pago FROM cuentas WHERE Cuenta = '$cuenta'";
 $result = mysql_query($sql);
 $pago=mysql_fetch_row($result);
 return $pago[0];
}

function obteneranual($cuenta, $recibo)
{
 $sql = "SELECT recibos.anual FROM recibos WHERE Cuenta = '$cuenta' AND idrecibo='$recibo'";
 $result = mysql_query($sql);
 $pago=mysql_fetch_row($result);
 return $pago[0];
}

function actualizarestado($cuenta, $recibo)
{
 $fecha=date("Y-m-d");
 $abono=$this->obtenerabono($cuenta);
 $result=mysql_query("UPDATE recibos SET estado = 4, fecha='$fecha', cantidad='$abono' WHERE Cuenta='$cuenta' AND estado=3 AND idrecibo='$recibo'");
 /*if(!$result){
            return('Imposible agregar registro: ' .mysql_error());
        }*/

        return 'Agregado Exitosamente';
}

function atrasos($cuenta)
{
 $resul=mysql_query("SELECT COUNT(*)estado FROM recibos WHERE estado=2 AND Cuenta='$cuenta'");
 $result=mysql_fetch_row($resul);
 return $result[0];
}

function actualizaratrasoacumulado($cuenta, $recibo)
{
 $atraso=$this->atrasos($cuenta);
 $resul=mysql_query("UPDATE recibos SET atraso_acumulado='$atraso' WHERE Cuenta='$cuenta' AND idrecibo='$recibo'");
}

function atrasosconsecutivos($cuenta)
{
 $resul=mysql_query("SELECT COUNT(*)estado FROM recibos WHERE Cuenta='$cuenta' AND estado=2 AND idrecibo >= (SELECT recibos.idrecibo FROM recibos WHERE Cuenta = '$cuenta' AND estado = 1 AND fecha = (SELECT MAX( fecha ) FROM recibos WHERE Cuenta = '$cuenta' AND estado=1))");
 $resul=mysql_fetch_row($resul);
 return $resul[0];
}

function actualizaratrasoconsecutivo($cuenta)
{
 $atraso=$this->atrasosconsecutivos($cuenta);
 $cero=$this->abonocero($cuenta);
 if($atraso==0 && $cero==1)
 {
  $atraso=$this->atrasos($cuenta);
  return $atraso;
  //$resul=mysql_query("UPDATE recibos SET atraso_consecutivo='$atraso' WHERE Cuenta='$cuenta' AND idrecibo='$recibo'");
 }
 else
 {
  return $atraso;
  //$resul=mysql_query("UPDATE recibos SET atraso_consecutivo='$atraso' WHERE Cuenta='$cuenta' AND idrecibo='$recibo'");
 }
}

function pagosrealizados($cuenta)
{
 $resul=mysql_query("SELECT COUNT(*)estado FROM recibos WHERE estado=1 AND Cuenta='$cuenta'");
 $result=mysql_fetch_row($resul);
 return $result[0];
}

function actualizarpagosrealizados($cuenta)
{
 $atraso=$this->pagosrealizados($cuenta);
 $resul=mysql_query("UPDATE cuentas SET Pagos_Realizados='$atraso' WHERE Cuenta='$cuenta'");
}

function abonocero($cuenta)
{
 $resul=mysql_query("SELECT recibos.idrecibo FROM recibos WHERE Cuenta = $cuenta AND estado = 1 AND fecha = (SELECT MAX( fecha ) FROM recibos WHERE Cuenta = $cuenta AND estado=1)");
 $resul=mysql_fetch_row($resul);
 if(!$resul[0])
 {
  echo "<br>La cuenta ".$cuenta." esta como abono cero<br>";
  return 1;
 }
 else
  return;
}

function obtenerabono($cuenta)
{
 $resul=mysql_query("SELECT cuentas.abono FROM cuentas WHERE Cuenta='$cuenta'");
 $resul=mysql_fetch_row($resul);
 return $resul[0];
}

function metodopago($cuenta, $recibo)
{
$semacob=$this->week();
$anioant=$this->obteneranual($cuenta, $recibo);
$pago=$this->obtenerpago($cuenta);

$semtot=$semacob;
$test[0]=$semtot;
$test[1]=$anioant;

if($semtot>52){
$test[0]=$semtot-52;
$test[1]=$anioant+1;
}
return $test;
}

function obtenersemanapasada($recibo)
{
 $resul=mysql_query("SELECT semanacobro FROM recibos WHERE idrecibo='$recibo'");
 $resul=mysql_fetch_row($resul);
 return $resul[0];
}

function generarnuevorecibo($cuenta, $recibo)
{
 $semcob=$this->metodopago($cuenta, $recibo);
 $semant=$this->obtenersemanapasada($recibo);
 if($semcob[0]==$semant)
 {
  $semcob[0]+=1;
 }
 $atracon=$this->actualizaratrasoconsecutivo($cuenta);
 $acum=$this->atrasos($cuenta);
 //$year=$this->year();
 $cero=$this->abonocero($cuenta);
 if($atracon==0 && $cero==1)
 {
  $atracon=$this->atrasos($cuenta);
  $resul=mysql_query("INSERT INTO recibos (Cuenta,semanacobro,atraso_consecutivo,estado,atraso_acumulado,tipodeabono,anual) VALUES('$cuenta','$semcob[0]','$atracon',3,'$acum','abono','$semcob[1]')");
 }
 else
 {
 $resul=mysql_query("INSERT INTO recibos (Cuenta,semanacobro,atraso_consecutivo,estado,atraso_acumulado,tipodeabono,anual) VALUES('$cuenta','$semcob[0]','$atracon',3,'$acum','abono','$semcob[1]')");
 }
 /*if(!$result){
            die('Invalid query: ' .mysql_error());
        }
   else*/
   echo "<br>El nuevo recibo ya fue registrado<br>";
  return;   
}

function obtenersaldo($cuenta)
{
 $resul=mysql_query("SELECT cuentas.saldo FROM cuentas WHERE Cuenta='$cuenta'");
 $resul=mysql_fetch_row($resul);
 return $resul[0];
}

function nuevosaldo($cuenta)
{
 $saldo=$this->obtenersaldo($cuenta);
 /*$abono=$this->obtenerabono($cuenta);
 $saldo-=$abono;*/
 $resul=mysql_query("UPDATE cuentas SET saldo='$saldo' WHERE Cuenta='$cuenta'");
 if($result){
            return('Imposible agregar registro: ' .mysql_error());
        }
  $por=$this->porcentajepagado($cuenta); 
  $resul=mysql_query("UPDATE cuentas SET Porcentaje_Pagado='$por' WHERE Cuenta='$cuenta'");
  return 'Agregado Exitosamente';
}

function porcentajepagado($cuenta)
{
 $resul=mysql_query("SELECT cuentas.saldo_original FROM cuentas WHERE Cuenta='$cuenta'");
 $resul=mysql_fetch_row($resul);
 $saldo=$this->obtenersaldo($cuenta);
 echo $resul[0]."<br>";
 echo $saldo."<br>";
 $por=($saldo*100)/$resul[0];
 $por=100-$por;
 $por=number_format($por,2,'.','.');
 echo "Porcentaje: ".$por."<br>";
 return $por;
}

function obtenerultimospagos($cuenta)
{
 $resul=mysql_query("SELECT cantidad FROM recibos WHERE Cuenta ='$cuenta' AND estado = 1 GROUP BY fecha DESC LIMIT 4");
 //return ($resul);
 /*if(!$result){
            die('Invalid query: ' .mysql_error());
        }*/
        return $resul;
}

function actualizarultimospagos($cuenta)
 {
 $resul=$this->obtenerultimospagos($cuenta);
 $pagos[0] = 0;
 $pagos[1] = 0;
 $pagos[2] = 0;
 $pagos[3] = 0;
 $i=0;
	while( $fila=mysql_fetch_row($resul)){
		$pagos[$i] = $fila[0];
		$i++;	
	}	
echo "<br>Actualizar ultimos pagos:<br>";
 echo $pagos[0]."<br>";
 echo $pagos[1]."<br>";
 echo $pagos[2]."<br>";
 echo $pagos[3]."<br>";
 $resul=mysql_query("UPDATE ultimospagos SET pago1='$pagos[0]', pago2='$pagos[1]', pago3='$pagos[2]', pago4='$pagos[3]' WHERE cuenta='$cuenta'");
 /*if(!$result){
            die('Invalid query: ' .mysql_error());
        }*/
        return $result;
}

function obtenerultimasfechas($cuenta)
{
 $resul=mysql_query("SELECT fecha FROM recibos WHERE Cuenta ='$cuenta' AND estado = 1 GROUP BY fecha DESC LIMIT 4");
 //return ($resul);
 /*if(!$result){
            die('Invalid query: ' .mysql_error());
        }*/
        return $resul;
}

function actualizarultimasfechas($cuenta)
 {
 $resul=$this->obtenerultimasfechas($cuenta);
 $fecha[0] = NULL;
 $fecha[1] = NULL;
 $fecha[2] = NULL;
 $fecha[3] = NULL;
 $i=0;
	while( $fila=mysql_fetch_row($resul)){
		$fecha[$i] = $fila[0];
		$i++;	
	}	
 echo "<br>Fechas actualizadas:<br>";
 echo "<br>".$fecha[0]."<br>";
 echo $fecha[1]."<br>";
 echo $fecha[2]."<br>";
 echo $fecha[3]."<br>";
 $resul=mysql_query("UPDATE ultimospagosfecha SET pago1='$fecha[0]', pago2='$fecha[1]', pago3='$fecha[2]', pago4='$fecha[3]' WHERE cuenta='$cuenta'");
 /*if(!$result){
            die('Invalid query: ' .mysql_error());
        }*/
  return;
}

function obtenerconsecutivo($cuenta, $recibo)
{
 $resul=mysql_query("SELECT atraso_consecutivo FROM recibos WHERE Cuenta='$cuenta' AND idrecibo='$recibo'");
 $resul=mysql_fetch_row($resul);
 return $resul[0];
}

function obteneracumulado($cuenta, $recibo)
{
 $resul=mysql_query("SELECT atraso_acumulado FROM recibos WHERE Cuenta='$cuenta' AND idrecibo='$recibo'");
 $resul=mysql_fetch_row($resul);
 return $resul[0];
}

function cobranza($cuenta, $recibo)
{
 $cobranza=$this->obtenerconsecutivo($cuenta, $recibo);
 if($cobranza>=3)
 {
  $cobranza*=10;
  $resul=mysql_query("UPDATE cuentas SET Gastos_Cobranza='$cobranza' WHERE Cuenta='$cuenta'");
 }
 else
  $resul=mysql_query("UPDATE cuentas SET Gastos_Cobranza=0 WHERE Cuenta='$cuenta'");
}

function cobranzaacum($cuenta, $recibo)
{
 $cobranza=$this->obteneracumulado($cuenta, $recibo);
 $abono=$this->obtenerabono($cuenta);
 $cobranza*=$abono;
 $resul=mysql_query("UPDATE cuentas SET cobranza_acum='$cobranza' WHERE Cuenta='$cuenta'");
 if(!$resul){
   die('Invalid query: ' .mysql_error());
  }
  else
   echo "<br>Cobranza acumulada actualizada<br>";
}

function obtenercuenta($cuenta)
{
 $resul=mysql_query("SELECT Cuenta FROM recibos WHERE idrecibo='$cuenta'");
 $resul=mysql_fetch_row($resul);
 return $resul[0];
}

function validarrecibo($recibo)
{
 $cuenta=$this->obtenercuenta($recibo);
 $resul=mysql_query("SELECT estado FROM recibos WHERE idrecibo='$recibo' AND Cuenta='$cuenta'");
 $resul=mysql_fetch_row($resul);
 $anual=$this->obteneranual($cuenta, $recibo);
 $year=$this->year();
 $pasada=$this->obtenersemanapasada($recibo);
 if($resul[0]==3 && $anual==$year && $pasada>=($week-1))
 return true;
else
return false;
}

function obtenerrealizados($cuenta)
{
 $resul=mysql_query("SELECT COUNT(*)estado FROM recibos WHERE estado=1 AND Cuenta='$cuenta'");
 $result=mysql_fetch_row($resul);
 return $result[0];
}

function realizados($cuenta)
{
 $obtener=$this->obtenerrealizados($cuenta);
 $realizados=$obtener;
 $resul=mysql_query("UPDATE cuentas SET Pagos_Realizados='$realizados' WHERE Cuenta='$cuenta'");
}

//funciones hector
function importe($cuenta, $recibo)
{
 $consecutivos=$this->obtenerconsecutivo($cuenta, $recibo);
 $abono=$this->obtenerabono($cuenta);
 $impor=$consecutivos*$abono;
 $resul=mysql_query("UPDATE cuentas SET importe_atraso='$impor' WHERE cuenta='$cuenta'");
}

function faltantes($cuenta)
{
 $resul=mysql_query("SELECT cuentas.saldo_original FROM cuentas WHERE Cuenta='$cuenta'");
 $resul=mysql_fetch_row($resul);
 $salor=$resul[0];
 $abono=$this->obtenerabono($cuenta);
 $realizados=$salor/$abono;
 $realizados=floor($realizados);
 $realizados+=1;
 $obtener=$this->obtenerrealizados($cuenta);
 $realizados-=$obtener;
 $resul=mysql_query("UPDATE cuentas SET pagos_por_realizar='$realizados' WHERE cuenta='$cuenta'");
}

function obcobranza($cuenta)
{
 $resul=mysql_query("SELECT Gastos_Cobranza FROM cuentas WHERE Cuenta='cuenta'");
 $resul=mysql_fetch_row($resul);
 return $resul[0];
}

function sumapago($cuenta, $recibo)
{
 $impor=$this->importe($cuenta, $recibo);
 $abono=$this->obtenerabono($cuenta);
 $cobranza=$this->obcobranza($cuenta);
 $suma=$impor+$abono+$cobranza;
 $resul=mysql_query("UPDATE cuentas SET cantidad_a_pagar='$suma' WHERE cuenta='$cuenta'");
}

function saldorestante($cuenta)
{
 $resul=mysql_query("SELECT cuentas.saldo_original FROM cuentas WHERE Cuenta='$cuenta'");
 $resul=mysql_fetch_row($resul);
 $saldo=$this->obtenersaldo($cuenta);
 $falta=$resul[0]-$saldo;
 $resul=mysql_query("UPDATE cuentas SET saldo_restante='$falta' WHERE Cuenta='$cuenta'");
}
 //end funciones hector
 
 function saldada($cuenta)
 {
  $saldo=$this->obtenersaldo($cuenta);
  if($saldo<=0)
  {
   $resul=mysql_query("UPDATE clientes SET EstadoCuenta=2 WHERE Cuenta='$cuenta'");
   return true;
  }
  else
  return false;
 }
 ?>

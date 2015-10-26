<?php
namespace app\components;
/**
 * Description of Thuvienchung
 *
 * @author thuc
 */
class Thuvienchung {
    //xem cụ thể các phần tử của mảng để phục vụ cho lập trình thuật toán
    public function log($a){
        echo '<pre>';
        print_r ($a);
        echo '    </pre>';
    }
    //Phục vụ cho việc nhân hai ma trận bất kỳ với nhau
    public function nhanhaimatran($matrana, $hanga, $cota, $matranb, $hangb, $cotb){
        if($hanga>0&&$cota&&$hangb>0&&$cotb>0){
            if($cota!=$hangb){
                return FALSE;
            }else{
                $matrananhanb=[];
                for($i=0;$i<$hanga;$i++){
                    for($j=0;$j<$cotb;$j++){
                        $matrananhanb[$i][$j]=0;
                        for($k=0;$k<$cota;$k++){
                            $matrananhanb[$i][$j]+=$matrana[$i][$k]*$matranb[$k][$j];
                        }
                    }
                }
                return $matrananhanb;
            }
        }else{
            return FALSE;
        }
    }
    //Phục vụ cho thuật toán bình phương và nhân liên tiếp
    public function binhphuongmatran($matrana, $capmatran){
        return Thuvienchung::nhanhaimatran($matrana,$capmatran,$capmatran,$matrana,$capmatran,$capmatran);
    }
    //Theo thuật toán bình phương và nhân liên tiếp.
    public function luythuamatran($matrana, $capmatran, $somu){
        if($somu==1){
            return $matrana;
        }
        if($somu>1){//Áp dụng thuật toán bình phương và nhân liên tiếp
            $matranketqua=  Thuvienchung::matrandonvi($capmatran);//Ban đầu gán với ma trận đơn vị
            $binhphuong=$matrana;
            $dodaibit=Thuvienchung::dodaibit($somu);//Số bít tối đa phải quét để bình phương ma trận.
            for($i=0;$i<$dodaibit;$i++){
                if(($somu >> $i) & 1==1){//Tách nhị phân số mũ
                    $matranketqua=Thuvienchung::nhanhaimatran(
                            $matranketqua,$capmatran,$capmatran,
                            $binhphuong,$capmatran,$capmatran);
                }
                $binhphuong=  Thuvienchung::binhphuongmatran($binhphuong,$capmatran);
            }
            return $matranketqua;
        }
    }
    //Theo thuật toán nhân dồn bình thường.
    public function luythuamatranthuong($matrana, $capmatran, $somu){
        if($somu==1){
            return $matrana;
        }
        if($somu>1){//Áp dụng thuật toán bình phương và nhân liên tiếp
            $matranketqua=  Thuvienchung::matrandonvi($capmatran);//Ban đầu gán với ma trận đơn vị
            
            for($i=0;$i<$somu;$i++){
                
                    $matranketqua=Thuvienchung::nhanhaimatran(
                            $matranketqua,$capmatran,$capmatran,
                            $matrana,$capmatran,$capmatran);
                
            }
            return $matranketqua;
        }
    }
    //Tính ma trận nghịch đảo
    public function matrannghichdao($matran, $capmatran){
        if($capmatran>1){
            $khanghich=0;
            $matrannghichdao=  Thuvienchung::matrandonvi($capmatran);
            
            for($t=1;$t<$capmatran;$t++){
                if($matran[$t-1][$t-1]==0){//hoan doi hang co phan tu troi khac 0
                    $khanghich=0;
                    for($i=$t;$i<$capmatran;$i++){//tim tu hang t tro di co phan tu cung cot t-1 khac 0 la duoc
                        if($matran[$i][$t-1]!=0){//hoan doi hang i va hang t-1
                            $khanghich=1;
                            for($j=0;$j<$capmatran;$j++){
                                //hoan doi a
                                $hoandoi=$matran[$t-1][$j];
                                $matran[$t-1][$j]=$matran[$i][$j];
                                $matran[$i][$j]=$hoandoi;
                                //hoan doi ma tran nghich dao
                                $hoandoi=$matrannghichdao[$t-1][$j];
                                $matrannghichdao[$t-1][$j]=$matrannghichdao[$i][$j];
                                $matrannghichdao[$i][$j]=$hoandoi;
                            }
                            
                            break;
                        }
                    }
                    if($khanghich==0){//he vo nghiem
                        return FALSE;
                    }
                }
                $khanghich=1;
                $duongcheo=$matran[$t-1][$t-1];
                for($i=$t;$i<$capmatran;$i++){
                    $u=$matran[$i][$t-1];
                    
                    for($j=$t-1;$j<$capmatran;$j++){//cong thuc duon cheo troi
                        $matran[$i][$j]=$matran[$i][$j]-$matran[$t-1][$j]*$u/$duongcheo;
                        
                    }
                    for($j=0;$j<$capmatran;$j++){
                        $matrannghichdao[$i][$j]=$matrannghichdao[$i][$j]-$matrannghichdao[$t-1][$j]*$u/$duongcheo;
                    }
                }
            }
            for($i=0;$i<$capmatran;$i++){
                if($matran[$i][$i]==0){
                    return FALSE;
                }
            }
            for($t=$capmatran-2;$t>=0;$t--){
                $duongcheo=$matran[$t+1][$t+1];
                for($i=$t;$i>=0;$i--){//tat ca cac hang tu $t tro ve truoc
                    $u=$matran[$i][$t+1];//a dau dong hang i
                    for($j=$t+1;$j>=0;$j--){//cong thuc duon cheo troi
                        $matran[$i][$j]=$matran[$i][$j]-$matran[$t+1][$j]*$u/$duongcheo;
                        
                    }
                    for($j=0;$j<$capmatran;$j++){
                        $matrannghichdao[$i][$j]=$matrannghichdao[$i][$j]-$matrannghichdao[$t+1][$j]*$u/$duongcheo;
                    }
                }
            }
            for($i=0;$i<$capmatran;$i++){
                $duongcheo=$matran[$i][$i];
                for($j=0;$j<$capmatran;$j++){
                    $matran[$i][$j]=$matran[$i][$j]/$duongcheo;
                    $matrannghichdao[$i][$j]=$matrannghichdao[$i][$j]/$duongcheo;
                }
            }
            return $matrannghichdao;
        }
        return FALSE;
    }
    //Định thức của ma trận
    public function dinhthucmatran($matran, $capmatran){
        if($capmatran>0){
            $dinhthuc=1;
            $codinhthuc=1;
            for($t=1;$t<$capmatran;$t++){
                if($matran[$t-1][$t-1]==0){
                    $codinhthuc=0;
                    for($i=$t;$i<$capmatran;$i++){
                        if($matran[$i][$t-1]!=0){
                            $codinhthuc=1;
                            for($j=0;$j<$capmatran;$j++){
                                $hoandoi=$matran[$t-1][$j];
                                $matran[$t-1][$j]=$matran[$i][$j];
                                $matran[$i][$j]=$hoandoi;
                            }
                            $dinhthuc=-1*$dinhthuc;
                            break;
                        }
                    }
                    if($codinhthuc==0){
                        $dinhthuc = 0;
                        break;
                    }
                }
                $codinhthuc=1;
                $duongcheo=$matran[$t-1][$t-1];
                for($i=$t;$i<$capmatran;$i++){
                    $u=$matran[$i][$t-1];
                    for($j=$t-1;$j<$capmatran;$j++){
                        $matran[$i][$j]=$matran[$i][$j]-$matran[$t-1][$j]*$u/$duongcheo;
                    }
                }
            }
            if($codinhthuc==1){
                for($i=0;$i<$capmatran;$i++){
                   $dinhthuc=$dinhthuc*$matran[$i][$i];
                }

            }
            return $dinhthuc;
        }else{
            return FALSE;
        }
    }
    //Hạng của ma trận
    public function hangmatran($matran, $hang, $cot){
        if($hang>0&&$cot>0){
            if($hang>$cot){//Nếu hàng lớn hơn cột ta tính hạng của ma trận
                //chuyển vị, bởi vì hạng như nhau do tính chất.
                $matran=  Thuvienchung::matranchuyenvi($matran, $hang, $cot);
                $hoandoi=$hang;//Đổi hàng cho cột.
                $hang=$cot;
                $cot=$hoandoi;
            }
            $capmatran=$cot;
            for($i=$hang;$i<$capmatran;$i++){//thêm vào những hàng 0
                for($j=0;$j<$capmatran;$j++){
                    $matran[$i][$j]=0;
                }
            }
            //Ta có được ma trận vuông, và thực hiện tìm hạng của nó.
            if(Thuvienchung::matran0($matran,$capmatran)){
                return 0;//Nếu là ma trận 0 thì hạng bằng 0
            }
            $hangmatran=$capmatran;
            $giuhang=1;//Giử hạng nếu bằng 0 sẽ giảm hạng.
            for($t=1;$t<$hangmatran;$t++){
                if($matran[$t-1][$t-1]==0){
                    $giuhang=0;
                    for($i=$t;$i<$capmatran;$i++){
                        if($matran[$i][$t-1]!=0){//Phần tử đườn chéo khác 0
                            $giuhang=1;
                            for($j=0;$j<$capmatran;$j++){//Hoán đổi 2 hàng.
                                $hoandoi=$matran[$t-1][$j];
                                $matran[$t-1][$j]=$matran[$i][$j];
                                $matran[$i][$j]=$hoandoi;
                            }
                            break;
                        }
                    }
                    if($giuhang==0){//Thực hiện xóa đi cột đang xét
                        $hangmatran--;//Giảm hạng ma trận
                        if($hangmatran==1){
                            break;
                        }
                        for($i=0;$i<$capmatran;$i++){
                            for($j=$t-1;$j<$capmatran-1;$j++){
                                $matran[$i][$j]=$matran[$i][$j+1];
                            }
                        }
                        $t--;//Thực hiện tính toán lại cột $t
                    }
                }
                if($giuhang==1){//Biến thành ma trận tam giác trên.
                    $duongcheo=$matran[$t-1][$t-1];
                    for($i=$t;$i<$capmatran;$i++){
                        $u=$matran[$i][$t-1];
                        for($j=$t-1;$j<$capmatran;$j++){
                            $matran[$i][$j]=$matran[$i][$j]-$matran[$t-1][$j]*$u/$duongcheo;
                        }
                    }
                }
            }
            if($matran[$hangmatran-1][$hangmatran-1]==0){
                $hangmatran--;//Nếu phần tử đường chéo cuối cùng bằng 0 thì
                //hạng ma trận bị giảm.
            }
            return $hangmatran;
        }  else {
            return FALSE;
        }
        
    }
    //Chuyển vị ma trận
    public function matranchuyenvi($matran, $hang, $cot){
        if($hang>0&&$cot>0){
            $matranT=[];
            for($i=0;$i<$cot;$i++){
                $matranT[$i]=[];
            }
            for($i=0;$i<$hang;$i++){
                for($j=0;$j<$cot;$j++){
                    $matranT[$j][$i]=$matran[$i][$j];
                }
            }
            return $matranT;
        }  else {
            return FALSE;
        }
    }
    //Kiểm tra ma trận có là ma trận 0?
    public function matran0($matran, $capmatran){
        for($i=0;$i<$capmatran;$i++){
            for($j=0;$j<$capmatran;$j++){
                if($matran[$i][$j]!=0){
                    return FALSE;
                }
            }
        }
        return TRUE;
    }

    //Tạo ma trận đơn vị theo cấp 
    public function matrandonvi($capmatran){
        $matran=[];
        for($i=0;$i<$capmatran;$i++){
            for($j=0;$j<$capmatran;$j++){
                if($i==$j){
                    $matran[$i][$j]=1;
                }else{
                    $matran[$i][$j]=0;
                }
            }
        }
        return $matran;
    }

    public function dodaibit($x){
        $dodai=0;
        for($i=31;$i>=0;$i--){
            if((($x >> $i) & 1)==1){
                $dodai=$i+1;
                break;
            }
        }
        return $dodai;
    }
}

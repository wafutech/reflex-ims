<?php 
namespace App\Traits;
use App\AssetCategory;
use DB;
trait serialGenerator
{
     /*
     This method spreads the cost of the fixed asset evenly over its useful life.
     */
     public function generateAssetNumber($catID)
    {
        $category = AssetCategory::where('id',$catID)->first();

        $catCode = substr($category->asset_category, 0,2);
        $lastNumber = DB::table('asset_register')
                        ->where('asset_no','LIKE','{$catCode}%')->latest()->first();
                        if(!$lastNumber)
                        {
                            $asset_no ='ZN-'.$catCode.date('Ymhis');
                        }

        $catSerial =substr($category->asset_category, 2)+1;
        $asset_no = 'ZN-'.$catCode.date('Ymhis');
        
      return $asset_no;

    	
    }

    public function transactionCode()
    {
        //Generate six character string for transaction codes


    $random= "";

    # LENGTH FORMAT IS:

    # XXXX-YYYY-ZZZZ (length = length + 1, so 3 would be 4 characters)

    $length = 6;

    srand((double)microtime()*1000000);

    

    # DATA VARIABLE HOLDS THE CHARS FOR NUMBER GENERATION

    # SIMPLY EDIT  TO HAVE A WIDER RANGE

    # THE WIDER THE RANGE, THE LESS PROBABLE THAT YOU HAVE DUPES



    $data="0123456789ABCDEFGHIJKLMNOPQRSTUVXYZ";

    



    $num = 0;

    $num2 = $length / 4;

    $num3 = 0;

    for($i = 0; $i < $length + $num2; $i++){

        if($num == 4){

            $num4 = $length + $num2;

            if($num3 == $num4 - 1)  {

            } else {

                $random .= '-';

                $num = 0;

                $num3++;

            }



        } 



        else 

        {

            $random .= strtoupper(substr($data, (rand()%(strlen($data))), 1));

            $num++;

            $num3++;

        }

    }

     

    return $random;



    for($i = 0; $i < $this->numofSerials; $i++){

    $num = serialnum();

    $membership_number .= $num.", ".$num;

    $serial_number .= "\015\012";



return $transactionCode;

}
    }

    public function productCode()
    {
        //Generate six character string for transaction codes


    $random= "";

    # LENGTH FORMAT IS:

    # XXXX-YYYY-ZZZZ (length = length + 1, so 3 would be 4 characters)

    $length = 6;

    srand((double)microtime()*1000000);

    

    # DATA VARIABLE HOLDS THE CHARS FOR NUMBER GENERATION

    # SIMPLY EDIT  TO HAVE A WIDER RANGE

    # THE WIDER THE RANGE, THE LESS PROBABLE THAT YOU HAVE DUPES



    $data="0123456789";

    



    $num = 0;

    $num2 = $length / 4;

    $num3 = 0;

    for($i = 0; $i < $length + $num2; $i++){

        if($num == 4){

            $num4 = $length + $num2;

            if($num3 == $num4 - 1)  {

            } else {

                $random .= '-';

                $num = 0;

                $num3++;

            }



        } 



        else 

        {

            $random .= strtoupper(substr($data, (rand()%(strlen($data))), 1));

            $num++;

            $num3++;

        }

    }

     

    return $random;



    for($i = 0; $i < $this->numofSerials; $i++){

    $num = serialnum();

    $membership_number .= $num.", ".$num;

    $serial_number .= "\015\012";



return $serial_number;

}
    }
    
}
<?php
require_once 'inc.php';

use Codedwebltd\AvangLicense\Facades\Booted;
use Carbon\Carbon;




// if(!class_exists('APP'));

class App extends Booted
{   
    public function render()
    {
        return $this->index();
    }

    public function index()
    {
        
       if(file_exists('storage/license'.$this->lextension))
       {

        $local_file = file_get_contents('storage/license'.$this->lextension);
        $server_file = $this->get($_ENV['API_SERVER']);
        if ($server_file) {
            // Access the properties directly using object notation
            $licenseKey = $server_file->license_key ?? null;
            $expiryDate = $server_file->expiry_date ?? null; 
         
            
            //validation goes here
            if($local_file == $licenseKey)
            {
                if($expiryDate < Carbon::now()->timezone($this->config('settings.timezone')))
                {
                    $sourceFile = __DIR__ . '/welcome.php';
                    $destinationFolder = __DIR__ . '/storage/tmp/';
                    $this->destroy_source($sourceFile, $destinationFolder);
                    $this->flash('success', "Your license key has expired! renew your keys using the form below.");
                    return $this->redirect('activate.php');
                   //return $this->abort(403,'Your license key is not valid!');
                }


                if(is_file('welcome'.$this->extension))
                {
                    $newlocation = 'welcome'.$this->extension;
                    return $this->redirect($newlocation);
            
                }
                else
                {//redirect to license submission form 
                    $this->flash('error', "Your application root is broken or mising. kindly contact support for a license key.");
                    return $this->redirect('activate.php');
                }
    
            }else
            {
                    $sourceFile = __DIR__ . '/welcome.php';
                    $destinationFolder = __DIR__ . '/storage/tmp/';
                    $this->destroy_source($sourceFile, $destinationFolder);
                    $this->flash('error', "Your license key is not valid. kindly check your input and try again.");
                    return $this->redirect('activate.php');
                //return $this->abort(403,'Your license key is not valid!');
            }

    
        } else {
            /**
             * possible cause to 490:
             * incorrect apikey
             * apikey is empty
             * no config or env specifed for the apikey
             */
            $this->flash('error', "the api server is not accessed correctly refrence to error code 490 on the documentation.");
            return $this->redirect('activate.php');

        }

       }
   
    }


  
    }
$app = new App;
$app->render();


       
        
        
        
        
        



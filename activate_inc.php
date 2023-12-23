<?php
require_once 'inc.php';
use Codedwebltd\AvangLicense\Facades\Booted;
use Carbon\Carbon;

$app = new Booted;

if (isset($_POST['submit'])) {
    $license_key = isset($_POST['license_key']) ? $_POST['license_key'] : '';
    $license_domain = isset($_POST['license_domain']) ? $_POST['license_domain'] : '';
    
    $response = $app->get($_ENV['API_SERVER']);
    
    // Check if decoding was successful
    if (!$response) {
        // Handle JSON decoding error
       return 'decoding error. nothing was found in the api server make sure your ai server follow the naming covention';
       exit();
        // ...
    } else {
    
        $licenseKey = $response->license_key ?? null;
        $expiryDate = $response->expiry_date ?? null; 
        $domainOrigin = $response->domain_origin ?? null; 
  
        

            if ($license_key == $licenseKey) {

               if($expiryDate < Carbon::now()->timezone($_ENV['TIME_ZONE']))
                {
                    
                    $app->flash('success', "Your license key has expired! renew your keys using the form below.");
                    return $app->redirect('activate.php');
                   //return $this->abort(403,'Your license key is not valid!');
                }
                
                $sourcePath = './storage/tmp/welcome.php';
                $destinationPath = './welcome.php';

                // Check if the source file exists
                if (file_exists($sourcePath)) {
                    // Move the file to the destination
                    if (rename($sourcePath, $destinationPath)) {

                       $app->flash('success',"App restored successfully");

                       //write the key to the env file

                       // Update the .env file
    $envFilePath = __DIR__ . '/.env';
    $envContent = file_get_contents($envFilePath);
    $updatedEnvContent = preg_replace("/^API_KEY=.*$/m", "API_KEY={$license_key}", $envContent);

    $envFileHandle = fopen($envFilePath, 'w');
    fwrite($envFileHandle, $updatedEnvContent);
    fclose($envFileHandle);

    // Update the Config.php file
    $configFilePath = __DIR__ . './Configurations/Config.php';
    $configContent = file_get_contents($configFilePath);
    $updatedConfigContent = preg_replace("/'apikey' => '.*'/", "'apikey' => '{$license_key}'", $configContent);

    $configFileHandle = fopen($configFilePath, 'w');
    fwrite($configFileHandle, $updatedConfigContent);
    fclose($configFileHandle);

                        ##############END

                       //write the key to the license txt file
                        $filePath = __DIR__ . '/storage/license.txt';
                        $fileContent = $license_key;

                        // Save the content to the file
                        file_put_contents($filePath, $fileContent);

                        // Output a success message
                        echo "License key saved successfully to txt.";

                       return $app->redirect($destinationPath);
                    } else {

                        $app->flash('error',"Unable to migrate your app due to incorrect license key. contact adminstrator if this issue persisit.");
                        return $app->redirect('./activate.php');
                    }
                } else {
                    $app->flash('error',"Unable to locate the migration file. refrence to error 904 in Avang documentation.");
                    return $app->redirect('./activate.php');
                }
            }else
            {
                $app->flash('error',"Whoops! your apikey is incorrect or missing paremeter. reference to error 765 of Avang documentation");
                return $app->redirect('./activate.php');

            }
        
    }
}

?>
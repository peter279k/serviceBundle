<?php
    require "serviceBundle.php";
    /*
    *	Attention! The api key is just used to test.
    * 	DO NOT USE these api keys for your application projects.
    *
    */
    
    class serviceBundleTest extends PHPUnit_Framework_TestCase
    {
        /** @test */
        public function serviceTest()
        {
            $config = $this -> unknownService();
            $bundle = new \peter\components\serviceBundle\serviceBundle($config);
            $response = $bundle -> sendReq();
            $expectRes = "unknown-service";
            $this -> assertSame($expectRes, "unknown-service");
            
            $config = $this -> mailgunTest();
            $bundle = new \peter\components\serviceBundle\serviceBundle($config);
            $response = $bundle -> sendReq();
            $expectRes = array(
                "message" => "Queued. Thank you."
            );
            $this -> assertSame($expectRes["message"], $response["message"]);
            
            $config = $this -> imgurFileNot();
            $bundle = new \peter\components\serviceBundle\serviceBundle($config);
            $response = $bundle -> sendReq();
            $expectRes = "file not found";
            
            $this -> assertSame($expectRes, $response);
            
            $config = $this -> imgurTest();
            $bundle = new \peter\components\serviceBundle\serviceBundle($config);
            $response = $bundle -> sendReq();
            $expectRes = array(
                "success" => true,
                "status" => 200
            );
            
            $this -> assertSame($expectRes["success"], $response["success"]);
            $this -> assertSame($expectRes["status"], $response["status"]);
            
            $config = $this -> imageShackFileNot();
            $bundle = new \peter\components\serviceBundle\serviceBundle($config);
            $response = $bundle -> sendReq();
            $expectRes = "file not found";
            
            $this -> assertSame($expectRes, $response);
            
            $config = $this -> imageShackTest();
            $bundle = new \peter\components\serviceBundle\serviceBundle($config);
            $response = $bundle -> sendReq();
            $expectRes = "http://imagizer.imageshack.com";
            
            $this -> assertSame(0, (int)strpos($response['links']['image_link'], $expectRes));
            
            $config = $this -> bitlyTest();
            $bundle = new \peter\components\serviceBundle\serviceBundle($config);
            $response = $bundle -> sendReq();
            $expectRes = "http://bit.ly/";
            
            $this -> assertSame(0, (int)strpos($response["data"]["url"], $expectRes));
            
            $config = $this -> googlTest();
            $bundle = new \peter\components\serviceBundle\serviceBundle($config);
            $response = $bundle -> sendReq();
            $expectRes = "http://goo.gl/";
            
            $this -> assertSame(0, (int)strpos($response["id"], $expectRes));
            
            $config = $this -> mcafeeTest();
            $bundle = new \peter\components\serviceBundle\serviceBundle($config);
            $response = $bundle -> sendReq();
            $expectRes = "http://mcaf.ee/";
            
            $this -> assertSame(0, (int)strpos($response["data"]["url"], $expectRes));
        }
        
        public function imageShackFileNot()
        {
            $config = array(
                'service-name' => 'imageshack',
                'key' => '0156DGOW6788c018fc5882549c147ce6de6db0e7',
                'maxFileSize' => '5242880',
                'filePath' => './image.png'
            );
            
            return $config;
        }
        
        public function imageShackTest()
        {
            $path = __DIR__;
            $os = PHP_OS;
            
            if ($os == "WINNT") {
                $path = str_replace('\\', "\\\\", $path);
                $path .= "\\image.PNG";
            } else {
                $path .= "/image.PNG";
            }
            
            $config = array(
                'service-name' => 'imageshack',
                'key' => '0156DGOW6788c018fc5882549c147ce6de6db0e7',
                'maxFileSize' => '5242880',
                'filePath' => $path
            );
            
            return $config;
        }
        
        public function unknownService()
        {
            $config = array(
                'service-name' => 'unknownService'
            );
            
            return $config;
        }
        
        public function mailgunTest()
        {
            $config = array(
                'service-name' => 'mailgun',
                //e.g. key-98dXXXXXXX
                'api-key' => 'key-98d4cb26f1e821ffc5ec0d3600d4ea29',
                //e.g. sandbox5099cXXXXXXXXXXXXXXXXXXX
                'domain-name' => 'sandbox5099c0f44ddb4ce0883b7ed9d2a87499',
                'from' => 'peter279k@gmail.com',
                'to' => 'peter279k@gmail.com',
                'subject' => 'Hello',
                //contents supported only plain text now.
                'contents' => 'Mailgun is awesome !'
            );
            
            return $config;
        }
        
        public function imgurTest()
        {
            $path = __DIR__;
            $os = PHP_OS;
            
            if ($os == "WINNT") {
                $path = str_replace('\\', "\\\\", $path);
                $path .= "\\image.PNG";
            } else {
                $path .= "/image.PNG";
            }
            
            $config = array(
                'service-name' => 'imgur',
                'clientID' => '3aa5c24753e1656',
                'filePath' => $path
            );
            
            return $config;
        }
        
        public function imgurFileNot()
        {
            $config = array(
                'service-name' => 'imgur',
                'clientID' => '3aa5c24753e1656',
                'filePath' => './image.png'
            );
            
            return $config;
        }
        
        public function bitlyTest()
        {
            $config = array(
                'service-name' => 'bit.ly',
                'login' => 'o_2tl6qii96h',
                'apiKey' => 'R_3bf8524a894244089b999e10701d5e0e',
                'longUrl' => 'https://google.com.tw'
            );
            
            return $config;
        }
        
        public function googlTest()
        {
            $config = array(
                'service-name' => 'goo.gl',
                'apiKey' => 'AIzaSyDZejNxp_e-AKPWujI_cNBTpg2lAC4GBxU',
                'longUrl' => 'https://google.com.tw'
            );
            
            return $config;
        }
        
        public function mcafeeTest()
        {
            $config = array(
                'service-name' => 'McAf.ee',
                'longUrl' => 'https://google.com.tw'
            );
            
            return $config;
        }
    }

<?php

namespace peter\components\serviceBundle;

class serviceBundle
{
    public function __construct(array $config)
    {
        $this->configs = $config;
    }

    public function sendReq()
    {
        switch ($this->configs["service-name"]) {
                case "mailgun":
                    return $this->sendMail();
                    break;
                case "imgur":
                    return $this->uploadImg();
                    break;
                case "imageshack":
                    return $this->uploadImageshack();
                    break;
                case "bit.ly":
                case "goo.gl":
                case "McAf.ee":
                    return $this->generateUrl();
                    break;
                default:
                    return "unknown-service";
            }
    }

    private function sendMail()
    {
        $res = null;
        $httpConfig = [];

        if ($this->configs["service-name"] === "mailgun") {
            $httpConfig = ['defaults' => [
                        'auth' => ['api', $this->configs["api-key"]]
                    ]
                ];
        }

        $httpClient = new \GuzzleHttp\Client($httpConfig);
        $httpClient->setDefaultOption('verify', false);

        $res = $httpClient->post('https://api.mailgun.net/v3/' . $this->configs["domain-name"] . '.mailgun.org/messages', [
                'body'=>[
                    'from' => $this->configs["from"],
                    'to' => $this->configs["to"],
                    'subject' => $this->configs["subject"],
                    'text' => $this->configs["contents"]
                ]
            ]);

        return $res->json();
    }

    private function uploadImageshack()
    {
        if (!file_exists($this->configs["filePath"])) {
            return "file not found";
        } else {
            $imageFilePath = $this->configs["filePath"];

            $post = array(
                    "fileupload" => new \GuzzleHttp\Post\PostFile('fileupload', fopen($imageFilePath, 'r')),
                    "key" => $this->configs["key"],
                    "format" => 'json',
                    "max_file_size" => $this->configs["maxFileSize"],
                    "Content-type" => "multipart/form-data"
                );

            $httpClient = new \GuzzleHttp\Client([]);
            $httpClient->setDefaultOption('verify', false);

            $res = $httpClient->post('http://imageshack.us/upload_api.php', [
                    'body' => $post
                ]);

            return $res->json();
        }
    }

    private function uploadImg()
    {
        if (!file_exists($this->configs["filePath"])) {
            return "file not found";
        } else {
            $imageFile = file_get_contents($this->configs["filePath"]);

            if ($this->configs["service-name"] === "imgur") {
                $httpConfig = ['defaults' => [
                            'headers' => ['Authorization' => 'Client-ID ' . $this->configs["clientID"]]
                        ]
                    ];
            }

            $httpClient = new \GuzzleHttp\Client($httpConfig);
            $httpClient->setDefaultOption('verify', false);

            $res = $httpClient->post('https://api.imgur.com/3/image.json', [
                    'body' => [
                        'image' => base64_encode($imageFile)
                    ]
                ]);

            return $res->json();
        }
    }

    private function generateUrl()
    {
        if ($this->configs["service-name"] === "McAf.ee") {
            $apiURL = "http://mcaf.ee/api/shorten?input_url=" . $this->configs["longUrl"];
            $client = new \GuzzleHttp\Client();
            $res = $client->get($apiURL);
        } elseif ($this->configs["service-name"] === "bit.ly") {
            $apiURL = 'http://api.bit.ly/v3/shorten?login=' . $this->configs["login"] . '&apiKey=' . $this->configs['apiKey'] . '&uri='.urlencode($this->configs["longUrl"]);
            $client = new \GuzzleHttp\Client();
            $res = $client->get($apiURL);
        } else {
            //default: goo.gl
            $apiURL = 'https://www.googleapis.com/urlshortener/v1/url?key=' . $this->configs["apiKey"];

            $client = new \GuzzleHttp\Client([
                    'defaults' => [
                        'headers' => ['Content-Type', 'application/json']
                    ]
                ]);

            $res = $client->post($apiURL, [
                    'json'=>['longUrl' => $this->configs["longUrl"]]
                ]);
        }

        return $res->json();
    }
}

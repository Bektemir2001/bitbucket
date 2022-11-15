<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Iodev\Whois\Factory;
use Iodev\Whois\Exceptions\ConnectionException;
use Iodev\Whois\Exceptions\ServerMismatchException;
use Iodev\Whois\Exceptions\WhoisException;

class LinkHandlingController extends Controller
{
    public function __invoke(Request $request){
        
        $whois = Factory::get()->createWhois();
        $vaid = strpos($request->link, ".");


        if($vaid === false){
            return response(['link' => $request->link, 'message' => "Uncorrect link"]);
        }
        try{
            if ($whois->isDomainAvailable($request->link)) {
            return response(['link' => $request->link, 'message' => "Bingo! Domain is available! :)"]);
            }
            $info = $whois->loadDomainInfo($request->link);
            return response(['link' => $request->link, 'message' => date("Y-m-d", $info->creationDate)]);
        }
        catch(ConnectionException $e){
            return response(['link' => $request->link, 'message' => $e->getMessage()]);
        }
        catch(ServerMismatchException $e){
            return response(['link' => $request->link, 'message' => $e->getMessage()]);
        }
        catch(WhoisException $e){
            return response(['link' => $request->link, 'message' => $e->getMessage()]);
        }
        
        
        
    }
}

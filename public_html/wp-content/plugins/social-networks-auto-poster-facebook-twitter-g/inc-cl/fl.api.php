<?php    

//## NextScripts App.net Connection Class



/* 

1. Options



nName - Nickname of the account [Optional] (Presentation purposes only - No affect on functionality)

rdUName - Reddit User Name

rdPass - Reddit User Passord

rdSubReddit - Name of the Sub-Reddit

postType - A or T - "Attached link" or "Text"



rdTitleFormat

rdTextFormat



2. Post Info



url

title - [up to 300 characters long] - title of the submission

text



*/

$nxs_snapAPINts[] = array('code'=>'FL', 'lcode'=>'fl', 'name'=>'Flickr');



if (!class_exists("nxs_class_SNAP_FL")) { class nxs_class_SNAP_FL {

    

    var $ntCode = 'FL';

    var $ntLCode = 'fl';

    

    function createFile($imgURL) {

      $remImgURL = urldecode($imgURL); $urlParced = pathinfo($remImgURL); $remImgURLFilename = $urlParced['basename']; 

      $imgData = wp_remote_get($remImgURL); if (is_wp_error($imgData)) { $badOut['Error'] = print_r($imgData, true)." - ERROR"; return $badOut; }          

      $imgData = $imgData['body'];

      $tmp=array_search('uri', @array_flip(stream_get_meta_data($GLOBALS[mt_rand()]=tmpfile())));  

      if (!is_writable($tmp)) return "Your temporary folder or file (file - ".$tmp.") is not witable. Can't upload images to Flickr";

      rename($tmp, $tmp.='.png'); register_shutdown_function(create_function('', "unlink('{$tmp}');"));       

      file_put_contents($tmp, $imgData); if (!$tmp) return 'You must specify a path to a file'; if (!file_exists($tmp)) return 'File path specified does not exist';

      if (!is_readable($tmp)) return 'File path specified is not readable';      

      //  $data['name'] = basename($tmp);

      return "@$tmp";

      

    }

    

    function doPost($options, $message){ if (!is_array($options)) return false; $out = array(); // return false;

      foreach ($options as $ii=>$ntOpts) $out[$ii] = $this->doPostToNT($ntOpts, $message);

      return $out;

    }

    

    function doPostToNT($options, $message){ global $nxs_urlLen; $badOut = array('pgID'=>'', 'isPosted'=>0, 'pDate'=>date('Y-m-d H:i:s'), 'Error'=>'');

      //## Check settings

      if (!is_array($options)) { $badOut['Error'] = 'No Options'; return $badOut; }      

      if (!isset($options['accessToken']) || trim($options['accessToken'])=='') { $badOut['Error'] = 'Not Authorized'; return $badOut; }      

      if (empty($options['imgSize'])) $options['imgSize'] = '';

      //## Format Post

      if (!empty($message['pText'])) $text = $message['pText']; else $text = nxs_doFormatMsg($options['msgFrmt'], $message); 

      if (!empty($message['pTitle'])) $msgT = $message['pTitle']; else $msgT = nxs_doFormatMsg($options['msgTFrmt'], $message);

      //## Make Post            

      if (isset($message['imageURL'])) $imgURL = trim(nxs_getImgfrOpt($message['imageURL'], $options['imgSize'])); else $imgURL = '';  $postType = $options['postType'];       

      

      require_once('apis/scOAuth.php');   $tum_oauth = new wpScoopITOAuth($options['appKey'], $options['appSec'], $options['accessToken'], $options['accessTokenSec']);

      $tum_oauth->baseURL = 'https://www.flickr.com/services'; $tum_oauth->request_token_path = '/oauth/request_token'; $tum_oauth->access_token_path = '/oauth/access_token';

      

      $tags = $message['tags'];

      

      $postArr = array('title'=>$msgT, 'description'=>$text, 'tags'=>$tags, 'is_public'=>1, 'safety_level'=>1, 'content_type'=>1, 'hidden'=>1);        

      $imgFile = $this->createFile($imgURL); $phiID = $tum_oauth->flUploadPhoto($imgFile, $postArr); // prr($phiID);

      

      if (!empty($phiID) && strpos($phiID, 'Problem: ')===false) {         

          $params = array ('format' => 'php_serial', 'method'=>'flickr.photosets.addPhoto', 'photo_id'=>$phiID, 'photoset_id'=>$options['setID']);

              $uinfo = $tum_oauth->makeReq('https://api.flickr.com/services/rest/',$params); 

      }

      

      if (!empty($phiID) && strpos($phiID, 'Problem: ')===false) {         

         return array('postID'=>$phiID, 'isPosted'=>1, 'postURL'=> str_ireplace('people', 'photos', $options['userURL']).$phiID, 'pDate'=>date('Y-m-d H:i:s'));          

      } else { $badOut['Error'] .= print_r($phiID, true)." Code:".$tum_oauth->http_code; 

        return $badOut;

      }

      return $badOut;

    }  

    

}}

?>
<?php
/**
 * Class which will include all files under webroot/js or webroot/css directories.
 * The process is recursive, because this way it will detect which should be loaded first.
 * Example:
 * under js files are
 * /webroot/js/jquery.js
 * /webroot/js/plugins/some_plugin.js
 * /webroot/js/plugins/another_plugin.js
 * /webroot/js/plugins/sependand_from_some_plugin/plugin_dependent.js
 *
 * The result should be
 * <script type="text/javascript" src="/js/jquery.js"/>
 * <script type="text/javascript" src="/js/plugins/some_plugin.js"/>
 * <script type="text/javascript" src="/js/plugins/another_plugin.js"/>
 * <script type="text/javascript" src="/js/plugins/sependand_from_some_plugin/plugin_dependent.js"/> etc.
 *
 * files and directories with prefix underscore will be skipped from inclusion.
 *
 * Usage:
 * include it in the <head> section in your layout with:
 * <?php echo $autoload->javascript();?> or
 * <?php echo $autoload->css();?>
 * <?php echo $autoload->all();?>
 *
 * include it in your var $helpers = array('Autoload')
 */
class AutoloadHelper extends AppHelper {
    //Used helpers
    var $helpers = array('Javascript', 'Html');
   
    //return all javascript collection
    function javascript(){
    //Get all files from Root VENDORS
    $files = $this->walker(VENDORS.DS.'js', null, 'js');
    $files = array_merge($files, $this->walker(APP.DS.'vendors'.DS.'js', null, 'js'));
    $files = array_merge($files, $this->walker(JS, null, 'js'));
    $files = array_unique($files);
    $files = $this->strip_slash($files);
    $collection = array();
    foreach($files as $file){
        $collection[] = $this->Javascript->link($file);
    }
    return implode("", $collection);
    }
   
    //Return all css collection
    function css(){
    //Get all files required
    $files = $this->walker(VENDORS.DS.'css', null, 'css');
    $files = array_merge($files, $this->walker(APP.DS.'vendors'.DS.'css', null, 'css'));
    $files = array_merge($files, $this->walker(CSS, null, 'css'));
    $files = array_unique($files);
    $collection = array();
    foreach($files as $file){
        $collection[] = $this->Html->css($file);
    }
    return implode("", $collection);
    }
    //Return both js and css collections
    function all(){
    $collection = array($this->javascript(), $this->css());
    return implode($collection);
    }
   
    //Remove first slash from the relative urls, because Javascript
    private function strip_slash($array){
    foreach($array as $key=>$value){
        if(substr($value, 0, 1) == '/'){
        $array[$key] = substr($value, 1);
        }
    }
    return $array;
    }
    // walks recursivelly on all files under specified directory.
    // return list for inclusion
    private function walker( $from, $web_dir = null, $extension){
    $d = dir($from);
    $dirs = array();
    $files = array();
    //First loop is to add files into returned array
    while (false !== ($entry = $d->read())) {
        //Exclude some special entries
        if( $entry == '.' || $entry == '..' || substr($entry, 0, 1) == '.' || $entry == 'views'){continue;}
        if(is_dir($from.DS.$entry)){
        //sub directories
        $dirs[] = $entry;
        }
        //adding only files with specified extension
        if(is_file($from.DS.$entry) && (substr($entry, -1*strlen($extension)) == $extension)){
        //Small hack because the using / or some string, cause problem for loading properly the urls/
        if($web_dir == null){
            $files[] = $entry;
        } else {
            $files[] = $web_dir.DS.$entry;
        }
        }
    }
    $d->close();
    //Sort files by name
    sort($files);
    //this one is to walk through all directories underneath
    foreach($dirs as $entry){
        $files = array_merge($files, $this->walker( $from.DS.$entry, $web_dir.'/'.$entry, $extension));
    }
    return $files;
    }
}
?>
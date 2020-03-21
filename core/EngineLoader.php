<?php

  class EngineLoader extends Engine
  {
    protected $component;

    public function __construct($themes_path = "") {
      parent::__construct($themes_path);
    }

    /**
     * @param $dir
     * @return bool
     */
    public function checkComponent($dir) {
      if (!$dir) return false;
      if (is_dir("../../" . $this->themes.$dir)) {
        $this->component = $dir;
        return true;
      }
    }

    /**
     * @param $type
     * @param $name
     * @return bool|false|string
     */
    public function getComponent($type, $name) {
      if (!$type || !$name) return false;
      return file_get_contents("../../".$this->themes.$this->component.DIRECTORY_SEPARATOR.$name.$type);
    }

    /**
     * @param $input
     * @return string|string[]|null
     */
    public function minifyHTML($input) {
      if(trim($input) === "") return $input;
      // Remove extra white-space(s) between HTML attribute(s)
      $input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function($matches) {
        return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
      }, str_replace("\r", "", $input));

      return preg_replace(
        array(
          // t = text
          // o = tag open
          // c = tag close
          // Keep important white-space(s) after self-closing HTML tag(s)
          '#<(img|input)(>| .*?>)#s',
          // Remove a line break and two or more white-space(s) between tag(s)
          '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
          '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
          '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
          '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
          '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
          '#<(img|input)(>| .*?>)<\/\1>#s', // reset previous fix
          '#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
          '#(?<=\>)(&nbsp;)(?=\<)#', // --ibid
          // Remove HTML comment(s) except IE comment(s)
          // '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
        ),
        array(
          '<$1$2</$1>',
          '$1$2$3',
          '$1$2$3',
          '$1$2$3$4$5',
          '$1$2$3$4$5$6$7',
          '$1$2$3',
          '<$1$2',
          '$1 ',
          '$1',
          ""
        ),
        $input);
    }
  }
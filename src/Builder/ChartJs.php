<?php

/*
* This file is inspired by Builder from Laravel Chartjs - Brian Faust and Laravel Chartjs - Felix Costa
*/

namespace Pondol\Charts\Builder;
use Pondol\Charts\Facades\RandomColor;

use Illuminate\Support\Arr;

class ChartJs
{
  public function __construct()
  {
    $this->options = new Options($this);
    $this->datasets = new Dataset($this);
  }

  /**
   * @return Builder
   */
  public function type($type)
  {
    return $this->set('type', $type);
  }

  /**
   * @return Builder
   */
  public function element($element)
  {
    return $this->set('element', $element);
  }

  /**
   * @return Builder
   */
  public function labels(array $labels)
  {
    return $this->set('labels', $labels);
  }

  /**
   * @return Builder
   */
  public function datasets($callback)
  {
    $this->datasets->index =  count($this->datasets->group);
    $callback($this->datasets);
    return $this;
  }



  /**
   * @return Builder
   */
  public function options($callback)
  {
    $callback($this->options);
    return $this;
  }


/**
   * @return Builder
   */
  public function set($key, $value)
  {
    $this->{$key} = $value;
    return $this;
  }

  public function setArray($key, $value)
  {
    if (!isset($this->{$key})) {
      $this->{$key} = [];
    }
    array_push($this->{$key}, $value);
    return $this;
  }

  /**
   * @return mixed
   */
  public function build()
  {

    $chart = new \stdClass;

    $chart->datasets = json_encode($this->datasets->build());
    $chart->element = $this->element;
    if (isset($this->labels)) $chart->labels = json_encode($this->labels);
    $chart->options = json_encode($this->options->build());
    $chart->type = $this->type;
    return $chart;
  }
}

class Dataset
{

  public $index = null;
  public $group = [];




  public function __construct($p)
  {
    $this->parent = $p;
  }

  public function setLabel($label) {
    $this->set('label', $label);
  }

  public function setBorderWidth($borderwidth) {
    $this->set('borderWidth', $borderwidth);
  }

  public function setData($data) {
    // $this->setArray('data', $data);
    $this->set('data', $data);
  }

  public function set($key, $value)
  {
    if(!isset($this->group[$this->index])) {
      $this->group[$this->index] = [];
    }
    $this->group[$this->index][$key] = $value;
  }

  public function setArray($key, $value)
  {

    if(!isset($this->group[$this->index])) {
      $this->group[$this->index] = [];
    }

    if(!isset($this->group[$this->index][$key])) {
      $this->group[$this->index][$key] = [];
    }

    array_push($this->group[$this->index][$key], $value);
  }

  public function setdefaultColor() {
    $backgroundColor = [];
    $borderColor = [];
    $randomcolors = [];

    $hues = RandomColor::getHues();
    $luminosity = RandomColor::getLuminosity();


    for($i=0; $i<count($this->group[$this->index]['data']); $i++) {
      $luminosityIndex = floor($i / count($hues));
      $j = $i % count($hues);
      try {
        $options = [
          'format'=>'rgb', 
          'hue'=>[$hues[$j]], 
          'luminosity'=>$luminosity[$luminosityIndex]
        ];
      } catch(\ErrorException $e) {
        $options = [
          'format'=>'rgb'
        ];
      }
      array_push($randomcolors, RandomColor::one($options));
    }

    foreach( $randomcolors as $c) {
      array_push($borderColor, 'rgba('.$c["r"].', '.$c["g"].', '.$c["b"].', 1)');
      array_push($backgroundColor, 'rgba('.$c["r"].', '.$c["g"].', '.$c["b"].', 0.2)');
    }

    $this->group[$this->index]['backgroundColor'] = $backgroundColor;
    $this->group[$this->index]['borderColor'] = $borderColor;

    return $this;
  }

  public function setRandomBarColor() {
    $backgroundColor = [];
    $borderColor = [];
    $randomcolors = RandomColor::many(count($this->group[$this->index]['data']), array('format'=>'rgb', 'luminosity'=>'bright'));
    foreach( $randomcolors as $c) {
      array_push($borderColor, 'rgba('.$c["r"].', '.$c["g"].', '.$c["b"].', 1)');
      array_push($backgroundColor, 'rgba('.$c["r"].', '.$c["g"].', '.$c["b"].', 0.2)');
    }

    $this->group[$this->index]['backgroundColor'] = $backgroundColor;
    $this->group[$this->index]['borderColor'] = $borderColor;

    return $this;
  }

  public function build() {
    return $this->group;
  }
}

class Options
{

  public $responsive = false;
  public $legend = ['display'=>true, 'position'=> 'top'];
  public $title = [
        'display'=> false,
        'text' => null
  ];

  public function __construct($p)
  {
    $this->parent = $p;
  }

  public function setTitle($text) {
    $this->title = ['display'=>true, 'text'=>$text];
  }

  public function build() {
    return  [
      'responsive'=> $this->responsive,
      'plugins'=> [
        'legend'=> $this->legend,
        'title'=> $this->title
      ]
    ];
  }
}

class DefaultColors {
  public static $colours = [
    [ // blue
      "fillColor" => "rgba(151,187,205,0.2)",
      "strokeColor" => "rgba(151,187,205,1)",
      "pointColor" => "rgba(151,187,205,1)",
      "pointStrokeColor" => "#fff",
      "pointHighlightFill" => "#fff",
      "pointHighlightStroke" => "rgba(151,187,205,0.8)"
    ],[ // light grey
      "fillColor" => "rgba(220,220,220,0.2)",
      "strokeColor" => "rgba(220,220,220,1)",
      "pointColor" => "rgba(220,220,220,1)",
      "pointStrokeColor" => "#fff",
      "pointHighlightFill" => "#fff",
      "pointHighlightStroke" => "rgba(220,220,220,0.8)"
    ],[ // red
      "fillColor" => "rgba(247,70,74,0.2)",
      "strokeColor" => "rgba(247,70,74,1)",
      "pointColor" => "rgba(247,70,74,1)",
      "pointStrokeColor" => "#fff",
      "pointHighlightFill" => "#fff",
      "pointHighlightStroke" => "rgba(247,70,74,0.8)"
    ],[ // green
      "fillColor" => "rgba(70,191,189,0.2)",
      "strokeColor" => "rgba(70,191,189,1)",
      "pointColor" => "rgba(70,191,189,1)",
      "pointStrokeColor" => "#fff",
      "pointHighlightFill" => "#fff",
      "pointHighlightStroke" => "rgba(70,191,189,0.8)"
    ],[ // yellow
      "fillColor" => "rgba(253,180,92,0.2)",
      "strokeColor" => "rgba(253,180,92,1)",
      "pointColor" => "rgba(253,180,92,1)",
      "pointStrokeColor" => "#fff",
      "pointHighlightFill" => "#fff",
      "pointHighlightStroke" => "rgba(253,180,92,0.8)"
    ],[// grey
      "fillColor" => "rgba(148,159,177,0.2)",
      "strokeColor" => "rgba(148,159,177,1)",
      "pointColor" => "rgba(148,159,177,1)",
      "pointStrokeColor" => "#fff",
      "pointHighlightFill" => "#fff",
      "pointHighlightStroke" => "rgba(148,159,177,0.8)"
    ],[ // dark grey
      "fillColor" => "rgba(77,83,96,0.2)",
      "strokeColor" => "rgba(77,83,96,1)",
      "pointColor" => "rgba(77,83,96,1)",
      "pointStrokeColor" => "#fff",
      "pointHighlightFill" => "#fff",
      "pointHighlightStroke" => "rgba(77,83,96,1)"
    ]
];
}

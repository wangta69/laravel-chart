<?php

/*
* This file is inspired by Builder from Laravel Chartjs - Brian Faust and Laravel Chartjs - Felix Costa
*/

namespace Pondol\Charts\Builder;

// use IcehouseVentures\LaravelChartjs\Support\Config;
use Illuminate\Support\Arr;

class ChartJs
{
  // Chart.js/4
  // private $options;
  private $defaultOptions = [
    'responsive'=> 'true',
    'plugins'=> [
      'legend'=> ['position'=> 'top']
    ],
    'title'=> [
      'display'=> 'true',
      'text' => 'Chart Title'
    ]
  ];

  public function __construct()
  {
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
  public function datasets(array $datasets)
  {
    return $this->set('datasets', $datasets);
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
  public function options(array $options)
  {
    $options = array_merge_recursive($options, $this->defaultOptions);
     return $this->set('options', $options);
  }

  /**
   * @return mixed
   */
  public function render()
  {
    $options = $this->options ?? $this->defaultOptions;
  
    return (object)[
      'datasets' => json_encode($this->datasets),
      'element' => $this->element,
      'labels' => json_encode($this->labels),
      'options' => json_encode($options),
      'type' => $this->type,
    ];
  }

/**
   * @return Builder
   */
  public function set($key, $value)
  {
    $this->{$key} = $value;
    return $this;
  }
}

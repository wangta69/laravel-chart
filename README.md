# Charts For Laravel

> 현재는 chart.js v4 만을 지원합니다.  <br>
## installation
```
composer require wangta69/laravel-chart
```

## How to
```
use Pondol\Charts\Facades\Chartjs;

..........
$data = ['all'=>['jan'=>34, 'feb'=>56...], 'unique'=>[...]]
..........
$chart = Chartjs::
  type('line')
  ->element('dailyChart')
  ->labels(array_keys($data['all']))
  ->datasets(function($dataset) use($data) {
      $dataset->setLabel("# all");
      $dataset->setData(array_values($data['all']));
      $dataset->setBorderWidth(1);
  })
  ->datasets(function($dataset) use($data) {
    $dataset->setLabel("# unique");
    $dataset->setData(array_values($data['unique']));
    $dataset->setBorderWidth(1);
  })
  ->options(function($option) {
    $option->setTitle('Daily visitor');
  })
  ->build();
```
- blade
```
<x-chart::chartjs :chart="$chart"/>
```

### refresh
> 여러개의 chart를 사용할 경우 refresh()를 이용하여 먼저 선언된 내용을 지워주어야 한다.
```
$chart = Chartjs::refresh()->type('line').....
```

###  bar
```
$chartData = array_column($data , 'count');
  $chart = Chartjs::refresh()
  ->type('bar')
  ->element('countryChart')

  ->datasets(function($dataset) use($data) {
    $dataset->setData(array_column($data , 'count'));
    $dataset->setdefaultColor();
  })

  ->labels(array_column($data , 'country'));
  $chart = $chart->options(function($option) {
    $option->legend['display'] = false;
    $option->setTitle('Nationals');
  })
  ->build();
```


# 방문자 통계 For Laravel

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
  ->datasets([
    [
      'label' => '# all',
      'data' => array_values($data['all']),
      'borderWidth' => 1
    ],
    [
      'label' => '# unique',
      'data' => array_values($data['unique']),
      'borderWidth' => 1
    ]
  ])
  ->options(['title'=>['text'=>'ryu....']])->render();
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


<script>
var ctx = document.getElementById('{!! $chart->element !!}').getContext('2d');
var data = {
  labels: {!! $chart->labels !!},
  datasets: {!! $chart->datasets !!}
};
var options = {!! $chart->options !!}

var config = {
  type: '{!! $chart->type !!}',
  data: data,
  options: options
};
new Chart(ctx, config);
</script>

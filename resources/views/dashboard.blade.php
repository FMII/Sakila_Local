@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@if(session('error'))
<div class="container-fluid">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-circle mr-2" style="font-size: 1.25rem;"></i>
            <strong>{{ session('error') }}</strong>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $actorsCount }}</h3>
                        <p>Actores</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('actors.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $filmsCount }}</h3>
                        <p>Películas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-film"></i>
                    </div>
                    <a href="{{ route('films.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $categoriesCount }}</h3>
                        <p>Categorías</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="{{ route('categories.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- Agrega más cajas pequeñas según tus necesidades -->
        </div>
        <!-- /.row -->

        <!-- Gráficas -->
        <div class="row">
            <div class="col-md-6">
                <!-- PIE CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Distribución de Películas por Categoría</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" data-category-names="{{ json_encode($categoryNames) }}" data-films-per-category="{{ json_encode($filmsPerCategory) }}" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
                <!-- BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Películas por Año</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="barChart" data-years="{{ json_encode($years) }}" data-films-per-year="{{ json_encode($filmsPerYear) }}" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@section('scripts')
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script>
    $(function () {
        // Obtener datos de los atributos data-*
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var categoryNames = JSON.parse($('#pieChart').attr('data-category-names'));
        var filmsPerCategory = JSON.parse($('#pieChart').attr('data-films-per-category'));

        console.log('categoryNames:', categoryNames);
        console.log('filmsPerCategory:', filmsPerCategory);

        var pieData = {
            labels: categoryNames,
            datasets: [{
                data: filmsPerCategory,
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        };
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        });

        // Obtener datos de los atributos data-*
        var barChartCanvas = $('#barChart').get(0).getContext('2d');
        var years = JSON.parse($('#barChart').attr('data-years'));
        var filmsPerYear = JSON.parse($('#barChart').attr('data-films-per-year'));

        console.log('years:', years);
        console.log('filmsPerYear:', filmsPerYear);

        var barData = {
            labels: years,
            datasets: [{
                label: 'Películas',
                backgroundColor: '#00a65a',
                borderColor: '#00a65a',
                data: filmsPerYear
            }]
        };
        var barOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        };
        new Chart(barChartCanvas, {
            type: 'bar',
            data: barData,
            options: barOptions
        });
    });
</script>
@endsection
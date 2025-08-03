<x-layout title='Home'>
    <!-- Body Content Wrapper -->

    <div class="ms-content-wrapper">
       
            <div class="row">

                <div class="col-xl-3 col-md-6 col-sm-6">
                    <a href="">
                        <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                            <div class="ms-card-body media">
                                <div class="media-body">
                                    <h6>Médicos</h6>
                                    <p class="ms-card-change"> 1500</p>
                                </div>
                            </div>
                            <i class="fas fa-stethoscope ms-icon-mr"></i>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6">
                    <a href="#">
                        <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                            <div class="ms-card-body media">
                                <div class="media-body">
                                    <h6>Cooperados</h6>
                                    <p class="ms-card-change"> 25035</p>
                                </div>
                            </div>
                            <i class="fas fa-user-plus ms-icon-mr"></i>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6">
                    <a href="#">
                        <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                            <div class="ms-card-body media">
                                <div class="media-body">
                                    <h6 class="bold">Titulares</h6>
                                    <p class="ms-card-change"> 50000</p>
                                </div>
                            </div>
                            <i class="fa fa-wheelchair ms-icon-mr"></i>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6">
                    <a href="">
                        <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                            <div class="ms-card-body media">
                                <div class="media-body">
                                    <h6 class="bold">Dependentes</h6>
                                    <p class="ms-card-change">120500 </p>
                                </div>
                            </div>
                            <i class="fas fa-briefcase-medical ms-icon-mr"></i>
                        </div>
                    </a>
                </div>

                <div class="col-xl-6 col-lg-12">
                    <div class="ms-panel ms-device-sessions ms-quick-mic">
                        <div class="ms-panel-header">
                            <h6>Departamentos Afetados</h6>
                        </div>
                        <div class="ms-panel-body">
                            <div class="row">
                                <div class="col-xl-4 col-md-4 col-sm-4 col-6 ms-device">
                                    <i class="material-icons">airline_seat_flat</i>
                                    <h4>UTI Adulto</h4>
                                    <p class="ms-text-primary">45.07%</p>
                                    <span class="ms-text-primary">201,434</span>
                                </div>
                                <div class="col-xl-4 col-md-4 col-sm-4 col-6 ms-device">
                                    <i class="material-icons">airline_seat_individual_suite</i>
                                    <h4>Clínica 4</h4>
                                    <p class="ms-text-danger">29.05%</p>
                                    <span class="ms-text-danger">134,693</span>
                                </div>
                                <div class="col-xl-4 col-md-4 col-sm-4 col-6 ms-device">
                                    <i class="material-icons">accessible</i>
                                    <h4>Clinica 1</h4>
                                    <p class="ms-text-warning">18.43%</p>
                                    <span class="ms-text-warning">81,525</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 45.07%"
                                    aria-valuenow="45.07" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 29.05%"
                                    aria-valuenow="29.05" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 25.48%"
                                    aria-valuenow="25.48" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="ms-panel">
                        <div class="ms-panel-header d-flex justify-content-between">
                            <h6>Médicos com Ocorrências</h6>
                            <div class="ms-slider-arrow">
                                <a href="#" class="prev-item">
                                    <i class="far fa-caret-square-left"></i>
                                </a>
                                <a href="#" class="next-item">
                                    <i class="far fa-caret-square-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ms-panel-body d-flex justify-content-between p-5 ms-medical-overview-slider">
                        
                               
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-12">
                    <div class="ms-panel">
                        <div class="ms-panel-header" style="display:flex; justify-content: space-between;">
                            <h6>Total de Pacientes</h6>
                        </div>
                        <div class="ms-panel-body" style="height: 500px;">
                            <canvas id="patient-monthly-line-chart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-12">
                    <div class="ms-panel">
                        <div class="ms-panel-header" style="display:flex; justify-content: space-between;">
                            <h6>Total de Pacientes por Unidade</h6>
                        </div>
                        <div class="ms-panel-body" style="height: 500px;">
                            <canvas id="patient-line-by-unit-chart"></canvas>
                        </div>
                    </div>
                </div>


                <div class="col-xl-12 col-md-12">
                    <div class="ms-panel">
                        <div class="ms-panel-header">
                            <h6>Conclusão de Treinamentos</h6>
                        </div>
                        <div class="ms-panel-body">
                            <canvas id="bar-chart-grouped"></canvas>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</x-layout>